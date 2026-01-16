<?php
	if (!isset($_SERVER["argc"]))
	{
		echo "Invalid usage";
		exit();
	}

	chdir(dirname($_SERVER["argv"][0]));

	require_once "../lib/db_open.inc.php";
	require_once "../lib/common.inc.php";

	$export_dir = "../export_xml";
	$export_state_file = $export_dir . "/export_state.json";
	$export_batch_size = 100;

	$export_state = array(
		"last_aid" => -1,
		"last_mid" => -1,
	);

	if (!file_exists($export_dir) && mkdir($export_dir, 0750) == false)
	{
		echo ("Create dir error!");
		exit(-1);
	}

	if(file_exists($export_state_file))
	{
		$export_state_json = file_get_contents($export_state_file);
		if ($export_state_json !== false)
		{
			$export_state_loaded = json_decode($export_state_json, true);
			if (isset($export_state_loaded["last_aid"]))
			{
				$export_state["last_aid"] = intval($export_state_loaded["last_aid"]);
			}
			if (isset($export_state_loaded["last_mid"]))
			{
				$export_state["last_mid"] = intval($export_state_loaded["last_mid"]);
			}
		}
	}

	if ($export_state["last_mid"] == -1)
	{
		$sql = "SELECT MID FROM bbs_article_op ORDER BY MID DESC LIMIT 1";

		$rs = mysqli_query($db_conn, $sql);
		if ($rs == false)
		{
			echo "Query article log error: " . mysqli_error($db_conn);
			mysqli_close($db_conn);
			exit(-2);
		}

		if ($row = mysqli_fetch_array($rs))
		{
			$export_state["last_mid"] = intval($row["MID"]);
		}

		mysqli_free_result($rs);
	}

	$ret = 0;
	while ($ret == 0)
	{
		$sql = "SELECT AID FROM bbs WHERE AID > " . $export_state["last_aid"] .
				" AND TID = 0 AND visible ORDER BY AID LIMIT $export_batch_size";

		$rs = mysqli_query($db_conn, $sql);
		if ($rs == false)
		{
			echo "Query article list error: " . mysqli_error($db_conn);
			$ret = -2;
			break;
		}

		$last_aid = $export_state["last_aid"];

		while($row = mysqli_fetch_array($rs))
		{
			$last_aid = intval($row["AID"]);

			$buffer = shell_exec($PHP_bin . " ../bbs/view_article.php export_xml " . $row["AID"]);
			if (!$buffer || ($buffer[0] == "<" && file_put_contents($export_dir . "/" . $row["AID"] . ".xml", $buffer) == false))
			{
				echo ("Write " . $row["AID"] . ".xml error!");
				$ret = -3;
				break;
			}
			echo $row["AID"] . "\n";
		}

		mysqli_free_result($rs);

		if ($ret != 0)
		{
			break;
		}

		if ($export_state["last_aid"] == $last_aid)
		{
			break;
		}
		$export_state["last_aid"] = $last_aid;

		file_put_contents($export_state_file, json_encode($export_state));
	}

	while($ret == 0)
	{
		$sql = "SELECT MID, bbs.AID, bbs.TID, type FROM bbs_article_op
				INNER JOIN bbs ON bbs_article_op.AID = bbs.AID
				WHERE MID > " . $export_state["last_mid"] .
				" AND type NOT IN ('A') ORDER BY MID LIMIT $export_batch_size";

		$rs = mysqli_query($db_conn, $sql);
		if ($rs == false)
		{
			echo "Query article log error: " . mysqli_error($db_conn);
			$ret = -4;
			break;
		}

		$export_aid_list = array();
		$delete_aid_list = array();

		$last_mid = $export_state["last_mid"];

		while($row = mysqli_fetch_array($rs))
		{
			$last_mid = intval($row["MID"]);
			$aid = ($row["TID"] == 0 ? $row["AID"] : $row["TID"]);

			switch ($row["type"])
			{
				case 'D': // Delete article
				case 'X': // Delete article by Admin
					if ($row["TID"] == 0)
					{
						// Topic
						unset($export_aid_list[$aid]);
						$delete_aid_list[$aid] = true;
					}
					else
					{
						// Reply
						unset($delete_aid_list[$aid]);
						$export_aid_list[$aid] = true;
					}
					break;
				case 'S': // Restore article
				case 'M': // Modify article
				case 'T': // Move article
				case 'Z': // Set article as trnasship
					unset($delete_aid_list[$aid]);
					$export_aid_list[$aid] = true;
					break;
				default:
					// Unknown type
					break;
			}
		}

		mysqli_free_result($rs);

		foreach($delete_aid_list as $aid => $dummy)
		{
			$export_file = $export_dir . "/" . $aid . ".xml";

			$buffer = <<< HTML
			<delete>
				<id>{$aid}</id>
			</delete>

			HTML;

			if (file_put_contents($export_dir . "/" . $aid . ".xml", $buffer) == false)
			{
				echo ("Write " . $aid . ".xml error!");
				$ret = -3;
				break;
			}
			echo $aid . "\n";
		}

		if ($ret != 0)
		{
			break;
		}

		foreach($export_aid_list as $aid => $dummy)
		{
			$buffer = shell_exec($PHP_bin . " ../bbs/view_article.php export_xml " . $aid);
			if (!$buffer || ($buffer[0] == "<" && file_put_contents($export_dir . "/" . $aid . ".xml", $buffer) == false))
			{
				echo ("Write " . $aid . ".xml error!");
				$ret = -3;
				break;
			}
			echo $aid . "\n";
		}

		if ($ret != 0)
		{
			break;
		}

		unset($export_aid_list);
		unset($delete_aid_list);

		if ($export_state["last_mid"] == $last_mid)
		{
			break;
		}
		$export_state["last_mid"] = $last_mid;

		file_put_contents($export_state_file, json_encode($export_state));
	}

	mysqli_close($db_conn);

	exit($ret);

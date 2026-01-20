<?php
	// Prevent load standalone
	if (!isset($result_set))
	{
		exit();
	}

	require_once "../lib/lml.inc.php";
	require_once "../lib/str_process.inc.php";

	$xsl_file = get_theme_file('xsl/1');

	$title = htmlspecialchars($result_set["data"]["title"], ENT_HTML401, 'UTF-8');

	header('Content-Type: text/xml; charset=UTF-8');

	echo <<< HTML
	<add>

	HTML;

	foreach ($result_set["data"]["articles"] as $article)
	{
		$username = htmlspecialchars($article["username"], ENT_HTML401, 'UTF-8');
		$nickname = htmlspecialchars($article["nickname"], ENT_HTML401, 'UTF-8');
		$title = htmlspecialchars($article["title"], ENT_HTML401, 'UTF-8');
		$content = LML($article["content"], 1024);

		$transship_info = "";
		if ($article["transship"])
		{
			$transship_info = <<<HTML
				 [转载]
			HTML;
		}

		echo <<< HTML
			<doc>
				<field name="id">{$article["aid"]}</field>
				<field name="PostUserId">{$article["uid"]}</field>
				<field name="PostUserName">{$username}</field>
				<field name="PostUserNickName">{$nickname}</field>
				<field name="Credit">{$article["exp"]}</field>
				<field name="Photo">{$article["photo_path"]}</field>
				<field name="TopicId">{$article["tid"]}</field>
				<field name="SectionId">{$result_set["data"]["sid"]}</field>
				<field name="ArticleId">{$article["aid"]}</field>
				<field name="ArticleTitle">{$title}{$transship_info}</field>
				<field name="ExpressionIcon">{$article["icon"]}</field>
				<field name="PostDateTime">{$article["sub_dt"]->setTimezone(new DateTimeZone("UTC"))->format("Y-m-d H:i:s")}</field>
				<field name="PostIP">{$article["sub_ip"]}</field>
				<field name="Content"><![CDATA[{$content}]]></field>
				<field name="Length">{$article["length"]}</field>
				<field name="Excerption">{$article["excerption"]}</field>
			</doc>

		HTML;
	}

	echo <<< HTML
	</add>

	HTML;

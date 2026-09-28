<?php
function verify_pass_complexity(string $password, string $username, int $min_len) : bool
{
	$num_count = 0;
	$upper_case = 0;
	$lower_case = 0;
	$len = strlen($password);

	if ($len < $min_len)
	{
		return false;
	}

	if ($username != "" && stristr($password, $username) !== false)
	{
		return false;
	}

	for ($i = 0; $i < $len; $i++)
	{
		$c = $password[$i];

		if (ctype_digit($c))
		{
			$num_count++;
		}

		if (ctype_upper($c))
		{
			$upper_case++;
		}

		if (ctype_lower($c))
		{
			$lower_case++;
		}
	}

	if ($upper_case == 0 || $lower_case == 0 || $num_count == 0)
	{
		return false;
	}

	return true;
}

function gen_passwd(int $len) : string
{
	// Character set kept consistent with the historical output
	// (digits, upper case letters, lower case letters)
	$charset = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
	$charset_len = strlen($charset);
	$str = "";

	for ($i = 0; $i < $len; $i++)
	{
		// random_int() is a cryptographically secure source of randomness;
		// mt_rand() / mt_srand() must never be used to generate passwords
		$str .= $charset[random_int(0, $charset_len - 1)];
	}

	return $str;
}

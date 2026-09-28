<?php
function ip_mask(string $ip, int $level = 2, string $mask = "*") : string
{
	if ($level <= 0)
	{
		return $ip;
	}
	if ($level > 4)
	{
		$level = 4;
	}

	$ips = explode(".", $ip);

	// Octet-wise masking is only defined for IPv4 addresses.
	// Anything else (empty value, IPv6, hostname...) is returned unchanged,
	// because a partially masked value cannot be produced for it.
	if (count($ips) != 4)
	{
		return $ip;
	}

	$keep = 4 - $level;

	$ret = implode(".", array_slice($ips, 0, $keep));
	if ($keep > 0)
	{
		$ret .= ".";
	}

	return $ret . implode(".", array_fill(0, $level, $mask));
}

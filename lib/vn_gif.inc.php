<?php
function VN_gif_display(string $str) : void
{
	if (!function_exists("imagecreate"))
	{
		// The GD extension is mandatory for captcha rendering.
		// dl() cannot be used instead: dynamically loading extensions is
		// no longer supported by PHP for web SAPIs (it always fails since PHP 8).
		http_response_code(500);
		exit("GD extension is required to render the captcha image.");
	}

	$im = imagecreate(60, 25);
	if ($im === false)
	{
		http_response_code(500);
		exit("Cannot initialize new GD image stream");
	}

	imagecolorallocate($im, 230, 230, 230); // background

	$len = strlen($str);
	for ($i = 0; $i < $len; $i++)
	{
		$text_color = imagecolorallocate($im,
			30 + random_int(0, 100), 30 + random_int(0, 100), 30 + random_int(0, 100));
		imagestring($im, 10 + random_int(0, 4), $i * 14 + random_int(5, 10),
			random_int(2, 7), $str[$i], $text_color);
	}

	//output image
	header("Content-type: image/png");
	imagepng($im);
	imagedestroy($im);
}

function VN_gen_str(int $len) : string
{
	$charset = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
	$charset_len = strlen($charset);
	$str = "";

	for ($i = 0; $i < $len; $i++)
	{
		// Verification codes must not be predictable: use a CSPRNG
		$str .= $charset[random_int(0, $charset_len - 1)];
	}

	return $str;
}

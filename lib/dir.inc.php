<?php
function delTree(string $dir) : bool
{
	$files = @scandir($dir);
	if ($files === false)
	{
		return false;
	}

	foreach (array_diff($files, array('.', '..')) as $file)
	{
		if (is_dir("$dir/$file"))
		{
			if (!delTree("$dir/$file"))
			{
				return false;
			}
		}
		else if (!unlink("$dir/$file"))
		{
			return false;
		}
	}

	return rmdir($dir);
}

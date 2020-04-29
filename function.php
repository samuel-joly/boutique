<?php

	function checkImage($image)
	{
		$type = pathinfo($image["name"], PATHINFO_EXTENSION);
		if($type == 'jpg' || $type == 'png' || $type == 'gif' || $type == 'PNG')
		{
			return true;
		}
		else
		{
			return false;
		}

	}






?>

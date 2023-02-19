<?php
	function securite_bdd($string)
	{		
		if(ctype_digit($string))
		{
			$string = intval($string);
		}
		else
		{
			$string = mysql_real_escape_string($string);
			$string = addcslashes($string, '%_');
		}
		
		return $string;
	}
?>
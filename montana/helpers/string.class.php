<?php 

class String 
{
	//ENCRYPT
	//GET KEY VALUE
	private static function encGetKey($key) 
	{ 
		$len = strlen($key);
		$keyValue = 0;
		for ($i=0; $i<$len; $i++) 
		{ 
			if (is_numeric(substr($key, $i, 1))) 
				$keyValue += substr($key, $i, 1);
			else 
				$keyValue += ord(substr($key, $i, 1));
		}
		return $keyValue;
	}
	//ENCRYPT STRING USING KEY
	public static function stringEncrypt($key, $string) 
	{ 
		$keyValue = self::encGetKey($key);
		$len = strlen($string);
		$newString = '';
		for ($i=0; $i<$len; $i++) 
		{ 
			$chr = substr($string, $i, 1);
			$value = ord($chr)+$keyValue;
			$newString .= chr($value);
		}	
		$newString = utf8_encode($newString);
		return $newString;
	}
	//DECRYPT STRING USING KEY
	public static function stringDecrypt($key, $string) 
	{ 
		$string = utf8_decode($string);
		$keyValue = self::encGetKey($key);
		$len = strlen($string);
		$newString = '';
		for ($i=0; $i<$len; $i++) 
		{ 
			$chr = substr($string, $i, 1);
			$value = ord($chr)-$keyValue;
			$newString .= chr($value);
		}	
		return $newString;
	}
}
?>
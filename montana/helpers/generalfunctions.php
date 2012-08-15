<?php	
function formatNumber($number, $decPlaces = 0, $tensSeparator = '.', $thousandSeparator = ',')
{
	return number_format($number, $decPlaces, $tensSeparator, $thousandSeparator);
}

function limitString($string, $newSize, $stripTags = false)
{
	if($stripTags)
		$string = strip_tags($string);
	$string = htmlspecialchars_decode($string);
	$string = substr($string, 0, $newSize);
	
	return $string;
}

function isSerialized($str) 
{
    return ($str == serialize(false) || @unserialize($str) !== false);
}
function documentURLName($document)
{
	return urlencode(str_replace(" ", "_", $document));
}
function escape($string)
{
    $connection	= Connection::getInstance();
	if(function_exists("mysql_real_escape_string"))
		$string = mysql_real_escape_string($string);
	elseif(function_exists("mysql_escape_string"))
		$string = mysql_escape_string($string);
	else
		$string = str_replace("'", "\\'", $string);
	
	return $string;
}
function montanaPrint($var)
{
	echo '<pre>';
	print_r($var);
	echo '</pre>';
}

function makeCleanTitle($string)
{
	return urlencode(str_replace(" ", "-", strtolower($string)));
}

function selfURL() 
{ 
	$s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : ""; 
	$protocol = strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/").$s; 
	$port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]); 
	return $protocol."://".$_SERVER['SERVER_NAME'].$port.$_SERVER['REQUEST_URI']; 
} 

function strleft($s1, $s2) 
{ 
	return substr($s1, 0, strpos($s1, $s2)); 
}

function ceil_hundreds($num)
{
	 return (ceil($num / 100) * 100); 	
}
function ceiling_hundreds($num)
{
	 return (ceil($num / 100) * 100); 	
}

function uc_latin1($str)
{
	$LATIN1_UC_CHARS = "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝ";
	$LATIN1_LC_CHARS= "àáâãäåæçèéêëìíîïðñòóôõöøùúûüý";

		$str = strtoupper(strtr($str, $LATIN1_LC_CHARS, $LATIN1_UC_CHARS));
		return strtr($str, array("ß" => "SS"));
}

function validMayus($str)
{

	$search  = array('á', 'é', 'í', 'ó', 'ú');
	$replace = array('Á', 'É', 'Í', 'Ó', 'Ú');
	echo str_replace($search, $replace, $str);
}

function validImages($image,$ruta = '83x83')
{
	if(strripos($image, 'profile') !== false)
		$imageProfile	= $image;
	elseif(strlen(trim($image))>1)
		$imageProfile	= APPLICATION_URL.'resources/images/'.$ruta.'/'.$image;	
	else
		$imageProfile	= APPLICATION_URL.'resources/images/'.$ruta.'/default.gif';
	
	return $imageProfile;
}
function searchResource($id,$nameField = 'content_gallery_1',$defaul = 'default.gif')
{
	$images = ResourceHelper::getGallery($id,$nameField);
	$image	= (count($images)>0) ? $images[0]->__get('resource_file') : $defaul;
	return $image;
}
function encrypt($decrypted, $password, $salt='!kQm*fF3pXe1Kbm%9') { 
 // Build a 256-bit $key which is a SHA256 hash of $salt and $password.
 $key = hash('SHA256', $salt . $password, true);
 // Build $iv and $iv_base64.  We use a block size of 128 bits (AES compliant) and CBC mode.  (Note: ECB mode is inadequate as IV is not used.)
 srand(); $iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC), MCRYPT_RAND);
 if (strlen($iv_base64 = rtrim(base64_encode($iv), '=')) != 22) return false;
 // Encrypt $decrypted and an MD5 of $decrypted using $key.  MD5 is fine to use here because it's just to verify successful decryption.
 $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $decrypted . md5($decrypted), MCRYPT_MODE_CBC, $iv));
 // We're done!
 return $iv_base64 . $encrypted;
 } 

function decrypt($encrypted, $password, $salt='!kQm*fF3pXe1Kbm%9') {
 // Build a 256-bit $key which is a SHA256 hash of $salt and $password.
 $key = hash('SHA256', $salt . $password, true);
 // Retrieve $iv which is the first 22 characters plus ==, base64_decoded.
 $iv = base64_decode(substr($encrypted, 0, 22) . '==');
 // Remove $iv from $encrypted.
 $encrypted = substr($encrypted, 22);
 // Decrypt the data.  rtrim won't corrupt the data because the last 32 characters are the md5 hash; thus any \0 character has to be padding.
 $decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, base64_decode($encrypted), MCRYPT_MODE_CBC, $iv), "\0\4");
 // Retrieve $hash which is the last 32 characters of $decrypted.
 $hash = substr($decrypted, -32);
 // Remove the last 32 characters from $decrypted.
 $decrypted = substr($decrypted, 0, -32);
 // Integrity check.  If this fails, either the data is corrupted, or the password/salt was incorrect.
 if (md5($decrypted) != $hash) return false;
 // Yay!
 return $decrypted;
 }
?>

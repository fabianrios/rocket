<?php
function retrieveFullURL() 
{
	$pageURL = 'http';
	
	if (isset($_SERVER["HTTPS"]) && ($_SERVER["HTTPS"] == "on")) 
		$pageURL .= "s";
	$pageURL .= "://";
	
	if ($_SERVER["SERVER_PORT"] != "80") 
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	else 
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	return $pageURL;
}

function retrieveClientIp()
{	

	if( isset( $_SERVER ['HTTP_X_FORWARDED_FOR'] ) ) 
		$ip = $_SERVER ['HTTP_X_FORWARDED_FOR'];  	
	elseif( isset( $_SERVER ['HTTP_VIA'] ) ) 
		$ip = $_SERVER ['HTTP_VIA'];	
	elseif( isset( $_SERVER ['REMOTE_ADDR'] ) )	
		$ip = $_SERVER ['REMOTE_ADDR'];	
	else
		$ip = "Anonima" ;	
	return $ip;
}

function formatDate($format = false, $date = 'now')
{
	if($date == 'now')
	{
		if($format)
			return strftime($format);
		else
			return strftime(APPLICATION_DATE_FORMAT);
	}
	else
	{
		if($format)
			return strftime($format, strtotime($date));
		else
			return strftime(APPLICATION_DATE_FORMAT,  strtotime($date));			
	}
}

function retrieveCurrentDirectory() 
{
	$path     = dirname($_SERVER['PHP_SELF']);
	$position = strrpos($path,'/') + 1;
	
	return substr($path,$position);
}



function redirectUrl($url)
{
	try 
	{
		header("location: " . $url);
	} 
	catch (Exception $e) 
	{
		echo '<script language="Javascript">';
		echo '	window.location.href="$url"';
		echo '</script>';	
	}
}	



function uploadFile($path, $tempName, $name)
{
	$fullName =  $path . $name;
	if (move_uploaded_file($tempName, $fullName)) 
		return true;
	else
		return false;
}

function getFileExtension($fileName)
{
	$pos = strrpos($fileName, '.');
	if($pos != false)
		return strtolower(substr($fileName, $pos));
	else
		return false;
}
function javascriptAlert($msg) 
{

	echo '<script language="javascript">';
	echo 'alert('.$msg.')';
    echo '</script>';
}

function javascriptExecute($line) 
{

	echo '<script language="javascript">';
	echo $line;
    echo '</script>';
}

function getDaysInMonth($month,$year)
{
	return cal_days_in_month(CAL_GREGORIAN,$month,$year);
}
function sizeImages($fileImages,$sizeImages,$directory = '')
{
	
	$myimagesserv = $_SERVER['DOCUMENT_ROOT'].'/ideko-web/resources/images/'.$fileImages;
	$img = ImageCreateFromJpeg($myimagesserv);
	if($sizeImages > ImageSX($img))
		$directory = '';
	else
		$directory .= '/';
		
	$viewImages = APPLICATION_URL.'/resources/images/'.$directory.$fileImages;	
	return $viewImages;
}
function dateSpanish($date = 'now', $format=1)
{
	$newFormatDate	= '';
	$arrayDates		= array();
	$months 		= array('01'=>'Enero','02'=>'Febrero','03'=>'Marzo','04'=>'Abril','05'=>'Mayo','06'=>'Junio','07'=>'Julio','08'=>'Agosto','09'=>'Septiembre','10'=>'Octubre','11'=>'Noviembe','12'=>'Diciembre');
	$days			= array(1=>'Lunes',2=>'Martes',3=>'Mi&eacute;rcoles',4=>'Jueves',5=>'Viernes',6=>'S&aacute;bado',7=>'Domingo');
	if($date == 'now')
	{
		$arrayDates['nameMonth'] 	= $months[formatDate('%m')];
		$arrayDates['nameMonthN'] 	= formatDate('%m');
		$arrayDates['nameDay']		= $days[formatDate('%u')];
		$arrayDates['nameDayN']		= formatDate('%d');
		$arrayDates['Year']			= formatDate('%Y');
		$arrayDates['YearN']			= formatDate('%y');
	}
	else
	{
		$arrayDates['nameMonth'] 	= $months[formatDate('%m',$date)];
		$arrayDates['nameMonthN'] 	= formatDate('%m',$date);
		$arrayDates['nameDay']		= $days[formatDate('%u',$date)];
		$arrayDates['nameDayN']		= formatDate('%d',$date);
		$arrayDates['Year']			= formatDate('%Y',$date);
		$arrayDates['YearN']		= formatDate('%y',$date);
	}
	switch($format)
	{
		case 1: //Domingo 31 / Noviembre, 2011
			$newFormatDate .= $arrayDates['nameDay'].' '.$arrayDates['nameDayN'].' / <em>'.$arrayDates['nameMonth'].', '.$arrayDates['Year'].'</em>';
		break;
		
		case 2: //Diciembre 20
			$newFormatDate .= $arrayDates['nameMonth'].' '.$arrayDates['nameDayN'];
		break;
		case 3: //FEB 19	
			$newFormatDate .= '<span>'.substr($arrayDates['nameMonth'],0,3).'<strong>'.$arrayDates['nameDayN'].'</strong></span>';
		break;
		case 4: //Febrero 10/2011
			$newFormatDate .= $arrayDates['nameMonth'].' '.$arrayDates['nameDayN'].'/'.$arrayDates['Year'];	
		break;
		case 5: //2/Noviembre/2010 
			$newFormatDate .= $arrayDates['nameDayN'].'/'.$arrayDates['nameMonth'].'/'.$arrayDates['Year'];
		break;
		case 6: //15 Enero
			$newFormatDate .= $arrayDates['nameDayN'].' '.$arrayDates['nameMonth'];
		break;
		case 7: //12 Febrero 2011
			$newFormatDate .= $arrayDates['nameDayN'].' '.$arrayDates['nameMonth'].' '.$arrayDates['Year'];
		break;
		
		case 8: //Viernes 10 Abril de 2011
			$newFormatDate .= $arrayDates['nameDay'].' '.$arrayDates['nameDayN'].' '.$arrayDates['nameMonth'].' de '.$arrayDates['Year'];
		break;
	}
	return $newFormatDate;
}
function monthSpanish($numberMonth = 1)
{
	$months 		= array('01'=>'Enero','02'=>'Febrero','03'=>'Marzo','04'=>'Abril','05'=>'Mayo','06'=>'Junio','07'=>'Julio','08'=>'Agosto','09'=>'Septiembre','10'=>'Octubre','11'=>'Noviembe','12'=>'Diciembre');
	return $months[$numberMonth];
}
function makeUrlClear($str,$delimiter='-')
{	
		
		//$clean	= iconv("UTF-8", "ISO-8859-1//TRANSLIT//IGNORE", $str);
		$clean = iconv("ISO-8859-1", "UTF-8//TRANSLIT//IGNORE", $str);
		$clean = utf8_decode($clean);
		$clean = htmlentities($clean, ENT_QUOTES, "ISO-8859-1");
		//$clean	= iconv("UTF-8", "ISO-8859-1//TRANSLIT//IGNORE", $str);*/
		$clean = str_replace(',',$delimiter,$clean);
		$clean = str_replace(' ',$delimiter,$clean);
		$clean = str_replace('/<(.*)?>/is',$delimiter,$clean);
		$clean = str_replace('acute','',$clean);
		$clean = str_replace('tilde','',$clean);
		
		$clean = iconv('ISO-8859-1', 'ISO-8859-1//TRANSLIT', $clean);
		$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
		$clean = strtolower(trim($clean, '-'));
		$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

		return $clean;
}
function Selected($item = 'NULL',$value='NULL')
{
	if(trim($item) == trim($value))
		return 'selected="selected"';
	else
		return '';
}
?>
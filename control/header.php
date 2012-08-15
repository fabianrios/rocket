<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>MlM Control 3.0 : <?=APPLICATION_NAME?></title>
<link href="css/control2.css" rel="stylesheet" type="text/css" />
<link href="css/lightbox.css" rel="stylesheet" type="text/css" />
<link href="css/cropper.css" rel="stylesheet" type="text/css" />
<script language="javascript">
var ApplicationUrl = '<?=APPLICATION_URL?>';
</script>
<?php
foreach(explode(',', CONTROL_SCRIPTS) as $script)
{
	echo '<script src="' . $script . '" type="text/javascript"></script>
	';
}
?>
</head>
<body>
<div id="wrapper">
    <div id="header"> <a class="logo" href="#">
      <h1>Control 3.0</h1>
      </a>
    <div class="logo_empresa">
      <h2><?=APPLICATION_NAME?></h2>
    </div>
    <?php
	if(isset($controlUser))
	{
		$header->displayIdentifyUser();
	}
	?>			
</div>
<div id="menu01">
	<?php
		if(isset($controlUser))
		{
			$header->displayMenu();
		}
	?>
</div>
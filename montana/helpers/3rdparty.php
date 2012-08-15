<?php
function youtubeEmbed($key, $height, $width)
{
	$key = explode('=',$key);
	$key = $key[1];
	$object = '<object width="'.$width.'" height="'.$height.'">
			<param name="movie" value="">
			</param>				   
			<param name="allowFullScreen" value="true">
			</param>
			<param name="allowscriptaccess" value="always">
			</param>
			<embed src="http://www.youtube.com/v/'.$key.'&hl=es&fs=1&rel=0&color1=0x2b405b&color2=0x6b8ab6" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="'.$width.'" height="'.$height.'"></embed>
		  </object>';
	return $object;
}
?>
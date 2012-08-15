<?php
$doc = new DOMDocument();
$doc->load( 'lang/language' . strtoupper(LANG_NAME) . '.xml' );
$sentences = $doc->getElementsByTagName( 'caption' );
foreach( $sentences as $sentence )
{
	define($sentence->getAttribute("name"), utf8_decode($sentence->nodeValue));
}
?>
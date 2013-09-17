<?php 
/*
otterphotos.php v0.1
by Geoffrey Hofman-Frethem
@GSeven330
https://github.com/gfrethem/otter

This file uses Flickr's REST API to return the 20 most recent
flickr photos tagged with "otter". It also creates a link to a gallery
that contains said photo.  These are then presented in a 5 x 4 square of 
square thumbnails.

*/

//Create SimpleXML object
$xml = 'http://ycpi.api.flickr.com/services/rest/?method=flickr.photos.search&api_key=91e45b9f013db661d2fc49a011b96586&per_page=23&tags=Otter&extras=url_sq&safe_search=1&content_type=1&in_gallery=1';
$xml = simplexml_load_file($xml);

//Reads xml data and creates XHTML for each image
for ($i = 0; $i < 20; $i++) 
{
	// Assigns string of url_sq of photo to $url
	$url = ((string)$xml->photos->photo[$i]->attributes()->url_sq);
	// Assigns string of title of photo to $title
	$title = ((string)$xml->photos->photo[$i]->attributes()->title);
	// Assigns string of id of photo to $id
	//Create SimpleXML object 
	$id = ((string)$xml->photos->photo[$i]->attributes()->id);
	$galleryxml = 'http://ycpi.api.flickr.com/services/rest/?method=flickr.galleries.getListForPhoto&api_key=91e45b9f013db661d2fc49a011b96586&per_page=1&photo_id=' . $id;
	$galleryxml = simplexml_load_file($galleryxml);
	// Assigns string of url to $galleryurl
	$galleryurl = ((string)$galleryxml->galleries->gallery[0]->attributes()->url);
	//echo XHTML for image
	echo '<a href="' . $galleryurl . '">';
	echo '<img src="' . $url . '" title="' . $title . '" alt="' . $title . '" /></a>';
	//On the 5th, 10th, and 15th image issue a line break
	if ($i == 4)
	{
		echo '<br/>';
	}
	else if ($i == 9)
	{
		echo '<br/>';
	}
	else if ($i == 14)
	{
		echo '<br/>';
	}
}

?>
<?php

function get_tags_for_url($url)
{
	global $blockedtags;
	global $extratags;
	
	$hash = md5($url);
	$infourl = 'http://feeds.delicious.com/v2/json/urlinfo/data?hash='.$hash;
	$curlhandle = curl_init();
	curl_setopt($curlhandle, CURLOPT_URL, $infourl);
	curl_setopt($curlhandle, CURLOPT_RETURNTRANSFER, true);
	$inforesultjson = curl_exec($curlhandle);
	$inforesult = json_decode($inforesultjson, true);

error_log(print_r($inforesultjson, true));

	if (!isset($inforesult[0]))
		return array();

	$urlinfo = $inforesult[0];

	if (!isset($urlinfo['top_tags']))
		return array();

	$toptags = $urlinfo['top_tags'];
		
	return $toptags;
}

?>
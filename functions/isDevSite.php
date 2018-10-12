<?php

function isDevSite() {

	$isDEV = FALSE;

	$currentDomain = $_SERVER['HTTP_HOST'];

	$devDomainIdentifiers = array(
		'demo.golaika.com',
		'iroen.local',
		);

	foreach ($devDomainIdentifiers as $devDomainIdentifier) {
		if (strpos($currentDomain, $devDomainIdentifier) !== false) {
			$isDEV = TRUE;
		}
	}

	return $isDEV;

}
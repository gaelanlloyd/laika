<?php

function isDemoSite() {

	$isDemo = FALSE;

	$currentDomain = $_SERVER['HTTP_HOST'];

	$devDomainIdentifiers = array(
		'demo.golaika.com',
		);

	foreach ($devDomainIdentifiers as $devDomainIdentifier) {
		if (strpos($currentDomain, $devDomainIdentifier) !== false) {
			$isDemo = TRUE;
		}
	}

	return $isDemo;

}
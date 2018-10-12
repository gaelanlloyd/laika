<?php

function writeDebugLoadedFiles() {

	global $loadFile;

	$out = "";

	$out .= "<h5>" . $GLOBALS['txtLoadedFiles'] . "</h5>";
	$out .= "<pre>";

	foreach ($loadFile as $file) {
		$out .= $file;
		$out .= "\n";
	}

	$out .= "</pre>";

	return $out;

}
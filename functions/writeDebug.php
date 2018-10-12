<?php

function writeDebug() {

	global $DEBUG_ENABLE;
	global $DATABASE;
	global $TBL_SITES;
	global $TBL_METRICS;

	// If debugging is disabled, exit
	if (!$DEBUG_ENABLE) { return; }

	// Enable PHP debugging
	ini_set('display_errors', 'On');
	error_reporting(E_ALL);

	$out = "";

	$out .= "<hr>";
	$out .= "<div class=\"well debug\">";
	$out .= "<p class=\"mt0 pull-right\">" . $GLOBALS['txtLaikaDebuggerConsole'] . "</p>";
	// $out .= "<pre>" . $GLOBALS['txtDebuggingEnabled'] . "</pre>";

	// --- RUN DEBUGGING FUNCTIONS ---------------------------------------------
	$out .= "<h3 class=\"mt0\">System</h3>";
	$out .= writeDebugLoadedFiles();

	// --- TEST DATABASE RETRIEVAL ---------------------------------------------

	$out .= "<h3>Database</h3>";

	// --- List all [sites] ----------------------------------------------------

	$datas = $DATABASE->select($TBL_SITES, "*");

	$out .= "<h5>DB: Sites (" . count($datas) . ")</h5>";

	$out .= "<pre>";

	foreach ($datas as $data) {
		$out .= $data["id"] . " --> " . $data["name"] . "<br/>";
	}

	$out .= "</pre>";

	// --- List all [itemnames] ------------------------------------------------

	$datas = $DATABASE->select($TBL_METRICS, "*");

	$out .= "<h5>DB: Metrics (" . count($datas) . ")</h5>";

	$out .= "<pre>";

	foreach ($datas as $data) {
		$out .= $data["id"] . " --> " . $data["name"] . "<br/>";
	}

	$out .= "</pre>";

	// -------------------------------------------------------------------------

	$myData = getData("1");

	$out .= "<pre>MyData:\n\n";
	$out .= print_r( $myData, TRUE );
	$out .= "</pre>";

	// -------------------------------------------------------------------------

	$out .= "</div>";

	return $out;

}
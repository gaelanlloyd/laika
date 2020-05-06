<?php

// --- ENABLE DEBUGGING OUTPUT -------------------------------------------------

$DEBUG_ENABLE = FALSE;


// --- DASHBOARD INTERFACE VARIABLES -------------------------------------------

$CURRENT_HOST = $_SERVER['HTTP_HOST'];		// Used to determine which client to show data for
											// Should be similar to laika.winshuttle.com

$CURRENT_URL  = $_SERVER['REQUEST_URI'];	// Used by nav to know which report is being shown
											// Should be similar to /?r=1

$TENANT_PATH  = "pack-members/";			// Also defined in [header.php]

// Include the additional common items
include('common.php');


// --- GET URL PARAMETERS ------------------------------------------------------

$REPORT_ID  = filter_input(INPUT_GET, 'r', FILTER_SANITIZE_STRING);
$NUM_MONTHS = filter_input(INPUT_GET, 'm', FILTER_SANITIZE_NUMBER_INT);

// DEBUG
// $CURRENT_HOST = "demo.golaika.com";		// MANUAL OVERRIDE FOR TESTING
// ini_set('display_errors', 'On');


// --- CHECK FOR TENANT --------------------------------------------------------

// Collar must be run first as it defines the DB credentials and table names.

$thisCollar = $TENANT_PATH . $CURRENT_HOST . '/collar.php';

if ( file_exists($thisCollar) ) {
	include($thisCollar);
} else {
	echo "ERROR - COLLAR.PHP not found for " . $CURRENT_HOST;
	exit;
}


// --- LOAD FUNCTIONS ----------------------------------------------------------

// Use this array to store files that will be loaded
// That way we can debug on it later (look in footer.php)
$loadFile = array();

// String translations
$loadFile[] = 'translations/' . $LANGUAGE . '.php';

// Medoo (database interaction)
$loadFile[] = 'plugins/medoo-1.0.2.php';

// PHP files in the [functions] folder
foreach ( glob('functions/*.php') as $file ) { $loadFile[] = $file; }

// Now, actually load all of those files
foreach ( $loadFile as $file ) {
	require $file;
}


// --- FILTERS -----------------------------------------------------------------

// If NUM_MONTHS URL param was not specified, set to the default maximum value
if ( empty($NUM_MONTHS) ) {
	$NUM_MONTHS = $MAX_MONTHS;
}

// This array controls the "Show months" filter
$FILTER_MONTHS = array( 3, 6, 9, 12, 15, 18, 21, 24, 27, 30, 36 );


// --- DATABASE CONNECTION -----------------------------------------------------

try {

	$DATABASE = new medoo([
		// required
		'database_type' => 'mysql',
		'database_name' => $DB_NAME,
		'server' => 'localhost',
		'username' => $DB_USER,
		'password' => $DB_PASS,
		'charset' => 'utf8',
		'port' => 3306,

		// [optional] Table prefix
		// 'prefix' => 'PREFIX_',

		// driver_option for connection, read more from http://www.php.net/manual/en/pdo.setattribute.php
		'option' => [
			PDO::ATTR_CASE => PDO::CASE_NATURAL
		]
	]);

} catch (Exception $e) {

	terminate(__t('ErrorDatabaseConnectionFailed'), $e->getMessage());

}


// --- VERIFY DATABASE DATA EXISTS ---------------------------------------------

// Ensure there's tables with data in the database

$dbTestCount = $DATABASE->count($TBL_DATA, ["LIMIT" => 1]);
if ( $dbTestCount == 0 ) { terminate(__t('ErrorNoDataInTBLDATA')); }

$dbTestCount = $DATABASE->count($TBL_SITES, ["LIMIT" => 1]);
if ( $dbTestCount == 0 ) { terminate(__t('ErrorNoDataInTBLSITES')); }

$dbTestCount = $DATABASE->count($TBL_METRICS, ["LIMIT" => 1]);
if ( $dbTestCount == 0 ) { terminate(__t('ErrorNoDataInTBLMETRICS')); }

$dbTestCount = $DATABASE->count($TBL_MENU_GROUPS, ["LIMIT" => 1]);
if ( $dbTestCount == 0 ) { terminate(__t('ErrorNoDataInTBLMENUGROUPS')); }

$dbTestCount = $DATABASE->count($TBL_MENU_ITEMS, ["LIMIT" => 1]);
if ( $dbTestCount == 0 ) { terminate(__t('ErrorNoDataInTBLMENUITEMS')); }


// -----------------------------------------------------------------------------

// Start page head
include('head.php');
<?php

// --- DEFINE TRANSLATION STORE ----------------------------------------------------------------

// _L_aika _T_ranslation _S_tore
$lts = array();

/* - - - - - - - - - - - - - - - - - - - - - - - -

 Sample translation entry

 $lts['Hello'] = array(
   'en' => "Hello",
   'de' => "Bonjour",
   'fr' => "Caught exception",
   'es' => "Hola",
   'jp' => "こんにちは",
 );

 If a translation of a string is the same as English,
 simply omit it.  English strings will be served
 as a fallback if a localized one is not available.

 In this example, there's no 'de' translation provided
 because 'name' in English is also 'name' in German.

 $lts['Name'] = array(
   'en' => "Name",
   'fr' => "Nom",
   'es' => "Nombre",
 );

- - - - - - - - - - - - - - - - - - - - - - - - - */

$lts['CaughtException'] = array(
	'en' => "Caught exception",
);

$lts['CSVHeader'] = array(
	'en' => "CSV",
);

$lts['CSVInstructions'] = array(
	'en' => "Copy and paste this into a plain text file to create a CSV of the chart data.",
);

$lts['Data'] = array(
	'en' => "Data",
);

$lts['DataWillBeFetchedForTheseSites'] = array(
	'en' => "Data will be fetched for these sites",
);

$lts['Date'] = array(
	'en' => "Date",
);

$lts['Debug'] = array(
	'en' => "Debug",
);

$lts['DebuggingEnabled'] = array(
	'en' => "Debugging enabled",
);

$lts['ErrorDataAlreadyExistsA'] = array(
	'en' => "ERROR - Data for pack member",
);

$lts['ErrorDataAlreadyExistsB'] = array(
	'en' => "time period",
);

$lts['ErrorDataAlreadyExistsC'] = array(
	'en' => "site",
);

$lts['ErrorDataAlreadyExistsD'] = array(
	'en' => "already exists in the database.  Aborting operation.",
);

$lts['ErrorDatabaseConnectionFailed'] = array(
	'en' => "Database connection error.  Ensure that the credentials in COLLAR.PHP are accurate and that the database exists.",
);

$lts['ErrorDateNotDefined'] = array(
	'en' => "ERROR - Date was not defined.  Aborting operation.",
);

$lts['ErrorFutureDataA'] = array(
	'en' => "ERROR - Data for",
);

$lts['ErrorFutureDataB'] = array(
	'en' => "is in the future.  Aborting operation.",
);

$lts['ErrorGetValueFailedA'] = array(
	'en' => "ERROR - getValue(",
);

$lts['ErrorGetValueFailedB'] = array(
	'en' => ") in operation",
);

$lts['ErrorGetValueFailedC'] = array(
	'en' => "failed to return data.  Aborting operation.",
);

$lts['ErrorListNotDefined'] = array(
	'en' => "Error list not defined",
);

$lts['ErrorMissingCollar'] = array(
	'en' => "A COLLAR.PHP was not found for pack member",
);

$lts['ErrorNoDataInTBLDATA'] = array(
	'en' => "There doesn't appear to be any data in TBL_DATA.",
);

$lts['ErrorNoDataInTBLMENUGROUPS'] = array(
	'en' => "There doesn't appear to be any data in TBL_MENU_GROUPS.",
);

$lts['ErrorNoDataInTBLMETRICS'] = array(
	'en' => "There doesn't appear to be any data in TBL_METRICS.",
);

$lts['ErrorNoDataInTBLSITES'] = array(
	'en' => "There doesn't appear to be any data in TBL_SITES.",
);

$lts['ErrorNoSitesDefined'] = array(
	'en' => "ERROR - No sites are defined.  Aborting operation.",
);

$lts['ErrorReportFileMissingA'] = array(
	'en' => "The report file",
);

$lts['ErrorReportFileMissingB'] = array(
	'en' => "cannot be found.",
);

$lts['ErrorSiteDoesNotExistA'] = array(
	'en' => "ERROR - Site ID",
);

$lts['ErrorSiteDoesNotExistB'] = array(
	'en' => "does not exist.",
);

$lts['ErrorTooMuchData'] = array(
	'en' => "Too much data (more than 7 series)",
);

$lts['FinalReport'] = array(
	'en' => "Final report",
);

$lts['FinishedAtA'] = array(
	'en' => "Fetching was completed at",
);

$lts['FinishedAtB'] = array(
	'en' => "and took",
);

$lts['GANProfileID'] = array(
	'en' => "GAN Profile ID",
);

$lts['GoalID'] = array(
	'en' => "Goal ID",
);

$lts['Go'] = array(
	'en' => "Go",
);

$lts['GoalNoData'] = array(
	'en' => "No data for this goal, will mark as zero",
);

$lts['InvalidChartType'] = array(
	'en' => "Invalid chart type specified",
);

$lts['InvalidSiteParameter'] = array(
	'en' => "Invalid site parameter supplied",
);

$lts['LaikaDebuggerConsole'] = array(
	'en' => "Laika debugger console",
);

$lts['LoadedFiles'] = array(
	'en' => "Loaded files",
);

$lts['Months'] = array(
	'en' => "Months",
);

$lts['NoDataWasProvided'] = array(
	'en' => "No data was provided",
);

$lts['OperationNumber'] = array(
	'en' => "Operation #",
);

$lts['OperationSkipped'] = array(
	'en' => "Operation is undefined, so it will be skipped",
);

$lts['OperationsToPerform'] = array(
	'en' => "Metrics for this site (global metrics + additional metrics):",
);

$lts['PackMember'] = array(
	'en' => "Pack member",
);

$lts['PivotHeader'] = array(
	'en' => "Pivot table data",
);

$lts['PivotInstructions'] = array(
	'en' => "Use this tab-delimited data for pivot tables in Excel.",
);

$lts['SeriousError'] = array(
	'en' => "A serious error has occured and Laika cannot continue.",
);

$lts['Sessions'] = array(
	'en' => "Sessions",
);

$lts['Show'] = array(
	'en' => "Show",
);

$lts['Site'] = array(
	'en' => "Site",
);

$lts['StartedAt'] = array(
	'en' => "Fetching began at",
);

$lts['StartFetchOperation'] = array(
	'en' => "Laika is fetching data for",
);

$lts['ViewDataTable'] = array(
	'en' => "Show data table",
);

// --- DATE AND TIME FORMATS -------------------------------------------------------------------

$lts['formatFullDate'] = array(
    "en" => "Y-m-d H:i:s",
);


$lts['formatMinSec'] = array(
    "en" => "%i:%s",
);

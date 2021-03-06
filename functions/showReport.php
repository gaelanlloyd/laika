<?php

function showReport($reportItem) {

	global $CURRENT_HOST;
	global $TENANT_PATH;

	$thisReport = $TENANT_PATH . $CURRENT_HOST . "/" . $reportItem;

	// DEBUG
	/*
	echo "<pre>";
	echo $thisReport;
	echo "</pre>";
	*/

	if (file_exists($thisReport)) {

		include($thisReport);

	} else {

		$errorList = array();

		$errorMessage  = __t('ErrorReportFileMissingA');
		$errorMessage .= " [" . $thisReport . "] ";
		$errorMessage .= __t('ErrorReportFileMissingB');

		$errorList[] = $errorMessage;

		echo writeError(__FUNCTION__, $errorList);

 	}

}
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

	ob_start();

	?>

	<div class="well debug">
	<p class="mt0 pull-right"><?php echo $GLOBALS['txtLaikaDebuggerConsole']; ?></p>
	<!--<pre><?php echo $GLOBALS['txtDebuggingEnabled']; ?></pre>-->

	<?php // --- RUN DEBUGGING FUNCTIONS ------------------------------------ ?>

	<h3 class="mt0">System</h3>
	<?php echo writeDebugLoadedFiles(); ?>


	<?php // --- TEST DATABASE RETRIEVAL ------------------------------------ ?>

	<h3>Database</h3>


	<?php // --- List all [sites] ------------------------------------------- ?>

	<?php
		$datas = $DATABASE->select($TBL_SITES, "*");
	?>

	<h5>DB: Sites (<?php echo count($datas); ?>)</h5>

	<pre><?php

	foreach ($datas as $data) {
		echo $data["id"] . " --> " . $data["name"] . "<br/>";
	}

	?></pre>


	<?php // --- List all [itemnames] --------------------------------------- ?>

	<?php
		$datas = $DATABASE->select($TBL_METRICS, "*");
	?>

	<h5>DB: Metrics (<?php echo count($datas); ?>)</h5>

	<pre><?php

	foreach ($datas as $data) {
		echo $data["id"] . " --> " . $data["name"] . "<br/>";
	}

	?></pre>


	<?php // ---------------------------------------------------------------- ?>

	<?php
		$myData = getData("1");

		echo "<pre>MyData:\n\n";

		print_r( $myData );

		echo "</pre>";
	?>

	<?php // ---------------------------------------------------------------- ?>

	</div>

	<?php

	$out = ob_get_clean();
	return $out;

}
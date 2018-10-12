<?php

// This would be called during init before anything else is written to the page

function terminate($failureTextA, $failureTextB = NULL) {

    global $CURRENT_HOST;

	$pStyle = "margin-left: 34px; margin-right: 64px; font-size: 16px; font-family: monospace;";

    ?>

    <html><body>
    <img src="/images/logo-laika-100h-black.png" style="margin-top: 2em;">
    <p style="<?php echo $pStyle; ?>"><?php echo $GLOBALS['txtSeriousError']; ?></p>
    <p style="<?php echo $pStyle; ?>"><?php echo $failureTextA;

    if ( strlen($failureTextB) > 0 ) { ?>
	    </p>
	    <p style="<?php echo $pStyle; ?>"><?php echo $GLOBALS['txtCaughtException']; ?>: <?php echo $failureTextB;
    } ?>

    </p>

    <p style="<?php echo $pStyle; ?>"><?php echo $GLOBALS['txtPackMember']; ?> = <?php echo $CURRENT_HOST; ?></p>

    <?php exit;

}
<?php

function writeSidebarNavItem($pageTitle, $pageURL) {

    global $CURRENT_URL;
    global $NUM_MONTHS;
    global $MAX_MONTHS;

    ob_start();

    // --- ADJUST URL TO INCLUDE FILTER PARAMS ---------------------------------

    // If there's a current month filter applied, add it to the nav URLs
    // - If it's the default (which is MAX_MONTHS) don't write the filter param

    if ($NUM_MONTHS != $MAX_MONTHS) {
        $filterMonths = "&m=" . $NUM_MONTHS;
    } else {
        $filterMonths = "";
    }

    // But don't add this parameter on the welcome page

    if ($pageURL != "/") {
        $pageURL = $pageURL . $filterMonths;
    }

    // --- DETERMINE IF THIS ITEM IS THE CURRENTLY VIEWED PAGE -----------------

    if ($pageURL == urldecode($CURRENT_URL)) {
        $isCurrentPage = TRUE;
    } else {
        $isCurrentPage = FALSE;
    }

    // --- WRITE THE NAV ITEM --------------------------------------------------

    $class = "";

    if ($isCurrentPage) {
        $class = "active";
    }

    echo '<li class="' . $class . '">';

    if (empty($pageURL)) {
        echo '<a href="javascript:void(0);" class="disabled">';
    } else {
        echo '<a href="' . $pageURL . '">';
    }

    echo $pageTitle;

    if ($isCurrentPage) {
        echo '<span class="sr-only">(current)</span>';
    }

    echo "</a>";
    echo "</li>";

    $out = ob_get_clean();
    return $out;
}
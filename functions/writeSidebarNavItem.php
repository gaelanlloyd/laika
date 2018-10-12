<?php

function writeSidebarNavItem($pageTitle, $pageURL) {

    global $CURRENT_URL;
    global $NUM_MONTHS;
    global $MAX_MONTHS;

    $out = "";

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

    if ($isCurrentPage) {
        $out .= "<li class=\"active\">";
    } else {
        $out .= "<li>";
    }

    if (empty($pageURL)) {
        $out .= "<a href=\"javascript:void(0)\" class=\"disabled\">";
    } else {
        $out .= "<a href=\"" . $pageURL . "\">";
    }

    $out .= $pageTitle;

    if ($isCurrentPage) {
        $out .= "<span class=\"sr-only\">(current)</span>";
    }

    $out .= "</a>";
    $out .= "</li>";

    return $out;
}
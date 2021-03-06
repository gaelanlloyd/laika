<?php

function getColor($name, $id) {

    $fillColorSolid = array(
        "rgba(69,114,167,1)",
        "rgba(170,70,67,1)",
        "rgba(137,165,78,1)",
        "rgba(219,132,61,1)",
        "rgba(65,152,175,1)",
        "rgba(113,88,143,1)",
        "rgba(147,169,207,1)",
    );

    $fillColorTransparent = array(
        "rgba(69,114,167,0.05)",
        "rgba(170,70,67,0.05)",
        "rgba(137,165,78,0.05)",
        "rgba(219,132,61,0.05)",
        "rgba(65,152,175,0.05)",
        "rgba(113,88,143,0.05)",
        "rgba(147,169,207,0.05)",
    );

    $fillColorNone = array(
        "rgba(255,255,255,0)",
        "rgba(255,255,255,0)",
        "rgba(255,255,255,0)",
        "rgba(255,255,255,0)",
        "rgba(255,255,255,0)",
        "rgba(255,255,255,0)",
        "rgba(255,255,255,0)",
    );

    $fillColorTransparentMonochrome = array(
        "rgba(128,128,128,0.04)",
        "rgba(128,128,128,0.04)",
        "rgba(128,128,128,0.04)",
        "rgba(128,128,128,0.04)",
        "rgba(128,128,128,0.04)",
        "rgba(128,128,128,0.04)",
        "rgba(128,128,128,0.04)",
    );

    $strokeColor = array(
        "rgba(69,114,167,1)",
        "rgba(170,70,67,1)",
        "rgba(137,165,78,1)",
        "rgba(219,132,61,1)",
        "rgba(65,152,175,1)",
        "rgba(113,88,143,1)",
        "rgba(147,169,207,1)",
    );

    $pointColor = array(
        "rgba(69,114,167,1)",
        "rgba(170,70,67,1)",
        "rgba(137,165,78,1)",
        "rgba(219,132,61,1)",
        "rgba(65,152,175,1)",
        "rgba(113,88,143,1)",
        "rgba(147,169,207,1)",
    );

    $pointStrokeColor = array(
        "#FFFFFF",
        "#FFFFFF",
        "#FFFFFF",
        "#FFFFFF",
        "#FFFFFF",
        "#FFFFFF",
        "#FFFFFF",
    );

    $pointHighlightFill = array(
        "#FFFFFF",
        "#FFFFFF",
        "#FFFFFF",
        "#FFFFFF",
        "#FFFFFF",
        "#FFFFFF",
        "#FFFFFF",
    );

    $pointHighlightStroke = array(
        "rgba(69,114,167,1)",
        "rgba(170,70,67,1)",
        "rgba(137,165,78,1)",
        "rgba(219,132,61,1)",
        "rgba(65,152,175,1)",
        "rgba(113,88,143,1)",
        "rgba(147,169,207,1)",
    );

    /*

    // Original color scheme

    $fillColor = array(
        "rgba(151,187,205,0.2)",
        "rgba(151,205,151,0.2)",
        "rgba(205,151,151,0.2)",
        "rgba(220,220,220,0.2)",
    );

    $strokeColor = array(
        "rgba(151,187,205,1)",
        "rgba(151,205,151,1)",
        "rgba(205,151,151,1)",
        "rgba(220,220,220,1)",
    );

    $pointColor = array(
        "rgba(151,187,205,1)",
        "rgba(151,205,151,1)",
        "rgba(205,151,151,1)",
        "rgba(220,220,220,1)",
    );

    $pointStrokeColor = array(
        "#FFFFFF",
        "#FFFFFF",
        "#FFFFFF",
        "#FFFFFF",
    );

    $pointHighlightFill = array(
        "#FFFFFF",
        "#FFFFFF",
        "#FFFFFF",
        "#FFFFFF",
    );

    $pointHighlightStroke = array(
        "rgba(151,187,205,1)",
        "rgba(151,205,151,1)",
        "rgba(205,151,151,1)",
        "rgba(220,220,220,1)",
    );

    */

    return ${$name}[$id];

}
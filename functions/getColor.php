<?php

function getColor($name, $id) {

    $fillColor = array(
        "rgba(69,114,167,1)",
        "rgba(170,70,67,1)",
        "rgba(137,165,78,1)",
        "rgba(219,132,61,1)",
        "rgba(65,152,175,1)",
        "rgba(113,88,143,1)",
        "rgba(147,169,207,1)",
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

?>
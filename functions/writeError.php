<?php

function writeError($procedure, $errorList) {

    // Use echoes on this output so that the <pre> output is nicely formatted

    ob_start();

    if (empty($errorList)) {
        $errorList = "<li>" . $GLOBALS['txtErrorListNotDefined'] . "</li>";
    }

    echo "<pre class=\"error\">";
    echo "<strong>ERROR: " . $procedure . "</strong>";
    echo "<ul>";

    foreach ($errorList as $errorListItem) {
        echo "<li>" . $errorListItem . "</li>";
    }

    echo "</ul>";
    echo "</pre>";

    $out = ob_get_clean();
    return $out;

}
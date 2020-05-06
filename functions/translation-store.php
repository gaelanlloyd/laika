<?php

// --- DEFINE TRANSLATION RETRIEVAL FUNCTION ---------------------------------------------------

function __t( $id = NULL, $lang = NULL ) {

    // Return the translation for the specified language, or language of the current site.
    // Otherwise, return the English translation as a fallback.

    if ( empty( $lang ) ) {
        $lang = 'en';
    }

    // If the translation doesn't exist, return an error

    if ( empty( $GLOBALS['lts'][$id] ) ) {
        return "--MISSING TRANSLATION [" . $id . "]--";
    }

    // Provide the 'en' translation as a fallback if it doesn't exist
    // in the requested language.

    if ( !empty( $GLOBALS['lts'][$id][$lang] ) ) {
        return $GLOBALS['lts'][$id][$lang];
    } else {
        return $GLOBALS['lts'][$id]['en'];
    }

}

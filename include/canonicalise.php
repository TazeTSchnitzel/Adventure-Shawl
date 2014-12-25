<?php

namespace ajf\AdventureShawl;

const SYNONYMS = [
    'enter' => 'go',
    'take' => 'get',
    'unlock' => 'open'
];

const REDUNDANT = [
    'the' => NULL,
    'an' => NULL,
    'a' => NULL
];

/* reformats a command and replaces synonyms to improve recognition */
function canonicalise(/* string */ $command) /* : string */ {
    $command = strtolower($command);
    $command = rtrim($command, ".!");

    $pieces = explode(' ', $command);

    $pieces = array_filter($pieces, function (/* string */ $piece) /* : bool */ {
        return (bool)strlen($piece) && !array_key_exists($piece, REDUNDANT);
    });

    foreach ($pieces as $i => $piece) {
        if (array_key_exists($piece, SYNONYMS)) {
            $pieces[$i] = SYNONYMS[$piece];
        }
    }

    return implode(' ', $pieces);
}

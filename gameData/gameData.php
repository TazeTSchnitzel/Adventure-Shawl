<?php

namespace ajf\AdventureShawl;

return (new Game())
    ->setStartingRoomName('startpoint')
    ->addRooms([
        'startpoint' => (new Room())
            ->setScenario('You are standing in a moonlit meadow. To your north is a witch\'s covern. To your side is a large boulder.')
            ->addOptions([
                'roll boulder' => 'hole_revealed'
            ]),
        'hole_revealed' => (new Room())
            ->setScenario('You roll the boulder. It reveals a large hole beneath.')
            ->addOptions([
                'go hole' => 'secret_catacomb'
            ]),
        'secret_catacomb' => (new Room())
            ->setScenario('You crawl through the hole, and enter a secret catacomb! There is a passage to the north. In the centre of the catacomb is... a sarcophagus!')
            ->addOptions([
                'open sarcophagus' => 'sarcophagus_opened'
            ]),
        'sarcophagus_opened' => (new Room())
            ->setScenario('You open the sarcophagus. Lying within is a skeleton. Around its neck is a golden amulet. You can only take one item with you.')
            ->addOptions([
                'get finger from skeleton' => 'finger_taken',
                'get skeleton finger' => 'finger_taken'
            ]),
        'finger_taken' => (new Room())
            ->setScenario('You take a finger from the skeleton.')
            ->addOptions([
                'go north' => 'foreboding_gate'
            ]),
        'foreboding_gate' => (new Room())
            ->setScenario('You stand before a foreboding gate made of bones. It is locked.')
            ->addOptions([
                'open gate with skeleton finger' => 'large_room'
            ]),
        'large_room' => (new Room())
            ->setScenario('You enter a large room. On the wall to your left lies a broomstick.')
            ->addOptions([
                'get broomstick' => 'got_broomstick'

            ]),
        'get_broomstick' => (new Room())
            ->setScenario('You take the broomstick.')
            ->addOptions([
                'go north' => 'useless_foreboding_gate'
            ]),
        'useless_foreboding_gate' => (new Room())
            ->setScenario('You stand before a foreboding gate made of bones. It is locked. You do not have any means to unlock it.')
            ->addOptions([
                'go back' => 'sarchopagus_opened'
            ])
    ]);

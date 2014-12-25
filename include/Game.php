<?php

namespace ajf\AdventureShawl;

class Game
{
    private /* array<Room> */ $rooms = [];
    private /* string */ $startingRoomName;
    
    public function addRooms(array/*<string, Room>*/ $rooms) {
        $this->rooms = $rooms;
        return $this;
    }

    public function setStartingRoomName(/* string */ $roomName) {
        $this->startingRoomName = $roomName;
        return $this;
    }

    public function getRoom(/* string */ $roomName) /* : Room */ {
        return $this->rooms[$roomName];
    }

    public function hasRoom(/* string */ $roomName) /* : bool */ {
        return isset($this->rooms[$roomName]);
    }

    public function getStartingRoomName() /* : string */ {
        return $this->startingRoomName;
    }
}

<?php

namespace ajf\AdventureShawl;

class GameStateException extends \RuntimeException
{
}

class GameState
{
    private /* Game */ $game;
    private /* string */ $roomName;
    private /* Room */ $room;

    public function __construct(Game $game, array $serialised = NULL) {
        $this->game = $game;
        if ($serialised !== NULL) {
            $this->deserialise($serialised);
        } else {
            $this->roomName = $game->getStartingRoomName();
            $this->room = $this->game->getRoom($this->roomName);
        }
    }

    public function serialise() /* : array */ {
        return [
            'roomName' => $this->roomName
        ];
    }

    public function deserialise(array $serialised) {
        $this->roomName = $serialised['roomName'];
        if (!$this->game->hasRoom($this->roomName)) {
            throw new GameStateException("Cannot deserialise GameState: no such room \"$this->roomName\"");
        }
        $this->room = $this->game->getRoom($this->roomName);
    }

    public function getScenario() /* : string */ {
        return $this->room->getScenario();
    }

    public function getOptions() /* : array<string> */ {
        return \array_keys($this->room->getOptions());
    }

    public function performCommand(/* string */ $option) /* : bool */ {
        if (isset($this->room->getOptions()[$option])) {
            $roomName = $this->room->getOptions()[$option];
            if (!$this->game->hasRoom($roomName)) {
                return false;
            }
            $this->roomName = $roomName;
            $this->room = $this->game->getRoom($this->room);
            return true;
        } else {
            return false;
        }
    }
}

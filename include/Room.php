<?php

namespace ajf\AdventureShawl;

class Room
{
    private /* string */ $scenario;
    private /* array<string, string> */ $options = [];

    public function setScenario(/* string */ $scenario) {
        $this->scenario = $scenario;
        return $this;
    }

    public function getScenario() /* : string */ {
        return $this->scenario;
    }

    public function addOptions(array/*<string, string>*/ $roomNames) {
        $this->options = $roomNames;
        return $this;
    }

    public function getOptions() /* : array<string, string> */ {
        return $this->options;
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: Tim
 * Date: 27-2-2018
 * Time: 21:13
 */

class Dice {
    private $_max = 1;
    private $_value = 1;

    public function __construct($max) {
        $this->_max = $max;
    }

    public function getValue() {
        return $this->_value;
    }

    public function roll() {
        $this->_value = rand(1, $this->_max);
    }
}
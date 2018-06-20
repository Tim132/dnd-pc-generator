<?php
/**
 * Created by PhpStorm.
 * User: Tim
 * Date: 27-2-2018
 * Time: 21:09
 */

class pc
{
    private $_class = '';
    private $_race = '';
    private $_backstory = '';

    private $_str = 1;
    private $_dex = 1;
    private $_con = 1;
    private $_int = 1;
    private $_wis = 1;
    private $_cha = 1;

    public function __construct()
    {
        //constructor
    }

    /**
     * @return string
     */
    public function getClass()
    {
        return $this->_class;
    }

    /**
     * @param string $class
     */
    public function setClass($class)
    {
        $this->_class = $class;
    }

    /**
     * @return string
     */
    public function getRace()
    {
        return $this->_race;
    }

    /**
     * @param string $race
     */
    public function setRace($race)
    {
        $this->_race = $race;
    }

    /**
     * @return int
     */
    public function getStr()
    {
        return $this->_str;
    }

    /**
     * @param int $str
     */
    public function setStr($str)
    {
        $this->_str = $str;
    }

    public function increaseStr($str)
    {
        $this->_str += $str;
    }

    /**
     * @return int
     */
    public function getDex()
    {
        return $this->_dex;
    }

    /**
     * @param int $dex
     */
    public function setDex($dex)
    {
        $this->_dex = $dex;
    }

    public function increaseDex($dex)
    {
        $this->_dex += $dex;
    }

    /**
     * @return int
     */
    public function getCon()
    {
        return $this->_con;
    }

    /**
     * @param int $con
     */
    public function setCon($con)
    {
        $this->_con = $con;
    }

    public function increaseCon($con)
    {
        $this->_con += $con;
    }

    /**
     * @return int
     */
    public function getInt()
    {
        return $this->_int;
    }

    /**
     * @param int $int
     */
    public function setInt($int)
    {
        $this->_int = $int;
    }

    public function increaseInt($int)
    {
        $this->_int += $int;
    }

    /**
     * @return int
     */
    public function getWis()
    {
        return $this->_wis;
    }

    /**
     * @param int $wis
     */
    public function setWis($wis)
    {
        $this->_wis = $wis;
    }

    public function increaseWis($wis)
    {
        $this->_wis += $wis;
    }

    /**
     * @return int
     */
    public function getCha()
    {
        return $this->_cha;
    }

    /**
     * @param int $cha
     */
    public function setCha($cha)
    {
        $this->_cha = $cha;
    }

    public function increaseCha($cha)
    {
        $this->_cha += $cha;
    }

    public function setTrait($trait)
    {
        $this->_trait = $trait;
    }

    public function setBackstory($backstory)
    {
        $this->_backstory = $backstory;
    }

    public function getBackstory()
    {
        return $this->_backstory;
    }

}
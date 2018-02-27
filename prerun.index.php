<?php
require_once 'models/dice.class.php';
require_once 'models/pc.class.php';

$classes = [
    'Barbarian',
    'Bard',
    'Cleric',
    'Druid',
    'Fighter',
    'Monk',
    'Paladin',
    'Ranger',
    'Rogue',
    'Sorcerer',
    'Warlock',
    'Wizard'
];

$races = [
    'Dwarf',
    'Elf',
    'Halfling',
    'Human',
    'Dragonborn',
    'Gnome',
    'Half-Elf',
    'Half-Orc',
    'Tiefling'
];

//make a pc object for data storage
$pc = new pc();

//roll stats
$pc->setStr(rollstat());
$pc->setDex(rollstat());
$pc->setCon(rollstat());
$pc->setInt(rollstat());
$pc->setWis(rollstat());
$pc->setCha(rollstat());

//set random race and class
$pc->setRace($races[array_rand($races)]);
$pc->setClass($classes[array_rand($classes)]);

function rollstat() {
    //make 4 d6's
    $dice1 = new dice(6);
    $dice2 = new dice(6);
    $dice3 = new dice(6);
    $dice4 = new dice(6);

    //roll 4d6
    $dice1->roll();
    $dice2->roll();
    $dice3->roll();
    $dice4->roll();

    //read the values from the 4d6
    $diceValues = [
        $dice1->getValue(),
        $dice2->getValue(),
        $dice3->getValue(),
        $dice4->getValue()
    ];

    //add the values from the 4d6 together
    $total = 0;
    foreach($diceValues as $diceValue) {
        $total += $diceValue;
    }

    //subtract the lowest value
    $total -= min($diceValues);

    return $total;
}
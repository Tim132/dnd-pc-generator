<?php
require_once 'models/dice.class.php';
require_once 'models/pc.class.php';
require_once 'config/classes.conf.php';
require_once 'config/races.conf.php';
require_once 'config/traits.conf.php';

//make a pc object for data storage
$pc = new pc();

//roll 6 stats
$stats = [];
for($i = 0; $i < 6; $i++) {
    $stats[] = rollstat();
}
$stats = sortStats($stats);

//set random race and class
$pc->setRace(array_rand($races));
$pc->setClass(array_rand($classes));

//set the stats required for the class
foreach($classes[$pc->getClass()]['statOrder'] as $i => $stat) {
    switch($stat) {
        case 'str':
            $pc->setStr($stats[$i]);
            break;
        case 'dex':
            $pc->setDex($stats[$i]);
            break;
        case 'con':
            $pc->setCon($stats[$i]);
            break;
        case 'int':
            $pc->setInt($stats[$i]);
            break;
        case 'wis':
            $pc->setWis($stats[$i]);
            break;
        case 'cha':
            $pc->setCha($stats[$i]);
            break;
        default:
            //TODO some error handling here, for now we just kill
            die('Error: Invalid statorder ' . $stat . ' in ' . $pc->getClass());
    }
}

$pc = assignRacialBonuses($pc, $races[$pc->getRace()]);

$pc->setTrait($traits[array_rand($traits)]);

$backstory = [
    "you're a " . $pc->getRace() . ' ' . $pc->getClass() . ' who ' . $verbsAboutRaces[array_rand($verbsAboutRaces)] . ' ' . array_rand($races) . 's because ' . $reasonsAboutRaces[array_rand($reasonsAboutRaces)],
    "you're a " . $pc->getRace(). ' ' . $pc->getClass() . ' who ' . $personalReason[array_rand($personalReason)]
];

$pc->setBackstory($backstory[array_rand($backstory)]);

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

function sortStats($stats) {
    for($i=0;$i<count($stats);$i++){
        $value = $stats[$i];
        $j = $i-1;
        while($j>=0 && $stats[$j] < $value){
            $stats[$j+1] = $stats[$j];
            $j--;
        }
        $stats[$j+1] = $value;
    }
    return $stats;
}

/**
 * @param pc $pc
 * @param array $raceData
 */
function assignRacialBonuses($pc, $raceData) {
    foreach ($raceData['stats'] as $stat => $value) {
        switch($stat) {
            case 'str':
                $pc->increaseStr($value);
                break;
            case 'dex':
                $pc->increaseDex($value);
                break;
            case 'con':
                $pc->increaseCon($value);
                break;
            case 'int':
                $pc->increaseInt($value);
                break;
            case 'wis':
                $pc->increaseWis($value);
                break;
            case 'cha':
                $pc->increaseCha($value);
                break;
            default:
                //TODO some error handling here, for now we just kill
                die('Error: Invalid statorder ' . $stat . ' in ' . $pc->getRace());
        }
    }

    return $pc;
}




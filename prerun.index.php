<?php
require_once 'models/dice.class.php';
require_once 'models/pc.class.php';
require_once 'config/classes.conf.php';
require_once 'config/races.conf.php';
require_once 'config/traits.conf.php';
require_once 'utility/pc.util.php';

//make a pc object for data storage
$pc = new Pc();

//roll 6 stats
$stats = [];
for ($i = 0; $i < 6; $i++) {
    $stats[] = rollstat();
}
$stats = sortStats($stats);

//set random race and class
$pc->setRace(array_rand($races));
$pc->setClass(array_rand($classes));
$pc = PcUtil::setStatsForRace($pc, $classes[$pc->getClass()]['statOrder'], $stats);
$pc = PcUtil::assignRacialBonuses($pc, $races[$pc->getRace()]);
$pc = PcUtil::assignRacialFeatures($pc, $races[$pc->getRace()]['features']);

$pc->setTrait($traits[array_rand($traits)]);

$backstory = [
    "you're a " . $pc->getRace() . ' ' . $pc->getClass() . ' who ' . $verbsAboutRaces[array_rand($verbsAboutRaces)] . ' ' . array_rand($races) . 's because ' . $reasonsAboutRaces[array_rand($reasonsAboutRaces)],
    "you're a " . $pc->getRace() . ' ' . $pc->getClass() . ' who ' . $personalReason[array_rand($personalReason)]
];

$pc->setBackstory($backstory[array_rand($backstory)]);

/**
 * @return int
 */
function rollstat()
{
    //make 4 d6's
    $dice1 = new Dice(6);
    $dice2 = new Dice(6);
    $dice3 = new Dice(6);
    $dice4 = new Dice(6);

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
    foreach ($diceValues as $diceValue) {
        $total += $diceValue;
    }

    //subtract the lowest value
    $total -= min($diceValues);
    return $total;
}

/**
 * @param array $stats
 * @return array<int>
 */
function sortStats($stats)
{
    for ($i = 0; $i < count($stats); $i++) {
        $value = $stats[$i];
        $j = $i - 1;
        while ($j >= 0 && $stats[$j] < $value) {
            $stats[$j + 1] = $stats[$j];
            $j--;
        }
        $stats[$j + 1] = $value;
    }
    return $stats;
}

<?php
require_once 'models/dice.class.php';
require_once 'models/pc.class.php';
require_once 'config/classes.conf.php';
require_once 'config/races.conf.php';
require_once 'config/traits.conf.php';
require_once 'utility/pc.util.php';
require_once 'utility/dice.util.php';

//make a pc object for data storage
$pc = new Pc();

//roll 6 stats
$stats = [];
for ($i = 0; $i < 6; $i++) {
    $stats[] = DiceUtil::rollstat();
}
$stats = DiceUtil::sortStats($stats);

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



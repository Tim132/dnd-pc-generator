<?php
require_once 'models/dice.class.php';
require_once 'models/pc.class.php';
require_once 'config/classes.conf.php';

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

//todo add more traits
//you're $trait who $verbsaboutraces $race $reasonaboutraces
//you're $trait who &personalreason
$traits = [
    'an adventurous', 'an agreeable', 'an anxious', 'an athletic', 'an apathetic',
    'a brilliant', 'a benevolent', 'a brave', 'a bitter', 'a bossy',
    'a clever', 'a calm', 'a clumsy', 'a childish', 'a confident',
    'a daring', 'a determined', 'a dementing', 'a deadly', 'a dull',
    'an enthusiastic', 'an empathetic', 'an eccentric', 'an educated',
    'a friendly', 'a foolish', 'a forgetful', 'aforgiving', 'a freethinking',
    'a gay', 'a generous', 'a greedy', 'a graceful',
    'a helpful', 'an honorable', 'a heroic', 'a humble',
    'an independent', 'an insightful', 'intuitive',
    'a jealous', 'a jolly', 'a jack of all trades',
    'a kind'
];

//___ who ___
$verbsAboutRaces = [
    'hates', 'loves', 'fears', 'avoids', 'likes', 'despises', 'adores', 'fights'
];

//___ because ___
$reasonsAboutRaces = [
    'of a childhood trauma',
    'his father never hugged him',
    'of the way their behaviour influences the world',
    'they remind him of his aunt',
    'he is jealous of their aesthetic',
    'they make the world go round',
    'of their work ethic',
    'of personal reasons',
    'they ruin everything',
    'they cook the best types of food',
    'his childhood friend was one'
];

$personalReason =[
    'is recovering from a freak accident at the mine',
    "hasn't worked a day in his life because of a clever scheme that recently fell apart",
    'is obsessed with a game where he pretends to be an IT-er in a world with computers and no magic',
    'tries to cause chaos in any form of organized government',
    'only wanted to be left alone but keeps getting drug into things',
    "hasn't taken a bath since the age of 14",
    'is trying his darnedest never to be sober'
];


//make a pc object for data storage
$pc = new pc();

//roll 6 stats
$stats = [];
for($i = 0; $i < 6; $i++) {
    $stats[] = rollstat();
}
$stats = sortStats($stats);

//set random race and class
$pc->setRace($races[array_rand($races)]);
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

$pc->setTrait($traits[array_rand($traits)]);

$backstory = [
    "you're a " . $pc->getRace() . ' ' . $pc->getClass() . ' who ' . $verbsAboutRaces[array_rand($verbsAboutRaces)] . ' ' . $races[array_rand($races)] . 's because ' . $reasonsAboutRaces[array_rand($reasonsAboutRaces)],
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




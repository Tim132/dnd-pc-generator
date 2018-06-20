<?php

class DiceUtil{
    /**
     * @return int
     */
    public static function rollstat()
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
    public static function sortStats($stats)
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
}
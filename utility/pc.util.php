<?php

class PcUtil {

    /**
     * @param pc $pc
     * @param array $raceData
     *
     * @return pc
     */
    public static function assignRacialBonuses($pc, $raceData)
    {
        foreach ($raceData['stats'] as $stat => $value) {
            switch ($stat) {
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

    /**
     * @param pc $pc
     * @param array $features
     *
     * @return pc
     */
    public static function assignRacialFeatures($pc, $features) {
        foreach ($features as $feature) {
            $pc->addFeature($feature);
        }
        return $pc;
    }

    /**
     * @param pc $pc
     * @param array<string> $statOrder
     * @param array<int> $stats
     *
     * @return pc
     */
    public static function setStatsForRace($pc, $statOrder, $stats) {
        //set the stats required for the class
        foreach ($statOrder as $i => $stat) {
            switch ($stat) {
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

        return $pc;
    }
}
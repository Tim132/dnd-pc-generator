<?php
require_once 'prerun.index.php';
?>
Race: <?= $pc->getRace(); ?> <br />
Class: <?= $pc->getClass(); ?> <br /><br />

<table>
    <tr>
        <td>str: <?= $pc->getStr(); ?></td>
        <td>int: <?= $pc->getInt(); ?></td>
    </tr>
    <tr>
        <td>dex: <?= $pc->getDex(); ?></td>
        <td>wis: <?= $pc->getWis(); ?></td>
    </tr>
    <tr>
        <td>con: <?= $pc->getCon(); ?></td>
        <td>cha: <?= $pc->getCha(); ?></td>
    </tr>
</table>

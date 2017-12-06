<?php
/**
 * @ http://educomp.runnet.ru/kroha/depak_art.html
 */
$rank = 15;
$cell = 16;

$cellNames = [];
for ($i = 0; $i < $cell; $i++) {
    $cellNames[$i] = sprintf("%04d", decbin($i));
}
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>ЭВМ Кроха-М</title>
    <style>
        td:nth-child(1), td:nth-child(4n-12) {
            padding-right: 10px;
        }
    </style>
</head>
<body>
<form method="get">
    <table>
        <caption>Задание команды</caption>
        <tr>
            <th>N Ячейка</th>
            <th>К Код действия</th>
            <th>А1</th>
            <th>А2</th>
            <th>А3</th>
        </tr>

        <tr>
            <td>
                <select name="N">
                    <?php
                    foreach ($cellNames as $num => $name) { ?>
                        <option><?= $name ?></option>
                        <?php
                    } ?>
                </select>
            </td>
            <td>
                <select name="K">
                    <option value="000">000 - переписать содержимое А1 в А3</option>
                    <option value="001">001 - сложить числа А1 и А2, записать в А3</option>
                    <option value="010">010 - разделить А1 на А2, записать в А3</option>
                    <option value="011">011 - найти модуль разности числел А1 и А2, записать в А3</option>
                    <option value="100">100 - если А1 = А2, перейти к А3</option>
                    <option value="101">101 - перемножить числа А1 и А2, записать в А3</option>
                    <option value="110">110 - если А1 > А2, перейти к А3</option>
                    <option value="111">111 - напечатать содержимое А1, А2 и А3 и остановиться</option>
                </select>
            </td>
            <td>
                <select name="A1">
                    <?php
                    foreach ($cellNames as $num => $name) { ?>
                        <option><?= $name ?></option>
                        <?php
                    } ?>
                </select>
            </td>
            <td>
                <select name="A2">
                    <?php
                    foreach ($cellNames as $num => $name) { ?>
                        <option><?= $name ?></option>
                        <?php
                    } ?>
                </select>
            </td>
            <td>
                <select name="A3">
                    <?php
                    foreach ($cellNames as $num => $name) { ?>
                        <option><?= $name ?></option>
                        <?php
                    } ?>
                </select>
            </td>
        </tr>
    </table>
    <input type="submit" value="Записать">
</form>

<table>
    <?php
    for ($i = 0; $i < $cell; $i++) { ?>
        <tr>
            <td>
                | <?= $cellNames[$i] ?> |
            </td>
            <?php
            for ($k = 1; $k <= $rank; $k++) { ?>
                <td>
                    <?= rand (0, 1); ?>
                </td>
                <?php
            } ?>
        </tr>
        <?php
    } ?>
</table>
<br>
<br>
<br>
<button>Запустить программу</button>
</body>
</html>
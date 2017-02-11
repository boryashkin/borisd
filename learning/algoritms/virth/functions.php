<?php
Class OBException extends Exception {
    function __construct($message, $code = 0, Exception $previous = null)
    {
        exit('Error: '.$message.' | '.$this->getTraceAsString());
    }
}

/**
 * Проверка четности
 * Check for odd
 *
 * @param $i
 * @return bool
 */
function ODD($i)
{
    return (MOD($i, 2) == 1);
}

/**
 * Целочисленное деление
 * Integer division
 *
 * $m = q * $n + MOD($m, $n) // 0 <= r < $n
 * DIV(31, 10) //q = 3
 * DIV(-31, 10) //q = 4
 *
 * @param $m
 * @param $n
 * @return int
 * @throws Exception
 */
function DIV($m, $n)
{
    if (!is_int($m) || !is_int($n)) {
        throw new OBException('Not integer');
    }

    if ($n !== 0) {
        $q = (int)floor($m / $n);
    } else {
        throw new OBException('Divide by zero');
    }
    return $q;
}

/**
 * Остаток от деления
 * Remainder of the integer division
 *
 * $m = DIV($m, $n) * $n + r // 0 <= r < $n
 * MOD(31, 10) //1
 * MOD(-31, 10) //9
 *
 * @param $m
 * @param $n
 * @return mixed
 * @throws OBException
 */
function MOD($m, $n)
{
    $r = (int)ceil($m - DIV($m, $n) * $n);

    return $r;
}

/**
 * Целая часть $x
 * The integer part of $x
 *
 * @param $x
 * @return int
 */
function ENTIER($x)
{
    return (int)floor($x);
}
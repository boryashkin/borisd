<?php
global $gar; // Глобальный массив для сохранения позиций букв
$alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'; // Строка кодирования
//$alphabet = 'АБВГДЕЁЖЗ';
$maxgetlen = '309'; // после 308 "девяток" скрипт падает из-за ограничения в количестве рекурсий (250)
$echo = '';
function getCode($n){
    global $alphabet;
    return $alphabet[($n-1)];
}
function getTimer($start){
    $fin = microtime(true);

    return ($fin + $start);
}
function getFinCode($X){
    global $alphabet;
    $col = strlen($alphabet);
    $L = floor($X / $col); // первые буквы
    $G = $L * $col; // координата последнего значения предыдущего разряда (ZZ, например)
    $K = $X - $G; // последняя буква $alph (26, например)
    if(!$K){
        $K = $col; // если последняя буква = 0, значит это конец разряда (ZZZ, например), и эта буква - последняя в alphabet
        --$L; // предыдущие буквы, соответственно, тоже нужно сдвинуть назад
    }
    $res[] = $K;
    if($L > $col){
        // если "первая буква" выходит за рамки длины строки, значит это не одна буква
        $res[] = getFinCode($L);
    }
    else{
        // а в этом случае одна
        $res[] = $L;
    }
    return $res;
}
function parseFinCode($X){
    global $gar;
    $r = getFinCode($X); // получаем многомерный массив с цифрами позиций букв
    $gar = ''; // обнуляем глобальную строку
    array_walk_recursive($r, 'getArrayItem'); // вытаскиваем цифры массива, формируем из них строку
    return '('.$X.') '.strrev($gar); // переворачиваем, так как в массиве цифры лежали с конца
    return '('.$X.') '.strrev($gar); // переворачиваем, так как в массиве цифры лежали с конца
}
function getArrayItem($item, $key)
{
    global $gar;
    $gar .= getCode($item); // превращаем цифру в соответствующую букву alphabet
}
function getNumber($code){
    global $alphabet;
    $ac = strlen($alphabet);
    $c = strlen($code);
    for($i=0; $i<$c; $i++){
        $l = mb_strtoupper($code[$i]);
        $pos = strpos($alphabet, $l);
        if($pos !== false){
            $arr[] = ($pos+1);
        }
        else{
            exit('Таких символов нет в кодировке');
        }
    }
    $pop = array_pop($arr);
    var_dump($pop);
    return getRowSum($ac, $c, $pop);
}
function getRowSum($ac, $c, $coeff){
    $r = $coeff;
    $ci = $c;
    for($i=0; $i<$c; $i++) {
        for ($ii = 0; $ii < $ci; $ii++) {
            --$ci;
            $r += pow($ac, $i);
        }
        $r += pow($ac, $i);
    }
    return $r;
    /*
     * $coeff + ($ac^0) + ($ac^1) + .. + ($ac^$c);
     * но походу для 3значных кодов
     * ($ac^0) + ($ac^1) + .. + ($ac^3) + !! (($ac^0) + ($ac^1) + .. + ($ac^2)) + $coeff;
     */
}
if($_REQUEST){
    $start = -microtime(true);
    $get = (string)$_GET['x'];
    $getlen = strlen($get);
    if($getlen<$maxgetlen) {
        if ($get < 1) {
            $get = 1;
        }
        if ($get > 0) {
            $echo .= parseFinCode($get) . PHP_EOL . '<br>';
        }

        $echo .= PHP_EOL.'<br><span class="small-text color-gray">'.getTimer($start) . '</span>';
    }
    else{
        $echo .= 'Даже великие сервера не смогут прочитать это число';
    }
}
?>
<!DOCTYPE html>
<html>
<head lang="ru">
    <meta charset="UTF-8">
    <title>Перевод номер столбца excel в код</title>
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="/css/main.css" />
</head>
<body id="space-background">
<header>
    <nav id="header-nav">
        <div id="nav-menu">
            <ul id="nav-menu-list">
                <li class="nav-menu-item logo">
                    <a href="./">
                        <img src="/img/theme/ySzBWqrmyuA.jpg" />
                    </a>
                </li>
                <li class="nav-menu-item"><a href="/about.html">Обо мне</a></li>
                <li class="nav-menu-item active"><a href="/stuff.html">Поделки</a></li>
                <li class="nav-menu-item"><a href="/accounts.html">Аккаунты</a></li>
            </ul>
        </div>
    </nav>
</header>
<div class="header-delimeter"></div>
<section>
    <div class="content">
        <h1>Перевести</h1>
        <form method="GET">
            <input type="text" name="x" placeholder="Номер столбца" />
            <input type="submit" value="Get Excel name" />
        </form>
        <div class="code"><?= $echo ?></div>
    </div>
</section>
<section>
    <div class="content">
        <h1>Исходник</h1>
        <div class="note">Музейный экспонат. Делал очень давно, не помню почему именно так.</div>
        <div class="code">
            <code><span style="color: #000000">
<span style="color: #0000BB">&lt;?php
<br /></span><span style="color: #007700">global&nbsp;</span><span style="color: #0000BB">$gar</span><span style="color: #007700">;&nbsp;</span><span style="color: #FF8000">//&nbsp;Глобальный&nbsp;массив&nbsp;для&nbsp;сохранения&nbsp;позиций&nbsp;букв
<br /></span><span style="color: #0000BB">$alphabet&nbsp;</span><span style="color: #007700">=&nbsp;</span><span style="color: #DD0000">'ABCDEFGHIJKLMNOPQRSTUVWXYZ'</span><span style="color: #007700">;&nbsp;</span><span style="color: #FF8000">//&nbsp;Строка&nbsp;кодирования
<br />//$alphabet&nbsp;=&nbsp;'АБВГДЕЁЖЗ';
<br /></span><span style="color: #0000BB">$maxgetlen&nbsp;</span><span style="color: #007700">=&nbsp;</span><span style="color: #DD0000">'309'</span><span style="color: #007700">;&nbsp;</span><span style="color: #FF8000">//&nbsp;после&nbsp;308&nbsp;"девяток"&nbsp;скрипт&nbsp;падает&nbsp;из-за&nbsp;ограничения&nbsp;в&nbsp;количестве&nbsp;рекурсий&nbsp;(250)
<br /></span><span style="color: #0000BB">$echo&nbsp;</span><span style="color: #007700">=&nbsp;</span><span style="color: #DD0000">''</span><span style="color: #007700">;
<br />function&nbsp;</span><span style="color: #0000BB">getCode</span><span style="color: #007700">(</span><span style="color: #0000BB">$n</span><span style="color: #007700">){
<br />&nbsp;&nbsp;&nbsp;&nbsp;global&nbsp;</span><span style="color: #0000BB">$alphabet</span><span style="color: #007700">;
<br />&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;</span><span style="color: #0000BB">$alphabet</span><span style="color: #007700">[(</span><span style="color: #0000BB">$n</span><span style="color: #007700">-</span><span style="color: #0000BB">1</span><span style="color: #007700">)];
<br />}
<br />function&nbsp;</span><span style="color: #0000BB">getTimer</span><span style="color: #007700">(</span><span style="color: #0000BB">$start</span><span style="color: #007700">){
<br />&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">$fin&nbsp;</span><span style="color: #007700">=&nbsp;</span><span style="color: #0000BB">microtime</span><span style="color: #007700">(</span><span style="color: #0000BB">true</span><span style="color: #007700">);
<br />
<br />&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;(</span><span style="color: #0000BB">$fin&nbsp;</span><span style="color: #007700">+&nbsp;</span><span style="color: #0000BB">$start</span><span style="color: #007700">);
<br />}
<br />function&nbsp;</span><span style="color: #0000BB">getFinCode</span><span style="color: #007700">(</span><span style="color: #0000BB">$X</span><span style="color: #007700">){
<br />&nbsp;&nbsp;&nbsp;&nbsp;global&nbsp;</span><span style="color: #0000BB">$alphabet</span><span style="color: #007700">;
<br />&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">$col&nbsp;</span><span style="color: #007700">=&nbsp;</span><span style="color: #0000BB">strlen</span><span style="color: #007700">(</span><span style="color: #0000BB">$alphabet</span><span style="color: #007700">);
<br />&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">$L&nbsp;</span><span style="color: #007700">=&nbsp;</span><span style="color: #0000BB">floor</span><span style="color: #007700">(</span><span style="color: #0000BB">$X&nbsp;</span><span style="color: #007700">/&nbsp;</span><span style="color: #0000BB">$col</span><span style="color: #007700">);&nbsp;</span><span style="color: #FF8000">//&nbsp;первые&nbsp;буквы
<br />&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">$G&nbsp;</span><span style="color: #007700">=&nbsp;</span><span style="color: #0000BB">$L&nbsp;</span><span style="color: #007700">*&nbsp;</span><span style="color: #0000BB">$col</span><span style="color: #007700">;&nbsp;</span><span style="color: #FF8000">//&nbsp;координата&nbsp;последнего&nbsp;значения&nbsp;предыдущего&nbsp;разряда&nbsp;(ZZ,&nbsp;например)
<br />&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">$K&nbsp;</span><span style="color: #007700">=&nbsp;</span><span style="color: #0000BB">$X&nbsp;</span><span style="color: #007700">-&nbsp;</span><span style="color: #0000BB">$G</span><span style="color: #007700">;&nbsp;</span><span style="color: #FF8000">//&nbsp;последняя&nbsp;буква&nbsp;$alph&nbsp;(26,&nbsp;например)
<br />&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #007700">if(!</span><span style="color: #0000BB">$K</span><span style="color: #007700">){
<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">$K&nbsp;</span><span style="color: #007700">=&nbsp;</span><span style="color: #0000BB">$col</span><span style="color: #007700">;&nbsp;</span><span style="color: #FF8000">//&nbsp;если&nbsp;последняя&nbsp;буква&nbsp;=&nbsp;0,&nbsp;значит&nbsp;это&nbsp;конец&nbsp;разряда&nbsp;(ZZZ,&nbsp;например),&nbsp;и&nbsp;эта&nbsp;буква&nbsp;-&nbsp;последняя&nbsp;в&nbsp;alphabet
<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #007700">--</span><span style="color: #0000BB">$L</span><span style="color: #007700">;&nbsp;</span><span style="color: #FF8000">//&nbsp;предыдущие&nbsp;буквы,&nbsp;соответственно,&nbsp;тоже&nbsp;нужно&nbsp;сдвинуть&nbsp;назад
<br />&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #007700">}
<br />&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">$res</span><span style="color: #007700">[]&nbsp;=&nbsp;</span><span style="color: #0000BB">$K</span><span style="color: #007700">;
<br />&nbsp;&nbsp;&nbsp;&nbsp;if(</span><span style="color: #0000BB">$L&nbsp;</span><span style="color: #007700">&gt;&nbsp;</span><span style="color: #0000BB">$col</span><span style="color: #007700">){
<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #FF8000">//&nbsp;если&nbsp;"первая&nbsp;буква"&nbsp;выходит&nbsp;за&nbsp;рамки&nbsp;длины&nbsp;строки,&nbsp;значит&nbsp;это&nbsp;не&nbsp;одна&nbsp;буква
<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">$res</span><span style="color: #007700">[]&nbsp;=&nbsp;</span><span style="color: #0000BB">getFinCode</span><span style="color: #007700">(</span><span style="color: #0000BB">$L</span><span style="color: #007700">);
<br />&nbsp;&nbsp;&nbsp;&nbsp;}
<br />&nbsp;&nbsp;&nbsp;&nbsp;else{
<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #FF8000">//&nbsp;а&nbsp;в&nbsp;этом&nbsp;случае&nbsp;одна
<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">$res</span><span style="color: #007700">[]&nbsp;=&nbsp;</span><span style="color: #0000BB">$L</span><span style="color: #007700">;
<br />&nbsp;&nbsp;&nbsp;&nbsp;}
<br />&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;</span><span style="color: #0000BB">$res</span><span style="color: #007700">;
<br />}
<br />function&nbsp;</span><span style="color: #0000BB">parseFinCode</span><span style="color: #007700">(</span><span style="color: #0000BB">$X</span><span style="color: #007700">){
<br />&nbsp;&nbsp;&nbsp;&nbsp;global&nbsp;</span><span style="color: #0000BB">$gar</span><span style="color: #007700">;
<br />&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">$r&nbsp;</span><span style="color: #007700">=&nbsp;</span><span style="color: #0000BB">getFinCode</span><span style="color: #007700">(</span><span style="color: #0000BB">$X</span><span style="color: #007700">);&nbsp;</span><span style="color: #FF8000">//&nbsp;получаем&nbsp;многомерный&nbsp;массив&nbsp;с&nbsp;цифрами&nbsp;позиций&nbsp;букв
<br />&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">$gar&nbsp;</span><span style="color: #007700">=&nbsp;</span><span style="color: #DD0000">''</span><span style="color: #007700">;&nbsp;</span><span style="color: #FF8000">//&nbsp;обнуляем&nbsp;глобальную&nbsp;строку
<br />&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">array_walk_recursive</span><span style="color: #007700">(</span><span style="color: #0000BB">$r</span><span style="color: #007700">,&nbsp;</span><span style="color: #DD0000">'getArrayItem'</span><span style="color: #007700">);&nbsp;</span><span style="color: #FF8000">//&nbsp;вытаскиваем&nbsp;цифры&nbsp;массива,&nbsp;формируем&nbsp;из&nbsp;них&nbsp;строку
<br />&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #007700">return&nbsp;</span><span style="color: #DD0000">'('</span><span style="color: #007700">.</span><span style="color: #0000BB">$X</span><span style="color: #007700">.</span><span style="color: #DD0000">')&nbsp;'</span><span style="color: #007700">.</span><span style="color: #0000BB">strrev</span><span style="color: #007700">(</span><span style="color: #0000BB">$gar</span><span style="color: #007700">);&nbsp;</span><span style="color: #FF8000">//&nbsp;переворачиваем,&nbsp;так&nbsp;как&nbsp;в&nbsp;массиве&nbsp;цифры&nbsp;лежали&nbsp;с&nbsp;конца
<br />&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #007700">return&nbsp;</span><span style="color: #DD0000">'('</span><span style="color: #007700">.</span><span style="color: #0000BB">$X</span><span style="color: #007700">.</span><span style="color: #DD0000">')&nbsp;'</span><span style="color: #007700">.</span><span style="color: #0000BB">strrev</span><span style="color: #007700">(</span><span style="color: #0000BB">$gar</span><span style="color: #007700">);&nbsp;</span><span style="color: #FF8000">//&nbsp;переворачиваем,&nbsp;так&nbsp;как&nbsp;в&nbsp;массиве&nbsp;цифры&nbsp;лежали&nbsp;с&nbsp;конца
<br /></span><span style="color: #007700">}
<br />function&nbsp;</span><span style="color: #0000BB">getArrayItem</span><span style="color: #007700">(</span><span style="color: #0000BB">$item</span><span style="color: #007700">,&nbsp;</span><span style="color: #0000BB">$key</span><span style="color: #007700">)
<br />{
<br />&nbsp;&nbsp;&nbsp;&nbsp;global&nbsp;</span><span style="color: #0000BB">$gar</span><span style="color: #007700">;
<br />&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">$gar&nbsp;</span><span style="color: #007700">.=&nbsp;</span><span style="color: #0000BB">getCode</span><span style="color: #007700">(</span><span style="color: #0000BB">$item</span><span style="color: #007700">);&nbsp;</span><span style="color: #FF8000">//&nbsp;превращаем&nbsp;цифру&nbsp;в&nbsp;соответствующую&nbsp;букву&nbsp;alphabet
<br /></span><span style="color: #007700">}
<br />function&nbsp;</span><span style="color: #0000BB">getNumber</span><span style="color: #007700">(</span><span style="color: #0000BB">$code</span><span style="color: #007700">){
<br />&nbsp;&nbsp;&nbsp;&nbsp;global&nbsp;</span><span style="color: #0000BB">$alphabet</span><span style="color: #007700">;
<br />&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">$ac&nbsp;</span><span style="color: #007700">=&nbsp;</span><span style="color: #0000BB">strlen</span><span style="color: #007700">(</span><span style="color: #0000BB">$alphabet</span><span style="color: #007700">);
<br />&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">$c&nbsp;</span><span style="color: #007700">=&nbsp;</span><span style="color: #0000BB">strlen</span><span style="color: #007700">(</span><span style="color: #0000BB">$code</span><span style="color: #007700">);
<br />&nbsp;&nbsp;&nbsp;&nbsp;for(</span><span style="color: #0000BB">$i</span><span style="color: #007700">=</span><span style="color: #0000BB">0</span><span style="color: #007700">;&nbsp;</span><span style="color: #0000BB">$i</span><span style="color: #007700">&lt;</span><span style="color: #0000BB">$c</span><span style="color: #007700">;&nbsp;</span><span style="color: #0000BB">$i</span><span style="color: #007700">++){
<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">$l&nbsp;</span><span style="color: #007700">=&nbsp;</span><span style="color: #0000BB">mb_strtoupper</span><span style="color: #007700">(</span><span style="color: #0000BB">$code</span><span style="color: #007700">[</span><span style="color: #0000BB">$i</span><span style="color: #007700">]);
<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">$pos&nbsp;</span><span style="color: #007700">=&nbsp;</span><span style="color: #0000BB">strpos</span><span style="color: #007700">(</span><span style="color: #0000BB">$alphabet</span><span style="color: #007700">,&nbsp;</span><span style="color: #0000BB">$l</span><span style="color: #007700">);
<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if(</span><span style="color: #0000BB">$pos&nbsp;</span><span style="color: #007700">!==&nbsp;</span><span style="color: #0000BB">false</span><span style="color: #007700">){
<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">$arr</span><span style="color: #007700">[]&nbsp;=&nbsp;(</span><span style="color: #0000BB">$pos</span><span style="color: #007700">+</span><span style="color: #0000BB">1</span><span style="color: #007700">);
<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;else{
<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;exit(</span><span style="color: #DD0000">'Таких&nbsp;символов&nbsp;нет&nbsp;в&nbsp;кодировке'</span><span style="color: #007700">);
<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
<br />&nbsp;&nbsp;&nbsp;&nbsp;}
<br />&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">$pop&nbsp;</span><span style="color: #007700">=&nbsp;</span><span style="color: #0000BB">array_pop</span><span style="color: #007700">(</span><span style="color: #0000BB">$arr</span><span style="color: #007700">);
<br />&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">var_dump</span><span style="color: #007700">(</span><span style="color: #0000BB">$pop</span><span style="color: #007700">);
<br />&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;</span><span style="color: #0000BB">getRowSum</span><span style="color: #007700">(</span><span style="color: #0000BB">$ac</span><span style="color: #007700">,&nbsp;</span><span style="color: #0000BB">$c</span><span style="color: #007700">,&nbsp;</span><span style="color: #0000BB">$pop</span><span style="color: #007700">);
<br />}
<br />function&nbsp;</span><span style="color: #0000BB">getRowSum</span><span style="color: #007700">(</span><span style="color: #0000BB">$ac</span><span style="color: #007700">,&nbsp;</span><span style="color: #0000BB">$c</span><span style="color: #007700">,&nbsp;</span><span style="color: #0000BB">$coeff</span><span style="color: #007700">){
<br />&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">$r&nbsp;</span><span style="color: #007700">=&nbsp;</span><span style="color: #0000BB">$coeff</span><span style="color: #007700">;
<br />&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">$ci&nbsp;</span><span style="color: #007700">=&nbsp;</span><span style="color: #0000BB">$c</span><span style="color: #007700">;
<br />&nbsp;&nbsp;&nbsp;&nbsp;for(</span><span style="color: #0000BB">$i</span><span style="color: #007700">=</span><span style="color: #0000BB">0</span><span style="color: #007700">;&nbsp;</span><span style="color: #0000BB">$i</span><span style="color: #007700">&lt;</span><span style="color: #0000BB">$c</span><span style="color: #007700">;&nbsp;</span><span style="color: #0000BB">$i</span><span style="color: #007700">++)&nbsp;{
<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;for&nbsp;(</span><span style="color: #0000BB">$ii&nbsp;</span><span style="color: #007700">=&nbsp;</span><span style="color: #0000BB">0</span><span style="color: #007700">;&nbsp;</span><span style="color: #0000BB">$ii&nbsp;</span><span style="color: #007700">&lt;&nbsp;</span><span style="color: #0000BB">$ci</span><span style="color: #007700">;&nbsp;</span><span style="color: #0000BB">$ii</span><span style="color: #007700">++)&nbsp;{
<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--</span><span style="color: #0000BB">$ci</span><span style="color: #007700">;
<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">$r&nbsp;</span><span style="color: #007700">+=&nbsp;</span><span style="color: #0000BB">pow</span><span style="color: #007700">(</span><span style="color: #0000BB">$ac</span><span style="color: #007700">,&nbsp;</span><span style="color: #0000BB">$i</span><span style="color: #007700">);
<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">$r&nbsp;</span><span style="color: #007700">+=&nbsp;</span><span style="color: #0000BB">pow</span><span style="color: #007700">(</span><span style="color: #0000BB">$ac</span><span style="color: #007700">,&nbsp;</span><span style="color: #0000BB">$i</span><span style="color: #007700">);
<br />&nbsp;&nbsp;&nbsp;&nbsp;}
<br />&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;</span><span style="color: #0000BB">$r</span><span style="color: #007700">;
<br />&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #FF8000">/*
<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;$coeff&nbsp;+&nbsp;($ac^0)&nbsp;+&nbsp;($ac^1)&nbsp;+&nbsp;..&nbsp;+&nbsp;($ac^$c);
<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;но&nbsp;походу&nbsp;для&nbsp;3значных&nbsp;кодов
<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;($ac^0)&nbsp;+&nbsp;($ac^1)&nbsp;+&nbsp;..&nbsp;+&nbsp;($ac^3)&nbsp;+&nbsp;!!&nbsp;(($ac^0)&nbsp;+&nbsp;($ac^1)&nbsp;+&nbsp;..&nbsp;+&nbsp;($ac^2))&nbsp;+&nbsp;$coeff;
<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/
<br /></span><span style="color: #007700">}
<br />if(</span><span style="color: #0000BB">$_REQUEST</span><span style="color: #007700">){
<br />&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">$start&nbsp;</span><span style="color: #007700">=&nbsp;-</span><span style="color: #0000BB">microtime</span><span style="color: #007700">(</span><span style="color: #0000BB">true</span><span style="color: #007700">);
<br />&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">$get&nbsp;</span><span style="color: #007700">=&nbsp;(string)</span><span style="color: #0000BB">$_GET</span><span style="color: #007700">[</span><span style="color: #DD0000">'x'</span><span style="color: #007700">];
<br />&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">$getlen&nbsp;</span><span style="color: #007700">=&nbsp;</span><span style="color: #0000BB">strlen</span><span style="color: #007700">(</span><span style="color: #0000BB">$get</span><span style="color: #007700">);
<br />&nbsp;&nbsp;&nbsp;&nbsp;if(</span><span style="color: #0000BB">$getlen</span><span style="color: #007700">&lt;</span><span style="color: #0000BB">$maxgetlen</span><span style="color: #007700">)&nbsp;{
<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if&nbsp;(</span><span style="color: #0000BB">$get&nbsp;</span><span style="color: #007700">&lt;&nbsp;</span><span style="color: #0000BB">1</span><span style="color: #007700">)&nbsp;{
<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">$get&nbsp;</span><span style="color: #007700">=&nbsp;</span><span style="color: #0000BB">1</span><span style="color: #007700">;
<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if&nbsp;(</span><span style="color: #0000BB">$get&nbsp;</span><span style="color: #007700">&gt;&nbsp;</span><span style="color: #0000BB">0</span><span style="color: #007700">)&nbsp;{
<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">$echo&nbsp;</span><span style="color: #007700">.=&nbsp;</span><span style="color: #0000BB">parseFinCode</span><span style="color: #007700">(</span><span style="color: #0000BB">$get</span><span style="color: #007700">)&nbsp;.&nbsp;</span><span style="color: #0000BB">PHP_EOL&nbsp;</span><span style="color: #007700">.&nbsp;</span><span style="color: #DD0000">'&lt;br&gt;'</span><span style="color: #007700">;
<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
<br />
<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">$echo&nbsp;</span><span style="color: #007700">.=&nbsp;</span><span style="color: #0000BB">PHP_EOL</span><span style="color: #007700">.</span><span style="color: #DD0000">'&lt;br&gt;&lt;span&nbsp;class="small-text&nbsp;color-gray"&gt;'</span><span style="color: #007700">.</span><span style="color: #0000BB">getTimer</span><span style="color: #007700">(</span><span style="color: #0000BB">$start</span><span style="color: #007700">)&nbsp;.&nbsp;</span><span style="color: #DD0000">'&lt;/span&gt;'</span><span style="color: #007700">;
<br />&nbsp;&nbsp;&nbsp;&nbsp;}
<br />&nbsp;&nbsp;&nbsp;&nbsp;else{
<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">$echo&nbsp;</span><span style="color: #007700">.=&nbsp;</span><span style="color: #DD0000">'Даже&nbsp;великие&nbsp;сервера&nbsp;не&nbsp;смогут&nbsp;прочитать&nbsp;это&nbsp;число'</span><span style="color: #007700">;
<br />&nbsp;&nbsp;&nbsp;&nbsp;}
<br />}</span>
</span>
</code>
        </div>
    </div>
</section>
<div class="header-delimeter"></div>
<!-- Yandex.Metrika counter --><script type="text/javascript"> (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter33791179 = new Ya.Metrika({ id:33791179, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true, trackHash:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks");</script><noscript><div><img src="https://mc.yandex.ru/watch/33791179" style="position:absolute; left:-9999px;" alt="" /></div></noscript><!-- /Yandex.Metrika counter -->
</body>
</html>
<form>
    <input name="x" placeholder="x"><br>
    <input name="n" placeholder="n"><br>
    <button>x^n = y</button>
</form>
<?php
include_once 'functions.php';

$source = <<<TXT
/* Source: */

y := 1.0; i := n;
WHILE i > 0 DO ( * x0^n = x^i * y * )
    IF ODD(i) THEN y := y*x END;
    x := x*x; i := i DIV 2
END

/* //Source */

/* Execution */
Input:
y := 1
n := 3
x := 2
i := 3
--
Calculation:

1|true (* i > 0 *)
2|true (* ODD(i) *), y = 1 * 2 = 2
3|x = 2 * 2 = 4, i = DIV (3, 2) = 1
---
1|true
2|true, y = 2 * 4 = 8
3|x = 4 * 4 = 16, i = DIV (1, 2) = 0
---
1|false
2|
3|
---
Result:
x = 16
i = 0
y = 8

TXT;

$php = <<<'TXT'
/* On PHP */

<?php
$y = 1.0;
$i = (int)$_GET['n'];
if ($i < 0) exit('n shouldn\'t be negative');

$x = (float)$_GET['x'];

while ($i > 0) {
    if (ODD($i)) {
        $y = $y * $x;
    }

    $x = $x * $x;
    $i = DIV($i, 2);
}
TXT;

$y = 1.0;
$i = (int)$_GET['n'];
if ($i < 0) throw new OBException('n shouldn\'t be negative');

$x = (float)$_GET['x'];

while ($i > 0) {
    if (ODD($i)) {
        $y = $y * $x;
    }

    $x = $x * $x;
    $i = DIV($i, 2);
}

echo('y = '.$y);

?><br><br><?php
echo nl2br($source);
?><br><br><?php
echo nl2br($php);

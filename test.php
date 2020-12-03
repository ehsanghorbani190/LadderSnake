<?php
$x1 = $y1 = $x2 = $y2 = 0;
$sw = $pl = 1;
//Dice Number Function
function getRandom()
{
    return mt_rand(1, 6);
}
//Move Function , our board is 5*5 ,we have a snake on x = 3 and y = 4 (goes to x=3 and y =3) and we have a ladder on x = 2 and y = 3 (goes to y = 5 and x = 2)
function move(&$x, &$y, $n)
{
    if (!$x && $n == 6) {
        $x = 1;
        $y = 1;
    } elseif ($x > 0 && $y != 5 && floor(($n + $x) / 5) + $y <= 5) {
        $x += $n;
        while ($x > 5) {
            $y += 1;
            $x -= 5;
        }

    } elseif ($x > 0 && $y == 5 && $x + $n <= 5) {

        $x += $n;

    }
    if ($y == 4 && $x == 3) {
        $y = 3;
    }
    if ($y == 3 && $x == 2) {
        $y = 5;
    }
}
//Play function 
//@param $role is showing who's to play
//@param $sw is for game ender
function play(&$role,  &$sw)
{
    $n= getRandom();
    global $x1, $x2, $y1, $y2;
    if ($role == 1) {
        move($x1, $y1, $n);
    } else {
        move($x2, $y2, $n);
    }
    if ($x1 == 5 && $y1 == 5) {
        $sw = 0;
        echo "Player 1 Won!";
    } elseif ($x2 == 5 && $y2 == 5) {
        $sw = 0;
        echo "Player 2 Won!";
    } else {
        echo ($x1 == 0) ? "$n not found " : "$n ($y1 , $x1) ";
        echo ($x2 == 0) ? " not found \n" : " ($y2 , $x2) \n";
    }
    if ($n == 6) {
        play($role, $sw);
    } else {
        if ($role == 1) {$role++;} else { $role--;}
    }
}
while ($sw) {
    play($pl, $sw);
}

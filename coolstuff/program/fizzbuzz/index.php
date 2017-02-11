<!DOCTYPE html>
<html>
<head lang="ru">
    <meta charset="UTF-8">
    <title>FizzBuzz PHP</title>
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
                    <a href="/">
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
<section id="bio">
    <div class="content">
        <h1>FizzBuzz на PHP</h1>
        <div class="note">Напишите программу, которая выводит на экран числа от 1 до 100. При этом вместо чисел, кратных трем, программа должна выводить слово «Fizz», а вместо чисел, кратных пяти — слово «Buzz». Если число кратно и 3, и 5, то программа должна выводить слово «FizzBuzz»</div>
        <div class="code">
            <code><span style="color: #000000">
<span style="color: #0000BB">&lt;?php
<br /></span><span style="color: #007700">for&nbsp;(</span><span style="color: #0000BB">$i&nbsp;</span><span style="color: #007700">=&nbsp;</span><span style="color: #0000BB">1</span><span style="color: #007700">;&nbsp;</span><span style="color: #0000BB">$i&nbsp;</span><span style="color: #007700">&lt;=&nbsp;</span><span style="color: #0000BB">100</span><span style="color: #007700">;&nbsp;</span><span style="color: #0000BB">$i</span><span style="color: #007700">++)&nbsp;{
<br />&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">$str&nbsp;</span><span style="color: #007700">=&nbsp;</span><span style="color: #DD0000">''</span><span style="color: #007700">;
<br />&nbsp;&nbsp;&nbsp;&nbsp;if&nbsp;(!(</span><span style="color: #0000BB">$i&nbsp;</span><span style="color: #007700">%&nbsp;</span><span style="color: #0000BB">3</span><span style="color: #007700">))&nbsp;{
<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">$str&nbsp;</span><span style="color: #007700">=&nbsp;</span><span style="color: #DD0000">'Fizz'</span><span style="color: #007700">;
<br />&nbsp;&nbsp;&nbsp;&nbsp;}
<br />&nbsp;&nbsp;&nbsp;&nbsp;if&nbsp;(!(</span><span style="color: #0000BB">$i&nbsp;</span><span style="color: #007700">%&nbsp;</span><span style="color: #0000BB">5</span><span style="color: #007700">))&nbsp;{
<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">$str&nbsp;</span><span style="color: #007700">.=&nbsp;</span><span style="color: #DD0000">'Buzz'</span><span style="color: #007700">;
<br />&nbsp;&nbsp;&nbsp;&nbsp;}
<br />
<br />&nbsp;&nbsp;&nbsp;&nbsp;if&nbsp;(!</span><span style="color: #0000BB">$str</span><span style="color: #007700">)&nbsp;</span><span style="color: #0000BB">$str&nbsp;</span><span style="color: #007700">=&nbsp;</span><span style="color: #0000BB">$i</span><span style="color: #007700">;
<br />&nbsp;&nbsp;&nbsp;&nbsp;echo&nbsp;</span><span style="color: #0000BB">$str&nbsp;</span><span style="color: #007700">.&nbsp;</span><span style="color: #DD0000">'&lt;br&gt;'</span><span style="color: #007700">;
<br />}</span>
</span>
            </code>
        </div>
        <div>
            1<br>2<br>Fizz<br>4<br>Buzz<br>Fizz<br>7<br>8<br>Fizz<br>Buzz<br>11<br>Fizz<br>13<br>14<br>FizzBuzz<br>16<br>17<br>Fizz<br>19<br>Buzz<br>Fizz<br>22<br>23<br>Fizz<br>Buzz<br>26<br>Fizz<br>28<br>29<br>FizzBuzz<br>31<br>32<br>Fizz<br>34<br>Buzz<br>Fizz<br>37<br>38<br>Fizz<br>Buzz<br>41<br>Fizz<br>43<br>44<br>FizzBuzz<br>46<br>47<br>Fizz<br>49<br>Buzz<br>Fizz<br>52<br>53<br>Fizz<br>Buzz<br>56<br>Fizz<br>58<br>59<br>FizzBuzz<br>61<br>62<br>Fizz<br>64<br>Buzz<br>Fizz<br>67<br>68<br>Fizz<br>Buzz<br>71<br>Fizz<br>73<br>74<br>FizzBuzz<br>76<br>77<br>Fizz<br>79<br>Buzz<br>Fizz<br>82<br>83<br>Fizz<br>Buzz<br>86<br>Fizz<br>88<br>89<br>FizzBuzz<br>91<br>92<br>Fizz<br>94<br>Buzz<br>Fizz<br>97<br>98<br>Fizz<br>Buzz<br>
        </div>
    </div>
</section>
<div class="header-delimeter"></div>
<!-- Yandex.Metrika counter --><script type="text/javascript"> (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter33791179 = new Ya.Metrika({ id:33791179, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true, trackHash:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks");</script><noscript><div><img src="https://mc.yandex.ru/watch/33791179" style="position:absolute; left:-9999px;" alt="" /></div></noscript><!-- /Yandex.Metrika counter -->
</body>
</html>
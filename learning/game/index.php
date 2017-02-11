<!DOCTYPE html>
<html>
<head lang="ru">
    <meta charset="UTF-8">
    <title>Игра-тест по PHP</title>
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="/css/main.css" />
    <style>
        div {
            margin:0 0 0.75em 0;
        }

        input[type="radio"] {
            display:none;
        }
        input[type="radio"] + label {
            display: block;
            width: 100%;
            font-family:Arial, sans-serif;
            font-size:14px;
        }
        input[type="radio"] + label span {
            display:inline-block;
            width:9px;
            height:9px;
            padding:4px;
            margin:-1px 4px 0 0;
            vertical-align:middle;
            cursor:pointer;
            -moz-border-radius:  50%;
            border-radius:  50%;
        }

        input[type="radio"] + label span {
            border:1px #587480 solid;
            background-color:white;
        }

        input[type="radio"] + label:hover span{
            padding:0;
            border-width: 5px;
            display:inline-block;
            margin:-1px 4px 0 0;
            vertical-align:middle;
            cursor:pointer;
            -moz-border-radius:  50%;
            border-radius:  50%;

            background-color:transparent;
        }

        input[type="radio"]:checked + label span{
            padding:0;
            border-width: 5px;
        }

        input[type="radio"]:checked + label span#true{
            border-color: #00A200;
        }
        input[type="radio"]:checked + label span#false{
            border-color: #DC0303;
        }

        input[type="radio"] + label span,
        input[type="radio"]:checked + label span {
            -webkit-transition:background-color linear;
            -o-transition:background-color linear;
            -moz-transition:background-color linear;
            transition:background-color linear;
        }
    </style>
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
                <li class="nav-menu-item"><a>Аккаунты</a></li>
            </ul>
        </div>
    </nav>
</header>
<div class="header-delimeter"></div>
<section>
    <div class="content">
        <h1>Тест по PHP</h1>
        <div>
            <code><span style="color: #000000">
<span style="color: #0000BB">&lt;?php
<br /></span><span style="color: #FF8000">/*
<br />&nbsp;*&nbsp;Что&nbsp;выведет&nbsp;этот&nbsp;код?
<br />&nbsp;*/
<br />
<br /></span><span style="color: #0000BB">$i&nbsp;</span><span style="color: #007700">=&nbsp;</span><span style="color: #0000BB">0</span><span style="color: #007700">;
<br /></span><span style="color: #0000BB">$i&nbsp;</span><span style="color: #007700">=&nbsp;</span><span style="color: #0000BB">$i</span><span style="color: #007700">++&nbsp;+&nbsp;--</span><span style="color: #0000BB">$i&nbsp;</span><span style="color: #007700">+&nbsp;</span><span style="color: #0000BB">$i</span><span style="color: #007700">++&nbsp;+&nbsp;echo&nbsp;</span><span style="color: #0000BB">$i</span><span style="color: #007700">;
<br /></span>
</span>
            </code>
        </div>
        <div>
            <form name="test" method="post" action="result.php">
                <div>
                    <input type="radio" name="answer" value="1" id="ans_1">
                    <label for="ans_1"><span id="true"></span>4</label>
                </div>
                <div>
                    <input type="radio" name="answer" value="2" id="ans_2">
                    <label for="ans_2"><span id="false"></span>3</label>
                </div>
                <div>
                    <input type="radio" name="answer" value="3" id="ans_3">
                    <label for="ans_3"><span id="false"></span>6</label>
                </div>
                <div>
                    <input type="radio" name="answer" value="4" id="ans_4">
                    <label for="ans_4"><span id="false"></span>-2</label>
                </div>
            </form>
        </div>
    </div>
</section>
<div class="header-delimeter"></div>
<!-- Yandex.Metrika counter --><script type="text/javascript"> (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter33791179 = new Ya.Metrika({ id:33791179, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true, trackHash:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks");</script><noscript><div><img src="https://mc.yandex.ru/watch/33791179" style="position:absolute; left:-9999px;" alt="" /></div></noscript><!-- /Yandex.Metrika counter -->
</body>
</html>
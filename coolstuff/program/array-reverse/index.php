<!DOCTYPE html>
<html>
<head lang="ru">
    <meta charset="UTF-8">
    <title>Array reverse PHP</title>
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
        <h1>Array reverse на PHP</h1>
        <div class="note">v.1 для массивов, с ключами 0..n</div>
        <div class="code">
            <code><span style="color: #000000">
<span style="color: #0000BB">&lt;?php
<br /></span><span style="color: #FF8000">//&nbsp;Медленнее&nbsp;array_reverse()&nbsp;в&nbsp;~3&nbsp;раза
<br />
<br /></span><span style="color: #007700">function&nbsp;</span><span style="color: #0000BB">reverse&nbsp;</span><span style="color: #007700">(</span><span style="color: #0000BB">$arr</span><span style="color: #007700">)
<br />{
<br />&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">$length&nbsp;</span><span style="color: #007700">=&nbsp;</span><span style="color: #0000BB">count</span><span style="color: #007700">(</span><span style="color: #0000BB">$arr</span><span style="color: #007700">)&nbsp;-&nbsp;</span><span style="color: #0000BB">1</span><span style="color: #007700">;
<br />
<br />&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">$lcenter&nbsp;</span><span style="color: #007700">=&nbsp;</span><span style="color: #0000BB">$length&nbsp;</span><span style="color: #007700">/&nbsp;</span><span style="color: #0000BB">2</span><span style="color: #007700">;
<br />
<br />&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">$temp1&nbsp;</span><span style="color: #007700">=&nbsp;</span><span style="color: #DD0000">''</span><span style="color: #007700">;
<br />&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">$temp2&nbsp;</span><span style="color: #007700">=&nbsp;</span><span style="color: #DD0000">''</span><span style="color: #007700">;
<br />&nbsp;&nbsp;&nbsp;&nbsp;for&nbsp;(</span><span style="color: #0000BB">$i&nbsp;</span><span style="color: #007700">=&nbsp;</span><span style="color: #0000BB">0</span><span style="color: #007700">;&nbsp;</span><span style="color: #0000BB">$i&nbsp;</span><span style="color: #007700">&lt;=&nbsp;</span><span style="color: #0000BB">$lcenter</span><span style="color: #007700">;&nbsp;</span><span style="color: #0000BB">$i</span><span style="color: #007700">++)&nbsp;{
<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">$temp1&nbsp;</span><span style="color: #007700">=&nbsp;</span><span style="color: #0000BB">$arr</span><span style="color: #007700">[</span><span style="color: #0000BB">$i</span><span style="color: #007700">];
<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">$temp2&nbsp;</span><span style="color: #007700">=&nbsp;</span><span style="color: #0000BB">$arr</span><span style="color: #007700">[(</span><span style="color: #0000BB">$length&nbsp;</span><span style="color: #007700">-&nbsp;</span><span style="color: #0000BB">$i</span><span style="color: #007700">)];
<br />
<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">$arr</span><span style="color: #007700">[</span><span style="color: #0000BB">$i</span><span style="color: #007700">]&nbsp;=&nbsp;</span><span style="color: #0000BB">$temp2</span><span style="color: #007700">;
<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">$arr</span><span style="color: #007700">[(</span><span style="color: #0000BB">$length&nbsp;</span><span style="color: #007700">-&nbsp;</span><span style="color: #0000BB">$i</span><span style="color: #007700">)]&nbsp;=&nbsp;</span><span style="color: #0000BB">$temp1</span><span style="color: #007700">;
<br />&nbsp;&nbsp;&nbsp;&nbsp;}
<br />
<br />&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;</span><span style="color: #0000BB">$arr</span><span style="color: #007700">;
<br />}</span>
</span>
            </code>
        </div>
        <div class="note">v.1.1</div>
        <div class="code">
            <code><span style="color: #000000">
<span style="color: #0000BB">&lt;?php
<br /></span><span style="color: #007700">function&nbsp;</span><span style="color: #0000BB">reverse&nbsp;</span><span style="color: #007700">(</span><span style="color: #0000BB">$arr</span><span style="color: #007700">)
<br />{
<br />&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">$length&nbsp;</span><span style="color: #007700">=&nbsp;</span><span style="color: #0000BB">count</span><span style="color: #007700">(</span><span style="color: #0000BB">$arr</span><span style="color: #007700">)&nbsp;-&nbsp;</span><span style="color: #0000BB">1</span><span style="color: #007700">;
<br />
<br />&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">$lcenter&nbsp;</span><span style="color: #007700">=&nbsp;</span><span style="color: #0000BB">$length&nbsp;</span><span style="color: #007700">/&nbsp;</span><span style="color: #0000BB">2</span><span style="color: #007700">;
<br />
<br />&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">$temp&nbsp;</span><span style="color: #007700">=&nbsp;</span><span style="color: #DD0000">''</span><span style="color: #007700">;
<br />&nbsp;&nbsp;&nbsp;&nbsp;for&nbsp;(</span><span style="color: #0000BB">$i&nbsp;</span><span style="color: #007700">=&nbsp;</span><span style="color: #0000BB">0</span><span style="color: #007700">;&nbsp;</span><span style="color: #0000BB">$i&nbsp;</span><span style="color: #007700">&lt;=&nbsp;</span><span style="color: #0000BB">$lcenter</span><span style="color: #007700">;&nbsp;</span><span style="color: #0000BB">$i</span><span style="color: #007700">++)&nbsp;{
<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">$temp&nbsp;</span><span style="color: #007700">=&nbsp;</span><span style="color: #0000BB">$arr</span><span style="color: #007700">[</span><span style="color: #0000BB">$i</span><span style="color: #007700">];
<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">$arr</span><span style="color: #007700">[</span><span style="color: #0000BB">$i</span><span style="color: #007700">]&nbsp;=&nbsp;</span><span style="color: #0000BB">$arr</span><span style="color: #007700">[(</span><span style="color: #0000BB">$length&nbsp;</span><span style="color: #007700">-&nbsp;</span><span style="color: #0000BB">$i</span><span style="color: #007700">)];
<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">$arr</span><span style="color: #007700">[(</span><span style="color: #0000BB">$length&nbsp;</span><span style="color: #007700">-&nbsp;</span><span style="color: #0000BB">$i</span><span style="color: #007700">)]&nbsp;=&nbsp;</span><span style="color: #0000BB">$temp</span><span style="color: #007700">;
<br />&nbsp;&nbsp;&nbsp;&nbsp;}
<br />
<br />&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;</span><span style="color: #0000BB">$arr</span><span style="color: #007700">;
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
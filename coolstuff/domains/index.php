<!DOCTYPE html>
<html>
<head lang="ru">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta name="description" content="Это самые бесполезные люди на Земле" />
    <title>Ненавижу киберсквоттеров!</title>
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
                <li class="nav-menu-item notactive"><a>Блог</a></li>
            </ul>
        </div>
    </nav>
</header>
<div class="header-delimeter"></div>
<section id="bio">
    <div class="content">
        <h1>Ненавижу киберсквоттеров</h1>
        <div>Но собираю интересные домены</div>
        <?php if (isset($_GET['domain']) && is_string($_GET['domain'])): ?>
            <h4><?= htmlspecialchars(idn_to_utf8(substr($_GET['domain'], 0, 50))) ?></h4>
        <?php endif; ?>
        <div class="note-mini">Могу отдать или продать.</div>
        <ul class="ul-list">
            <li>
                <a href="http://asaprocky.ru">asaprocky.ru</a>
            </li>
            <li>
                <a href="http://jenner.ru">jenner.ru</a>
            </li>
            <li>
                <a href="http://lilwayne.ru">lilwayne.ru</a>
            </li>
        </ul>
        <div>Почта указана в разделе "<a href="/accounts.html">Аккаунты</a>"</div>
    </div>
</section>
<div class="header-delimeter"></div>
<!-- Yandex.Metrika counter --><script type="text/javascript"> (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter33791179 = new Ya.Metrika({ id:33791179, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true, trackHash:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks");</script><noscript><div><img src="https://mc.yandex.ru/watch/33791179" style="position:absolute; left:-9999px;" alt="" /></div></noscript><!-- /Yandex.Metrika counter -->
</body>
</html>

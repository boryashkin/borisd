<?php
define('DB_NAME', 'domainslibrary.db');
define('DB_PREFIX', 'all_');

$page = (int)$_GET['page'];
if ($page <= 0 ) $page = 1;
$step = 30;
$from = ($page - 1) * $step;
$to = ($page - 1) + $step;

$db = new SQLite3(DB_NAME);

$domainslist = [];

$result = $db->query('SELECT * FROM `' . DB_PREFIX . 'profiles` LIMIT ' . $from . ', ' . $to);
while ($row = $result->fetchArray())
{
    $domainslist[$row['profile_id']] = $row['homepage'];
}
$db->close();
?>
<!DOCTYPE html>
<html>
<head lang="ru">
    <meta charset="UTF-8">
    <title>База домашних страниц</title>
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
<section>
    <div class="content">
        <h1>База домашних страниц</h1>
        <?php if ($page == 1):?>
            <span class="note-mini">Избранное</span>
            <ul>
                <li data-tags="home-page web architecture">
                    <a href="http://bolknote.ru/">Евгений Степанищев</a>
                </li>
                <li data-tags="home-page patterns architecture">
                    <a href="https://martinfowler.com/">Martin Fowler</a>
                </li>
                <li data-tags="cs home-page blog caltech">
                    <a href="http://worrydream.com">Bret Victor</a>
                </li>
                <li data-tags="c python blog">
                    <a href="http://drewdevault.com/">Drew DeVault</a>
                </li>
                <li data-tags="architecture">
                    <a href="http://www.giorgiosironi.com/">Giorgio Sironi</a>
                </li>
                <li data-tags="php ddd">
                    <a href="http://stakeholderwhisperer.com/">Konstantin Kudryashov</a>
                </li>
                <li data-tags="php ddd">
                    <a href="http://verraes.net/">Mathias Verraes</a>
                </li>
                <li data-tags="php web">
                    <a href="https://jtreminio.com/">Juan Treminio</a>
                </li>
                <li data-tags="php core c">
                    <a href="http://blog.krakjoe.ninja/">Joe Watkins</a>
                </li>
                <li data-tags="php go">
                    <a href="https://www.christophh.net/">Christoph Hochstrasser</a>
                </li>
                <li data-tags="php senior">
                    <a href="http://cebe.cc">Carsten Brandt</a>
                </li>
                <li>
                    <a href="http://secretgeek.net/">Leon Bambrick</a>
                </li>
                <li>
                    <a href="http://www.merkushin.com">Merkushin Dmitry</a>
                </li>
                <li>
                    <a href="http://travisneilson.com">Travis Neilson</a>
                </li>
                <li>
                    <a href="https://dmitri.shuralyov.com">Dmitri Shuralyov</a>
                </li>
                <li>
                    <a href="https://jgalenson.github.io">Joel Galenson</a>
                </li>
                <li>
                    <a href="http://web.eecs.umich.edu/~snaglee/">Sang Won Lee</a>
                </li>
                <li>
                    <a href="https://www.inf.ethz.ch/personal/wirth/">Никлаус Вирт</a>
                </li>
                <li data-tags="blog phd cs">
                    <a href="http://tom7.org">Tom Murphy</a>
                </li>
                <li>
                    <a href="http://blog.codinghorror.com">Jeff Atwood</a>
                </li>
                <li data-tags="blog">
                    <a href="http://www.joelonsoftware.com">Joel Spolsky</a>
                </li>
                <li>
                    <a href="http://tom.preston-werner.com">Tom Preston-Werner</a>
                </li>
                <li>
                    <a href="http://blog.jdevelop.com">Jdevelop (Eugene Dzhurinsky?)</a>
                </li>
                <li>
                    <a href="http://dobryakov.com">Григорий Добряков</a>
                </li>
                <li>
                    <a href="https://ryan.boren.me">Ryan Boren</a>
                </li>
                <li>
                    <a href="https://richadams.me">Rich Adams</a>
                </li>
                <li>
                    <a href="https://thomas.rabaix.net">Thomas Rabaix</a>
                </li>
                <li>
                    <a href="http://elnur.pro">Elnur Abdurrakhimov</a>
                </li>
                <li>
                    <a href="http://afilina.com">Anna Filina</a>
                </li>
                <li>
                    <a href="http://glebradchenko.ru">Глеб Радченко</a>
                </li>
                <li>
                    <a href="http://explainextended.com/">Quassnoi</a>
                </li>
                <li>
                    <a href="http://torshina.me">Елена Торшина</a>
                </li>

            </ul>
        <?php endif; ?>
        <form action="search.php" method="get">
            <input type="text" name="q" value="<?= $q ?>" placeholder="search"/>
            <input type="submit" value="Search" />
        </form>
        <?php if ($page == 1):?>
            <span class="note-mini">Спаршенные профили SO; когда нибудь разберу (придумаю алгоритм). В планах большая рассортированная по всевозможным крупицам библиотека домашних страниц.</span>
        <?php endif; ?>
        <ul>
            <?php foreach ($domainslist as $profile_id => $homepage) { ?>
                <li>
                    <span><a href="http://stackoverflow.com/users/<?= $profile_id ?>" target="_blank">user# <?= $profile_id ?></a>: </span><span><a href="<?= $homepage ?>" target="_blank"><?= $homepage ?></a></span>
                </li>
            <?php } ?>
        </ul>
        <br><br>
        <?php if ($page > 1) { ?><a href="?page=<?= ($page - 1);?>"> < Prev</a> | <?= $page ?> | <?php } ?><a href="?page=<?= ($page + 1);?>">Next ></a>
    </div>
</section>
<div class="header-delimeter"></div>
<!-- Yandex.Metrika counter --><script type="text/javascript"> (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter33791179 = new Ya.Metrika({ id:33791179, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true, trackHash:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks");</script><noscript><div><img src="https://mc.yandex.ru/watch/33791179" style="position:absolute; left:-9999px;" alt="" /></div></noscript><!-- /Yandex.Metrika counter -->
</body>
</html>

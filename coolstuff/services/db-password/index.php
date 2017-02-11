<!DOCTYPE html>
<html>
<head lang="ru">
    <meta charset="UTF-8">
    <meta name="description" content="Восстановление пароля Worpdress, ImageCMS, Битрикс. Пароли для баз данных фреймворков и CMS" />
    <title>DB passwords for</title>
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="/css/main.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
    <script src="handler.js"></script>
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
        <h1>Хэши паролей для таблиц пользователей</h1>
        <div class="note">Иногда есть доступ к таблице пользователей в базе данных незнакомой системы,
            а нужен доступ к админке. Пароль, как правило, лежит в базе в виде хэша
            и быстро заменить его на "что-то своё" не получится. И вот - сервис
            генерации этих хэшей для всех встретившихся мне CMS и фреймворков.
        </div>
    </div>
</section>
<section id="wordpress">
    <div class="content">
        <h1>Wordpress</h1>
        <div class="note-mini">
            CMS для блогов.
        </div>
        <div class="delimeter"></div>
        <form name="wordpress" action="actions/wordpress.php" method="GET" class="pure-form">
            <input type="text" name="password" placeholder="Пароль" />
            <input type="submit" value="Получить хэш" class="pure-button pure-button-primary" />
        </form>
        <div>
            <table class="pure-table">
                <caption>`wp_users`</caption>
                <thead>
                <tr>
                    <th>...</th>
                    <th>user_pass</th>
                    <th>...</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>...</td>
                    <td id="wordpress-hash">$P$BfmFOiQHroMNGA.m7PfrsI2rfOfzxr0</td>
                    <td>...</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>
<section id="opencart">
    <div class="content">
        <h1>OpenCart</h1>
        <div class="note-mini">
            CMS для интернет-магазинов.
        </div>
        <div class="delimeter"></div>
        <form name="opencart" action="actions/opencart.php" method="GET" class="pure-form">
            <input type="text" name="password" placeholder="Пароль" />
            <input type="submit" value="Получить хэш" class="pure-button pure-button-primary" />
        </form>
        <div>
            <table class="pure-table">
                <caption>`oc_user`</caption>
                <thead>
                    <tr>
                        <th>...</th>
                        <th>password</th>
                        <th>salt</th>
                        <th>...</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>...</td>
                        <td id="opencart-hash">f0a588198839a492e2e9c3562575f34a478a700d</td>
                        <td id="opencart-salt">311fd093d</td>
                        <td>...</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>
<section id="imagecms">
    <div class="content">
        <h1>ImageCMS</h1>
        <div class="note-mini">
            CMS для интернет-магазинов на фреймворке CodeIgniter
        </div>
        <div class="delimeter"></div>
        <form name="imagecms" action="actions/imagecms.php" method="GET" class="pure-form">
            <input type="text" name="password" placeholder="Пароль" />
            <input type="submit" value="Получить хэш" class="pure-button pure-button-primary" />
        </form>
        <div>
            <table class="pure-table">
                <caption>`users`</caption>
                <thead>
                <tr>
                    <th>...</th>
                    <th>password</th>
                    <th>...</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>...</td>
                    <td id="imagecms-hash">edcf45abcf852306d170873175f45905</td>
                    <td>...</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>
<section id="bitrix">
    <div class="content">
        <h1>Битрикс 15</h1>
        <div class="note-mini">
            Framework / CMS.
        </div>
        <div class="code">
            <code><span style="color: #000000">
<span style="color: #0000BB">&lt;?php
<br /></span><span style="color: #FF8000">/*
<br />&nbsp;*&nbsp;В&nbsp;битриксе&nbsp;для&nbsp;генерации&nbsp;используются&nbsp;уникальные&nbsp;значения&nbsp;из&nbsp;локальной&nbsp;БД,
<br />&nbsp;*&nbsp;поэтому&nbsp;нужно&nbsp;создать&nbsp;такой&nbsp;скрипт&nbsp;на&nbsp;сайте
<br />&nbsp;*/
<br />
<br /></span><span style="color: #007700">require_once(</span><span style="color: #0000BB">$_SERVER</span><span style="color: #007700">[</span><span style="color: #DD0000">"DOCUMENT_ROOT"</span><span style="color: #007700">].</span><span style="color: #DD0000">"/bitrix/modules/main/include/prolog_before.php"</span><span style="color: #007700">);
<br />
<br />
<br /></span><span style="color: #0000BB">$new_password&nbsp;</span><span style="color: #007700">=&nbsp;</span><span style="color: #DD0000">'Пароль'</span><span style="color: #007700">;&nbsp;</span><span style="color: #FF8000">//&nbsp;Новый&nbsp;пароль
<br />
<br />
<br /></span><span style="color: #0000BB">$salt&nbsp;</span><span style="color: #007700">=&nbsp;</span><span style="color: #0000BB">randString</span><span style="color: #007700">(</span><span style="color: #0000BB">8</span><span style="color: #007700">);
<br /></span><span style="color: #0000BB">$PASSWORD&nbsp;</span><span style="color: #007700">=&nbsp;</span><span style="color: #0000BB">$salt</span><span style="color: #007700">.</span><span style="color: #0000BB">md5</span><span style="color: #007700">(</span><span style="color: #0000BB">$salt</span><span style="color: #007700">.</span><span style="color: #0000BB">$new_password</span><span style="color: #007700">);
<br />
<br /></span><span style="color: #0000BB">$salt&nbsp;</span><span style="color: #007700">=&nbsp;&nbsp;</span><span style="color: #0000BB">randString</span><span style="color: #007700">(</span><span style="color: #0000BB">8</span><span style="color: #007700">);
<br /></span><span style="color: #0000BB">$checkword&nbsp;</span><span style="color: #007700">=&nbsp;</span><span style="color: #0000BB">md5</span><span style="color: #007700">(</span><span style="color: #0000BB">CMain</span><span style="color: #007700">::</span><span style="color: #0000BB">GetServerUniqID</span><span style="color: #007700">().</span><span style="color: #0000BB">uniqid</span><span style="color: #007700">());
<br />
<br /></span><span style="color: #0000BB">$CHECKWORD&nbsp;</span><span style="color: #007700">=&nbsp;</span><span style="color: #0000BB">$salt</span><span style="color: #007700">.</span><span style="color: #0000BB">md5</span><span style="color: #007700">(</span><span style="color: #0000BB">$salt</span><span style="color: #007700">.</span><span style="color: #0000BB">$checkword</span><span style="color: #007700">);
<br />
<br /></span><span style="color: #FF8000">//&nbsp;Новые&nbsp;значения&nbsp;для&nbsp;таблицы&nbsp;`b_user`
<br /></span><span style="color: #007700">echo&nbsp;</span><span style="color: #DD0000">'PASSWORD&nbsp;=&nbsp;'&nbsp;</span><span style="color: #007700">.&nbsp;</span><span style="color: #0000BB">$PASSWORD</span><span style="color: #007700">;
<br />echo&nbsp;</span><span style="color: #DD0000">'&lt;br&gt;'</span><span style="color: #007700">;
<br />echo&nbsp;</span><span style="color: #DD0000">'CHECKWORD&nbsp;=&nbsp;'&nbsp;</span><span style="color: #007700">.&nbsp;</span><span style="color: #0000BB">$CHECKWORD</span><span style="color: #007700">;
<br />
<br /></span>
</span>
            </code>
        </div>
    </div>
</section>
<section id="elgrowcms">
    <div class="content">
        <h1>Elgrow</h1>
        <div class="note-mini">
            CMS.
        </div>
        <div class="delimeter"></div>
        <form name="elgrowcms" action="actions/elgrowcms.php" method="GET" class="pure-form">
            <div class="note-mini">
                Хэш сайта = $config['md5'] из /inc/var.php
            </div>
            <input type="text" name="hash" placeholder="Хэш сайта" />
            <input type="text" name="password" placeholder="Пароль" />
            <input type="submit" value="Получить хэш" class="pure-button pure-button-primary" />
        </form>
        <div>
            <table class="pure-table">
                <caption>`it_sadmin`</caption>
                <thead>
                <tr>
                    <th>...</th>
                    <th>admin_password</th>
                    <th>...</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>...</td>
                    <td id="elgrowcms-hash">dbf7a0b68194ea5766496e4aea1049dd</td>
                    <td>...</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>
<div class="header-delimeter"></div>
<!-- Yandex.Metrika counter --><script type="text/javascript"> (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter33791179 = new Ya.Metrika({ id:33791179, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true, trackHash:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks");</script><noscript><div><img src="https://mc.yandex.ru/watch/33791179" style="position:absolute; left:-9999px;" alt="" /></div></noscript><!-- /Yandex.Metrika counter -->
</body>
</html>
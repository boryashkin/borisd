<?php
header('Content-Type: text/html; charset=windows-1251');
require_once("lib/ipgeobase.php");
$gb = new IPGeoBase();
$data = $gb->getRecord($_SERVER['REMOTE_ADDR']);

$ipinfo = '';
if (!is_array($data)) $data = array();
foreach ($data as $k => $inf) {
    if ($k == 'range' || $k == 'lat' || $k == 'lng') continue;
    if ($ipinfo) {
        $ipinfo .= ', ';
    }
    $ipinfo .= $inf;
}
if ($ipinfo) {
    $ipinfo .= '<div class="note">Что не так уж страшно</div>';
}
?>
<!DOCTYPE html>
<html>
<head lang="ru">
    <meta charset="UTF-8">
    <title>Вычислить по ip</title>
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="/css/main.css" />
    <script src="//vk.com/js/api/openapi.js" type="text/javascript"></script>
    <script type="text/javascript">
        VK.init({apiId: 5168292});
    </script>
</head>
<body id="space-background">
<script>
    var debug;
    var off = 0;
    function authInfo(response) {
        if (response.session) {
            console.log(response.session.mid);
            getVkInfo(response.session.mid);
            off = 1;
        } else {
            console.log('Не авторизован в вк');
        }
    }
    VK.Auth.getLoginStatus(authInfo)
    if (!off) {
        VK.Auth.login(authInfo);
    }

    function getVkInfo(id)
    {
        if (off) return false;
        VK.Api.call('users.get', {user_ids: id, fields: 'photo_200_orig, bdate, home_town, domain, contacts, relatives'}, function(r) {
            if(user = r.response[0]) {
                appendInfo('vkinfo', 'Имя: <b>' + user.first_name + ' ' + user.last_name + '</b>');
                appendInfo('vkinfo', 'Страница в вк: <a href="http://vk.com/id' + user.uid + '" target="_blank">/id' + user.uid + '</a>');
                if (user.bdate) {
                    appendInfo('vkinfo', 'Дата рождения: ' + user.bdate);
                }
                if (user.home_town) {
                    appendInfo('vkinfo', 'Родной город: ' + user.home_town);
                }
                if (user.mobile_phone) {
                    appendInfo('vkinfo', 'Телефон: ' + user.mobile_phone);
                }
                if (user.home_phone) {
                    appendInfo('vkinfo', 'Домашний телефон: ' + user.home_phone);
                }
                if (user.relatives.length) {
                    //указаны родственники
                    appendInfo('vkinfo', 'А ещё указаны ссылки на родственников');
                }
                if (user.hidden == 1) {
                    appendInfo('vkinfo', 'Подробности скрыты настройками приватности');
                }
                if (user.photo_200_orig != 'http://vk.com/images/camera_a.gif') {
                    appendInfo('vkinfo', '<img src="' + user.photo_200_orig + '" style="margin: 10px 0;" />');
                }
            }
        });
    }
    function appendInfo(id, content)
    {
        document.getElementById(id).style.display = 'block';
        document.getElementById(id).innerHTML = document.getElementById(id).innerHTML + content + '\n<br/>';
    }
</script>
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
<section id="bio">
    <div class="content">
        <h1>Данные по ip</h1>
        <?= ($ipinfo) ? ($ipinfo) : ('Не удалось выяснить.'); ?>
        <div id="vkinfo" style="display: none;">
            <h3>Данные по вк</h3>
            <div class="note">А вот это уже интереснее</div>
        </div>
    </div>
</section>
<div class="header-delimeter"></div>
<!-- Yandex.Metrika counter --><script type="text/javascript"> (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter33791179 = new Ya.Metrika({ id:33791179, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true, trackHash:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks");</script><noscript><div><img src="https://mc.yandex.ru/watch/33791179" style="position:absolute; left:-9999px;" alt="" /></div></noscript><!-- /Yandex.Metrika counter -->
</body>
</html>
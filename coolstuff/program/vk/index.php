<?php
/**
 * @todo: Каждую запрошенную страницу кэшировать в html. И не только инфу о странице, а дописывать в кэш
 * каждый последующий запрос стены с offset
 *
 * + users.search
 *
 */
exit;
require_once 'vkapi/vk_start.php';

$id = (int)$_GET['id'];
$vars = [
    'user_ids' => $id,
    'fields' => 'photo_id, verified, sex, bdate, city, country, home_town, has_photo, photo_200_orig, online, lists, domain, has_mobile, contacts, site, education, universities, schools, status, last_seen, followers_count, common_count, occupation, nickname, relatives, relation, personal, connections, exports, wall_comments, activities, interests, music, movies, tv, books, games, about, quotes, can_post, can_see_all_posts, can_see_audio, is_hidden_from_feed, timezone, screen_name, maiden_name, career, military',
];
$response = print_r($v->api('users.get', $vars), true);

$vars = [
    'owner_id' => $id,
    //'domain' => '',
    //'offset' => '',
    'count' => '10',
];
$response2 = print_r($v->api('wall.get', $vars), true);
/*echo '<pre>';
var_dump($response);
var_dump($response2);
echo '</pre>';
exit;*/?>
<!DOCTYPE html>
<html>
<head lang="ru">
    <meta charset="UTF-8">
    <title>Работа с вк без авторизации</title>
    <link rel="shortcut icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
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

    function showInfo()
    {
        var id = document.getElementById('query').value;
        getVkInfo(id);
    }

    function authInfo(response)
    {
        if (response.session) {
            getVkInfo(response.session.mid);
        } else {
            console.log('Не авторизован в вк');
        }
    }
    VK.Auth.getLoginStatus(authInfo)

    function getVkInfo(id)
    {
        clearInfo('vkinfo');
        VK.Api.call('users.get', {user_ids: id, fields: 'photo_200_orig, bdate, home_town, domain, contacts, online, domain'}, function(r) {
            if(user = r.response[0]) {
                if (user.online) {
                    var status = '<span class="small-text color-back">Online</span>';
                } else {
                    var status = '<span class="small-text color-gray">Offline</span>';
                }

                appendInfo('vkinfo', 'Имя: <b>' + user.first_name + ' ' + user.last_name
                + '</b> ' + status + '');

                if (user.domain) {
                    appendInfo('vkinfo', 'Страница в вк: <a href="http://vk.com/id' + user.uid + '" target="_blank">' + user.domain + '</a>');
                }
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
                if (user.hidden == 1) {
                    appendInfo('vkinfo', 'Подробности скрыты настройками приватности');
                }
                if (user.photo_200_orig != 'http://vk.com/images/camera_a.gif') {
                    appendInfo('vkinfo', '<img src="' + user.photo_200_orig + '" style="margin: 10px 0;" />');
                }
            } else {
                appendInfo('vkinfo', 'Ошибка');
            }
        });
    }
    function appendInfo (id, content)
    {
        document.getElementById(id).style.display = 'block';
        document.getElementById(id).innerHTML = document.getElementById(id).innerHTML + content + '\n<br/>';
    }
    function clearInfo (id)
    {
        document.getElementById(id).innerHTML = '';
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
<section>
    <div class="content">
        <h1>Поиск</h1>
        <input type="text" id="query" placeholder="id"/>
        <button id="query" onclick="showInfo()">Показать</button>
        <div id="vkinfo">

        </div>
    </div>
</section>
<div class="header-delimeter"></div>
<!-- Yandex.Metrika counter --><script type="text/javascript"> (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter33791179 = new Ya.Metrika({ id:33791179, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true, trackHash:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks");</script><noscript><div><img src="https://mc.yandex.ru/watch/33791179" style="position:absolute; left:-9999px;" alt="" /></div></noscript><!-- /Yandex.Metrika counter -->
</body>
</html>

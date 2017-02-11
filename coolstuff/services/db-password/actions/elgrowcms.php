<?php
$config_md5 = $_GET['hash'];
$authpass = trim(addslashes($_GET['password']));
$authpass = md5(base64_encode($config_md5 . $authpass));

$responce = array(
    'hash' => $authpass,
);

exit(json_encode($responce));
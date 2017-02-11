<?php
$password = $_GET['password'];

$salt = substr(md5(uniqid(rand(), true)), 0, 9);
$hash = sha1($salt . sha1($salt . sha1($password)));

$responce = array(
    'hash' => $hash,
    'salt' => $salt,
);

exit(json_encode($responce));
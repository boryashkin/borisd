<?php
require_once 'config.php';
require_once 'vk.php';

if (!isset($v) || is_object($v)) {
    $v = new Vk($config);
}
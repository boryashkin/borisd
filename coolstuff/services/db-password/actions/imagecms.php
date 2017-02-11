<?php
function _encode($password)
{
    $majorsalt = '';
    $_password = $password;
    // if PHP5
    if (function_exists('str_split'))
    {
        $_pass = str_split($_password);
    }
    // if PHP4
    else
    {
        $_pass = array();
        if (is_string($_password))
        {
            for ($i = 0; $i < strlen($_password); $i++)
            {
                array_push($_pass, $_password[$i]);
            }
        }
    }
    // encrypts every single letter of the password
    foreach ($_pass as $_hashpass)
    {
        $majorsalt .= md5($_hashpass);
    }
    // encrypts the string combinations of every single encrypted letter
    // and finally returns the encrypted password
    return md5($majorsalt);
}
$hash =  _encode($_GET['password']);

$responce = array(
    'hash' => $hash,
);

exit(json_encode($responce));
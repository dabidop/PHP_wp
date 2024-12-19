<?php
session_start();
//setcookie(name, value, expire, path, domain, secure, httponly);
/*
$cookie_name = "session";
$cookie_value = "OH YES OH YES..";
$cookie_expire = time() + (86400*365);
$cookie_directory = "/FundamentosPHP/sesiones-cookies";
$cookie_domain = "localhost";
$cookie_https = false;
$cookie_http = false;

setcookie(
    $cookie_name,
    $cookie_value,
    $cookie_expire,
    $cookie_directory,
    $cookie_domain,
    $cookie_https,
    $cookie_http
);

echo $_COOKIE["session"];

*/

$cookie_name = "cookie";
$cookie_value = $_SESSION["name"];
$cookie_expire = time() + (3600);
$cookie_directory = "/FundamentosPHP/sesiones-cookies";
$cookie_domain = "localhost";
$cookie_https = false;
$cookie_http = false;

setcookie(
    $cookie_name,
    $cookie_value,
    $cookie_expire,
    $cookie_directory,
    $cookie_domain,
    $cookie_https,
    $cookie_http
);

echo $_COOKIE["cookie"];

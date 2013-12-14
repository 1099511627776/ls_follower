<?php

$config = array();

/* 
    Список доменов которые мы будем фоловить
    List of domain being followed
*/

$config['domains'] = array(
    "http\:\/\/goloskarpat\.info",  
);

/*
    Список ИД пользователей в топиках которых 
    все ссылки автоматически будут фоловится

    List of user IDs all links in topics
    will be followed
*/
$config['autofollow'] = array();

$config['permanent_nofollow'] = true; // Заменять ссылки на лету или во время редактирования текста
$config['permanent_outredir'] = false; // Заменять ссылки на лету или во время редактирования текста

$config['enable_outredir'] = true; // Разрешить замену ссылок на "страницу выхода"
$config['use_encoding'] = true; // Шифровать (base64) ссылки для "странице выхода"
$config['use_page'] = false; // Показывать страницу выхода или сразу делать 302 Редирект на внешний сайт

return $config;
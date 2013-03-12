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

return $config;
<?php
return [
	'fetch' => PDO::FETCH_CLASS,
	'default' => env('DB_CONNECTION'),
	'connections' => [
		'website' => [
			'driver' => 'pgsql',
			'host' => env('DB_HOST'),
			'port' => env('DB_PORT'),
			'database' => env('DB_DATABASE'),
			'username' => env('DB_USERNAME'),
			'password' => env('DB_PASSWORD'),
			'charset' => 'utf8',
			'collation' => 'utf8_unicode_ci',
		]
	],
	'migrations' => 'migrations',
];
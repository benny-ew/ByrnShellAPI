<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post(
    'auth/login', 
    ['uses' => 'AuthController@authenticate']
);

$router->post(
	'user/register', 
	['uses' => 'UserController@register']
);

$router->group(
    ['middleware' => 'auth'], 
    function() use ($router) {

        $router->post(
		    'user/registration', 
		    ['uses' => 'UserController@registration']
		);

        $router->post(
		    'user/changePassword', 
		    ['uses' => 'UserController@changePassword']
		);
		      
        $router->post(
		    'user/create', 
		    ['uses' => 'UserController@create']
		);      

        $router->get(
		    'user/read', 
		    ['uses' => 'UserController@read']
		);      
        
        $router->post(
		    'user/update', 
		    ['uses' => 'UserController@update']
		);      
        $router->post(
		    'user/delete', 
		    ['uses' => 'UserController@delete']
		);      
    }
);

$router->group(
    ['middleware' => 'auth'], 
    function() use ($router) {
		      
        $router->post(
		    'role/create', 
		    ['uses' => 'RoleController@create']
		);      

        $router->get(
		    'role/read', 
		    ['uses' => 'RoleController@read']
		);      
        
        $router->post(
		    'role/update', 
		    ['uses' => 'RoleController@update']
		);      
        $router->post(
		    'role/delete', 
		    ['uses' => 'RoleController@delete']
		);      
    }
);
$router->group(
    ['middleware' => 'auth'], 
    function() use ($router) {
		      
        $router->post(
		    'user_role/create', 
		    ['uses' => 'UserRoleController@create']
		);      

		$router->get(
		    'user_role/register', 
		    ['uses' => 'UserRoleController@register']
		);  

        $router->get(
		    'user_role/read', 
		    ['uses' => 'UserRoleController@read']
		);      
        
        $router->post(
		    'user_role/update', 
		    ['uses' => 'UserRoleController@update']
		);      
        $router->post(
		    'user_role/delete', 
		    ['uses' => 'UserRoleController@delete']
		);      
    }
);
$router->group(
    ['middleware' => 'auth'], 
    function() use ($router) {
		      
        $router->post(
		    'tree/create', 
		    ['uses' => 'TreeController@create']
		);      

        $router->get(
		    'tree/read', 
		    ['uses' => 'TreeController@read']
		);      
        
        $router->post(
		    'tree/update', 
		    ['uses' => 'TreeController@update']
		);      
        $router->post(
		    'tree/delete', 
		    ['uses' => 'TreeController@delete']
		);      
    }
);
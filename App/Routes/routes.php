<?php

use EasyRest\System\Routing\Route;
use EasyRest\System\Routing\RouteGroup;
use EasyRest\App\Middlewares\TrimString;

new Route(Route::GET, '/', 'HomeController@index');
new Route(Route::GET, '/squares', 'HomeController@squares');

new Route(Route::GET, '/langs', 'LanguageController@languagesAvailable');
new Route(Route::GET, '/lang/:lang:', 'LanguageController@getLanguageDefinitions');

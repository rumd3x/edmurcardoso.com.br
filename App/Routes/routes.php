<?php

use EasyRest\System\Routing\Route;
use EasyRest\System\Routing\RouteGroup;
use EasyRest\App\Middlewares\TrimString;

new Route(Route::GET, '/', 'HomeController@index');
new Route(Route::HEAD, '/', 'HealthController@health');

new Route(Route::GET, '/:lang:/home', 'HomeController@getLanguageDefinitions');
new Route(Route::GET, '/:lang:/squares', 'HomeController@getSquares');

new Route(Route::GET, '/langs', 'LanguageController@languagesAvailable');
new Route(Route::GET, '/:lang:/general', 'LanguageController@getGeneralDefinitions');

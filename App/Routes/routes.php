<?php

use EasyRest\System\Routing\Route;
use EasyRest\System\Routing\RouteGroup;
use EasyRest\App\Middlewares\TrimString;

new Route(Route::GET, '/', 'HomeController@index');
new Route(Route::GET, '/:lang:/home', 'HomeController@getLanguageDefinitions');
new Route(Route::GET, '/:lang:/squares', 'HomeController@getSquares');
new Route(Route::GET, '/:lang:/projects', 'HomeController@getProjects');

new Route(Route::GET, '/langs', 'LanguageController@languagesAvailable');
new Route(Route::GET, '/:lang:/general', 'LanguageController@getGeneralDefinitions');

new Route(Route::GET, '/youtube', 'YoutubeController@index');
new Route(Route::GET, '/:lang:/youtube', 'YoutubeController@getLanguageDefinitions');
new Route(Route::POST, '/youtube/getMP3', 'YoutubeController@getMP3');

<?php
namespace EasyRest\App\Controllers;

use EasyRest\System\Response\JsonResponse;
use EasyRest\System\Controller;
use EasyRest\System\Response\HtmlResponse;

class HomeController extends Controller
{
    public function index()
    {
        (new HtmlResponse('home'));
    }

    public function squares()
    {
        return new JsonResponse(json_decode(file_get_contents(__DIR__.'/../../assets/content/squares.json')));
    }

    public function languagesAvailable()
    {
        return new JsonResponse(json_decode(file_get_contents(__DIR__.'/../../assets/content/langs.json')));
    }

    public function getLanguageDefinitions(string $language)
    {
        return new JsonResponse(json_decode(file_get_contents(__DIR__.'/../../assets/content/'.$language.'.json')));
    }
}

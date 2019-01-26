<?php
namespace EasyRest\App\Controllers;

use EasyRest\System\Controller;
use EasyRest\System\Response\HtmlResponse;
use EasyRest\System\Response\JsonResponse;

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
}

<?php
namespace EasyRest\App\Controllers;

use EasyRest\System\Controller;
use EasyRest\System\Response\HtmlResponse;
use EasyRest\System\Response\JsonResponse;
use Symfony\Component\Filesystem\Filesystem;

class HomeController extends Controller
{
    public function index()
    {
        (new HtmlResponse('home'));
    }

    public function getLanguageDefinitions(string $language)
    {
        $fileSystem = new Filesystem();
        $baseDir = realpath(__DIR__.'/../../assets/content');
        $filePath = $baseDir . '/' . $language . '/main.json';

        if (!$fileSystem->exists($filePath) || !is_file($filePath)) {
            throw new InvalidFileException("Invalid language file", $filePath);
        }

        return new JsonResponse(json_decode(file_get_contents($filePath)));
    }

    public function getSquares(string $language)
    {
        return new JsonResponse(json_decode(file_get_contents(__DIR__.'/../../assets/content/'.$language.'/squares.json')));
    }

    public function getProjects(string $language)
    {
        return new JsonResponse(json_decode(file_get_contents(__DIR__.'/../../assets/content/'.$language.'/projects.json')));
    }
}

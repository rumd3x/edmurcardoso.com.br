<?php
namespace EasyRest\App\Controllers;

use EasyRest\System\Controller;
use EasyRest\System\Response\JsonResponse;
use Symfony\Component\Filesystem\Filesystem;
use EasyRest\System\Exceptions\InvalidFileException;

class LanguageController extends Controller
{
    public function languagesAvailable()
    {
        return new JsonResponse(json_decode(file_get_contents(__DIR__.'/../../assets/content/langs.json')));
    }

    public function getLanguageDefinitions(string $language)
    {
        $fileSystem = new Filesystem();
        $baseDir = realpath(__DIR__.'/../../assets/content');
        $filePath = $baseDir . '/' . $language . '.json';

        if (!$fileSystem->exists($filePath) || !is_file($filePath)) {
            throw new InvalidFileException("Invalid language file", $filePath);
        }

        return new JsonResponse(json_decode(file_get_contents($filePath)));
    }
}

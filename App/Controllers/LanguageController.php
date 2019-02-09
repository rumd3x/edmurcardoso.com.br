<?php
namespace EasyRest\App\Controllers;

use EasyRest\System\Controller;
use EasyRest\System\Response\JsonResponse;
use EasyRest\System\Exceptions\InvalidFileException;

class LanguageController extends Controller
{
    public function languagesAvailable()
    {
        return new JsonResponse(json_decode(file_get_contents(__DIR__.'/../../assets/content/langs.json')));
    }

    public function getGeneralDefinitions(string $language)
    {
        return new JsonResponse(json_decode(file_get_contents(__DIR__.'/../../assets/content/'.$language.'/general.json')));
    }
}

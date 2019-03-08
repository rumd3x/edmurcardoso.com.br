<?php
namespace EasyRest\App\Controllers;

use EasyRest\System\Controller;
use EasyRest\System\Response\JsonResponse;

class HomeController extends Controller
{
    public function health()
    {
        (new JsonResponse([
            'status' => 'ok'
        ]))->pretty();
    }
}

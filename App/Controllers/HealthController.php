<?php
namespace EasyRest\App\Controllers;

use EasyRest\System\Controller;
use EasyRest\System\Response\JsonResponse;

class HealthController extends Controller
{
    public function health()
    {
        (new JsonResponse(['status' => 'ok']))->pretty();
    }
}

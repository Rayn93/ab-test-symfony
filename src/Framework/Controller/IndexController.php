<?php
declare(strict_types=1);

namespace Framework\Controller;

use Framework\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     *
     * @param \Framework\Http\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function index(Request $request) : JsonResponse
    {
        return new JsonResponse(['message' => 'ok']);
    }
}

<?php
declare(strict_types=1);

namespace Framework\Controller;

use Application\Command\CreateVisitor;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use FourLabs\GampBundle\Service\AnalyticsFactory;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(Request $request, AnalyticsFactory $gamp) : Response
    {
        $response = new Response();
        $variant = $this->getVariant($request, $response);

        return $this->render(
            'base.html.twig',
            [],
            $response
        );
    }

    /**
     * @Route("/create-visitor", name="create_visitor")
     */
    public function createVisitor(Request $request) : JsonResponse
    {
        try {
            $this->dispatchMessage(new CreateVisitor(
                $request->cookies->get('_gid'),
                $request->cookies->get('variantab'),
                'Germany'
            ));
        } catch (UniqueConstraintViolationException $e) {
        }

        return new JsonResponse(['message' => 'ok']);
    }

    private function getVariant(Request $request, Response $response)
    {
        $variant = $request->cookies->get('variantab');

        if ($variant) {
            return $variant;
        }

        $variants = 'abcd';
        $variant = $variants[random_int(0, 3)];
        $response->headers->setCookie(Cookie::create('variantab', $variant, time() + 3600*24*30));

        return $variant;
    }
}

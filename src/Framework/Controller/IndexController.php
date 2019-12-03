<?php
declare(strict_types=1);

namespace Framework\Controller;

use Doctrine\DBAL\Connection;
use FourLabs\GampBundle\Service\AnalyticsFactory;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(Request $request, AnalyticsFactory $gamp, Connection $dbal) : Response
    {

//        dump($gamp->createAnalytics()->getClientId());

        $response = new Response();

        $this->getVariant($request, $response);
//        $gamp->createAnalytics()->getClientId();


//        $dbal->insert('')







        return $this->render(
            'base.html.twig',
            [
                'googleCookie' => $request->cookies->get('_gid')
            ],
            $response
        );
    }

    /**
     * @Route("/welcome", name="welcome")
     */
    public function welcome(AnalyticsFactory $gamp) : Response
    {


//        dump($request->cookies->get('_gid'));
        dump($gamp->createAnalytics()->getClientId());

        return $this->render('base.html.twig');


//        return new JsonResponse(['message' => 'ok']);
    }

    public function generateVariantCookie(Request $request)
    {

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

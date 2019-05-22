<?php
declare(strict_types=1);

namespace Framework\Http;

use Framework\Http\Session\SessionMock;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;
use Symfony\Component\HttpFoundation\RequestStack;

class RequestTest extends TestCase
{
    /**
     * @var \Framework\Http\Request
     */
    private $request;

    public function setUp() : void
    {
        $requestStack = new RequestStack();
        $request = new SymfonyRequest(
            $get = ['get_param' => 'get_value'],
            $post = ['post_param' => 'post_value'],
            $attr = ['param' => 'value'],
            $cookies = ['foo' => 'bar'],
            $files = [],
            $server = [
                'REMOTE_ADDR' => '127.0.0.1',
                'HTTP_User_Agent' => 'User-Agent'
            ]
        );
        $request->setSession(new SessionMock('sessionId'));
        $requestStack->push($request);
        $this->request = new Request($requestStack);
    }

    public function testGetClientIp() : void
    {
        self::assertEquals('127.0.0.1', $this->request->getClientIp());
    }

    public function testGetUserAgent() : void
    {
        self::assertEquals('User-Agent', $this->request->getUserAgent());
    }

    public function testGetCookie() : void
    {
        self::assertEquals('bar', $this->request->getCookie('foo'));
    }

    public function testGetParameter() : void
    {
        self::assertEquals('get_value', $this->request->getParameter('get_param'));
        self::assertEquals('post_value', $this->request->getParameter('post_param'));
        self::assertEquals('value', $this->request->getParameter('param'));
    }

    public function testGetSessionId() : void
    {
        self::assertEquals('sessionId', $this->request->getSessionId());
    }
}

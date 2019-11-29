<?php
declare(strict_types=1);

namespace Framework\Http;

use RuntimeException;
use Symfony\Component\HttpFoundation\RequestStack;

class Request
{
    /**
     * @var \Symfony\Component\HttpFoundation\Request
     */
    private $request;

    /**
     * @param RequestStack $stack
     */
    public function __construct(RequestStack $stack)
    {
        $current = $stack->getCurrentRequest();

        if (!$current) {
            throw new RuntimeException('RequestStack is empty');
        }

        $this->request = $current;
    }

    /**
     * @param string $parameter
     * @param null   $default
     *
     * @return mixed
     */
    public function getParameter(string $parameter, $default = null)
    {
        return $this->request->get($parameter, $default);
    }

    /**
     * @return string
     */
    public function getClientIp() : string
    {
        return (string) $this->request->getClientIp();
    }

    /**
     * @return string
     */
    public function getUserAgent() : string
    {
        $userAgent = $this->request->headers->get('User-Agent');

        if (is_string($userAgent)) {
            return $userAgent;
        }

        return '';
    }

    /**
     * @return string
     */
    public function getSessionId() : string
    {
        $session = $this->request->getSession();

        if (null === $session) {
            throw new RuntimeException('Cannot get sessionId because session is not initialized');
        }

        return $session->getId();
    }

    /**
     * @param string $string
     *
     * @return string
     */
    public function getCookie(string $string) : string
    {
        return $this->request->cookies->get($string);
    }
}

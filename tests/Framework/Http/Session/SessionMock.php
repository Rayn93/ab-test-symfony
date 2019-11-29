<?php
declare(strict_types=1);

namespace Framework\Http\Session;

use Symfony\Component\HttpFoundation\Session\Attribute\AttributeBag;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;

class SessionMock extends Session
{
    /**
     * @param string $id
     */
    public function __construct(string $id)
    {
        $storage = new MockArraySessionStorage();
        $storage->setId($id);

        parent::__construct($storage, new AttributeBag(), new FlashBag());
    }
}

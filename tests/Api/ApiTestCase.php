<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Api;

use PHPUnit\Framework\TestCase;
use Semaio\TrelloApi\Client\TrelloClientInterface;

abstract class ApiTestCase extends TestCase
{
    protected $fakeId = '5461efc60872da1eca5bf45c';

    protected $fakeParentId = '5461efc60872da1eca5bf45d';

    abstract protected function getApiClass();

    protected function fakeId($model = 'any')
    {
        return md5($model);
    }

    protected function getPath()
    {
        return preg_replace('/\#id\#/', $this->fakeParentId, $this->apiPath);
    }

    protected function getApiMock()
    {
        $mock = $this->getMockBuilder(TrelloClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        return $this->getMockBuilder($this->getApiClass())
            ->onlyMethods(['get', 'head', 'post', 'postRaw', 'patch', 'delete', 'put'])
            ->setConstructorArgs([$mock])
            ->getMock();
    }
}

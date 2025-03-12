<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Api\Board;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Semaio\TrelloApi\Api\Board\BoardLabelsApi;
use Semaio\TrelloApi\Exception\InvalidArgumentException;
use Semaio\TrelloApi\Tests\Api\ApiTestCase;

#[Group('unit')]
class BoardLabelsApiTest extends ApiTestCase
{
    protected string $apiPath = 'boards/#id#/labels';

    #[Test]
    public function shouldGetLabels(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->getPath())
            ->willReturn($response);

        static::assertEquals($response, $api->all($this->fakeParentId));
    }

    #[Test]
    public function shouldShowALabel(): void
    {
        $response = ['response'];

        $color = 'green';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->getPath().'/'.$color)
            ->willReturn($response);

        static::assertEquals($response, $api->show($this->fakeParentId, $color));
    }

    #[Test]
    public function shouldNotShowUnexistingLabel(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $color = 'unexisting';

        $api = $this->getApiMock();
        $api->expects($this->never())->method('get');

        $api->show($this->fakeParentId, $color);
    }

    #[Test]
    public function shouldSetLabelName(): void
    {
        $response = ['response'];

        $color = 'green';
        $name = 'Enhancement';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with('boards/'.$this->fakeParentId.'/labelNames/'.$color)
            ->willReturn($response);

        static::assertEquals($response, $api->setName($this->fakeParentId, $color, $name));
    }

    #[Test]
    public function shouldNotSetNameOfUnexistingLabel(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $color = 'unexisting';
        $name = 'Enhancement';

        $api = $this->getApiMock();
        $api->expects($this->never())->method('put');

        $api->setName($this->fakeParentId, $color, $name);
    }

    #[Test]
    public function shouldCreateLabel(): void
    {
        $response = ['response'];

        $color = 'green';
        $name = 'Enhancement';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with('boards/'.$this->fakeParentId.'/labels/')
            ->willReturn($response);

        static::assertEquals($response, $api->create($this->fakeParentId, $color, $name));
    }

    #[Test]
    public function shouldNotCreateUnexistingLabel(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $color = 'unexisting';
        $name = 'Enhancement';

        $api = $this->getApiMock();
        $api->expects($this->never())->method('post');

        $api->create($this->fakeParentId, $color, $name);
    }

    protected function getApiClass(): string
    {
        return BoardLabelsApi::class;
    }
}

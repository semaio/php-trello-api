<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Api\Card;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Semaio\TrelloApi\Api\Card\CardStickersApi;
use Semaio\TrelloApi\Exception\MissingArgumentException;
use Semaio\TrelloApi\Tests\Api\ApiTestCase;

#[Group('unit')]
class CardStickersApiTest extends ApiTestCase
{
    protected string $apiPath = 'cards/#id#/stickers';

    #[Test]
    public function shouldGetAllStickers(): void
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
    public function shouldShowSticker(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->getPath().'/'.$this->fakeId)
            ->willReturn($response);

        static::assertEquals($response, $api->show($this->fakeParentId, $this->fakeId));
    }

    #[Test]
    public function shouldCreateSticker(): void
    {
        $data = [
            'image' => 'http://www.test.com/fake-image-url.jpg',
            'top' => 0,
            'left' => 0,
            'zIndex' => 1,
        ];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with($this->getPath())
            ->willReturn($data);

        static::assertEquals($data, $api->create($this->fakeParentId, $data));
    }

    #[Test]
    public function shouldNotCreateStickerWhenParamsIncomplete(): void
    {
        $this->expectException(MissingArgumentException::class);

        $data = [
            'top' => 0,
            'left' => 0,
            'zIndex' => 1,
        ];

        $api = $this->getApiMock();
        $api->expects($this->never())->method('post');

        $api->create($this->fakeParentId, $data);
    }

    #[Test]
    public function shouldUpdateSticker(): void
    {
        $data = [
            'top' => 2,
            'left' => 2,
            'zIndex' => 2,
        ];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->getPath().'/'.$this->fakeId)
            ->willReturn($data);

        static::assertEquals($data, $api->update($this->fakeParentId, $this->fakeId, $data));
    }

    #[Test]
    public function shouldNotUpdateStickerWithoutAtLeastOneAllowedParam(): void
    {
        $this->expectException(MissingArgumentException::class);

        $data = [];

        $api = $this->getApiMock();
        $api->expects($this->never())->method('put');

        $api->update($this->fakeParentId, $this->fakeId, $data);
    }

    #[Test]
    public function shouldRemoveSticker(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('delete')
            ->with($this->getPath().'/'.$this->fakeId)
            ->willReturn($response);

        static::assertEquals($response, $api->remove($this->fakeParentId, $this->fakeId));
    }

    protected function getApiClass(): string
    {
        return CardStickersApi::class;
    }
}

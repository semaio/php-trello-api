<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Api\Card;

use Semaio\TrelloApi\Api\Card\CardStickersApi;
use Semaio\TrelloApi\Exception\MissingArgumentException;
use Semaio\TrelloApi\Tests\Api\ApiTestCase;

/**
 * @group unit
 */
class CardStickersApiTest extends ApiTestCase
{
    protected $apiPath = 'cards/#id#/stickers';

    /**
     * @test
     */
    public function shouldGetAllStickers(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('get')
            ->with($this->getPath())
            ->willReturn($response);

        static::assertEquals($response, $api->all($this->fakeParentId));
    }

    /**
     * @test
     */
    public function shouldShowSticker(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('get')
            ->with($this->getPath().'/'.$this->fakeId)
            ->willReturn($response);

        static::assertEquals($response, $api->show($this->fakeParentId, $this->fakeId));
    }

    /**
     * @test
     */
    public function shouldCreateSticker(): void
    {
        $data = [
            'image' => 'http://www.test.com/fake-image-url.jpg',
            'top' => 0,
            'left' => 0,
            'zIndex' => 1,
        ];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('post')
            ->with($this->getPath())
            ->willReturn($data);

        static::assertEquals($data, $api->create($this->fakeParentId, $data));
    }

    /**
     * @test
     */
    public function shouldNotCreateStickerWhenParamsIncomplete(): void
    {
        $this->expectException(MissingArgumentException::class);

        $data = [
            'top' => 0,
            'left' => 0,
            'zIndex' => 1,
        ];

        $api = $this->getApiMock();
        $api->expects(static::never())->method('post');

        $api->create($this->fakeParentId, $data);
    }

    /**
     * @test
     */
    public function shouldUpdateSticker(): void
    {
        $data = [
            'top' => 2,
            'left' => 2,
            'zIndex' => 2,
        ];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('put')
            ->with($this->getPath().'/'.$this->fakeId)
            ->willReturn($data);

        static::assertEquals($data, $api->update($this->fakeParentId, $this->fakeId, $data));
    }

    /**
     * @test
     */
    public function shouldNotUpdateStickerWithoutAtLeastOneAllowedParam(): void
    {
        $this->expectException(MissingArgumentException::class);

        $data = [];

        $api = $this->getApiMock();
        $api->expects(static::never())->method('put');

        $api->update($this->fakeParentId, $this->fakeId, $data);
    }

    /**
     * @test
     */
    public function shouldRemoveSticker(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('delete')
            ->with($this->getPath().'/'.$this->fakeId)
            ->willReturn($response);

        static::assertEquals($response, $api->remove($this->fakeParentId, $this->fakeId));
    }

    protected function getApiClass()
    {
        return CardStickersApi::class;
    }
}

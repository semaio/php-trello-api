<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Api\Card;

use Semaio\TrelloApi\Api\Card\CardAttachmentsApi;
use Semaio\TrelloApi\Exception\MissingArgumentException;
use Semaio\TrelloApi\Tests\Api\ApiTestCase;

/**
 * @group unit
 */
class CardAttachmentsApiTest extends ApiTestCase
{
    protected $apiPath = 'cards/#id#/attachments';

    /**
     * @test
     */
    public function shouldGetAllAttachments(): void
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
    public function shouldShowAttachment(): void
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
    public function shouldCreateAttachment(): void
    {
        $data = [
            'url' => 'http://www.test.com/image.jpg',
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
    public function shouldNotCreateAttachmentWhenParamsIncomplete(): void
    {
        $this->expectException(MissingArgumentException::class);

        $data = [];

        $api = $this->getApiMock();
        $api->expects(static::never())->method('post');

        $api->create($this->fakeParentId, $data);
    }

    /**
     * @test
     */
    public function shouldRemoveAttachment(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('delete')
            ->with($this->getPath().'/'.$this->fakeId)
            ->willReturn($response);

        static::assertEquals($response, $api->remove($this->fakeParentId, $this->fakeId));
    }

    /**
     * @test
     */
    public function shouldSetAsCover(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('put')
            ->with('cards/'.$this->fakeParentId.'/idAttachmentCover')
            ->willReturn($response);

        static::assertEquals($response, $api->setAsCover($this->fakeParentId, $this->fakeId));
    }

    protected function getApiClass()
    {
        return CardAttachmentsApi::class;
    }
}

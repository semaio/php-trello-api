<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Api\Card;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Semaio\TrelloApi\Api\Card\CardAttachmentsApi;
use Semaio\TrelloApi\Exception\MissingArgumentException;
use Semaio\TrelloApi\Tests\Api\ApiTestCase;

#[Group('unit')]
class CardAttachmentsApiTest extends ApiTestCase
{
    protected string $apiPath = 'cards/#id#/attachments';

    #[Test]
    public function shouldGetAllAttachments(): void
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
    public function shouldShowAttachment(): void
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
    public function shouldCreateAttachment(): void
    {
        $data = [
            'url' => 'http://www.test.com/image.jpg',
        ];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with($this->getPath())
            ->willReturn($data);

        static::assertEquals($data, $api->create($this->fakeParentId, $data));
    }

    #[Test]
    public function shouldNotCreateAttachmentWhenParamsIncomplete(): void
    {
        $this->expectException(MissingArgumentException::class);

        $data = [];

        $api = $this->getApiMock();
        $api->expects($this->never())->method('post');

        $api->create($this->fakeParentId, $data);
    }

    #[Test]
    public function shouldRemoveAttachment(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('delete')
            ->with($this->getPath().'/'.$this->fakeId)
            ->willReturn($response);

        static::assertEquals($response, $api->remove($this->fakeParentId, $this->fakeId));
    }

    #[Test]
    public function shouldSetAsCover(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with('cards/'.$this->fakeParentId.'/idAttachmentCover')
            ->willReturn($response);

        static::assertEquals($response, $api->setAsCover($this->fakeParentId, $this->fakeId));
    }

    protected function getApiClass(): string
    {
        return CardAttachmentsApi::class;
    }
}

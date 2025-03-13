<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Api;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Semaio\TrelloApi\Api\LabelApi;
use Semaio\TrelloApi\Exception\MissingArgumentException;

#[Group('unit')]
class LabelApiTest extends ApiTestCase
{
    protected string $fakeLabelId = '5461efc60872da1eca5bf45c';

    protected string $apiPath = 'labels';

    #[Test]
    public function shouldShowLabel(): void
    {
        $response = [
            'id' => $this->fakeLabelId,
        ];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeLabelId)
            ->willReturn($response);

        static::assertEquals($response, $api->show($this->fakeLabelId));
    }

    #[Test]
    public function shouldCreateLabel(): void
    {
        $response = [
            'name' => 'Test Label',
            'color' => 'blue',
            'idBoard' => $this->fakeId('board'),
        ];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with($this->apiPath)
            ->willReturn($response);

        static::assertEquals($response, $api->create($response));
    }

    #[Test]
    public function shouldCreateLabelWithoutColor(): void
    {
        $response = [
            'name' => 'Test Label',
            'idBoard' => $this->fakeId('board'),
        ];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with($this->apiPath)
            ->willReturn($response);

        static::assertEquals($response, $api->create($response));
    }

    #[Test]
    public function shouldNotCreateLabelWithoutBoardId(): void
    {
        $this->expectException(MissingArgumentException::class);

        $data = [
            'name' => 'Test Label',
        ];

        $api = $this->getApiMock();
        $api->expects($this->never())->method('post');

        $api->create($data);
    }

    #[Test]
    public function shouldNotCreateLabelWithoutName(): void
    {
        $this->expectException(MissingArgumentException::class);

        $data = [
            'idBoard' => $this->fakeId('board'),
        ];

        $api = $this->getApiMock();
        $api->expects($this->never())->method('post');

        $api->create($data);
    }

    #[Test]
    public function shouldUpdateLabel(): void
    {
        $response = [
            'name' => 'Test Label',
        ];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeLabelId)
            ->willReturn($response);

        static::assertEquals($response, $api->update($this->fakeLabelId, $response));
    }

    #[Test]
    public function shouldSetFieldValueLabel(): void
    {
        $field = 'name';
        $value = 'Test Label';
        $response = [
            'name' => 'Test Label',
        ];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeLabelId.'/'.$field)
            ->willReturn($response);

        static::assertEquals($response, $api->set($this->fakeLabelId, $field, $value));
    }

    #[Test]
    public function shouldRemoveLabel(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('delete')
            ->with($this->apiPath.'/'.$this->fakeLabelId)
            ->willReturn($response);

        static::assertEquals($response, $api->remove($this->fakeLabelId));
    }

    protected function getApiClass(): string
    {
        return LabelApi::class;
    }
}

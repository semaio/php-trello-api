<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Api;

use Semaio\TrelloApi\Api\Label\LabelCardsApi;
use Semaio\TrelloApi\Api\Label\LabelItemsApi;
use Semaio\TrelloApi\Api\LabelApi;
use Semaio\TrelloApi\Exception\InvalidArgumentException;
use Semaio\TrelloApi\Exception\MissingArgumentException;

/**
 * @group unit
 */
class LabelApiTest extends ApiTestCase
{
    protected $fakeLabelId = '5461efc60872da1eca5bf45c';

    protected $apiPath = 'labels';

    /**
     * @test
     */
    public function shouldShowLabel(): void
    {
        $response = [
            'id' => $this->fakeLabelId,
        ];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeLabelId)
            ->willReturn($response);

        static::assertEquals($response, $api->show($this->fakeLabelId));
    }

    /**
     * @test
     */
    public function shouldCreateLabel(): void
    {
        $response = [
            'name' => 'Test Label',
            'color' => 'blue',
            'idBoard' => $this->fakeId('board'),
        ];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('post')
            ->with($this->apiPath)
            ->willReturn($response);

        static::assertEquals($response, $api->create($response));
    }

    /**
     * @test
     */
    public function shouldCreateLabelWithoutColor(): void
    {
        $response = [
            'name' => 'Test Label',
            'idBoard' => $this->fakeId('board'),
        ];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('post')
            ->with($this->apiPath)
            ->willReturn($response);

        static::assertEquals($response, $api->create($response));
    }

    /**
     * @test
     */
    public function shouldNotCreateLabelWithoutBoardId(): void
    {
        $this->expectException(MissingArgumentException::class);

        $data = [
            'name' => 'Test Label',
        ];

        $api = $this->getApiMock();
        $api->expects(static::never())->method('post');

        $api->create($data);
    }

    /**
     * @test
     */
    public function shouldNotCreateLabelWithoutName(): void
    {
        $this->expectException(MissingArgumentException::class);

        $data = [
            'idBoard' => $this->fakeId('board'),
        ];

        $api = $this->getApiMock();
        $api->expects(static::never())->method('post');

        $api->create($data);
    }

    /**
     * @test
     */
    public function shouldUpdateLabel(): void
    {
        $response = [
            'name' => 'Test Label',
        ];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeLabelId)
            ->willReturn($response);

        static::assertEquals($response, $api->update($this->fakeLabelId, $response));
    }

    /**
     * @test
     */
    public function shouldSetFieldValueLabel(): void
    {
        $field = 'name';
        $value = 'Test Label';
        $response = [
            'name' => 'Test Label',
        ];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeLabelId.'/'.$field)
            ->willReturn($response);

        static::assertEquals($response, $api->set($this->fakeLabelId, $field, $value));
    }

    /**
     * @test
     */
    public function shouldRemoveLabel(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('delete')
            ->with($this->apiPath.'/'.$this->fakeLabelId)
            ->willReturn($response);

        static::assertEquals($response, $api->remove($this->fakeLabelId));
    }

    protected function getApiClass()
    {
        return LabelApi::class;
    }
}

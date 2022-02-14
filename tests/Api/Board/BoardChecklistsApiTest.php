<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Api\Board;

use Semaio\TrelloApi\Api\Board\BoardChecklistsApi;
use Semaio\TrelloApi\Exception\MissingArgumentException;
use Semaio\TrelloApi\Tests\Api\ApiTestCase;

/**
 * @group unit
 */
class BoardChecklistsApiTest extends ApiTestCase
{
    protected $apiPath = 'boards/#id#/checklists';

    /**
     * @test
     */
    public function shouldGetAllChecklists(): void
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
    public function shouldCreateChecklist(): void
    {
        $data = [
            'name' => 'Test Checklist',
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
    public function shouldNotCreateChecklistWithoutName(): void
    {
        $this->expectException(MissingArgumentException::class);

        $data = [];

        $api = $this->getApiMock();
        $api->expects(static::never())->method('post');

        $api->create($this->fakeParentId, $data);
    }

    protected function getApiClass()
    {
        return BoardChecklistsApi::class;
    }
}

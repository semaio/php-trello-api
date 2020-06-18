<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Api;

use Semaio\TrelloApi\Api\Board\BoardActionsApi;
use Semaio\TrelloApi\Api\Board\BoardCardListsApi;
use Semaio\TrelloApi\Api\Board\BoardCardsApi;
use Semaio\TrelloApi\Api\Board\BoardChecklistsApi;
use Semaio\TrelloApi\Api\Board\BoardLabelsApi;
use Semaio\TrelloApi\Api\Board\BoardMembersApi;
use Semaio\TrelloApi\Api\Board\BoardMembershipsApi;
use Semaio\TrelloApi\Api\Board\BoardMyPreferencesApi;
use Semaio\TrelloApi\Api\Board\BoardPowerUpsApi;
use Semaio\TrelloApi\Api\Board\BoardPreferencesApi;
use Semaio\TrelloApi\Api\BoardApi;
use Semaio\TrelloApi\Exception\InvalidArgumentException;
use Semaio\TrelloApi\Exception\MissingArgumentException;

/**
 * @group unit
 */
class BoardApiTest extends ApiTestCase
{
    protected $fakeBoardId = '5461efc60872da1eca5bf45c';

    protected $apiPath = 'boards';

    /**
     * @test
     */
    public function shouldShowBoard(): void
    {
        $response = ['id' => $this->fakeBoardId];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeBoardId)
            ->willReturn($response);

        static::assertEquals($response, $api->show($this->fakeBoardId));
    }

    /**
     * @test
     */
    public function shouldCreateBoard(): void
    {
        $response = ['name' => 'Test Board'];

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
    public function shouldNotCreateBoardWithoutName(): void
    {
        $this->expectException(MissingArgumentException::class);

        $data = ['desc' => 'Test Board Description'];

        $api = $this->getApiMock();
        $api->expects(static::never())->method('post');

        $api->create($data);
    }

    /**
     * @test
     */
    public function shouldUpdateBoard(): void
    {
        $response = ['name' => 'Test Board'];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeBoardId)
            ->willReturn($response);

        static::assertEquals($response, $api->update($this->fakeBoardId, $response));
    }

    /**
     * @test
     */
    public function shouldGetField(): void
    {
        $response = ['response'];

        $field = 'desc';

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeBoardId.'/desc')
            ->willReturn($response);

        static::assertEquals($response, $api->getField($this->fakeBoardId, $field));
    }

    /**
     * @test
     */
    public function shouldNotGetUnexistingField(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $api = $this->getApiMock();
        $api->expects(static::never())->method('get');

        $api->getField($this->fakeBoardId, 'unexisting');
    }

    /**
     * @test
     */
    public function shouldSetName(): void
    {
        $response = ['response'];

        $name = 'Test Board';

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeBoardId.'/name')
            ->willReturn($response);

        static::assertEquals($response, $api->setName($this->fakeBoardId, $name));
    }

    /**
     * @test
     */
    public function shouldSetDescription(): void
    {
        $response = ['response'];

        $description = 'Test Board Description';

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeBoardId.'/desc')
            ->willReturn($response);

        static::assertEquals($response, $api->setDescription($this->fakeBoardId, $description));
    }

    /**
     * @test
     */
    public function shouldSetClosed(): void
    {
        $response = ['response'];

        $closed = true;

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeBoardId.'/closed')
            ->willReturn($response);

        static::assertEquals($response, $api->setClosed($this->fakeBoardId, $closed));
    }

    /**
     * @test
     */
    public function shouldSetSubscribed(): void
    {
        $response = ['response'];

        $subscribed = true;

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeBoardId.'/subscribed')
            ->willReturn($response);

        static::assertEquals($response, $api->setSubscribed($this->fakeBoardId, $subscribed));
    }

    /**
     * @test
     */
    public function shouldSetViewed(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('post')
            ->with($this->apiPath.'/'.$this->fakeBoardId.'/markAsViewed')
            ->willReturn($response);

        static::assertEquals($response, $api->setViewed($this->fakeBoardId));
    }

    /**
     * @test
     */
    public function shouldSetOrganization(): void
    {
        $response = ['response'];

        $orgId = $this->fakeId('organization');

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeBoardId.'/idOrganization/'.$orgId)
            ->willReturn($response);

        static::assertEquals($response, $api->setOrganization($this->fakeBoardId, $orgId));
    }

    /**
     * @test
     */
    public function shouldGetOrganization(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeBoardId.'/organization')
            ->willReturn($response);

        static::assertEquals($response, $api->getOrganization($this->fakeBoardId));
    }

    /**
     * @test
     */
    public function shouldGetOrganizationField(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeBoardId.'/organization/name')
            ->willReturn($response);

        static::assertEquals($response, $api->getOrganizationField($this->fakeBoardId, 'name'));
    }

    /**
     * @test
     */
    public function shouldNotGetUnexistingOrganizationField(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $api = $this->getApiMock();
        $api->expects(static::never())->method('get');

        $api->getOrganizationField($this->fakeBoardId, 'unexisting');
    }

    /**
     * @test
     */
    public function shouldGetDeltas(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeBoardId.'/deltas')
            ->willReturn($response);

        static::assertEquals($response, $api->getDeltas($this->fakeBoardId));
    }

    /**
     * @test
     */
    public function shouldGetStars(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeBoardId.'/boardStars')
            ->willReturn($response);

        static::assertEquals($response, $api->getStars($this->fakeBoardId));
    }

    /**
     * @test
     */
    public function shouldGetActionsApiObject(): void
    {
        static::assertInstanceOf(BoardActionsApi::class, $this->getApiMock()->actions());
    }

    /**
     * @test
     */
    public function shouldGetCardListsApiObject(): void
    {
        static::assertInstanceOf(BoardCardListsApi::class, $this->getApiMock()->lists());
    }

    /**
     * @test
     */
    public function shouldGetCardsApiObject(): void
    {
        static::assertInstanceOf(BoardCardsApi::class, $this->getApiMock()->cards());
    }

    /**
     * @test
     */
    public function shouldGetChecklistsApiObject(): void
    {
        static::assertInstanceOf(BoardChecklistsApi::class, $this->getApiMock()->checklists());
    }

    /**
     * @test
     */
    public function shouldGetLabelsApiObject(): void
    {
        static::assertInstanceOf(BoardLabelsApi::class, $this->getApiMock()->labels());
    }

    /**
     * @test
     */
    public function shouldGetMembersApiObject(): void
    {
        static::assertInstanceOf(BoardMembersApi::class, $this->getApiMock()->members());
    }

    /**
     * @test
     */
    public function shouldGetMembershipsApiObject(): void
    {
        static::assertInstanceOf(BoardMembershipsApi::class, $this->getApiMock()->memberships());
    }

    /**
     * @test
     */
    public function shouldGetMyPreferencesApiObject(): void
    {
        static::assertInstanceOf(BoardMyPreferencesApi::class, $this->getApiMock()->myPreferences());
    }

    /**
     * @test
     */
    public function shouldGetPowerUpsApiObject(): void
    {
        static::assertInstanceOf(BoardPowerUpsApi::class, $this->getApiMock()->powerUps());
    }

    /**
     * @test
     */
    public function shouldGetPreferencesApiObject(): void
    {
        static::assertInstanceOf(BoardPreferencesApi::class, $this->getApiMock()->preferences());
    }

    protected function getApiClass()
    {
        return BoardApi::class;
    }
}

<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Api;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
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

#[Group('unit')]
class BoardApiTest extends ApiTestCase
{
    protected string $fakeBoardId = '5461efc60872da1eca5bf45c';

    protected string $apiPath = 'boards';

    #[Test]
    public function shouldShowBoard(): void
    {
        $response = [
            'id' => $this->fakeBoardId,
        ];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeBoardId)
            ->willReturn($response);

        static::assertEquals($response, $api->show($this->fakeBoardId));
    }

    #[Test]
    public function shouldCreateBoard(): void
    {
        $response = [
            'name' => 'Test Board',
        ];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with($this->apiPath)
            ->willReturn($response);

        static::assertEquals($response, $api->create($response));
    }

    #[Test]
    public function shouldNotCreateBoardWithoutName(): void
    {
        $this->expectException(MissingArgumentException::class);

        $data = [
            'desc' => 'Test Board Description',
        ];

        $api = $this->getApiMock();
        $api->expects($this->never())->method('post');

        $api->create($data);
    }

    #[Test]
    public function shouldUpdateBoard(): void
    {
        $response = [
            'name' => 'Test Board',
        ];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeBoardId)
            ->willReturn($response);

        static::assertEquals($response, $api->update($this->fakeBoardId, $response));
    }

    #[Test]
    public function shouldGetField(): void
    {
        $response = ['response'];

        $field = 'desc';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeBoardId.'/desc')
            ->willReturn($response);

        static::assertEquals($response, $api->getField($this->fakeBoardId, $field));
    }

    #[Test]
    public function shouldNotGetUnexistingField(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $api = $this->getApiMock();
        $api->expects($this->never())->method('get');

        $api->getField($this->fakeBoardId, 'unexisting');
    }

    #[Test]
    public function shouldSetName(): void
    {
        $response = ['response'];

        $name = 'Test Board';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeBoardId.'/name')
            ->willReturn($response);

        static::assertEquals($response, $api->setName($this->fakeBoardId, $name));
    }

    #[Test]
    public function shouldSetDescription(): void
    {
        $response = ['response'];

        $description = 'Test Board Description';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeBoardId.'/desc')
            ->willReturn($response);

        static::assertEquals($response, $api->setDescription($this->fakeBoardId, $description));
    }

    #[Test]
    public function shouldSetClosed(): void
    {
        $response = ['response'];

        $closed = true;

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeBoardId.'/closed')
            ->willReturn($response);

        static::assertEquals($response, $api->setClosed($this->fakeBoardId, $closed));
    }

    #[Test]
    public function shouldSetSubscribed(): void
    {
        $response = ['response'];

        $subscribed = true;

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeBoardId.'/subscribed')
            ->willReturn($response);

        static::assertEquals($response, $api->setSubscribed($this->fakeBoardId, $subscribed));
    }

    #[Test]
    public function shouldSetViewed(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with($this->apiPath.'/'.$this->fakeBoardId.'/markAsViewed')
            ->willReturn($response);

        static::assertEquals($response, $api->setViewed($this->fakeBoardId));
    }

    #[Test]
    public function shouldSetOrganization(): void
    {
        $response = ['response'];

        $orgId = $this->fakeId('organization');

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeBoardId.'/idOrganization/'.$orgId)
            ->willReturn($response);

        static::assertEquals($response, $api->setOrganization($this->fakeBoardId, $orgId));
    }

    #[Test]
    public function shouldGetOrganization(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeBoardId.'/organization')
            ->willReturn($response);

        static::assertEquals($response, $api->getOrganization($this->fakeBoardId));
    }

    #[Test]
    public function shouldGetOrganizationField(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeBoardId.'/organization/name')
            ->willReturn($response);

        static::assertEquals($response, $api->getOrganizationField($this->fakeBoardId, 'name'));
    }

    #[Test]
    public function shouldNotGetUnexistingOrganizationField(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $api = $this->getApiMock();
        $api->expects($this->never())->method('get');

        $api->getOrganizationField($this->fakeBoardId, 'unexisting');
    }

    #[Test]
    public function shouldGetDeltas(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeBoardId.'/deltas')
            ->willReturn($response);

        static::assertEquals($response, $api->getDeltas($this->fakeBoardId));
    }

    #[Test]
    public function shouldGetStars(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeBoardId.'/boardStars')
            ->willReturn($response);

        static::assertEquals($response, $api->getStars($this->fakeBoardId));
    }

    #[Test]
    public function shouldGetActionsApiObject(): void
    {
        static::assertInstanceOf(BoardActionsApi::class, $this->getApiMock()->actions());
    }

    #[Test]
    public function shouldGetCardListsApiObject(): void
    {
        static::assertInstanceOf(BoardCardListsApi::class, $this->getApiMock()->lists());
    }

    #[Test]
    public function shouldGetCardsApiObject(): void
    {
        static::assertInstanceOf(BoardCardsApi::class, $this->getApiMock()->cards());
    }

    #[Test]
    public function shouldGetChecklistsApiObject(): void
    {
        static::assertInstanceOf(BoardChecklistsApi::class, $this->getApiMock()->checklists());
    }

    #[Test]
    public function shouldGetLabelsApiObject(): void
    {
        static::assertInstanceOf(BoardLabelsApi::class, $this->getApiMock()->labels());
    }

    #[Test]
    public function shouldGetMembersApiObject(): void
    {
        static::assertInstanceOf(BoardMembersApi::class, $this->getApiMock()->members());
    }

    #[Test]
    public function shouldGetMembershipsApiObject(): void
    {
        static::assertInstanceOf(BoardMembershipsApi::class, $this->getApiMock()->memberships());
    }

    #[Test]
    public function shouldGetMyPreferencesApiObject(): void
    {
        static::assertInstanceOf(BoardMyPreferencesApi::class, $this->getApiMock()->myPreferences());
    }

    #[Test]
    public function shouldGetPowerUpsApiObject(): void
    {
        static::assertInstanceOf(BoardPowerUpsApi::class, $this->getApiMock()->powerUps());
    }

    #[Test]
    public function shouldGetPreferencesApiObject(): void
    {
        static::assertInstanceOf(BoardPreferencesApi::class, $this->getApiMock()->preferences());
    }

    protected function getApiClass(): string
    {
        return BoardApi::class;
    }
}

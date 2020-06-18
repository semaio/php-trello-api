<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Api;

use Semaio\TrelloApi\Api\ActionApi;
use Semaio\TrelloApi\Exception\InvalidArgumentException;

/**
 * @group unit
 */
class ActionApiTest extends ApiTestCase
{
    protected $apiPath = 'actions';

    /**
     * @test
     */
    public function shouldShowAction(): void
    {
        $response = ['id' => $this->fakeId];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeId)
            ->willReturn($response);

        static::assertEquals($response, $api->show($this->fakeId));
    }

    /**
     * @test
     */
    public function shouldUpdateAction(): void
    {
        $response = ['id' => $this->fakeId];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeId)
            ->willReturn($response);

        static::assertEquals($response, $api->update($this->fakeId, $response));
    }

    /**
     * @test
     */
    public function shouldRemoveAction(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('delete')
            ->with($this->apiPath.'/'.$this->fakeId)
            ->willReturn($response);

        static::assertEquals($response, $api->remove($this->fakeId));
    }

    /**
     * @test
     */
    public function shouldSetText(): void
    {
        $response = ['response'];

        $text = 'Lorem Ipsum';

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeId.'/text')
            ->willReturn($response);

        static::assertEquals($response, $api->setText($this->fakeId, $text));
    }

    /**
     * @test
     */
    public function shouldGetBoard(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeParentId.'/board')
            ->willReturn($response);

        static::assertEquals($response, $api->getBoard($this->fakeParentId));
    }

    /**
     * @test
     */
    public function shouldGetBoardField(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeParentId.'/board/name')
            ->willReturn($response);

        static::assertEquals($response, $api->getBoardField($this->fakeParentId, 'name'));
    }

    /**
     * @test
     */
    public function shouldNotGetUnexistingBoardField(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $api = $this->getApiMock();
        $api->expects(static::never())->method('get');

        $api->getBoardField($this->fakeParentId, 'unexisting');
    }

    /**
     * @test
     */
    public function shouldGetList(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeParentId.'/list')
            ->willReturn($response);

        static::assertEquals($response, $api->getList($this->fakeParentId));
    }

    /**
     * @test
     */
    public function shouldGetListField(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeParentId.'/list/name')
            ->willReturn($response);

        static::assertEquals($response, $api->getListField($this->fakeParentId, 'name'));
    }

    /**
     * @test
     */
    public function shouldNotGetUnexistingListField(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $api = $this->getApiMock();
        $api->expects(static::never())->method('get');

        $api->getListField($this->fakeParentId, 'unexisting');
    }

    /**
     * @test
     */
    public function shouldGetCard(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeParentId.'/card')
            ->willReturn($response);

        static::assertEquals($response, $api->getCard($this->fakeParentId));
    }

    /**
     * @test
     */
    public function shouldGetCardField(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeParentId.'/card/name')
            ->willReturn($response);

        static::assertEquals($response, $api->getCardField($this->fakeParentId, 'name'));
    }

    /**
     * @test
     */
    public function shouldNotGetUnexistingCardField(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $api = $this->getApiMock();
        $api->expects(static::never())->method('get');

        $api->getCardField($this->fakeParentId, 'unexisting');
    }

    /**
     * @test
     */
    public function shouldGetMember(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeParentId.'/member')
            ->willReturn($response);

        static::assertEquals($response, $api->getMember($this->fakeParentId));
    }

    /**
     * @test
     */
    public function shouldGetMemberField(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeParentId.'/member/bio')
            ->willReturn($response);

        static::assertEquals($response, $api->getMemberField($this->fakeParentId, 'bio'));
    }

    /**
     * @test
     */
    public function shouldNotGetUnexistingMemberField(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $api = $this->getApiMock();
        $api->expects(static::never())->method('get');

        $api->getMemberField($this->fakeParentId, 'unexisting');
    }

    /**
     * @test
     */
    public function shouldGetCreator(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeParentId.'/memberCreator')
            ->willReturn($response);

        static::assertEquals($response, $api->getCreator($this->fakeParentId));
    }

    /**
     * @test
     */
    public function shouldGetCreatorField(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeParentId.'/memberCreator/bio')
            ->willReturn($response);

        static::assertEquals($response, $api->getCreatorField($this->fakeParentId, 'bio'));
    }

    /**
     * @test
     */
    public function shouldNotGetUnexistingCreatorField(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $api = $this->getApiMock();
        $api->expects(static::never())->method('get');

        $api->getCreatorField($this->fakeParentId, 'unexisting');
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
            ->with($this->apiPath.'/'.$this->fakeParentId.'/organization')
            ->willReturn($response);

        static::assertEquals($response, $api->getOrganization($this->fakeParentId));
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
            ->with($this->apiPath.'/'.$this->fakeParentId.'/organization/name')
            ->willReturn($response);

        static::assertEquals($response, $api->getOrganizationField($this->fakeParentId, 'name'));
    }

    /**
     * @test
     */
    public function shouldNotGetUnexistingOrganizationField(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $api = $this->getApiMock();
        $api->expects(static::never())->method('get');

        $api->getOrganizationField($this->fakeParentId, 'unexisting');
    }

    protected function getApiClass()
    {
        return ActionApi::class;
    }
}

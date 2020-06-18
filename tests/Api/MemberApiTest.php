<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Api;

use Semaio\TrelloApi\Api\Member\Board\MemberBoardBackgroundsApi;
use Semaio\TrelloApi\Api\Member\Board\MemberBoardStarsApi;
use Semaio\TrelloApi\Api\Member\MemberActionsApi;
use Semaio\TrelloApi\Api\Member\MemberBoardsApi;
use Semaio\TrelloApi\Api\Member\MemberCardsApi;
use Semaio\TrelloApi\Api\Member\MemberCustomBackgroundsApi;
use Semaio\TrelloApi\Api\Member\MemberCustomEmojiApi;
use Semaio\TrelloApi\Api\Member\MemberCustomStickersApi;
use Semaio\TrelloApi\Api\Member\MemberNotificationsApi;
use Semaio\TrelloApi\Api\Member\MemberOrganizationsApi;
use Semaio\TrelloApi\Api\Member\MemberSavedSearchesApi;
use Semaio\TrelloApi\Api\MemberApi;

/**
 * @group unit
 */
class MemberApiTest extends ApiTestCase
{
    protected $fakeMemberId = '5461efc60872da1eca5bf45c';

    protected $apiPath = 'members';

    /**
     * @test
     */
    public function shouldShowMember(): void
    {
        $response = ['id' => $this->fakeMemberId];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeMemberId)
            ->willReturn($response);

        static::assertEquals($response, $api->show($this->fakeMemberId));
    }

    /**
     * @test
     */
    public function shouldUpdateMember(): void
    {
        $response = ['id' => $this->fakeMemberId];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeMemberId)
            ->willReturn($response);

        static::assertEquals($response, $api->update($this->fakeMemberId, $response));
    }

    /**
     * @test
     */
    public function shouldGetDeltas(): void
    {
        $response = ['id' => $this->fakeMemberId];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeMemberId.'/deltas')
            ->willReturn($response);

        static::assertEquals($response, $api->getDeltas($this->fakeMemberId));
    }

    /**
     * @test
     */
    public function shouldSetUsername(): void
    {
        $response = ['response'];

        $username = 'TestUser';

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeMemberId.'/username')
            ->willReturn($response);

        static::assertEquals($response, $api->setUsername($this->fakeMemberId, $username));
    }

    /**
     * @test
     */
    public function shouldSetBio(): void
    {
        $response = ['response'];

        $bio = 'bio';

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeMemberId.'/bio')
            ->willReturn($response);

        static::assertEquals($response, $api->setBio($this->fakeMemberId, $bio));
    }

    /**
     * @test
     */
    public function shouldSetAvatar(): void
    {
        $response = ['response'];

        $avatar = 'avatar';

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('post')
            ->with($this->apiPath.'/'.$this->fakeMemberId.'/avatar')
            ->willReturn($response);

        static::assertEquals($response, $api->setAvatar($this->fakeMemberId, $avatar));
    }

    /**
     * @test
     */
    public function shouldSetAvatarSource(): void
    {
        $response = ['response'];

        $avatarSource = 'avatarSource';

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeMemberId.'/avatarSource')
            ->willReturn($response);

        static::assertEquals($response, $api->setAvatarSource($this->fakeMemberId, $avatarSource));
    }

    /**
     * @test
     */
    public function shouldSetInitials(): void
    {
        $response = ['response'];

        $initials = 'AA';

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeMemberId.'/initials')
            ->willReturn($response);

        static::assertEquals($response, $api->setInitials($this->fakeMemberId, $initials));
    }

    /**
     * @test
     */
    public function shouldSetFullName(): void
    {
        $response = ['response'];

        $fullName = 'John Doe';

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeMemberId.'/fullName')
            ->willReturn($response);

        static::assertEquals($response, $api->setFullName($this->fakeMemberId, $fullName));
    }

    /**
     * @test
     */
    public function shouldGetActionsApiObject(): void
    {
        static::assertInstanceOf(MemberActionsApi::class, $this->getApiMock()->actions());
    }

    /**
     * @test
     */
    public function shouldGetBoardsApiObject(): void
    {
        static::assertInstanceOf(MemberBoardsApi::class, $this->getApiMock()->boards());
    }

    /**
     * @test
     */
    public function shouldGetCardsApiObject(): void
    {
        static::assertInstanceOf(MemberCardsApi::class, $this->getApiMock()->cards());
    }

    /**
     * @test
     */
    public function shouldGetCustomBackgroundsApiObject(): void
    {
        static::assertInstanceOf(MemberCustomBackgroundsApi::class, $this->getApiMock()->customBackgrounds());
    }

    /**
     * @test
     */
    public function shouldGetCustomEmojiApiObject(): void
    {
        static::assertInstanceOf(MemberCustomEmojiApi::class, $this->getApiMock()->customEmoji());
    }

    /**
     * @test
     */
    public function shouldGetCustomStickersApiObject(): void
    {
        static::assertInstanceOf(MemberCustomStickersApi::class, $this->getApiMock()->customStickers());
    }

    /**
     * @test
     */
    public function shouldGetNotificationsApiObject(): void
    {
        static::assertInstanceOf(MemberNotificationsApi::class, $this->getApiMock()->notifications());
    }

    /**
     * @test
     */
    public function shouldGetOrganizationsApiObject(): void
    {
        static::assertInstanceOf(MemberOrganizationsApi::class, $this->getApiMock()->organizations());
    }

    /**
     * @test
     */
    public function shouldGetSavedSearchesApiObject(): void
    {
        static::assertInstanceOf(MemberSavedSearchesApi::class, $this->getApiMock()->savedSearches());
    }

    /**
     * @test
     */
    public function shouldGetBoardBackgroundsApiObject(): void
    {
        static::assertInstanceOf(MemberBoardBackgroundsApi::class, $this->getApiMock()->boards()->backgrounds());
    }

    /**
     * @test
     */
    public function shouldGetBoardStarsApiObject(): void
    {
        static::assertInstanceOf(MemberBoardStarsApi::class, $this->getApiMock()->boards()->stars());
    }

    protected function getApiClass()
    {
        return MemberApi::class;
    }
}

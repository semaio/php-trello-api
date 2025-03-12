<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Api;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
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

#[Group('unit')]
class MemberApiTest extends ApiTestCase
{
    protected string $fakeMemberId = '5461efc60872da1eca5bf45c';

    protected string $apiPath = 'members';

    #[Test]
    public function shouldShowMember(): void
    {
        $response = [
            'id' => $this->fakeMemberId,
        ];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeMemberId)
            ->willReturn($response);

        static::assertEquals($response, $api->show($this->fakeMemberId));
    }

    #[Test]
    public function shouldUpdateMember(): void
    {
        $response = [
            'id' => $this->fakeMemberId,
        ];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeMemberId)
            ->willReturn($response);

        static::assertEquals($response, $api->update($this->fakeMemberId, $response));
    }

    #[Test]
    public function shouldGetDeltas(): void
    {
        $response = [
            'id' => $this->fakeMemberId,
        ];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeMemberId.'/deltas')
            ->willReturn($response);

        static::assertEquals($response, $api->getDeltas($this->fakeMemberId));
    }

    #[Test]
    public function shouldSetUsername(): void
    {
        $response = ['response'];

        $username = 'TestUser';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeMemberId.'/username')
            ->willReturn($response);

        static::assertEquals($response, $api->setUsername($this->fakeMemberId, $username));
    }

    #[Test]
    public function shouldSetBio(): void
    {
        $response = ['response'];

        $bio = 'bio';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeMemberId.'/bio')
            ->willReturn($response);

        static::assertEquals($response, $api->setBio($this->fakeMemberId, $bio));
    }

    #[Test]
    public function shouldSetAvatar(): void
    {
        $response = ['response'];

        $avatar = 'avatar';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with($this->apiPath.'/'.$this->fakeMemberId.'/avatar')
            ->willReturn($response);

        static::assertEquals($response, $api->setAvatar($this->fakeMemberId, $avatar));
    }

    #[Test]
    public function shouldSetAvatarSource(): void
    {
        $response = ['response'];

        $avatarSource = 'avatarSource';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeMemberId.'/avatarSource')
            ->willReturn($response);

        static::assertEquals($response, $api->setAvatarSource($this->fakeMemberId, $avatarSource));
    }

    #[Test]
    public function shouldSetInitials(): void
    {
        $response = ['response'];

        $initials = 'AA';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeMemberId.'/initials')
            ->willReturn($response);

        static::assertEquals($response, $api->setInitials($this->fakeMemberId, $initials));
    }

    #[Test]
    public function shouldSetFullName(): void
    {
        $response = ['response'];

        $fullName = 'John Doe';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeMemberId.'/fullName')
            ->willReturn($response);

        static::assertEquals($response, $api->setFullName($this->fakeMemberId, $fullName));
    }

    #[Test]
    public function shouldGetActionsApiObject(): void
    {
        static::assertInstanceOf(MemberActionsApi::class, $this->getApiMock()->actions());
    }

    #[Test]
    public function shouldGetBoardsApiObject(): void
    {
        static::assertInstanceOf(MemberBoardsApi::class, $this->getApiMock()->boards());
    }

    #[Test]
    public function shouldGetCardsApiObject(): void
    {
        static::assertInstanceOf(MemberCardsApi::class, $this->getApiMock()->cards());
    }

    #[Test]
    public function shouldGetCustomBackgroundsApiObject(): void
    {
        static::assertInstanceOf(MemberCustomBackgroundsApi::class, $this->getApiMock()->customBackgrounds());
    }

    #[Test]
    public function shouldGetCustomEmojiApiObject(): void
    {
        static::assertInstanceOf(MemberCustomEmojiApi::class, $this->getApiMock()->customEmoji());
    }

    #[Test]
    public function shouldGetCustomStickersApiObject(): void
    {
        static::assertInstanceOf(MemberCustomStickersApi::class, $this->getApiMock()->customStickers());
    }

    #[Test]
    public function shouldGetNotificationsApiObject(): void
    {
        static::assertInstanceOf(MemberNotificationsApi::class, $this->getApiMock()->notifications());
    }

    #[Test]
    public function shouldGetOrganizationsApiObject(): void
    {
        static::assertInstanceOf(MemberOrganizationsApi::class, $this->getApiMock()->organizations());
    }

    #[Test]
    public function shouldGetSavedSearchesApiObject(): void
    {
        static::assertInstanceOf(MemberSavedSearchesApi::class, $this->getApiMock()->savedSearches());
    }

    #[Test]
    public function shouldGetBoardBackgroundsApiObject(): void
    {
        static::assertInstanceOf(MemberBoardBackgroundsApi::class, $this->getApiMock()->boards()->backgrounds());
    }

    #[Test]
    public function shouldGetBoardStarsApiObject(): void
    {
        static::assertInstanceOf(MemberBoardStarsApi::class, $this->getApiMock()->boards()->stars());
    }

    protected function getApiClass(): string
    {
        return MemberApi::class;
    }
}

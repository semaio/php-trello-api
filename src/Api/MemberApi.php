<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Api;

use Semaio\TrelloApi\Api\Member\MemberActionsApi;
use Semaio\TrelloApi\Api\Member\MemberBoardsApi;
use Semaio\TrelloApi\Api\Member\MemberCardsApi;
use Semaio\TrelloApi\Api\Member\MemberCustomBackgroundsApi;
use Semaio\TrelloApi\Api\Member\MemberCustomEmojiApi;
use Semaio\TrelloApi\Api\Member\MemberCustomStickersApi;
use Semaio\TrelloApi\Api\Member\MemberNotificationsApi;
use Semaio\TrelloApi\Api\Member\MemberOrganizationsApi;
use Semaio\TrelloApi\Api\Member\MemberSavedSearchesApi;

/**
 * @see https://trello.com/docs/api/member
 *
 * Not implemented:
 * - Board backgrounds API @see Member\Board\MemberBoardBackgroundsApi
 * - Board stars API @see Member\Board\MemberBoardStarsApi
 * - Custom backgrounds API @see Member\MemberCustomBackgroundsApi
 * - Saved Searches API @see Member\MemberSavedSearchesApi
 * - Custom Emoji API @see Member\MemberCustomEmojiApi
 * - Custom Stickers API @see Member\MemberCustomStickersApi
 * - https://trello.com/docs/api/member/#get-1-members-idmember-or-username-tokens
 * - https://trello.com/docs/api/member/#put-1-members-idmember-or-username-prefs-colorblind
 * - https://trello.com/docs/api/member/#put-1-members-idmember-or-username-prefs-minutesbetweensummaries
 * - https://trello.com/docs/api/member/#post-1-members-idmember-or-username-onetimemessagesdismissed
 * - https://trello.com/docs/api/member/#post-1-members-idmember-or-username-unpaidaccount
 */
class MemberApi extends AbstractApi
{
    /**
     * @see https://trello.com/docs/api/member/#get-1-members-idmember-or-username-field
     */
    public static $fields = [
        'avatarHash',
        'bio',
        'bioData',
        'confirmed',
        'fullName',
        'idPremOrgsAdmin',
        'initials',
        'memberType',
        'products',
        'status',
        'url',
        'username',
        'avatarSource',
        'email',
        'gravatarHash',
        'idBoards',
        'idBoardsPinned',
        'idOrganizations',
        'loginTypes',
        'newEmail',
        'oneTimeMessagesDismissed',
        'prefs',
        'status',
        'trophies',
        'uploadedAvatarHash',
        'premiumFeatures',
    ];

    protected $path = 'members';

    /**
     * Find a member by id or username.
     *
     * @see https://trello.com/docs/api/member/index.html#get-1-members-idmember-or-username
     */
    public function show(string $id, array $params = []): array
    {
        return $this->get($this->getPath().'/'.rawurlencode($id), $params);
    }

    /**
     * Update a member.
     *
     * @see https://trello.com/docs/api/member/#put-1-members-idmember-or-username
     */
    public function update(string $id, array $params = []): array
    {
        return $this->put($this->getPath().'/'.rawurlencode($id), $params);
    }

    /**
     * Get a given member's deltas.
     *
     * @see https://trello.com/docs/api/member/#get-1-members-idmember-or-username-deltas
     */
    public function getDeltas(string $id, array $params = []): array
    {
        return $this->get($this->path.'/'.rawurlencode($id).'/deltas', $params);
    }

    /**
     * Set a given member's avatarSource.
     *
     * @see https://trello.com/docs/api/member/#put-1-members-idmember-or-username-avatarSource
     */
    public function setAvatarSource(string $id, string $avatarSource): array
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/avatarSource', [
            'value' => $avatarSource,
        ]);
    }

    /**
     * Set a given member's bio.
     *
     * @see https://trello.com/docs/api/member/#put-1-members-idmember-or-username-bio
     */
    public function setBio(string $id, string $bio): array
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/bio', [
            'value' => $bio,
        ]);
    }

    /**
     * Set a given member's full name.
     *
     * @see https://trello.com/docs/api/member/#put-1-members-idmember-or-username-fullname
     */
    public function setFullName(string $id, string $fullName): array
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/fullName', [
            'value' => $fullName,
        ]);
    }

    /**
     * Set a given member's initials.
     *
     * @see https://trello.com/docs/api/member/#put-1-members-idmember-or-username-initials
     */
    public function setInitials(string $id, string $initials): array
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/initials', [
            'value' => $initials,
        ]);
    }

    /**
     * Set a given member's username.
     *
     * @see https://trello.com/docs/api/member/#put-1-members-idmember-or-username-username
     */
    public function setUsername(string $id, string $username): array
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/username', [
            'value' => $username,
        ]);
    }

    /**
     * Set a given member's avatar.
     *
     * @see https://trello.com/docs/api/member/#put-1-members-idmember-or-avatar-avatar
     */
    public function setAvatar(string $id, string $file): array
    {
        return $this->post($this->getPath().'/'.rawurlencode($id).'/avatar', [
            'file' => $file,
        ]);
    }

    public function actions(): MemberActionsApi
    {
        return new MemberActionsApi($this->client);
    }

    public function boards(): MemberBoardsApi
    {
        return new MemberBoardsApi($this->client);
    }

    public function cards(): MemberCardsApi
    {
        return new MemberCardsApi($this->client);
    }

    public function notifications(): MemberNotificationsApi
    {
        return new MemberNotificationsApi($this->client);
    }

    public function organizations(): MemberOrganizationsApi
    {
        return new MemberOrganizationsApi($this->client);
    }

    public function customBackgrounds(): MemberCustomBackgroundsApi
    {
        return new MemberCustomBackgroundsApi($this->client);
    }

    public function customEmoji(): MemberCustomEmojiApi
    {
        return new MemberCustomEmojiApi($this->client);
    }

    public function customStickers(): MemberCustomStickersApi
    {
        return new MemberCustomStickersApi($this->client);
    }

    public function savedSearches(): MemberSavedSearchesApi
    {
        return new MemberSavedSearchesApi($this->client);
    }
}

<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Api\Member;

use Semaio\TrelloApi\Api\AbstractApi;
use Semaio\TrelloApi\Api\BoardApi;
use Semaio\TrelloApi\Api\Member\Board\MemberBoardBackgroundsApi;
use Semaio\TrelloApi\Api\Member\Board\MemberBoardStarsApi;

/**
 * @see https://trello.com/docs/api/member
 *
 * Fully implemented.
 */
class MemberBoardsApi extends AbstractApi
{
    protected $path = 'members/#id#/boards';

    /**
     * Get boads related to a given member.
     *
     * @see https://trello.com/docs/api/member/#get-1-members-idmember-or-username-boards
     */
    public function all(string $id = 'me', array $params = []): array
    {
        return $this->get($this->getPath($id), $params);
    }

    /**
     * Filter boards related to a given member.
     *
     * @see https://trello.com/docs/api/member/#get-1-members-idmember-or-username-boards-filter
     */
    public function filter(string $id, string $filter = 'all', array $params = []): array
    {
        return $this->filters($id, [$filter], $params);
    }

    /**
     * Filter boards related to a given member.
     *
     * @see https://trello.com/docs/api/member/#get-1-members-idmember-or-username-boards-filter
     */
    public function filters(string $id, array $filters): array
    {
        $allowed = ['all', 'members', 'organization', 'public', 'open', 'closed', 'pinned', 'unpinned', 'starred'];
        $filters = $this->validateAllowedParameters($allowed, $filters, 'filter');

        return $this->get($this->getPath($id).'/'.implode(',', $filters), $params);
    }

    /**
     * Get boards a given member is invited to.
     *
     * @see https://trello.com/docs/api/member/#get-1-members-idmember-or-username-boardsinvited
     */
    public function invitedTo(string $id, array $params = []): array
    {
        return $this->get($this->getPath($id).'Invited', $params);
    }

    /**
     * Get a field of a board a given member is invited to.
     *
     * @see https://trello.com/docs/api/member/#get-1-members-idmember-or-username-boardsinvited-field
     */
    public function invitedToField(string $id, string $field): array
    {
        $this->validateAllowedParameter(BoardApi::$fields, $field, 'field');

        return $this->get($this->getPath($id).'Invited/'.rawurlencode($field));
    }

    /**
     * Pin a board for a given member.
     *
     * @see https://trello.com/docs/api/member/#post-1-members-idmember-or-username-idboardspinned
     */
    public function pin(string $id, string $boardId): array
    {
        return $this->post('members/'.rawurlencode($id).'/idBoardsPinned', [
            'value' => $boardId,
        ]);
    }

    /**
     * Unpin a board for a given member.
     *
     * @see https://trello.com/docs/api/member/#delete-1-members-idmember-or-username-idboardspinned-idboard
     */
    public function unpin(string $id, string $boardId): array
    {
        return $this->delete('members/'.rawurlencode($id).'/idBoardsPinned/'.rawurlencode($boardId));
    }

    /**
     * Board Backgrounds API.
     */
    public function backgrounds(): MemberBoardBackgroundsApi
    {
        return new MemberBoardBackgroundsApi($this->client);
    }

    /**
     * Board Stars API.
     */
    public function stars(): MemberBoardStarsApi
    {
        return new MemberBoardStarsApi($this->client);
    }
}

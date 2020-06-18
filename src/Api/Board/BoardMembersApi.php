<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Api\Board;

use Semaio\TrelloApi\Api\AbstractApi;
use Semaio\TrelloApi\Api\MemberApi;
use Semaio\TrelloApi\Exception\InvalidArgumentException;

/**
 * @see https://trello.com/docs/api/board
 *
 * Fully implemented.
 */
class BoardMembersApi extends AbstractApi
{
    /**
     * Base path of board members api.
     *
     * @var string
     */
    protected $path = 'boards/#id#/members';

    /**
     * Get a given board's members.
     *
     * @see https://trello.com/docs/api/board/#get-1-boards-board-id-members
     */
    public function all(string $id, array $params = []): array
    {
        return $this->get($this->getPath($id), $params);
    }

    /**
     * Remove a given member from a given board.
     *
     * @see https://trello.com/docs/api/board/#get-1-boards-board-id-members
     */
    public function remove(string $id, string $memberId): array
    {
        return $this->delete($this->getPath($id).'/'.$memberId);
    }

    /**
     * Filter members related to a given board.
     *
     * @see https://trello.com/docs/api/board/#get-1-boards-board-id-members-filter
     */
    public function filter(string $id, string $filter = 'all'): array
    {
        return $this->filters($id, [$filter]);
    }

    /**
     * Filter members related to a given board.
     *
     * @see https://trello.com/docs/api/board/#get-1-boards-board-id-members-filter
     */
    public function filters(string $id, array $filters): array
    {
        $allowed = ['none', 'normal', 'admins', 'owners', 'all'];
        $filters = $this->validateAllowedParameters($allowed, $filters, 'filter');

        return $this->get($this->getPath($id).'/'.implode(',', $filters));
    }

    /**
     * Get a member's cards related to a given board.
     *
     * @see https://trello.com/docs/api/board/#get-1-boards-board-id-members-filter
     */
    public function cards(string $id, string $memberId, array $params = []): array
    {
        return $this->get($this->getPath($id).'/'.rawurlencode($memberId).'/cards', $params);
    }

    /**
     * Add member to a given board.
     *
     * @see https://trello.com/docs/api/board/#put-1-boards-board-id-members
     */
    public function invite(string $id, string $email, string $fullName, string $role = 'normal'): array
    {
        $roles = ['normal', 'observer', 'admin'];

        if (!in_array($role, $roles, true)) {
            throw new InvalidArgumentException(sprintf('The "role" parameter must be one of "%s".', implode(', ', $roles)));
        }

        $params = [
            'email' => $email,
            'fullName' => $fullName,
            'type' => $role,
        ];

        return $this->put($this->getPath($id), $params);
    }

    /**
     * Get members invited to a given board.
     *
     * @see https://trello.com/docs/api/board/#get-1-boards-board-id-membersinvited
     */
    public function getInvitedMembers(string $id, array $params = []): array
    {
        return $this->get($this->getPath($id).'Invited', $params);
    }

    /**
     * Get a field related to a member invited to a given board.
     *
     * @see https://trello.com/docs/api/board/#get-1-boards-board-id-membersinvited-field
     */
    public function getInvitedMembersField(string $id, string $field): array
    {
        $this->validateAllowedParameter(MemberApi::$fields, $field, 'field');

        return $this->get($this->getPath($id).'Invited/'.rawurlencode($field));
    }

    /**
     * Set the role of a user or an organization on a given board.
     *
     * @see https://trello.com/docs/api/board/index.html#put-1-boards-board-id-members-idmember
     */
    public function setRole(string $id, string $memberOrOrganization, string $role): array
    {
        $roles = ['normal', 'observer', 'admin'];

        if (!in_array($role, $roles, true)) {
            throw new InvalidArgumentException(sprintf('The "role" parameter must be one of "%s".', implode(', ', $roles)));
        }

        $params = [
            'idMember' => $memberOrOrganization,
            'type' => $role,
        ];

        return $this->post($this->getPath($id).'/'.rawurlencode($memberOrOrganization), $params);
    }
}

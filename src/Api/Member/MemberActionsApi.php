<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Api\Member;

use Semaio\TrelloApi\Api\AbstractApi;

/**
 * @see https://trello.com/docs/api/member
 *
 * Fully implemented.
 */
class MemberActionsApi extends AbstractApi
{
    protected string $path = 'members/#id#/actions';

    /**
     * Get actions related to a given member.
     *
     * @see https://trello.com/docs/api/member/#get-1-members-idmember-or-username-actions
     */
    public function all(string $id, array $params = []): array
    {
        return $this->get($this->getPath($id), $params);
    }
}

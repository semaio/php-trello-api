<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Api\Member;

use Semaio\TrelloApi\Api\AbstractApi;

/**
 * @see https://trello.com/docs/api/member
 *
 * Fully implemented.
 */
class MemberCardsApi extends AbstractApi
{
    protected $path = 'members/#id#/cards';

    /**
     * Get cards related to a given list.
     *
     * @see https://trello.com/docs/api/member/#get-1-members-idmember-or-username-cards
     */
    public function all(string $id, array $params = []): array
    {
        return $this->get($this->getPath($id), $params);
    }

    /**
     * Filter cards related to a given list.
     *
     * @see https://trello.com/docs/api/list/#get-1-lists-idlist-cards-filter
     */
    public function filter(string $id, string $filter = 'all'): array
    {
        return $this->filters($id, [$filter]);
    }

    /**
     * Filter cards related to a given list.
     *
     * @see https://trello.com/docs/api/list/#get-1-lists-idlist-cards-filter
     */
    public function filters(string $id, array $filters): array
    {
        $allowed = ['none', 'visible', 'open', 'closed', 'all'];
        $filters = $this->validateAllowedParameters($allowed, $filters, 'filter');

        return $this->get($this->getPath($id).'/'.implode(',', $filters));
    }
}

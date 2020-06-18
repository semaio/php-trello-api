<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Api\CardList;

use Semaio\TrelloApi\Api\AbstractApi;

/**
 * @see https://trello.com/docs/api/list
 *
 * Fully implemented.
 */
class CardListActionsApi extends AbstractApi
{
    protected $path = 'lists/#id#/actions';

    /**
     * Get actions related to a given list.
     *
     * @see https://trello.com/docs/api/list/#get-1-lists-idlist-actions
     */
    public function all(string $id, array $params = []): array
    {
        return $this->get($this->getPath($id), $params);
    }
}

<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Api\Board;

use Semaio\TrelloApi\Api\AbstractApi;

/**
 * @see https://trello.com/docs/api/board
 *
 * Fully implemented.
 */
class BoardCardsApi extends AbstractApi
{
    protected $path = 'boards/#id#/cards';

    /**
     * Get cards related to a given board.
     *
     * @see https://trello.com/docs/api/board/#get-1-boards-board-id-cards
     */
    public function all(string $id, array $params = []): array
    {
        return $this->get($this->getPath($id), $params);
    }

    /**
     * Filter cards related to a given board.
     *
     * @see https://trello.com/docs/api/board/#get-1-boards-board-id-cards-filter
     */
    public function filter(string $id, string $filter = 'all'): array
    {
        return $this->filters($id, [$filter]);
    }

    /**
     * Filter cards related to a given board.
     *
     * @see https://trello.com/docs/api/board/#get-1-boards-board-id-cards-filter
     */
    public function filters(string $id, array $filters): array
    {
        $allowed = ['all', 'visible', 'none', 'open', 'closed'];
        $filters = $this->validateAllowedParameters($allowed, $filters, 'filter');

        return $this->get($this->getPath($id).'/'.implode(',', $filters));
    }

    /**
     * Get a card related to a given board.
     *
     * @see https://trello.com/docs/api/board/#get-1-boards-board-id-cards-idcard
     */
    public function show(string $id, string $cardId): array
    {
        return $this->get($this->getPath($id).'/'.rawurlencode($cardId));
    }
}

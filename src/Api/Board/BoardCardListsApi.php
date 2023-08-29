<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Api\Board;

use Semaio\TrelloApi\Api\AbstractApi;

/**
 * @see https://trello.com/docs/api/board
 *
 * Fully implemented.
 */
class BoardCardListsApi extends AbstractApi
{
    protected $path = 'boards/#id#/lists';

    /**
     * Get a given board's lists.
     *
     * @see https://trello.com/docs/api/board/#get-1-boards-board-id-lists
     */
    public function all(string $id, array $params = []): array
    {
        return $this->get($this->getPath($id), $params);
    }

    /**
     * Filter card lists related to a given board.
     *
     * @see https://trello.com/docs/api/board/#get-1-boards-board-id-lists-filter
     */
    public function filter(string $id, string $filter = 'all', array $params = []): array
    {
        return $this->filters($id, [$filter], $params);
    }

    /**
     * Filter card lists related to a given board.
     *
     * @see https://trello.com/docs/api/board/#get-1-boards-board-id-lists-filter
     */
    public function filters(string $id, array $filters, array $params = []): array
    {
        $allowed = ['all', 'none', 'open', 'closed'];
        $filters = $this->validateAllowedParameters($allowed, $filters, 'filter');

        return $this->get($this->getPath($id).'/'.implode(',', $filters), $params);
    }

    /**
     * Create a list on a given board.
     *
     * @see https://trello.com/docs/api/board/#post-1-boards-board-id-lists
     *
     * @throws \Semaio\TrelloApi\Exception\MissingArgumentException
     */
    public function create(string $id, array $params = []): array
    {
        $this->validateRequiredParameters(['name'], $params);

        return $this->post($this->getPath($id), $params);
    }
}

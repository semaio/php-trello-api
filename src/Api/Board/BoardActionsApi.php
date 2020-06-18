<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Api\Board;

use Semaio\TrelloApi\Api\AbstractApi;

/**
 * @see https://trello.com/docs/api/board
 *
 * Fully implemented.
 */
class BoardActionsApi extends AbstractApi
{
    protected $path = 'boards/#id#/actions';

    /**
     * Get actions related to a given board.
     *
     * @see https://trello.com/docs/api/board/#get-1-boards-board-id-actions
     */
    public function all(string $id, array $params = []): array
    {
        return $this->get($this->getPath($id), $params);
    }
}

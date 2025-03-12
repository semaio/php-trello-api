<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Api\Board;

use Semaio\TrelloApi\Api\AbstractApi;
use Semaio\TrelloApi\Exception\InvalidArgumentException;

/**
 * @see https://trello.com/docs/api/board
 *
 * Fully implemented.
 */
class BoardLabelsApi extends AbstractApi
{
    protected string $path = 'boards/#id#/labels';

    /**
     * Get labels related to a given board.
     *
     * @see https://trello.com/docs/api/board/#get-1-boards-board-id-labels
     */
    public function all(string $id, array $params = []): array
    {
        return $this->get($this->getPath($id), $params);
    }

    /**
     * Get a label related to a given board.
     *
     * @see https://trello.com/docs/api/board/#get-1-boards-board-id-labels-idlabel
     */
    public function show(string $id, string $color): array
    {
        $colors = ['black', 'blue', 'green', 'lime', 'orange', 'pink', 'purple', 'red', 'sky', 'yellow'];

        if (!in_array($color, $colors, true)) {
            throw new InvalidArgumentException(sprintf('The "color" parameter must be one of "%s".', implode(', ', $colors)));
        }

        return $this->get($this->getPath($id).'/'.rawurlencode($color));
    }

    /**
     * Set a label's name on a given board and for a given color.
     *
     * @see https://trello.com/docs/api/board/#put-1-boards-board-id-labelnames-blue
     * @see https://trello.com/docs/api/board/#put-1-boards-board-id-labelnames-green
     * @see https://trello.com/docs/api/board/#put-1-boards-board-id-labelnames-orange
     * @see https://trello.com/docs/api/board/#put-1-boards-board-id-labelnames-purple
     * @see https://trello.com/docs/api/board/#put-1-boards-board-id-labelnames-red
     * @see https://trello.com/docs/api/board/#put-1-boards-board-id-labelnames-yellow
     */
    public function setName(string $id, string $color, string $name): array
    {
        $colors = ['black', 'blue', 'green', 'lime', 'orange', 'pink', 'purple', 'red', 'sky', 'yellow'];

        if (!in_array($color, $colors, true)) {
            throw new InvalidArgumentException(sprintf('The "color" parameter must be one of "%s".', implode(', ', $colors)));
        }

        return $this->put('boards/'.rawurlencode($id).'/labelNames/'.rawurlencode($color), [
            'value' => $name,
        ]);
    }

    /**
     * Create a list on a given board.
     *
     * @see https://trello.com/docs/api/board/#post-1-boards-board-id-lists
     */
    public function create(string $id, string $color, string $name): array
    {
        $colors = ['black', 'blue', 'green', 'lime', 'orange', 'pink', 'purple', 'red', 'sky', 'yellow'];

        if (!in_array($color, $colors, true)) {
            throw new InvalidArgumentException(sprintf('The "color" parameter must be one of "%s".', implode(', ', $colors)));
        }

        return $this->post('boards/'.rawurlencode($id).'/labels/', [
            'name' => $name,
            'color' => $color,
        ]);
    }
}

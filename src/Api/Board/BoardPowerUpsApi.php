<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Api\Board;

use Semaio\TrelloApi\Api\AbstractApi;

/**
 * @see https://trello.com/docs/api/board
 *
 * Not implemented:
 * - https://trello.com/docs/api/board/#post-1-boards-board-id-powerups
 * - https://trello.com/docs/api/board/#delete-1-boards-board-id-powerups-powerup
 */
class BoardPowerUpsApi extends AbstractApi
{
    /**
     * Base path of board power ups api.
     *
     * @var string
     */
    protected string $path = 'boards/#id#/powerUps';
}

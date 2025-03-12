<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Api\Board;

use Semaio\TrelloApi\Api\AbstractApi;

/**
 * @see https://trello.com/docs/api/board
 *
 * Not implemented:
 * - https://trello.com/docs/api/board/#get-1-boards-board-id-memberships
 * - https://trello.com/docs/api/board/#get-1-boards-board-id-memberships-idmembership
 * - https://trello.com/docs/api/board/#put-1-boards-board-id-memberships-idmembership
 */
class BoardMembershipsApi extends AbstractApi
{
    /**
     * Base path of board power ups api.
     *
     * @var string
     */
    protected string $path = 'boards/#id#/memberships';
}

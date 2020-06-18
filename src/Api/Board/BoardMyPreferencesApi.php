<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Api\Board;

use Semaio\TrelloApi\Api\AbstractApi;

/**
 * @see https://trello.com/docs/api/board
 *
 * Not implemented:
 * - https://trello.com/docs/api/board/#get-1-boards-board-id-myprefs
 * - https://trello.com/docs/api/board/#put-1-boards-board-id-myprefs-emailposition
 * - https://trello.com/docs/api/board/#put-1-boards-board-id-myprefs-idemaillist
 * - https://trello.com/docs/api/board/#put-1-boards-board-id-myprefs-showlistguide
 * - https://trello.com/docs/api/board/#put-1-boards-board-id-myprefs-showsidebar
 * - https://trello.com/docs/api/board/#put-1-boards-board-id-myprefs-showsidebaractivity
 * - https://trello.com/docs/api/board/#put-1-boards-board-id-myprefs-showsidebarboardactions
 * - https://trello.com/docs/api/board/#put-1-boards-board-id-myprefs-showsidebarmembers
 */
class BoardMyPreferencesApi extends AbstractApi
{
    /**
     * Base path of board my preferences api.
     *
     * @var string
     */
    protected $path = 'boards/#id#/myPrefs';
}

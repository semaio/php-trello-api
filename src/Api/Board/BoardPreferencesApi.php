<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Api\Board;

use Semaio\TrelloApi\Api\AbstractApi;

/**
 * @see https://trello.com/docs/api/board
 *
 * Not implemented:
 * - https://trello.com/docs/api/board/#put-1-boards-board-id-prefs-background
 * - https://trello.com/docs/api/board/#put-1-boards-board-id-prefs-calendarfeedenabled
 * - https://trello.com/docs/api/board/#put-1-boards-board-id-prefs-cardaging
 * - https://trello.com/docs/api/board/#put-1-boards-board-id-prefs-cardcovers
 * - https://trello.com/docs/api/board/#put-1-boards-board-id-prefs-comments
 * - https://trello.com/docs/api/board/#put-1-boards-board-id-prefs-invitations
 * - https://trello.com/docs/api/board/#put-1-boards-board-id-prefs-permissionlevel
 * - https://trello.com/docs/api/board/#put-1-boards-board-id-prefs-selfjoin
 * - https://trello.com/docs/api/board/#put-1-boards-board-id-prefs-voting
 */
class BoardPreferencesApi extends AbstractApi
{
    /**
     * Base path of board preferences api.
     *
     * @var string
     */
    protected string $path = 'boards/#id#/prefs';
}

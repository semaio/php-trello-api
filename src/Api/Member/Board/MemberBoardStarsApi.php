<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Api\Member\Board;

use Semaio\TrelloApi\Api\AbstractApi;

/**
 * @see https://trello.com/docs/api/member
 *
 * Not implemented:
 * - https://trello.com/docs/api/member/#get-1-members-idmember-or-username-boardstars
 * - https://trello.com/docs/api/member/#get-1-members-idmember-or-username-boardstars-idboardstar
 * - https://trello.com/docs/api/member/#put-1-members-idmember-or-username-boardstars-idboardstar
 * - https://trello.com/docs/api/member/#put-1-members-idmember-or-username-boardstars-idboardstar-idboard
 * - https://trello.com/docs/api/member/#put-1-members-idmember-or-username-boardstars-idboardstar-pos
 * - https://trello.com/docs/api/member/#post-1-members-idmember-or-username-boardstars
 * - https://trello.com/docs/api/member/#delete-1-members-idmember-or-username-boardstars-idboardstar
 */
class MemberBoardStarsApi extends AbstractApi
{
    protected $path = 'member/#id#/boardStars';
}

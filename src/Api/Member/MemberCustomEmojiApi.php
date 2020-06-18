<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Api\Member;

use Semaio\TrelloApi\Api\AbstractApi;

/**
 * @see https://trello.com/docs/api/member
 *
 * Not implemented:
 * - https://trello.com/docs/api/member/#get-1-members-idmember-or-username-customemoji
 * - https://trello.com/docs/api/member/#get-1-members-idmember-or-username-customemoji-idcustomemoji
 * - https://trello.com/docs/api/member/#post-1-members-idmember-or-username-customemoji
 */
class MemberCustomEmojiApi extends AbstractApi
{
    protected $path = 'members/#id#/customEmoji';
}

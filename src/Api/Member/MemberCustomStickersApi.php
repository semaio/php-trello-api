<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Api\Member;

use Semaio\TrelloApi\Api\AbstractApi;

/**
 * @see https://trello.com/docs/api/member
 *
 * Not implemented:
 * - https://trello.com/docs/api/member/#get-1-members-idmember-or-username-customstickers
 * - https://trello.com/docs/api/member/#get-1-members-idmember-or-username-customstickers-idcustomsticker
 * - https://trello.com/docs/api/member/#post-1-members-idmember-or-username-customstickers
 * - https://trello.com/docs/api/member/#delete-1-members-idmember-or-username-customstickers-idcustomsticker
 */
class MemberCustomStickersApi extends AbstractApi
{
    protected string $path = 'members/#id#/customStickers';
}

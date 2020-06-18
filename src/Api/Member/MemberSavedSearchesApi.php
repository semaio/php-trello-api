<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Api\Member;

use Semaio\TrelloApi\Api\AbstractApi;

/**
 * @see https://trello.com/docs/api/member
 *
 * Not implemented:
 * - https://trello.com/docs/api/member/#get-1-members-idmember-or-username-savedsearches
 * - https://trello.com/docs/api/member/#get-1-members-idmember-or-username-savedsearches-idsavedsearch
 * - https://trello.com/docs/api/member/#put-1-members-idmember-or-username-savedsearches-idsavedsearch
 * - https://trello.com/docs/api/member/#put-1-members-idmember-or-username-savedsearches-idsavedsearch-name
 * - https://trello.com/docs/api/member/#put-1-members-idmember-or-username-savedsearches-idsavedsearch-pos
 * - https://trello.com/docs/api/member/#put-1-members-idmember-or-username-savedsearches-idsavedsearch-query
 * - https://trello.com/docs/api/member/#post-1-members-idmember-or-username-savedsearches
 * - https://trello.com/docs/api/member/#delete-1-members-idmember-or-username-savedsearches-idsavedsearch
 */
class MemberSavedSearchesApi extends AbstractApi
{
    protected $path = 'members/#id#/savedSearches';
}

<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Api\Member;

use Semaio\TrelloApi\Api\AbstractApi;
use Semaio\TrelloApi\WebhookEvents;

/**
 * @see https://trello.com/docs/api/member
 *
 * Fully implemented.
 */
class MemberNotificationsApi extends AbstractApi
{
    protected $path = 'members/#id#/notifications';

    /**
     * Get notifications related to a given list.
     *
     * @see https://trello.com/docs/api/member/#get-1-members-idmember-or-username-notifications
     */
    public function all(string $id, array $params = []): array
    {
        return $this->get($this->getPath($id), $params);
    }

    /**
     * Filter notifications related to a given member.
     *
     * @see https://trello.com/docs/api/member/#get-1-members-idmember-or-username-notifications-filter
     */
    public function filter(string $id, string $filter = 'all'): array
    {
        return $this->filters($id, [$filter]);
    }

    /**
     * Filter notifications related to a given member.
     *
     * @see https://trello.com/docs/api/member/#get-1-members-idmember-or-username-notifications-filter
     */
    public function filters(string $id, array $filters): array
    {
        $events = WebhookEvents::all();
        $events[] = 'all';

        $filters = $this->validateAllowedParameters($events, $filters, 'event');

        return $this->get($this->getPath($id).'/'.implode(',', $filters));
    }
}

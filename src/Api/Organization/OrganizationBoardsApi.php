<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Api\Organization;

use Semaio\TrelloApi\Api\AbstractApi;

class OrganizationBoardsApi extends AbstractApi
{
    protected string $path = 'organization/#id#/boards';

    /**
     * Get boards related to a given organization.
     *
     * @see https://trello.com/docs/api/organization/#get-1-organizations-idorganization-or-username-boards
     */
    public function all(string $id, array $params = []): array
    {
        return $this->get($this->getPath($id), $params);
    }

    /**
     * Filter boards related to a given organization.
     *
     * @see https://trello.com/docs/api/organization/#get-1-organizations-idorganization-or-username-boards-filter
     */
    public function filter(string $id, string $filter = 'all', array $params = []): array
    {
        return $this->filters($id, [$filter], $params);
    }

    /**
     * Filter boards related to a given organization.
     *
     * @see https://trello.com/docs/api/organization/#get-1-organizations-idorganization-or-username-boards-filter
     */
    public function filters(string $id, array $filters, array $params = []): array
    {
        $allowed = ['all', 'members', 'organization', 'public', 'open', 'closed', 'starred'];
        $filters = $this->validateAllowedParameters($allowed, $filters, 'filter');

        return $this->get($this->getPath($id).'/'.implode(',', $filters), $params);
    }
}

<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Api\Member;

use Semaio\TrelloApi\Api\AbstractApi;
use Semaio\TrelloApi\Api\OrganizationApi;

/**
 * @see https://trello.com/docs/api/member
 *
 * Fully implemented.
 */
class MemberOrganizationsApi extends AbstractApi
{
    protected $path = 'members/#id#/organizations';

    /**
     * Get organizations related to a given member.
     *
     * @see https://trello.com/docs/api/member/#get-1-members-idmember-or-username-organizations
     */
    public function all(string $id, array $params = []): array
    {
        return $this->get($this->getPath($id), $params);
    }

    /**
     * Filter organizations related to a given member.
     *
     * @see https://trello.com/docs/api/member/#get-1-members-idmember-or-username-organizations-filter
     */
    public function filter(string $id, string $filter = 'all', array $params = []): array
    {
        return $this->filters($id, [$filter], $params);
    }

    /**
     * Filter organizations related to a given member.
     *
     * @see https://trello.com/docs/api/member/#get-1-members-idmember-or-username-organizations-filter
     */
    public function filters(string $id, array $filters, array $params = []): array
    {
        $allowed = ['all', 'none', 'members', 'public'];
        $filters = $this->validateAllowedParameters($allowed, $filters, 'filter');

        return $this->get($this->getPath($id).'/'.implode(',', $filters), $params);
    }

    /**
     * Get organizations a given member is invited to.
     *
     * @see https://trello.com/docs/api/member/#get-1-members-idmember-or-username-organizationsinvited
     */
    public function invitedTo(string $id, array $params = []): array
    {
        return $this->get($this->getPath($id).'Invited', $params);
    }

    /**
     * Get a field of an organization a given member is invited to.
     *
     * @see https://trello.com/docs/api/member/#get-1-members-idmember-or-username-organizationsinvited-field
     */
    public function invitedToField(string $id, string $field): array
    {
        $this->validateAllowedParameter(OrganizationApi::$fields, $field, 'field');

        return $this->get($this->getPath($id).'Invited/'.rawurlencode($field));
    }
}

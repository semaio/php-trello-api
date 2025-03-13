<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Api;

use Semaio\TrelloApi\Api\Organization\OrganizationBoardsApi;

/**
 * @see https://trello.com/docs/api/organization
 *
 * Not implemented.
 */
class OrganizationApi extends AbstractApi
{
    /**
     * @see https://trello.com/docs/api/organization/#get-1-organizations-idorg-or-name-field
     */
    public static array $fields = [
        'name',
        'displayName',
        'desc',
        'descData',
        'idBoards',
        'invited',
        'invitations',
        'memberships',
        'prefs',
        'powerUps',
        'products',
        'billableMemberCount',
        'url',
        'website',
        'logoHash',
        'premiumFeatures',
    ];

    protected string $path = 'organizations';

    /**
     * Find an organization by id.
     *
     * @see https://trello.com/docs/api/organization/#get-1-organizations-idorg-or-name
     */
    public function show(string $id, array $params = []): array
    {
        return $this->get($this->getPath().'/'.rawurlencode($id), $params);
    }

    public function boards(): OrganizationBoardsApi
    {
        return new OrganizationBoardsApi($this->client);
    }
}

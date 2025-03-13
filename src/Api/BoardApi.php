<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Api;

use Semaio\TrelloApi\Api\Board\BoardActionsApi;
use Semaio\TrelloApi\Api\Board\BoardCardListsApi;
use Semaio\TrelloApi\Api\Board\BoardCardsApi;
use Semaio\TrelloApi\Api\Board\BoardChecklistsApi;
use Semaio\TrelloApi\Api\Board\BoardLabelsApi;
use Semaio\TrelloApi\Api\Board\BoardMembersApi;
use Semaio\TrelloApi\Api\Board\BoardMembershipsApi;
use Semaio\TrelloApi\Api\Board\BoardMyPreferencesApi;
use Semaio\TrelloApi\Api\Board\BoardPowerUpsApi;
use Semaio\TrelloApi\Api\Board\BoardPreferencesApi;

/**
 * @see https://trello.com/docs/api/board
 *
 * Not implemented:
 * - Board my preferences API @see Board\BoardMyPreferencesApi
 * - Board preferences API @see Board\BoardPreferencesApi
 * - Board power ups API @see Board\BoardPowerUpsApi
 * - Board memberships API @see Board\BoardMembershipsApi
 * - https://trello.com/docs/api/board/#post-1-boards-board-id-calendarkey-generate
 * - https://trello.com/docs/api/board/#post-1-boards-board-id-emailkey-generate
 */
class BoardApi extends AbstractApi
{
    /**
     * @see https://trello.com/docs/api/board/#get-1-boards-board-id-field
     */
    public static array $fields = [
        'name',
        'desc',
        'descData',
        'closed',
        'idOrganization',
        'invited',
        'pinned',
        'starred',
        'url',
        'prefs',
        'invitations',
        'memberships',
        'shortLink',
        'subscribed',
        'labelNames',
        'powerUps',
        'dateLastActivity',
        'dateLastView',
        'shortUrl',
    ];

    protected string $path = 'boards';

    /**
     * Find a board by id.
     *
     * @see https://trello.com/docs/api/board/#get-1-boards-board-id
     */
    public function show(string $id, array $params = []): array
    {
        return $this->get($this->getPath().'/'.rawurlencode($id), $params);
    }

    /**
     * Create a board.
     *
     * @see https://trello.com/docs/api/board/#post-1-boards
     *
     * @throws \Semaio\TrelloApi\Exception\MissingArgumentException
     */
    public function create(array $params = []): array
    {
        $this->validateRequiredParameters(['name'], $params);

        return $this->post($this->getPath(), $params);
    }

    /**
     * Update a board.
     *
     * @see https://trello.com/docs/api/board/#put-1-boards
     */
    public function update(string $id, array $params = []): array
    {
        return $this->put($this->getPath().'/'.rawurlencode($id), $params);
    }

    /**
     * Set a given board's name.
     *
     * @see https://trello.com/docs/api/board/#put-1-boards-board-id-name
     */
    public function setName(string $id, string $name): array
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/name', [
            'value' => $name,
        ]);
    }

    /**
     * Set a given board's description.
     *
     * @see https://trello.com/docs/api/board/#put-1-boards-board-id-desc
     */
    public function setDescription(string $id, string $description): array
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/desc', [
            'value' => $description,
        ]);
    }

    /**
     * Set a given board's state.
     *
     * @see https://trello.com/docs/api/board/#put-1-boards-board-id-closed
     */
    public function setClosed(string $id, bool $closed = true): array
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/closed', [
            'value' => $closed,
        ]);
    }

    /**
     * Set a given board's subscription state.
     *
     * @see https://trello.com/docs/api/board/#put-1-boards-board-id-subscribed
     */
    public function setSubscribed(string $id, bool $subscribed = true): array
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/subscribed', [
            'value' => $subscribed,
        ]);
    }

    /**
     * Set a given board's organization.
     *
     * @see https://trello.com/docs/api/board/#put-1-boards-board-id-organization
     */
    public function setOrganization(string $id, string $organizationId): array
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/idOrganization/'.rawurlencode($organizationId));
    }

    /**
     * Get a given board's organization.
     *
     * @see https://trello.com/docs/api/board/#get-1-boards-board-id-organization
     */
    public function getOrganization(string $id, array $params = []): array
    {
        return $this->get($this->getPath().'/'.rawurlencode($id).'/organization', $params);
    }

    /**
     * Get the field of the organization of a given board.
     *
     * @see https://trello.com/docs/api/board/#get-1-boards-board-id-organization-field
     */
    public function getOrganizationField(string $id, string $field): array
    {
        $this->validateAllowedParameter(OrganizationApi::$fields, $field, 'field');

        return $this->get($this->getPath().'/'.rawurlencode($id).'/organization/'.rawurlencode($field));
    }

    /**
     * Get a given board's stars.
     *
     * @see https://trello.com/docs/api/board/#get-1-boards-board-id-boardstars
     */
    public function getStars(string $id, array $params = []): array
    {
        return $this->get($this->getPath().'/'.rawurlencode($id).'/boardStars', $params);
    }

    /**
     * Get a given board's deltas.
     *
     * @see https://trello.com/docs/api/board/index.html#get-1-boards-board-id-deltas
     */
    public function getDeltas(string $id, array $params = []): array
    {
        return $this->get($this->getPath().'/'.rawurlencode($id).'/deltas', $params);
    }

    /**
     * Mark a given board as viewed.
     *
     * @see https://trello.com/docs/api/board/#post-1-boards-board-id-markasviewed
     */
    public function setViewed(string $id): array
    {
        return $this->post($this->getPath().'/'.rawurlencode($id).'/markAsViewed');
    }

    public function actions(): BoardActionsApi
    {
        return new BoardActionsApi($this->client);
    }

    public function lists(): BoardCardListsApi
    {
        return new BoardCardListsApi($this->client);
    }

    public function cards(): BoardCardsApi
    {
        return new BoardCardsApi($this->client);
    }

    public function checklists(): BoardChecklistsApi
    {
        return new BoardChecklistsApi($this->client);
    }

    public function labels(): BoardLabelsApi
    {
        return new BoardLabelsApi($this->client);
    }

    public function members(): BoardMembersApi
    {
        return new BoardMembersApi($this->client);
    }

    public function memberships(): BoardMembershipsApi
    {
        return new BoardMembershipsApi($this->client);
    }

    public function preferences(): BoardPreferencesApi
    {
        return new BoardPreferencesApi($this->client);
    }

    public function myPreferences(): BoardMyPreferencesApi
    {
        return new BoardMyPreferencesApi($this->client);
    }

    public function powerUps(): BoardPowerUpsApi
    {
        return new BoardPowerUpsApi($this->client);
    }
}

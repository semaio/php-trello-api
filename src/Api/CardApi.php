<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Api;

use Semaio\TrelloApi\Api\Card\CardActionsApi;
use Semaio\TrelloApi\Api\Card\CardAttachmentsApi;
use Semaio\TrelloApi\Api\Card\CardChecklistsApi;
use Semaio\TrelloApi\Api\Card\CardLabelsApi;
use Semaio\TrelloApi\Api\Card\CardMembersApi;
use Semaio\TrelloApi\Api\Card\CardStickersApi;

/**
 * @see https://trello.com/docs/api/card
 *
 * Unimplemented:
 * - https://trello.com/docs/api/card/#put-1-cards-card-id-or-shortlink-checklist-idchecklist-checkitem-idcheckitem-name
 * - https://trello.com/docs/api/card/#put-1-cards-card-id-or-shortlink-checklist-idchecklist-checkitem-idcheckitem-pos
 * - https://trello.com/docs/api/card/#put-1-cards-card-id-or-shortlink-checklist-idchecklist-checkitem-idcheckitem-state
 * - https://trello.com/docs/api/card/#put-1-cards-card-id-or-shortlink-checklist-idchecklistcurrent-checkitem-idcheckitem
 * - https://trello.com/docs/api/card/#post-1-cards-card-id-or-shortlink-checklist-idchecklist-checkitem
 * - https://trello.com/docs/api/card/#post-1-cards-card-id-or-shortlink-checklist-idchecklist-checkitem-idcheckitem-converttocard
 * - https://trello.com/docs/api/card/#post-1-cards-card-id-or-shortlink-markassociatednotificationsread
 */
class CardApi extends AbstractApi
{
    /**
     * @see https://trello.com/docs/api/card/#get-1-cards-card-id-or-shortlink-field
     */
    public static $fields = [
        'badges',
        'checkItemStates',
        'closed',
        'dateLastActivity',
        'desc',
        'descData',
        'due',
        'email',
        'idBoard',
        'idChecklists',
        'idList',
        'idMembers',
        'idMembersVoted',
        'idShort',
        'idAttachmentCover',
        'manualCoverAttachment',
        'labels',
        'name',
        'pos',
        'shortLink',
        'shortUrl',
        'subscribed',
        'url',
    ];

    protected $path = 'cards';

    /**
     * Find a card by id.
     *
     * @see https://trello.com/docs/api/card/#get-1-cards-card-id-or-shortlink
     */
    public function show(string $id, array $params = []): array
    {
        return $this->get($this->getPath().'/'.rawurlencode($id), $params);
    }

    /**
     * Create a card.
     *
     * @see https://trello.com/docs/api/card/#post-1-cards
     */
    public function create(array $params = []): array
    {
        $this->validateRequiredParameters(['idList', 'name'], $params);

        if (!array_key_exists('due', $params)) {
            $params['due'] = null;
        }
        if (!array_key_exists('urlSource', $params)) {
            $params['urlSource'] = null;
        }

        return $this->post($this->getPath(), $params);
    }

    /**
     * Update a card.
     *
     * @see https://trello.com/docs/api/card/#put-1-cards
     */
    public function update(string $id, array $params = []): array
    {
        return $this->put($this->getPath().'/'.rawurlencode($id), $params);
    }

    /**
     * Set a given card's board.
     *
     * @see https://trello.com/docs/api/card/#put-1-cards-card-id-or-shortlink-idboard
     */
    public function setBoard(string $id, string $boardId): array
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/idBoard', ['value' => $boardId]);
    }

    /**
     * Get a given card's board.
     *
     * @see https://trello.com/docs/api/card/#put-1-cards-card-id-or-shortlink-idboard
     */
    public function getBoard(string $id, array $params = []): array
    {
        return $this->get($this->getPath().'/'.rawurlencode($id).'/board', $params);
    }

    /**
     * Get the field of a board of a given card.
     *
     * @see https://trello.com/docs/api/card/#get-1-cards-card-id-or-shortlink-board-field
     */
    public function getBoardField(string $id, string $field): array
    {
        $this->validateAllowedParameter(BoardApi::$fields, $field, 'field');

        return $this->get($this->getPath().'/'.rawurlencode($id).'/board/'.rawurlencode($field));
    }

    /**
     * Set a given card's list.
     *
     * @see https://trello.com/docs/api/card/#put-1-cards-card-id-or-shortlink-idlist
     */
    public function setList(string $id, string $listId): array
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/idList', ['value' => $listId]);
    }

    /**
     * Get a given card's list.
     *
     * @see https://trello.com/docs/api/card/#get-1-cards-card-id-or-shortlink-list
     */
    public function getList(string $id, array $params = []): array
    {
        return $this->get($this->getPath().'/'.rawurlencode($id).'/list', $params);
    }

    /**
     * Get the field of a list of a given card.
     *
     * @see https://trello.com/docs/api/card/#get-1-cards-card-id-or-shortlink-list-field
     */
    public function getListField(string $id, string $field): array
    {
        $this->validateAllowedParameter(CardListApi::$fields, $field, 'field');

        return $this->get($this->getPath().'/'.rawurlencode($id).'/list/'.rawurlencode($field));
    }

    /**
     * Set a given card's name.
     *
     * @see https://trello.com/docs/api/card/#put-1-cards-card-id-name
     */
    public function setName(string $id, string $name): array
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/name', ['value' => $name]);
    }

    /**
     * Set a given card's description.
     *
     * @see https://trello.com/docs/api/card/#put-1-cards-card-id-desc
     */
    public function setDescription(string $id, string $description): array
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/desc', ['value' => $description]);
    }

    /**
     * Set a given card's state.
     *
     * @see https://trello.com/docs/api/card/#put-1-cards-card-id-closed
     */
    public function setClosed(string $id, bool $closed = true): array
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/closed', ['value' => $closed]);
    }

    /**
     * Set a given card's due date.
     *
     * @see https://trello.com/docs/api/card/#put-1-cards-card-id-or-shortlink-due
     */
    public function setDueDate(string $id, \DateTime $date): array
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/due', ['value' => $date]);
    }

    /**
     * Set a given card's position.
     *
     * @see https://trello.com/docs/api/card/#put-1-cards-card-id-or-shortlink-pos
     */
    public function setPosition(string $id, string $position): array
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/pos', ['value' => $position]);
    }

    /**
     * Set a given card's position.
     *
     * @see https://trello.com/docs/api/card/#put-1-cards-card-id-or-shortlink-pos
     */
    public function setPositionNumber(string $id, int $position): array
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/pos', ['value' => $position]);
    }

    /**
     * Set a given card's subscription state.
     *
     * @see https://trello.com/docs/api/card/#put-1-cards-card-id-or-shortlink-subscribed
     */
    public function setSubscribed(string $id, bool $subscribed): array
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/subscribed', ['value' => $subscribed]);
    }

    public function actions(): CardActionsApi
    {
        return new CardActionsApi($this->client);
    }

    public function attachments(): CardAttachmentsApi
    {
        return new CardAttachmentsApi($this->client);
    }

    public function checklists(): CardChecklistsApi
    {
        return new CardChecklistsApi($this->client);
    }

    public function labels(): CardLabelsApi
    {
        return new CardLabelsApi($this->client);
    }

    public function members(): CardMembersApi
    {
        return new CardMembersApi($this->client);
    }

    public function stickers(): CardStickersApi
    {
        return new CardStickersApi($this->client);
    }
}

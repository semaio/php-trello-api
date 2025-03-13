<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Api;

use Semaio\TrelloApi\Api\CardList\CardListActionsApi;
use Semaio\TrelloApi\Api\CardList\CardListCardsApi;

/**
 * @see https://trello.com/docs/api/list
 *
 * Fully implemented.
 */
class CardListApi extends AbstractApi
{
    /**
     * @see https://trello.com/docs/api/list/#get-1-lists-list-id-or-shortlink-field
     */
    public static array $fields = [
        'name',
        'closed',
        'idBoard',
        'pos',
        'subscribed',
    ];

    protected string $path = 'lists';

    /**
     * Find a list by id.
     *
     * @see https://trello.com/docs/api/list/#get-1-lists-idlist
     */
    public function show(string $id, array $params = []): array
    {
        return $this->get($this->getPath().'/'.rawurlencode($id), $params);
    }

    /**
     * Create a list.
     *
     * @see https://trello.com/docs/api/list/#post-1-lists
     *
     * @throws \Semaio\TrelloApi\Exception\MissingArgumentException
     */
    public function create(array $params = []): array
    {
        $this->validateRequiredParameters(['name', 'idBoard'], $params);

        return $this->post($this->getPath(), $params);
    }

    /**
     * Update a list.
     *
     * @see https://trello.com/docs/api/list/#put-1-lists-idlist
     */
    public function update(string $id, array $params = []): array
    {
        return $this->put($this->getPath().'/'.rawurlencode($id), $params);
    }

    /**
     * Set a given list's board.
     *
     * @see https://trello.com/docs/api/list/#put-1-lists-idlist-idboard
     */
    public function setBoard(string $id, string $boardId): array
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/idBoard', [
            'value' => $boardId,
        ]);
    }

    /**
     * Get a given list's board.
     *
     * @see https://trello.com/docs/api/list/#get-1-lists-idlist-board
     */
    public function getBoard(string $id, array $params = []): array
    {
        return $this->get($this->getPath().'/'.rawurlencode($id).'/board', $params);
    }

    /**
     * Get the field of a board of a given list.
     *
     * @see https://trello.com/docs/api/list/#get-1-lists-idlist-board-field
     */
    public function getBoardField(string $id, string $field): array
    {
        $this->validateAllowedParameter(BoardApi::$fields, $field, 'field');

        return $this->get($this->getPath().'/'.rawurlencode($id).'/board/'.rawurlencode($field));
    }

    /**
     * Set a given list's name.
     *
     * @see https://trello.com/docs/api/list/#put-1-lists-idlist-name
     */
    public function setName(string $id, string $name): array
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/name', [
            'value' => $name,
        ]);
    }

    /**
     * Set a given list's description.
     *
     * @see https://trello.com/docs/api/list/#put-1-lists-list-id-desc
     */
    public function setSubscribed(string $id, bool $subscribed): array
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/subscribed', [
            'value' => $subscribed,
        ]);
    }

    /**
     * Set a given list's state.
     *
     * @see https://trello.com/docs/api/list/#put-1-lists-idlist-closed
     */
    public function setClosed(string $id, bool $closed = true): array
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/closed', [
            'value' => $closed,
        ]);
    }

    /**
     * Set a given list's position.
     *
     * @see https://trello.com/docs/api/list/#put-1-lists-idlist-pos
     */
    public function setPosition(string $id, string $position): array
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/pos', [
            'value' => $position,
        ]);
    }

    /**
     * Set a given list's position.
     *
     * @see https://trello.com/docs/api/list/#put-1-lists-idlist-pos
     */
    public function setPositionNumber(string $id, int $position): array
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/pos', [
            'value' => $position,
        ]);
    }

    public function actions(): CardListActionsApi
    {
        return new CardListActionsApi($this->client);
    }

    public function cards(): CardListCardsApi
    {
        return new CardListCardsApi($this->client);
    }
}

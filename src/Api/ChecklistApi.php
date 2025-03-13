<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Api;

use Semaio\TrelloApi\Api\Checklist\ChecklistCardsApi;
use Semaio\TrelloApi\Api\Checklist\ChecklistItemsApi;

/**
 * @see https://trello.com/docs/api/checklist
 *
 * Fully implemented.
 */
class ChecklistApi extends AbstractApi
{
    /**
     * @see https://trello.com/docs/api/list/#get-1-lists-list-id-or-shortlink-field
     */
    public static array $fields = [
        'name',
        'idBoard',
        'idCard',
        'pos',
    ];

    protected string $path = 'checklists';

    /**
     * Find a list by id.
     *
     * @see https://trello.com/docs/api/checklist/#get-1-checklists-idchecklist
     */
    public function show(string $id, array $params = []): array
    {
        return $this->get($this->getPath().'/'.rawurlencode($id), $params);
    }

    /**
     * Create a checklist.
     *
     * @see https://trello.com/docs/api/checklist/#post-1-checklists
     *
     * @throws \Semaio\TrelloApi\Exception\MissingArgumentException
     */
    public function create(array $params = []): array
    {
        $this->validateRequiredParameters(['name', 'idCard'], $params);

        return $this->post($this->getPath(), $params);
    }

    /**
     * Update a checklist.
     *
     * @see https://trello.com/docs/api/checklist/#put-1-checklists-idchecklist
     */
    public function update(string $id, array $params = []): array
    {
        return $this->put($this->getPath().'/'.rawurlencode($id), $params);
    }

    /**
     * Remove a checklist.
     *
     * @see https://trello.com/docs/api/checklist/#delete-1-checklists-idchecklist
     */
    public function remove(string $id): array
    {
        return $this->delete($this->getPath().'/'.rawurlencode($id));
    }

    /**
     * Get the board of a given checklist.
     *
     * @see https://trello.com/docs/api/checklist/#get-1-checklists-idchecklist-board
     */
    public function getBoard(string $id, array $params = []): array
    {
        return $this->get($this->getPath().'/'.rawurlencode($id).'/board', $params);
    }

    /**
     * Get the field of a board of a given checklist.
     *
     * @see https://trello.com/docs/api/checklist/#get-1-checklists-idchecklist-board-field
     */
    public function getBoardField(string $id, string $field): array
    {
        $this->validateAllowedParameter(BoardApi::$fields, $field, 'field');

        return $this->get($this->getPath().'/'.rawurlencode($id).'/board/'.rawurlencode($field));
    }

    /**
     * Set a given checklist's card.
     *
     * @see https://trello.com/docs/api/checklist/#put-1-checklists-idchecklist-idcard
     */
    public function setCard(string $id, string $cardId): array
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/idCard', [
            'value' => $cardId,
        ]);
    }

    /**
     * Set a given checklist's name.
     *
     * @see https://trello.com/docs/api/checklist/#put-1-checklists-idchecklist-name
     */
    public function setName(string $id, string $name): array
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/name', [
            'value' => $name,
        ]);
    }

    /**
     * Set a given checklist's position.
     *
     * @see https://trello.com/docs/api/checklist/#put-1-checklists-idchecklist-pos
     */
    public function setPosition(string $id, string $position): array
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/pos', [
            'value' => $position,
        ]);
    }

    /**
     * Set a given checklist's position.
     *
     * @see https://trello.com/docs/api/checklist/#put-1-checklists-idchecklist-pos
     */
    public function setPositionNumber(string $id, int $position): array
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/pos', [
            'value' => $position,
        ]);
    }

    public function cards(): ChecklistCardsApi
    {
        return new ChecklistCardsApi($this->client);
    }

    public function items(): ChecklistItemsApi
    {
        return new ChecklistItemsApi($this->client);
    }
}

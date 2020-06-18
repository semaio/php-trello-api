<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Api\Card;

use Semaio\TrelloApi\Api\AbstractApi;

/**
 * @see https://trello.com/docs/api/card
 *
 * Fully implemented.
 */
class CardChecklistsApi extends AbstractApi
{
    protected $path = 'cards/#id#/checklists';

    /**
     * Get checklists related to a given card.
     *
     * @see https://trello.com/docs/api/card/#get-1-cards-card-id-or-shortlink-checklists
     */
    public function all(string $id, array $params = []): array
    {
        return $this->get('cards/'.rawurlencode($id).'/checklists', $params);
    }

    /**
     * Add a checklist to a given card.
     *
     * @see https://trello.com/docs/api/card/#post-1-cards-card-id-or-shortlink-checklists
     */
    public function create(string $id, array $params): array
    {
        $atLeastOneOf = ['value', 'name', 'idChecklistSource'];
        $this->validateAtLeastOneOf($atLeastOneOf, $params);

        return $this->post($this->getPath($id), $params);
    }

    /**
     * Remove a given checklist from a given card.
     *
     * @see https://trello.com/docs/api/card/#delete-1-cards-card-id-or-shortlink-checklists-idchecklist
     */
    public function remove(string $id, string $checklistId): array
    {
        return $this->delete($this->getPath($id).'/'.rawurlencode($checklistId));
    }

    /**
     * Get a given card's checklist item states.
     *
     * @see https://trello.com/docs/api/card/#get-1-cards-card-id-or-shortlink-checkitemstates
     */
    public function itemStates(string $id, array $params = []): array
    {
        return $this->get('cards/'.rawurlencode($id).'/checkItemStates', $params);
    }

    /**
     * Update a given check item.
     *
     * @see https://trello.com/docs/api/card/#put-1-cards-card-id-or-shortlink-checklist-idchecklistcurrent-checkitem-idcheckitem
     */
    public function updateItem(string $id, string $checklistId, string $checkItemId, array $data): array
    {
        return $this->put(
            $this->getPath($id).'/'.rawurlencode($checklistId).'/checkItem/'.rawurlencode($checkItemId),
            $data
        );
    }

    /**
     * Create a check item.
     *
     * @see https://trello.com/docs/api/card/#post-1-cards-card-id-or-shortlink-checklist-idchecklist-checkitem
     */
    public function createItem(string $id, string $checklistId, string $name, array $data = []): array
    {
        $data['idChecklist'] = $checklistId;
        $data['name'] = $name;

        return $this->post($this->getPath($id).'/'.rawurlencode($checklistId).'/checkItem', $data);
    }

    /**
     * Convert a check item to card.
     *
     * @see https://trello.com/docs/api/card/#post-1-cards-card-id-or-shortlink-checklist-idchecklist-checkitem
     */
    public function convertItemToCard(string $id, string $checklistId, string $checkItemId): array
    {
        return $this->post(
            $this->getPath($id).'/'.rawurlencode($checklistId).'/checkItem/'.rawurlencode($checkItemId).'/convertToCard'
        );
    }

    /**
     * Remove a check item from card.
     *
     * @see https://trello.com/docs/api/card/#post-1-cards-card-id-or-shortlink-checklist-idchecklist-checkitem
     */
    public function removeItem(string $id, string $checklistId, string $checkItemId): array
    {
        return $this->delete(
            $this->getPath($id).'/'.rawurlencode($checklistId).'/checkItem/'.rawurlencode($checkItemId)
        );
    }
}

<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Api\CardList;

use Semaio\TrelloApi\Api\AbstractApi;

/**
 * @see https://trello.com/docs/api/list
 *
 * Fully implemented.
 */
class CardListCardsApi extends AbstractApi
{
    protected $path = 'lists/#id#/cards';

    /**
     * Get cards related to a given list.
     *
     * @see https://trello.com/docs/api/list/#get-1-lists-idlist-cards
     */
    public function all(string $id, array $params = []): array
    {
        return $this->get($this->getPath($id), $params);
    }

    /**
     * Filter cards related to a given list.
     *
     * @see https://trello.com/docs/api/list/#get-1-lists-idlist-cards-filter
     */
    public function filter(string $id, string $filter = 'all'): array
    {
        return $this->filters($id, [$filter]);
    }

    /**
     * Filter cards related to a given list.
     *
     * @see https://trello.com/docs/api/list/#get-1-lists-idlist-cards-filter
     */
    public function filters(string $id, array $filters): array
    {
        $allowed = ['none', 'open', 'closed', 'all'];
        $filters = $this->validateAllowedParameters($allowed, $filters, 'filter');

        return $this->get($this->getPath($id).'/'.implode(',', $filters));
    }

    /**
     * Create a card.
     *
     * @see https://trello.com/docs/api/list/#post-1-lists-idlist-cards
     */
    public function create(string $id, string $name, array $params = []): array
    {
        $params['idList'] = $id;
        $params['name'] = $name;

        if (!array_key_exists('due', $params)) {
            $params['due'] = null;
        }

        return $this->post($this->getPath($id), $params);
    }

    /**
     * Archive all cards of a given list.
     *
     * @see https://trello.com/docs/api/list/#post-1-lists-idlist-archiveallcards
     */
    public function archiveAll(string $id): array
    {
        return $this->post('lists/'.rawurlencode($id).'/archiveAllCards');
    }

    /**
     * Move all cards of a given list to another list.
     *
     * @see https://trello.com/docs/api/list/#post-1-lists-idlist-moveallcards
     */
    public function moveAll(string $id, string $boardId, string $destListId): array
    {
        $data = ['idBoard' => $boardId, 'idList' => $destListId];

        return $this->post('lists/'.rawurlencode($id).'/moveAllCards', $data);
    }
}

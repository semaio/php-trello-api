<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Api\Checklist;

use Semaio\TrelloApi\Api\AbstractApi;

/**
 * @see https://trello.com/docs/api/checklist
 *
 * Fully implemented.
 */
class ChecklistCardsApi extends AbstractApi
{
    protected $path = 'checklists/#id#/cards';

    /**
     * Get cards related to a given checklist.
     *
     * @see https://trello.com/docs/api/checklist/#get-1-checklists-idchecklist-cards
     */
    public function all(string $id, array $params = []): array
    {
        return $this->get($this->getPath($id), $params);
    }

    /**
     * Filter cards related to a given checklist.
     *
     * @see https://trello.com/docs/api/checklist/#get-1-checklists-idchecklist-cards-filter
     */
    public function filter(string $id, string $filter = 'all', array $params = []): array
    {
        return $this->filters($id, [$filter], $params);
    }

    /**
     * Filter cards related to a given checklist.
     *
     * @see https://trello.com/docs/api/checklist/#get-1-checklists-idchecklist-cards-filter
     */
    public function filters(string $id, array $filters, array $params = []): array
    {
        $allowed = ['none', 'open', 'closed', 'all'];
        $filters = $this->validateAllowedParameters($allowed, $filters, 'filter');

        return $this->get($this->getPath($id).'/'.implode(',', $filters), $params);
    }
}

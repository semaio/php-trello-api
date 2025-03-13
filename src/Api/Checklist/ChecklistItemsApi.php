<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Api\Checklist;

use Semaio\TrelloApi\Api\AbstractApi;

/**
 * @see https://trello.com/docs/api/checklist
 *
 * Fully implemented.
 */
class ChecklistItemsApi extends AbstractApi
{
    public static array $fields = [
        'name',
        'nameData',
        'type',
        'pos',
        'state',
    ];

    protected string $path = 'checklists/#id#/checkItems';

    /**
     * Get items related to a given checklist.
     *
     * @see https://trello.com/docs/api/checklist/#get-1-checklists-idchecklist-checkitems
     */
    public function all(string $id, array $params = []): array
    {
        return $this->get($this->getPath($id), $params);
    }

    /**
     * Create an item in the given checklist.
     *
     * @see https://trello.com/docs/api/checklist/#post-1-checklists-idchecklist-checkitems
     */
    public function create(string $id, string $name, array $data = [], bool $isChecked = false): array
    {
        $data['checked'] = $isChecked;
        $data['name'] = $name;

        return $this->post($this->getPath($id), $data);
    }

    /**
     * Update an item in the given checklist.
     *
     * TODO: There is no put method on checklist items, so this is a dirty workaround which works by deleting the item and recreating it.
     *
     * @throws \Semaio\TrelloApi\Exception\MissingArgumentException
     */
    public function update(string $id, string $itemId, array $data, bool $isChecked = false): array
    {
        $this->validateRequiredParameters(['name', 'state'], $data);

        $this->remove($id, $itemId);

        return $this->create($id, $data['name'], $data, $isChecked);
    }

    /**
     * Remove an item from checklist.
     *
     * @see https://trello.com/docs/api/checklist/#delete-1-checklists-idchecklist-checkitems-idcheckitem
     */
    public function remove(string $id, string $itemId): array
    {
        return $this->delete($this->getPath($id).'/'.rawurlencode($itemId));
    }
}

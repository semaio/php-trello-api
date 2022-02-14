<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Api\Card;

use Semaio\TrelloApi\Api\AbstractApi;
use Semaio\TrelloApi\Exception\InvalidArgumentException;

/**
 * @see https://trello.com/docs/api/card
 *
 * Fully implemented.
 */
class CardLabelsApi extends AbstractApi
{
    protected $path = 'cards/#id#/labels';

    /**
     * Set a given card's labels.
     *
     * @see https://trello.com/docs/api/card/#put-1-cards-card-id-or-shortlink-labels
     */
    public function set(string $id, array $labels): array
    {
        foreach ($labels as $label) {
            if (!in_array($label, ['all', 'green', 'yellow', 'orange', 'red', 'purple', 'blue'], true)) {
                throw new InvalidArgumentException(sprintf('Label "%s" does not exist.', $label));
            }
        }

        return $this->put($this->getPath($id), [
            'value' => implode(',', $labels),
        ]);
    }

    /**
     * Remove a given label from a given card.
     *
     * @see https://trello.com/docs/api/card/#delete-1-cards-card-id-or-shortlink-labels-color
     */
    public function remove(string $id, string $label): array
    {
        if (!in_array($label, ['green', 'yellow', 'orange', 'red', 'purple', 'blue'], true)) {
            throw new InvalidArgumentException(sprintf('Label "%s" does not exist.', $label));
        }

        return $this->delete($this->getPath($id).'/'.rawurlencode($label));
    }
}

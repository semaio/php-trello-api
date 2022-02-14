<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Api\Card;

use Semaio\TrelloApi\Api\AbstractApi;

/**
 * @see https://trello.com/docs/api/card
 *
 * Fully implemented.
 */
class CardActionsApi extends AbstractApi
{
    protected $path = 'cards/#id#/actions';

    /**
     * Get actions related to a given card.
     *
     * @see https://trello.com/docs/api/card/#get-1-cards-card-id-or-shortlink-actions
     */
    public function all(string $id, array $params = []): array
    {
        return $this->get($this->getPath($id), $params);
    }

    /**
     * Add comment to a given card.
     *
     * @see https://trello.com/docs/api/card/#post-1-cards-card-id-or-shortlink-actions-comments
     */
    public function addComment(string $id, string $text): array
    {
        return $this->post($this->getPath($id).'/comments', [
            'text' => $text,
        ]);
    }

    /**
     * Remove comment to a given card.
     *
     * @see https://trello.com/docs/api/card/#delete-1-cards-card-id-or-shortlink-actions-idaction-comments
     */
    public function removeComment(string $id, string $commentId): array
    {
        return $this->delete($this->getPath($id).'/'.rawurlencode($commentId).'/comments');
    }
}

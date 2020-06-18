<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Api\Card;

use Semaio\TrelloApi\Api\AbstractApi;

/**
 * @see https://trello.com/docs/api/card
 *
 * Fully implemented.
 */
class CardStickersApi extends AbstractApi
{
    protected $path = 'cards/#id#/stickers';

    /**
     * Get stickers related to a given card.
     *
     * @see https://trello.com/docs/api/card/#get-1-cards-card-id-or-shortlink-stickers
     */
    public function all(string $id, array $params = []): array
    {
        return $this->get($this->getPath($id), $params);
    }

    /**
     * Get a given sticker on a given card.
     *
     * @see https://trello.com/docs/api/card/#get-1-cards-card-id-or-shortlink-stickers-idsticker
     */
    public function show(string $id, string $stickerId, string $fields = 'all'): array
    {
        $allowed = ['all', 'image', 'imageScaled', 'imageUrl', 'left', 'rotate', 'top', 'zIndex'];
        $fields = $this->validateAllowedParameter($allowed, $fields, 'field');

        return $this->get($this->getPath($id).'/'.rawurlencode($stickerId), $fields);
    }

    /**
     * Update a given sticker on a given card.
     *
     * @see https://trello.com/docs/api/card/#put-1-cards-card-id-or-shortlink-stickers-idsticker
     */
    public function update(string $id, string $stickerId, array $params): array
    {
        $oneOf = ['left', 'rotate', 'top', 'zIndex'];
        $this->validateAtLeastOneOf($oneOf, $params);

        return $this->put($this->getPath($id).'/'.rawurlencode($stickerId), $params);
    }

    /**
     * Create a given sticker on a given card.
     *
     * @see https://trello.com/docs/api/card/#put-1-cards-card-id-or-shortlink-stickers-idsticker
     */
    public function create(string $id, array $params): array
    {
        $required = ['image', 'left', 'top', 'zIndex'];
        $this->validateRequiredParameters($required, $params);

        return $this->post($this->getPath($id), $params);
    }

    /**
     * Remove a given sticker from a given card.
     *
     * @see https://trello.com/docs/api/card/#delete-1-cards-card-id-or-shortlink-stickers-idsticker
     */
    public function remove(string $id, string $stickerId): array
    {
        return $this->delete($this->getPath($id).'/'.rawurlencode($stickerId));
    }
}

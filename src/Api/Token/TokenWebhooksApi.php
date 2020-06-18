<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Api\Token;

use Semaio\TrelloApi\Api\AbstractApi;

/**
 * @see https://trello.com/docs/api/token
 *
 * Fully implemented.
 */
class TokenWebhooksApi extends AbstractApi
{
    protected $path = 'tokens/#id#/webhooks';

    /**
     * Get webhooks related to a given token.
     *
     * @see https://trello.com/docs/api/token/#get-1-tokens-token-webhooks
     */
    public function all(string $id, array $data = []): array
    {
        return $this->get($this->getPath($id), $data);
    }

    /**
     * Get a webhook.
     *
     * @see https://trello.com/docs/api/token/#get-1-tokens-token-webhooks-idwebhook
     */
    public function show(string $id, string $webhookId): array
    {
        return $this->get($this->getPath($id).'/'.rawurlencode($webhookId));
    }

    /**
     * Create a webhook.
     *
     * @see https://trello.com/docs/api/token/#post-1-tokens-token-webhooks
     */
    public function create(string $id, array $data): array
    {
        $this->validateRequiredParameters(['callbackURL', 'idModel'], $data);

        return $this->post($this->getPath($id), $data);
    }

    /**
     * Update a webhook.
     *
     * @see https://trello.com/docs/api/token/#put-1-tokens-token-webhooks
     */
    public function update(string $id, array $data): array
    {
        $this->validateRequiredParameters(['callbackURL', 'idModel'], $data);

        return $this->put($this->getPath($id), $data);
    }

    /**
     * Remove a webhook.
     *
     * @see https://trello.com/docs/api/token/#delete-1-tokens-token-webhooks-idwebhook
     */
    public function remove(string $id, string $webhookId): array
    {
        return $this->delete($this->getPath($id).'/'.rawurlencode($webhookId));
    }
}

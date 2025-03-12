<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Api;

use Semaio\TrelloApi\Api\Token\TokenWebhooksApi;

/**
 * @see https://trello.com/docs/api/token
 *
 * Fully implemented.
 */
class TokenApi extends AbstractApi
{
    /**
     * @see https://trello.com/docs/api/token/#get-1-tokens-token-field
     */
    public static array $fields = [
        'identifier',
        'idMember',
        'dateCreated',
        'dateExpires',
        'permissions',
    ];

    protected string $path = 'tokens';

    /**
     * Find a token by id.
     *
     * @see https://trello.com/docs/api/token/#get-1-tokens-idtoken
     */
    public function show(string $id, array $params = []): array
    {
        return $this->get($this->getPath().'/'.rawurlencode($id), $params);
    }

    /**
     * Remove a token.
     *
     * @see https://trello.com/docs/api/token/#delete-1-tokens-idtoken
     */
    public function remove(string $id): array
    {
        return $this->delete($this->getPath().'/'.rawurlencode($id));
    }

    /**
     * Get a given token's member.
     *
     * @see https://trello.com/docs/api/token/#get-1-tokens-token-member
     */
    public function getMember(string $id, array $params = []): array
    {
        return $this->get($this->getPath().'/'.rawurlencode($id).'/member', $params);
    }

    /**
     * Get a given token's member's field.
     *
     * @see https://trello.com/docs/api/token/#get-1-tokens-token-member-field
     */
    public function getMemberField(string $id, string $field): array
    {
        $this->validateAllowedParameter(MemberApi::$fields, $field, 'field');

        return $this->get($this->getPath().'/'.rawurlencode($id).'/member/'.rawurlencode($field));
    }

    public function webhooks(): TokenWebhooksApi
    {
        return new TokenWebhooksApi($this->client);
    }
}

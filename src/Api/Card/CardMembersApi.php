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
class CardMembersApi extends AbstractApi
{
    protected string $path = 'cards/#id#/members';

    /**
     * Get members related to a given card.
     *
     * @see https://trello.com/docs/api/card/#get-1-cards-card-id-or-shortlink-members
     */
    public function all(string $id, array $params = []): array
    {
        return $this->get($this->getPath($id), $params);
    }

    /**
     * Set members of a given card.
     *
     * @see https://trello.com/docs/api/card/#put-1-cards-card-id-or-shortlink-idmembers
     */
    public function set(string $id, array $members): array
    {
        if (!count($members)) {
            throw new InvalidArgumentException('You must specify at least one member id.');
        }

        return $this->put($this->getPath($id), [
            'value' => implode(',', $members),
        ]);
    }

    /**
     * Add a member to a given card.
     *
     * @see https://trello.com/docs/api/card/#post-1-cards-card-id-or-shortlink-idmembers
     */
    public function add(string $id, string $memberId): array
    {
        return $this->post($this->getPath($id), [
            'value' => $memberId,
        ]);
    }

    /**
     * Remove a given member from a given card.
     *
     * @see https://trello.com/docs/api/card/#delete-1-cards-card-id-or-shortlink-idmembers-idmember
     */
    public function remove(string $id, string $memberId): array
    {
        return $this->delete($this->getPath($id).'/'.rawurlencode($memberId));
    }

    /**
     * Add a given member's vote to a given card.
     *
     * @see https://trello.com/docs/api/card/#post-1-cards-card-id-or-shortlink-membersvoted
     */
    public function addVote(string $id, string $memberId): array
    {
        return $this->post($this->getPath($id).'/membersVoted', [
            'value' => $memberId,
        ]);
    }

    /**
     * Remove a given member's vote from a given card.
     *
     * @see https://trello.com/docs/api/card/#delete-1-cards-card-id-or-shortlink-membersvoted-idmember
     */
    public function removeVote(string $id, string $memberId): array
    {
        return $this->delete($this->getPath($id).'/membersVoted/'.rawurlencode($memberId));
    }
}

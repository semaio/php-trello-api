<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Api\Card;

use Semaio\TrelloApi\Api\AbstractApi;

/**
 * @see https://trello.com/docs/api/card
 *
 * Fully implemented.
 */
class CardAttachmentsApi extends AbstractApi
{
    protected string $path = 'cards/#id#/attachments';

    /**
     * Get attachments related to a given card.
     *
     * @see https://trello.com/docs/api/card/#get-1-cards-card-id-or-shortlink-attachments
     */
    public function all(string $id, array $params = []): array
    {
        return $this->get($this->getPath($id), $params);
    }

    /**
     * Add an attachment to a given card.
     *
     * @see https://trello.com/docs/api/card/#post-1-cards-card-id-or-shortlink-attachments
     *
     * @throws \Semaio\TrelloApi\Exception\MissingArgumentException
     */
    public function create(string $id, array $params): array
    {
        $atLeastOneOf = ['url', 'file'];
        $this->validateAtLeastOneOf($atLeastOneOf, $params);

        return $this->post($this->getPath($id), $params);
    }

    /**
     * Get a given attachment on a given card.
     *
     * @see https://trello.com/docs/api/card/#get-1-cards-card-id-or-shortlink-attachments-idattachment
     */
    public function show(string $id, string $attachmentId): array
    {
        return $this->get($this->getPath($id).'/'.rawurlencode($attachmentId));
    }

    /**
     * Remove a given attachment from a given card.
     *
     * @see https://trello.com/docs/api/card/#delete-1-cards-card-id-or-shortlink-attachments-idattachment
     */
    public function remove(string $id, string $attachmentId): array
    {
        return $this->delete($this->getPath($id).'/'.rawurlencode($attachmentId));
    }

    /**
     * Set a given attachment as cover of a given card.
     *
     * @see https://trello.com/docs/api/card/#put-1-cards-card-id-or-shortlink-idattachmentcover
     */
    public function setAsCover(string $id, string $attachmentId): array
    {
        return $this->put('cards/'.rawurlencode($id).'/idAttachmentCover', [
            'value' => $attachmentId,
        ]);
    }
}

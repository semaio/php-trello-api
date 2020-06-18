<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Api;

/**
 * @see https://trello.com/docs/api/notification
 *
 * Fully implemented.
 */
class NotificationApi extends AbstractApi
{
    /**
     * Notification fields.
     *
     * @see https://trello.com/docs/api/notification/#get-1-notifications-idnotification-field
     */
    public static $fields = [
        'unread',
        'type',
        'date',
        'data',
        'idMemberCreator',
    ];

    protected $path = 'notifications';

    /**
     * @see https://trello.com/docs/api/notification/#get-1-notifications-idnotification
     */
    public function show(string $id, array $params = []): array
    {
        return $this->get($this->getPath().'/'.rawurlencode($id), $params);
    }

    /**
     * Update a notification.
     *
     * @see https://trello.com/docs/api/notification/#put-1-notifications-idnotification
     */
    public function update(string $id, array $data): array
    {
        return $this->put($this->getPath().'/'.rawurlencode($id), $data);
    }

    /**
     * Set a notification's unread status.
     *
     * @see https://trello.com/docs/api/notification/#put-1-notifications-idnotification-unread
     */
    public function setUnread(string $id, bool $status): array
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/unread', ['value' => $status]);
    }

    /**
     * Set all notification's as read.
     *
     * @see https://trello.com/docs/api/notification/#put-1-notifications-idnotification-unread
     */
    public function setAllRead(): array
    {
        return $this->post($this->getPath().'/all/read');
    }

    /**
     * Get a given notification's entities.
     *
     * @see https://trello.com/docs/api/notification/#get-1-notifications-notification-id-entities
     */
    public function getEntities(string $id, array $params = []): array
    {
        return $this->get($this->path.'/'.rawurlencode($id).'/entities', $params);
    }

    /**
     * Get a notification's board.
     *
     * @see https://trello.com/docs/api/notification/#get-1-notifications-idnotification-board
     */
    public function getBoard(string $id, array $params = []): array
    {
        return $this->get($this->getPath().'/'.rawurlencode($id).'/board', $params);
    }

    /**
     * Get the field of a board of a given card.
     *
     * @see https://trello.com/docs/api/notification/#get-1-notifications-idnotification-board
     */
    public function getBoardField(string $id, string $field): array
    {
        $this->validateAllowedParameter(BoardApi::$fields, $field, 'field');

        return $this->get($this->getPath().'/'.rawurlencode($id).'/board/'.rawurlencode($field));
    }

    /**
     * Get a notification's list.
     *
     * @see https://trello.com/docs/api/notification/#get-1-notifications-idnotification-list
     */
    public function getList(string $id, array $params = []): array
    {
        return $this->get($this->getPath().'/'.rawurlencode($id).'/list', $params);
    }

    /**
     * Get the field of a list of a given notification.
     *
     * @see https://trello.com/docs/api/notification/index.html#get-1-notifications-idnotification-list-field
     */
    public function getListField(string $id, string $field): array
    {
        $this->validateAllowedParameter(CardListApi::$fields, $field, 'field');

        return $this->get($this->getPath().'/'.rawurlencode($id).'/list/'.rawurlencode($field));
    }

    /**
     * Get a notification's card.
     *
     * @see https://trello.com/docs/api/notification/#get-1-notifications-idnotification-card
     */
    public function getCard(string $id, array $params = []): array
    {
        return $this->get($this->getPath().'/'.rawurlencode($id).'/card', $params);
    }

    /**
     * Get the field of a card of a given notification.
     *
     * @see https://trello.com/docs/api/notification/index.html#get-1-notifications-idnotification-card-field
     */
    public function getCardField(string $id, string $field): array
    {
        $this->validateAllowedParameter(CardApi::$fields, $field, 'field');

        return $this->get($this->getPath().'/'.rawurlencode($id).'/card/'.rawurlencode($field));
    }

    /**
     * Get a notification's member.
     *
     * @see https://trello.com/docs/api/notification/#get-1-notifications-idnotification-member
     */
    public function getMember(string $id, array $params = []): array
    {
        return $this->get($this->getPath().'/'.rawurlencode($id).'/member', $params);
    }

    /**
     * Get the field of a member of a given notification.
     *
     * @see https://trello.com/docs/api/notification/#get-1-notifications-idnotification-member-field
     */
    public function getMemberField(string $id, string $field): array
    {
        $this->validateAllowedParameter(MemberApi::$fields, $field, 'field');

        return $this->get($this->getPath().'/'.rawurlencode($id).'/member/'.rawurlencode($field));
    }

    /**
     * Get a notification's creator.
     *
     * @see https://trello.com/docs/api/notification/#get-1-notifications-idnotification-creator
     */
    public function getCreator(string $id, array $params = []): array
    {
        return $this->get($this->getPath().'/'.rawurlencode($id).'/memberCreator', $params);
    }

    /**
     * Get the field of a creator of a given notification.
     *
     * @see https://trello.com/docs/api/notification/#get-1-notifications-idnotification-creator-field
     */
    public function getCreatorField(string $id, string $field): array
    {
        $this->validateAllowedParameter(MemberApi::$fields, $field, 'field');

        return $this->get($this->getPath().'/'.rawurlencode($id).'/memberCreator/'.rawurlencode($field));
    }

    /**
     * Get a notification's organization.
     *
     * @see https://trello.com/docs/api/notification/#get-1-notifications-idnotification-organization
     */
    public function getOrganization(string $id, array $params = []): array
    {
        return $this->get($this->getPath().'/'.rawurlencode($id).'/organization', $params);
    }

    /**
     * Get the field of an organization of a given notification.
     *
     * @see https://trello.com/docs/api/notification/#get-1-notifications-idnotification-organization-field
     */
    public function getOrganizationField(string $id, string $field): array
    {
        $this->validateAllowedParameter(OrganizationApi::$fields, $field, 'field');

        return $this->get($this->getPath().'/'.rawurlencode($id).'/organization/'.rawurlencode($field));
    }
}

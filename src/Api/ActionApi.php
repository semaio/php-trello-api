<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Api;

/**
 * @see https://trello.com/docs/api/action
 *
 * Fully implemented.
 */
class ActionApi extends AbstractApi
{
    /**
     * @see https://trello.com/docs/api/action/#get-1-actions-idaction-field
     */
    public static $fields = [
        'idMemberCreator',
        'data',
        'type',
        'date',
    ];

    protected $path = 'actions';

    /**
     * Find an action by id.
     *
     * @see https://trello.com/docs/api/action/#get-1-actions-idaction
     */
    public function show(string $id, array $params = []): array
    {
        return $this->get($this->getPath().'/'.rawurlencode($id), $params);
    }

    /**
     * Update a checklist.
     *
     * @see https://trello.com/docs/api/checklist/#put-1-checklists-idchecklist
     */
    public function update(string $id, array $params = []): array
    {
        return $this->put($this->getPath().'/'.rawurlencode($id), $params);
    }

    /**
     * Remove an action.
     *
     * @see https://trello.com/docs/api/action/#delete-1-actions-idaction
     */
    public function remove(string $id): array
    {
        return $this->delete($this->getPath().'/'.rawurlencode($id));
    }

    /**
     * Get an action's board.
     *
     * @see https://trello.com/docs/api/action/#get-1-actions-idaction-board
     */
    public function getBoard(string $id, array $params = []): array
    {
        return $this->get($this->getPath().'/'.rawurlencode($id).'/board', $params);
    }

    /**
     * Get the field of a board of a given card.
     *
     * @see https://trello.com/docs/api/action/#get-1-actions-idaction-board
     */
    public function getBoardField(string $id, string $field): array
    {
        $this->validateAllowedParameter(BoardApi::$fields, $field, 'field');

        return $this->get($this->getPath().'/'.rawurlencode($id).'/board/'.rawurlencode($field));
    }

    /**
     * Get an action's list.
     *
     * @see https://trello.com/docs/api/action/#get-1-actions-idaction-list
     */
    public function getList(string $id, array $params = []): array
    {
        return $this->get($this->getPath().'/'.rawurlencode($id).'/list', $params);
    }

    /**
     * Get the field of a list of a given action.
     *
     * @see https://trello.com/docs/api/action/index.html#get-1-actions-idaction-list-field
     */
    public function getListField(string $id, string $field): array
    {
        $this->validateAllowedParameter(CardListApi::$fields, $field, 'field');

        return $this->get($this->getPath().'/'.rawurlencode($id).'/list/'.rawurlencode($field));
    }

    /**
     * Get an action's card.
     *
     * @see https://trello.com/docs/api/action/#get-1-actions-idaction-card
     */
    public function getCard(string $id, array $params = []): array
    {
        return $this->get($this->getPath().'/'.rawurlencode($id).'/card', $params);
    }

    /**
     * Get the field of a card of a given action.
     *
     * @see https://trello.com/docs/api/action/index.html#get-1-actions-idaction-card-field
     */
    public function getCardField(string $id, string $field): array
    {
        $this->validateAllowedParameter(CardApi::$fields, $field, 'field');

        return $this->get($this->getPath().'/'.rawurlencode($id).'/card/'.rawurlencode($field));
    }

    /**
     * Get an action's member.
     *
     * @see https://trello.com/docs/api/action/#get-1-actions-idaction-member
     */
    public function getMember(string $id, array $params = []): array
    {
        return $this->get($this->getPath().'/'.rawurlencode($id).'/member', $params);
    }

    /**
     * Get the field of a member of a given action.
     *
     * @see https://trello.com/docs/api/action/#get-1-actions-idaction-member-field
     */
    public function getMemberField(string $id, string $field): array
    {
        $this->validateAllowedParameter(MemberApi::$fields, $field, 'field');

        return $this->get($this->getPath().'/'.rawurlencode($id).'/member/'.rawurlencode($field));
    }

    /**
     * Get an action's creator.
     *
     * @see https://trello.com/docs/api/action/#get-1-actions-idaction-creator
     */
    public function getCreator(string $id, array $params = []): array
    {
        return $this->get($this->getPath().'/'.rawurlencode($id).'/memberCreator', $params);
    }

    /**
     * Get the field of a creator of a given action.
     *
     * @see https://trello.com/docs/api/action/#get-1-actions-idaction-creator-field
     */
    public function getCreatorField(string $id, string $field): array
    {
        $this->validateAllowedParameter(MemberApi::$fields, $field, 'field');

        return $this->get($this->getPath().'/'.rawurlencode($id).'/memberCreator/'.rawurlencode($field));
    }

    /**
     * Get an action's organization.
     *
     * @see https://trello.com/docs/api/action/#get-1-actions-idaction-organization
     */
    public function getOrganization(string $id, array $params = []): array
    {
        return $this->get($this->getPath().'/'.rawurlencode($id).'/organization', $params);
    }

    /**
     * Get the field of an organization of a given action.
     *
     * @see https://trello.com/docs/api/action/#get-1-actions-idaction-organization-field
     */
    public function getOrganizationField(string $id, string $field): array
    {
        $this->validateAllowedParameter(OrganizationApi::$fields, $field, 'field');

        return $this->get($this->getPath().'/'.rawurlencode($id).'/organization/'.rawurlencode($field));
    }

    /**
     * Set a given action's text.
     *
     * @see https://trello.com/docs/api/action/#put-1-actions-idaction-text
     */
    public function setText(string $id, string $text): array
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/text', [
            'value' => $text,
        ]);
    }
}

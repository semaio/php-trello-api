<?php

declare(strict_types=1);

namespace Semaio\TrelloApi;

/**
 * @see https://trello.com/docs/api/card/#get-1-cards-card-id-or-shortlink-actions
 */
final class WebhookEvents
{
    /**************************************************************************************
     * Board Events                                                                       *
     **************************************************************************************/

    /**
     * When a board is created
     * The event listener method receives a Semaio\TrelloApi\Event\BoardEvent instance.
     */
    public const BOARD_CREATE = 'createBoard';

    /**
     * When a board is updated
     * The event listener method receives a Semaio\TrelloApi\Event\BoardEvent instance.
     */
    public const BOARD_UPDATE = 'updateBoard';

    /**
     * When a board is copied
     * The event listener method receives a Semaio\TrelloApi\Event\BoardEvent instance.
     */
    public const BOARD_COPY = 'copyBoard';

    /**
     * When a card is moved from a board
     * The event listener method receives a Semaio\TrelloApi\Event\CardMoveEvent instance.
     */
    public const BOARD_MOVE_CARD_FROM = 'moveCardFromBoard';

    /**
     * When a card is moved to a board
     * The event listener method receives a Semaio\TrelloApi\Event\CardMoveEvent instance.
     */
    public const BOARD_MOVE_CARD_TO = 'moveCardToBoard';

    /**
     * When a card is moved from a board
     * The event listener method receives a Semaio\TrelloApi\Event\ListMoveEvent instance.
     */
    public const BOARD_MOVE_LIST_FROM = 'moveListFromBoard';

    /**
     * When a card is moved to a board
     * The event listener method receives a Semaio\TrelloApi\Event\ListMoveEvent instance.
     */
    public const BOARD_MOVE_LIST_TO = 'moveListToBoard';

    /**
     * When a member is added to a board
     * The event listener method receives a Semaio\TrelloApi\Event\BoardMemberEvent instance.
     */
    public const BOARD_ADD_MEMBER = 'addMemberToBoard';

    /**
     * When a member becomes admin of a board
     * The event listener method receives a Semaio\TrelloApi\Event\BoardMemberEvent instance.
     */
    public const BOARD_MAKE_ADMIN = 'makeAdminOfBoard';

    /**
     * When a member becomes normal member of a board
     * The event listener method receives a Semaio\TrelloApi\Event\BoardMemberEvent instance.
     */
    public const BOARD_MAKE_NORMAL_MEMBER = 'makeNormalMemberOfBoard';

    /**
     * When a member becomes observer of a board
     * The event listener method receives a Semaio\TrelloApi\Event\BoardMemberEvent instance.
     */
    public const BOARD_MAKE_OBSERVER = 'makeObserverOfBoard';

    /**
     * When a member looses admin rights on a board
     * The event listener method receives a Semaio\TrelloApi\Event\BoardMemberEvent instance.
     */
    public const BOARD_REMOVE_ADMIN = 'removeAdminFromBoard';

    /**
     * When an invitation is deleted
     * The event listener method receives a Semaio\TrelloApi\Event\BoardMemberEvent instance.
     */
    public const BOARD_DELETE_INVITATION = 'deleteBoardInvitation';

    /**
     * When an invitation is in unconfirmed state
     * The event listener method receives a Semaio\TrelloApi\Event\BoardMemberEvent instance.
     */
    public const BOARD_UNCONFIRMED_INVITATION = 'unconfirmedBoardInvitation';

    /**
     * When a board is added to an organization
     * The event listener method receives a Semaio\TrelloApi\Event\BoardOrganizationEvent instance.
     */
    public const BOARD_ADD_TO_ORGANIZATION = 'addToOrganizationBoard';

    /**
     * When a board is removed from an organization
     * The event listener method receives a Semaio\TrelloApi\Event\BoardOrganizationEvent instance.
     */
    public const BOARD_REMOVE_FROM_ORGANIZATION = 'removeFromOrganizationBoard';

    /**************************************************************************************
     * List Events                                                                        *
     **************************************************************************************/

    /**
     * When a list is created
     * The event listener method receives a Semaio\TrelloApi\Event\ListEvent instance.
     */
    public const LIST_CREATE = 'createList';

    /**
     * When a list is updated
     * The event listener method receives a Semaio\TrelloApi\Event\ListEvent instance.
     */
    public const LIST_UPDATE = 'updateList';

    /**
     * When a list's closed state changes
     * The event listener method receives a Semaio\TrelloApi\Event\ListEvent instance.
     */
    public const LIST_UPDATE_CLOSED = 'updateList:closed';

    /**
     * When a list's name changes
     * The event listener method receives a Semaio\TrelloApi\Event\ListEvent instance.
     */
    public const LIST_UPDATE_NAME = 'updateList:name';

    /**************************************************************************************
     * Card Events                                                                        *
     **************************************************************************************/

    /**
     * When a card is created
     * The event listener method receives a Semaio\TrelloApi\Event\CardEvent instance.
     */
    public const CARD_CREATE = 'createCard';

    /**
     * When a card is updated
     * The event listener method receives a Semaio\TrelloApi\Event\CardEvent instance.
     */
    public const CARD_UPDATE = 'updateCard';

    /**
     * When a card is moved to an other list
     * The event listener method receives a Semaio\TrelloApi\Event\CardMoveEvent instance.
     */
    public const CARD_UPDATE_LIST = 'updateCard:idList';

    /**
     * When a card's name is updated
     * The event listener method receives a Semaio\TrelloApi\Event\CardEvent instance.
     */
    public const CARD_UPDATE_NAME = 'updateCard:name';

    /**
     * When a card's description is updated
     * The event listener method receives a Semaio\TrelloApi\Event\CardEvent instance.
     */
    public const CARD_UPDATE_DESC = 'updateCard:desc';

    /**
     * When a card's closed state changes
     * The event listener method receives a Semaio\TrelloApi\Event\CardEvent instance.
     */
    public const CARD_UPDATE_CLOSED = 'updateCard:closed';

    /**
     * When a card is deleted
     * The event listener method receives a Semaio\TrelloApi\Event\CardEvent instance.
     */
    public const CARD_DELETE = 'deleteCard';

    /**
     * When a card is copied
     * The event listener method receives a Semaio\TrelloApi\Event\CardCopyEvent instance.
     */
    public const CARD_COPY = 'copyCard';

    /**
     * When a new member is added to a card
     * The event listener method receives a Semaio\TrelloApi\Event\CardMemberEvent instance.
     */
    public const CARD_ADD_MEMBER = 'addMemberToCard';

    /**
     * When a new member is removed from a card
     * The event listener method receives a Semaio\TrelloApi\Event\CardMemberEvent instance.
     */
    public const CARD_REMOVE_MEMBER = 'removeMemberFromCard';

    /**
     * When a new label is added to a card
     * The event listener method receives a Semaio\TrelloApi\Event\CardEvent instance.
     */
    public const CARD_ADD_LABEL = 'addLabelToCard';

    /**
     * When a new label is removed from a card
     * The event listener method receives a Semaio\TrelloApi\Event\CardEvent instance.
     */
    public const CARD_REMOVE_LABEL = 'removeLabelFromCard';

    /**
     * When a comment is added to a card
     * The event listener method receives a Semaio\TrelloApi\Event\CardCommentEvent instance.
     */
    public const CARD_COMMENT = 'commentCard';

    /**
     * When a card's comment is copied
     * The event listener method receives a Semaio\TrelloApi\Event\CardCommentEvent instance.
     */
    public const CARD_COPY_COMMENT = 'copyCommentCard';

    /**
     * When a card is created from a check item
     * The event listener method receives a Semaio\TrelloApi\Event\CardFromCheckItemEvent instance.
     */
    public const CARD_FROM_CHECKITEM = 'convertToCardFromCheckItem';

    /**
     * When an attachment is added to a card
     * The event listener method receives a Semaio\TrelloApi\Event\CardAttachmentEvent instance.
     */
    public const CARD_ADD_ATTACHMENT = 'addAttachmentToCard';

    /**
     * When an attachment is deleted from a card
     * The event listener method receives a Semaio\TrelloApi\Event\CardAttachmentEvent instance.
     */
    public const CARD_DELETE_ATTACHMENT = 'deleteAttachmentFromCard';

    /**
     * When a card is shared by email
     * The event listener method receives a Semaio\TrelloApi\Event\CardEvent instance.
     */
    public const CARD_EMAIL = 'emailCard';

    /**************************************************************************************
     * Checklist Events                                                                   *
     **************************************************************************************/

    /**
     * When a checklist is added to a card
     * The event listener method receives a Semaio\TrelloApi\Event\CardChecklistEvent instance.
     */
    public const CARD_ADD_CHECKLIST = 'addChecklistToCard';

    /**
     * When a checklist is updated on a card
     * The event listener method receives a Semaio\TrelloApi\Event\CardChecklistEvent instance.
     */
    public const CARD_CREATE_CHECKLIST = 'createChecklist';

    /**
     * When a checklist is updated on a card
     * The event listener method receives a Semaio\TrelloApi\Event\CardChecklistEvent instance.
     */
    public const CARD_UPDATE_CHECKLIST = 'updateChecklist';

    /**
     * When a checklist is removed from a card
     * The event listener method receives a Semaio\TrelloApi\Event\CardChecklistEvent instance.
     */
    public const CARD_REMOVE_CHECKLIST = 'removeChecklistFromCard';

    /**
     * When an item is added to a checklist
     * The event listener method receives a Semaio\TrelloApi\Event\CardChecklistEvent instance.
     */
    public const CARD_CREATE_CHECKLIST_ITEM = 'createCheckItem';

    /**
     * When a checklist is removed from a card
     * The event listener method receives a Semaio\TrelloApi\Event\CardChecklistEvent instance.
     */
    public const CARD_UPDATE_CHECKLIST_ITEM_STATE = 'updateCheckItemStateOnCard';

    /**************************************************************************************
     * Organization Events                                                                *
     **************************************************************************************/

    /**
     * When an organization is created
     * The event listener method receives a Semaio\TrelloApi\Event\OrganizationEvent instance.
     */
    public const ORGANIZATION_CREATE = 'createOrganization';

    /**
     * When an organization is updated
     * The event listener method receives a Semaio\TrelloApi\Event\OrganizationEvent instance.
     */
    public const ORGANIZATION_UPDATE = 'updateOrganization';

    /**
     * When a member is added to an organization
     * The event listener method receives a Semaio\TrelloApi\Event\OrganizationMemberEvent instance.
     */
    public const ORGANIZATION_ADD_MEMBER = 'addMemberToOrganization';

    /**
     * When a member is made normal member of an organization
     * The event listener method receives a Semaio\TrelloApi\Event\OrganizationMemberEvent instance.
     */
    public const ORGANIZATION_MAKE_NORMAL_MEMBER = 'makeNormalMemberOfOrganization';

    /**
     * When a member looses admin rights of an organization
     * The event listener method receives a Semaio\TrelloApi\Event\OrganizationMemberEvent instance.
     */
    public const ORGANIZATION_REMOVE_ADMIN = 'removeAdminFromOrganization';

    /**
     * When an invitation to join an organization is deleted
     * The event listener method receives a Semaio\TrelloApi\Event\OrganizationMemberEvent instance.
     */
    public const ORGANIZATION_DELETE_INVITATION = 'deleteOrganizationInvitation';

    /**
     * When a member is invited to an organization
     * The event listener method receives a Semaio\TrelloApi\Event\OrganizationMemberEvent instance.
     */
    public const ORGANIZATION_UNCONFIRMED_INVITATION = 'unconfirmedOrganizationInvitation';

    /**************************************************************************************
     * Member Events                                                                      *
     **************************************************************************************/

    /**
     * When a member joins
     * The event listener method receives a Semaio\TrelloApi\Event\MemberEvent instance.
     */
    public const MEMBER_JOINED = 'memberJoinedTrello';

    /**
     * When a member is updated
     * The event listener method receives a Semaio\TrelloApi\Event\MemberEvent instance.
     */
    public const MEMBER_UPDATE = 'updateMember';

    /**************************************************************************************
     * PowerUp Events                                                                     *
     **************************************************************************************/

    /**
     * When a power up is enabled
     * The event listener method receives a Semaio\TrelloApi\Event\PowerUpEvent instance.
     */
    public const POWERUP_ENABLE = 'enablePowerUp';

    /**
     * When a power up is disabled
     * The event listener method receives a Semaio\TrelloApi\Event\PowerUpEvent instance.
     */
    public const POWERUP_DISABLE = 'disablePowerUp';

    public static function all(): array
    {
        return [
            self::BOARD_CREATE,
            self::BOARD_UPDATE,
            self::BOARD_COPY,
            self::BOARD_MOVE_CARD_FROM,
            self::BOARD_MOVE_CARD_TO,
            self::BOARD_MOVE_LIST_FROM,
            self::BOARD_MOVE_LIST_TO,
            self::BOARD_ADD_MEMBER,
            self::BOARD_MAKE_ADMIN,
            self::BOARD_MAKE_NORMAL_MEMBER,
            self::BOARD_MAKE_OBSERVER,
            self::BOARD_REMOVE_ADMIN,
            self::BOARD_DELETE_INVITATION,
            self::BOARD_UNCONFIRMED_INVITATION,
            self::BOARD_ADD_TO_ORGANIZATION,
            self::BOARD_REMOVE_FROM_ORGANIZATION,
            self::LIST_CREATE,
            self::LIST_UPDATE,
            self::LIST_UPDATE_CLOSED,
            self::LIST_UPDATE_NAME,
            self::CARD_CREATE,
            self::CARD_UPDATE,
            self::CARD_UPDATE_LIST,
            self::CARD_UPDATE_NAME,
            self::CARD_UPDATE_DESC,
            self::CARD_UPDATE_CLOSED,
            self::CARD_DELETE,
            self::CARD_COPY,
            self::CARD_ADD_MEMBER,
            self::CARD_REMOVE_MEMBER,
            self::CARD_COMMENT,
            self::CARD_COPY_COMMENT,
            self::CARD_FROM_CHECKITEM,
            self::CARD_ADD_ATTACHMENT,
            self::CARD_DELETE_ATTACHMENT,
            self::CARD_EMAIL,
            self::CARD_ADD_LABEL,
            self::CARD_REMOVE_LABEL,
            self::CARD_ADD_CHECKLIST,
            self::CARD_UPDATE_CHECKLIST,
            self::CARD_REMOVE_CHECKLIST,
            self::CARD_UPDATE_CHECKLIST_ITEM_STATE,
            self::ORGANIZATION_CREATE,
            self::ORGANIZATION_UPDATE,
            self::ORGANIZATION_ADD_MEMBER,
            self::ORGANIZATION_MAKE_NORMAL_MEMBER,
            self::ORGANIZATION_REMOVE_ADMIN,
            self::ORGANIZATION_DELETE_INVITATION,
            self::ORGANIZATION_UNCONFIRMED_INVITATION,
            self::MEMBER_JOINED,
            self::MEMBER_UPDATE,
            self::POWERUP_ENABLE,
            self::POWERUP_DISABLE,
        ];
    }
}

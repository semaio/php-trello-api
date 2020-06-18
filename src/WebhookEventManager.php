<?php

declare(strict_types=1);

namespace Semaio\TrelloApi;

use Semaio\TrelloApi\Event\BoardEvent;
use Semaio\TrelloApi\Event\BoardMemberEvent;
use Semaio\TrelloApi\Event\BoardOrganizationEvent;
use Semaio\TrelloApi\Event\CardAttachmentEvent;
use Semaio\TrelloApi\Event\CardChecklistEvent;
use Semaio\TrelloApi\Event\CardCommentEvent;
use Semaio\TrelloApi\Event\CardCopyEvent;
use Semaio\TrelloApi\Event\CardEvent;
use Semaio\TrelloApi\Event\CardFromCheckItemEvent;
use Semaio\TrelloApi\Event\CardListEvent;
use Semaio\TrelloApi\Event\CardListMoveEvent;
use Semaio\TrelloApi\Event\CardMemberEvent;
use Semaio\TrelloApi\Event\CardMoveEvent;
use Semaio\TrelloApi\Event\MemberEvent;
use Semaio\TrelloApi\Event\OrganizationEvent;
use Semaio\TrelloApi\Event\OrganizationMemberEvent;
use Semaio\TrelloApi\Event\PowerUpEvent;
use Semaio\TrelloApi\Exception\InvalidArgumentException;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;

class WebhookEventManager extends Manager implements WebhookEventManagerInterface
{
    /**
     * @var EventDispatcherInterface
     */
    protected $dispatcher;

    /**
     * Constructor.
     */
    public function __construct(ClientInterface $client, ?EventDispatcherInterface $dispatcher = null)
    {
        parent::__construct($client);

        $this->dispatcher = $dispatcher ?? new EventDispatcher();
    }

    /**
     * {@inheritdoc}
     */
    public function addEventSubscriber(EventSubscriberInterface $subscriber): void
    {
        $this->dispatcher->addSubscriber($subscriber);
    }

    /**
     * {@inheritdoc}
     */
    public function addListener(string $eventName, callable $listener, int $priority = 0): void
    {
        $this->dispatcher->addListener($eventName, $listener, $priority);
    }

    /**
     * {@inheritdoc}
     */
    public function execute(?Request $request = null): void
    {
        if ($request === null) {
            $request = Request::createFromGlobals();

            $data = json_decode($request->getContent(), true);
            if (!$data) {
                $data = [];
            }
            $request->request->replace($data);
        }

        if (!$this->isTrelloWebhook($request) || !$action = $request->get('action')) {
            return;
        }

        if (!isset($action['type'])) {
            throw new InvalidArgumentException('Unable to determine event from request.');
        }

        if (!isset($action['data'])) {
            throw new InvalidArgumentException('Unable to retrieve data from request.');
        }

        $event = null;
        $data = $action['data'];
        $memberCreator = $action['memberCreator'] ?? []; // User who actually performed the action

        $eventName = $action['type'];
        switch ($eventName) {
            case WebhookEvents::BOARD_CREATE:
            case WebhookEvents::BOARD_UPDATE:
            case WebhookEvents::BOARD_COPY:
                $event = new BoardEvent();
                $event->setMemberCreator($memberCreator);
                $event->setBoard($this->getBoard($data['board']['id']));

                break;
            case WebhookEvents::BOARD_MOVE_CARD_FROM:
            case WebhookEvents::BOARD_MOVE_CARD_TO:
                $event = new CardMoveEvent();
                $event->setMemberCreator($memberCreator);
                $event->setCard($this->getCard($data['card']['id']));

                break;
            case WebhookEvents::BOARD_MOVE_LIST_FROM:
            case WebhookEvents::BOARD_MOVE_LIST_TO:
                $event = new CardListMoveEvent();
                $event->setMemberCreator($memberCreator);
                $event->setList($this->getList($data['list']['id']));

                break;
            case WebhookEvents::BOARD_ADD_MEMBER:
            case WebhookEvents::BOARD_MAKE_ADMIN:
            case WebhookEvents::BOARD_MAKE_NORMAL_MEMBER:
            case WebhookEvents::BOARD_MAKE_OBSERVER:
            case WebhookEvents::BOARD_REMOVE_ADMIN:
            case WebhookEvents::BOARD_DELETE_INVITATION:
            case WebhookEvents::BOARD_UNCONFIRMED_INVITATION:
                $event = new BoardMemberEvent();
                $event->setMemberCreator($memberCreator);
                $event->setBoard($this->getBoard($data['board']['id']));
                $event->setMember($this->getMember($data['member']['id']));

                break;
            case WebhookEvents::BOARD_ADD_TO_ORGANIZATION:
            case WebhookEvents::BOARD_REMOVE_FROM_ORGANIZATION:
                $event = new BoardOrganizationEvent();
                $event->setMemberCreator($memberCreator);
                $event->setBoard($this->getBoard($data['board']['id']));
                $event->setOrganization($this->getOrganization($data['organization']['id']));

                break;
            case WebhookEvents::LIST_CREATE:
            case WebhookEvents::LIST_UPDATE:
            case WebhookEvents::LIST_UPDATE_CLOSED:
            case WebhookEvents::LIST_UPDATE_NAME:
                $event = new CardListEvent();
                $event->setMemberCreator($memberCreator);
                $event->setList($this->getList($data['list']['id']));

                break;
            case WebhookEvents::CARD_CREATE:
            case WebhookEvents::CARD_UPDATE:
            case WebhookEvents::CARD_UPDATE_LIST:
            case WebhookEvents::CARD_UPDATE_NAME:
            case WebhookEvents::CARD_UPDATE_DESC:
            case WebhookEvents::CARD_UPDATE_CLOSED:
            case WebhookEvents::CARD_DELETE:
            case WebhookEvents::CARD_EMAIL:
            case WebhookEvents::CARD_ADD_LABEL:
            case WebhookEvents::CARD_REMOVE_LABEL:
                $event = new CardEvent();
                $event->setMemberCreator($memberCreator);
                $event->setCard($this->getCard($data['card']['id']));
                if ($data['listBefore']) {
                    $event->setPreviousListName($data['listBefore']['name']);
                }
                if ($data['listAfter']) {
                    $event->setNextListName($data['listAfter']['name']);
                }

                break;
            case WebhookEvents::CARD_COPY:
                $event = new CardCopyEvent();
                $event->setMemberCreator($memberCreator);
                $event->setCard($this->getCard($data['card']['id']));

                break;
            case WebhookEvents::CARD_ADD_MEMBER:
            case WebhookEvents::CARD_REMOVE_MEMBER:
                $event = new CardMemberEvent();
                $event->setMemberCreator($memberCreator);
                $event->setCard($this->getCard($data['card']['id']));
                $event->setMember($this->getMember($data['member']['id']));

                break;
            case WebhookEvents::CARD_COMMENT:
            case WebhookEvents::CARD_COPY_COMMENT:
                $event = new CardCommentEvent();
                $event->setMemberCreator($memberCreator);
                $event->setCard($this->getCard($data['card']['id']));
                $event->setComment($data['text']);

                break;
            case WebhookEvents::CARD_FROM_CHECKITEM:
                $event = new CardFromCheckItemEvent();
                $event->setMemberCreator($memberCreator);
                $event->setCard($this->getCard($data['card']['id']));

                break;
            case WebhookEvents::CARD_ADD_ATTACHMENT:
            case WebhookEvents::CARD_DELETE_ATTACHMENT:
                $event = new CardAttachmentEvent();
                $event->setMemberCreator($memberCreator);
                $event->setCard($this->getCard($data['card']['id']));
                $event->setAttachment($data['attachment']);

                break;
            case WebhookEvents::CARD_ADD_CHECKLIST:
            case WebhookEvents::CARD_CREATE_CHECKLIST_ITEM:
            case WebhookEvents::CARD_UPDATE_CHECKLIST_ITEM_STATE:
                $event = new CardChecklistEvent();
                $event->setMemberCreator($memberCreator);
                $event->setCard($this->getCard($data['card']['id']));
                $event->setChecklist($this->getChecklist($data['checklist']['id']));

                break;
            case WebhookEvents::CARD_CREATE_CHECKLIST:
            case WebhookEvents::CARD_UPDATE_CHECKLIST:
            case WebhookEvents::CARD_REMOVE_CHECKLIST:
                $event = new CardChecklistEvent();
                $event->setMemberCreator($memberCreator);
                $event->setCard($this->getCard($data['cardTarget']['_id']));
                $event->setChecklist($this->getChecklist($data['checklist']['id']));

                break;
            case WebhookEvents::ORGANIZATION_CREATE:
            case WebhookEvents::ORGANIZATION_UPDATE:
                $event = new OrganizationEvent();
                $event->setMemberCreator($memberCreator);
                $event->setOrganization($this->getOrganization($data['organization']['id']));

                break;
            case WebhookEvents::ORGANIZATION_ADD_MEMBER:
            case WebhookEvents::ORGANIZATION_MAKE_NORMAL_MEMBER:
            case WebhookEvents::ORGANIZATION_REMOVE_ADMIN:
            case WebhookEvents::ORGANIZATION_DELETE_INVITATION:
            case WebhookEvents::ORGANIZATION_UNCONFIRMED_INVITATION:
                $event = new OrganizationMemberEvent();
                $event->setMemberCreator($memberCreator);
                $event->setOrganization($this->getOrganization($data['organization']['id']));
                $event->setMember($this->getMember($data['member']['id']));

                break;
            case WebhookEvents::MEMBER_JOINED:
            case WebhookEvents::MEMBER_UPDATE:
                $event = new MemberEvent();
                $event->setMemberCreator($memberCreator);
                $event->setMember($this->getMember($data['member']['id']));

                break;
            case WebhookEvents::POWERUP_ENABLE:
            case WebhookEvents::POWERUP_DISABLE:
                $event = new PowerUpEvent();
                $event->setMemberCreator($memberCreator);
                $event->setPowerUp($data['powerUp']);

                break;
        }

        if ($event === null) {
            return;
        }

        $event->setRequest($request);
        $event->setRequestData($data);

        $this->dispatcher->dispatch($event, $eventName);
    }

    private function isTrelloWebhook(Request $request): bool
    {
        if ($request->getMethod() !== 'POST') {
            return false;
        }

        if (!$request->headers->has('X-Trello-Webhook')) {
            return false;
        }

        return true;
    }
}

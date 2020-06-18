<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Model;

/**
 * @codeCoverageIgnore
 */
class CardListModel extends AbstractModel implements CardListModelInterface
{
    protected $apiName = 'list';

    protected $loadParams = [
        'cards' => 'all',
        'fields' => 'all',
    ];

    /**
     * {@inheritdoc}
     */
    public function setName($name)
    {
        $this->data['name'] = $name;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->data['name'];
    }

    /**
     * {@inheritdoc}
     */
    public function setBoardId($boardId)
    {
        $this->data['idBoard'] = $boardId;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getBoardId()
    {
        return $this->data['idBoard'];
    }

    /**
     * {@inheritdoc}
     */
    public function setBoard(BoardModelInterface $board)
    {
        return $this->setBoardId($board->getId());
    }

    /**
     * {@inheritdoc}
     */
    public function getBoard()
    {
        return new BoardModel($this->client, $this->client->getBoardApi(), $this->getBoardId());
    }

    /**
     * {@inheritdoc}
     */
    public function setPosition($pos)
    {
        $this->data['pos'] = $pos;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getPosition()
    {
        return $this->data['pos'];
    }

    /**
     * {@inheritdoc}
     */
    public function setClosed($closed)
    {
        $this->data['closed'] = $closed;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function isClosed()
    {
        return $this->data['closed'];
    }

    /**
     * {@inheritdoc}
     */
    public function setSubscribed($subscribed)
    {
        $this->data['subscribed'] = $subscribed;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function isSubscribed()
    {
        return $this->data['subscribed'];
    }

    /**
     * {@inheritdoc}
     */
    public function getCards()
    {
        $cards = [];

        foreach ($this->data['cards'] as $card) {
            $cards[] = new CardModel($this->client, $this->client->getCardApi(), $card['id']);
        }

        return $cards;
    }
}

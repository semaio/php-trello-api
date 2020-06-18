<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Model;

interface CardListModelInterface extends ModelInterface
{
    /**
     * Set name.
     *
     * @param string $name
     *
     * @return CardListModelInterface
     */
    public function setName($name);

    /**
     * Get name.
     *
     * @return string
     */
    public function getName();

    /**
     * Set boardId.
     *
     * @param string $boardId
     *
     * @return CardListModelInterface
     */
    public function setBoardId($boardId);

    /**
     * Get boardId.
     *
     * @return string
     */
    public function getBoardId();

    /**
     * Set board.
     *
     * @return CardListModelInterface
     */
    public function setBoard(BoardModelInterface $board);

    /**
     * Get board.
     *
     * @return BoardModelInterface
     */
    public function getBoard();

    /**
     * Set position.
     *
     * @param string $pos
     *
     * @return CardListModelInterface
     */
    public function setPosition($pos);

    /**
     * Get position.
     *
     * @return string
     */
    public function getPosition();

    /**
     * Set closed.
     *
     * @param bool $closed
     *
     * @return CardListModelInterface
     */
    public function setClosed($closed);

    /**
     * Get closed.
     *
     * @return bool
     */
    public function isClosed();

    /**
     * Set subscribed.
     *
     * @param bool $subscribed
     *
     * @return CardListModelInterface
     */
    public function setSubscribed($subscribed);

    /**
     * Get subscribed.
     *
     * @return bool
     */
    public function isSubscribed();

    /**
     * Get cards.
     *
     * @return array|CardModelInterface[]
     */
    public function getCards();
}

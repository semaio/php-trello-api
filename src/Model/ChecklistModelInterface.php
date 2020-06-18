<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Model;

interface ChecklistModelInterface extends ModelInterface
{
    /**
     * Set name.
     *
     * @param string $name
     *
     * @return ChecklistModelInterface
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
     * @return ChecklistModelInterface
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
     * @return ChecklistModelInterface
     */
    public function setBoard(BoardModelInterface $board);

    /**
     * Get board.
     *
     * @return BoardModelInterface
     */
    public function getBoard();

    /**
     * Set card id.
     *
     * @param string $cardId
     *
     * @return ChecklistModelInterface
     */
    public function setCardId($cardId);

    /**
     * Get card id.
     *
     * @return string
     */
    public function getCardId();

    /**
     * Set card.
     *
     * @param CardModelInterface $card [description]
     *
     * @return ChecklistModelInterface
     */
    public function setCard(CardModelInterface $card);

    /**
     * Get card.
     *
     * @return CardModelInterface
     */
    public function getCard();

    /**
     * Set position.
     *
     * @param string $pos
     *
     * @return ChecklistModelInterface
     */
    public function setPosition($pos);

    /**
     * Get position.
     *
     * @return string
     */
    public function getPosition();

    /**
     * Get checklist items.
     *
     * @return array an array of check item arrays. each check item array has the following keys:
     *               - id : the identifier of the item
     *               - name : the name (label) o fthe item
     *               - state : 'complete' or 'incomplete'
     *               - pos : the position of the item
     */
    public function getItems();

    /**
     * Set an item.
     *
     * @param string $name     name of the item
     * @param bool   $checked  whether it should be marked as completed or not
     * @param int    $position position on the list
     *
     * @return ChecklistModelInterface
     */
    public function setItem($name, $checked = null, $position = null);

    /**
     * Find out whether the item with the given name is checked.
     *
     * @param string $name the item's name
     *
     * @return bool
     */
    public function isItemChecked($name);
}

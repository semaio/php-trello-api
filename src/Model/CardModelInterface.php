<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Model;

interface CardModelInterface extends ModelInterface
{
    /**
     * Get id Short.
     *
     * @return string
     */
    public function getShortId();

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return CardModelInterface
     */
    public function setName($name);

    /**
     * Get name.
     *
     * @return string
     */
    public function getName();

    /**
     * Set description.
     *
     * @param string $desc
     *
     * @return CardModelInterface
     */
    public function setDescription($desc);

    /**
     * Get description.
     *
     * @return string
     */
    public function getDescription();

    /**
     * Get descriptionData.
     *
     * @return string
     */
    public function getDescriptionData();

    /**
     * Get url.
     *
     * @return string
     */
    public function getUrl();

    /**
     * Get shortUrl.
     *
     * @return string
     */
    public function getShortUrl();

    /**
     * Get shortLink.
     *
     * @return string
     */
    public function getShortLink();

    /**
     * Set position.
     *
     * @param string $pos
     *
     * @return CardModelInterface
     */
    public function setPosition($pos);

    /**
     * Get position.
     *
     * @return string
     */
    public function getPosition();

    /**
     * Set due date.
     *
     * @param \DateTime $due
     *
     * @return CardModelInterface
     */
    public function setDueDate(?\DateTime $due = null);

    /**
     * Get due date.
     *
     * @return \DateTime
     */
    public function getDueDate();

    /**
     * Set email.
     *
     * @param string $email
     *
     * @return CardModelInterface
     */
    public function setEmail($email);

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail();

    /**
     * Set closed.
     *
     * @param bool $closed
     *
     * @return CardModelInterface
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
     * @return CardModelInterface
     */
    public function setSubscribed($subscribed);

    /**
     * Get subscribed.
     *
     * @return bool
     */
    public function isSubscribed();

    /**
     * Set checkItemStates.
     *
     * @return CardModelInterface
     */
    public function setCheckItemStates(array $checkItemStates);

    /**
     * Get checkItemStates.
     *
     * @return array
     */
    public function getCheckItemStates();

    /**
     * Set boardId.
     *
     * @param string $boardId
     *
     * @return CardModelInterface
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
     * @return CardModelInterface
     */
    public function setBoard(BoardModelInterface $board);

    /**
     * Get board.
     *
     * @return BoardModelInterface
     */
    public function getBoard();

    /**
     * Set listId.
     *
     * @param string $listId
     *
     * @return CardModelInterface
     */
    public function setListId($listId);

    /**
     * Get listId.
     *
     * @return string
     */
    public function getListId();

    /**
     * Set list.
     *
     * @return CardModelInterface
     */
    public function setList(CardListModelInterface $list);

    /**
     * Get list.
     *
     * @return CardListModelInterface
     */
    public function getList();

    /**
     * Set checklistIds.
     *
     * @return CardModelInterface
     */
    public function setChecklistIds(array $checklistIds);

    /**
     * Get checklistIds.
     *
     * @return array
     */
    public function getChecklistIds();

    /**
     * Set checklists.
     *
     * @param array|ChecklistModelInterface[] $checklists
     *
     * @return CardModelInterface
     */
    public function setChecklists(array $checklists);

    /**
     * Get checklists.
     *
     * @return array|ChecklistModelInterface[]
     */
    public function getChecklists();

    /**
     * Get checklist by name.
     *
     * @return ChecklistModelInterface
     */
    public function getChecklist($name);

    /**
     * Has checklist?
     *
     * @param ChecklistModelInterface|string $checklistOrName
     *
     * @return bool
     */
    public function hasChecklist($checklistOrName);

    /**
     * Add checklist to card.
     *
     * @param ChecklistModelInterface|string $checklistOrName
     *
     * @return CardModelInterface
     */
    public function addChecklist($checklistOrName);

    /**
     * Remove checklist from card.
     *
     * This will only remove the checklist from this card,
     * without actually deleting it. Call ChecklistInterface::remove()
     * to removed it completely.
     *
     * @param ChecklistModelInterface|string $checklistOrName
     *
     * @return CardModelInterface
     */
    public function removeChecklist($checklistOrName);

    /**
     * Set member ids.
     *
     * @return CardModelInterface
     */
    public function setMemberIds(array $memberIds);

    /**
     * Get member ids.
     *
     * @return array
     */
    public function getMemberIds();

    /**
     * Has member.
     *
     * @return bool
     */
    public function hasMember(MemberModelInterface $member);

    /**
     * Add member.
     *
     * @return CardModelInterface
     */
    public function addMember(MemberModelInterface $member);

    /**
     * Remove member.
     *
     * @return CardModelInterface
     */
    public function removeMember(MemberModelInterface $member);

    /**
     * Set members.
     *
     * @param array|MemberModelInterface[] $members
     *
     * @return CardModelInterface
     */
    public function setMembers(array $members);

    /**
     * Get members.
     *
     * @return array|MemberModelInterface[]
     */
    public function getMembers();

    /**
     * Set members voted ids.
     *
     * @return CardModelInterface
     */
    public function setMembersVotedIds(array $membersVotedIds);

    /**
     * Get members voted ids.
     *
     * @return array
     */
    public function getMembersVotedIds();

    /**
     * Has member voted.
     *
     * @return bool
     */
    public function hasMemberVoted(MemberModelInterface $member);

    /**
     * Add member voted.
     *
     * @return CardModelInterface
     */
    public function addMemberVoted(MemberModelInterface $member);

    /**
     * Remove member voted.
     *
     * @return CardModelInterface
     */
    public function removeMemberVoted(MemberModelInterface $member);

    /**
     * Set members voted.
     *
     * @param array|MemberModelInterface[] $members
     *
     * @return CardModelInterface
     */
    public function setMembersVoted(array $members);

    /**
     * Get members voted.
     *
     * @return array|MemberModelInterface[]
     */
    public function getMembersVoted();

    /**
     * Set attachmentCoverId.
     *
     * @param string $attachmentCoverId
     *
     * @return CardModelInterface
     */
    public function setAttachmentCoverId($attachmentCoverId);

    /**
     * Get attachmentCoverId.
     *
     * @return string
     */
    public function getAttachmentCoverId();

    /**
     * Set manualCoverAttachment.
     *
     * @param string $coverAttachment
     *
     * @return CardModelInterface
     */
    public function setManualCoverAttachment($coverAttachment);

    /**
     * Get manualCoverAttachment.
     *
     * @return string
     */
    public function getManualCoverAttachment();

    /**
     * Set labels.
     *
     * @return CardModelInterface
     */
    public function setLabels(array $labels);

    /**
     * Get labels.
     *
     * @return array
     */
    public function getLabels();

    /**
     * Get the colors of labels associated to this card.
     *
     * @return array
     */
    public function getLabelColors();

    /**
     * Does the card have the label of which the color is $color?
     *
     * @param string $color
     *
     * @return bool
     */
    public function hasLabel($color);

    /**
     * Add the label of color $color.
     *
     * @param string $color
     *
     * @return CardModelInterface
     */
    public function addLabel($color);

    /**
     * Remove the label of color $color.
     *
     * @param string $color
     *
     * @return CardModelInterface
     */
    public function removeLabel($color);

    /**
     * Set Badges.
     *
     * @param array $badges an array with the following keys:
     *                      - votes              integer
     *                      - viewingMemberVoted bool
     *                      - subscribed         bool
     *                      - fogbugz            string
     *                      - checkItems         integer
     *                      - checkItemsChecked  integer
     *                      - comments           integer
     *                      - attachments        integer
     *                      - description        bool
     *                      - due                \DateTime
     *
     * @return CardModelInterface
     */
    public function setBadges(array $badges);

    /**
     * Get badges.
     *
     * @return array
     */
    public function getBadges();

    /**
     * Get dateOfLastActivity.
     *
     * @return \DateTime
     */
    public function getDateOfLastActivity();

    /**
     * Get actions.
     *
     * @return array
     */
    public function getActions();

    /**
     * Add comment.
     *
     * @param string $text comment text
     *
     * @return CardModelInterface
     */
    public function addComment($text);

    /**
     * Remove comment.
     *
     * @param string $commentId id of the comment to remove
     *
     * @return CardModelInterface
     */
    public function removeComment($commentId);
}

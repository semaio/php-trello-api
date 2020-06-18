<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Model;

interface TokenModelInterface extends ModelInterface
{
    /**
     * Get identifier.
     *
     * @return string
     */
    public function getIdentifier();

    /**
     * Get member id.
     *
     * @return string
     */
    public function getMemberId();

    /**
     * Get member.
     *
     * @return MemberModelInterface
     */
    public function getMember();

    /**
     * Get date of creation.
     *
     * @return \DateTime
     */
    public function getDateOfCreation();

    /**
     * Get date of expiry.
     *
     * @return \DateTime
     */
    public function getDateOfExpiry();

    /**
     * Get permissions.
     *
     * @return array
     */
    public function getPermissions();

    /**
     * Get webhooks.
     *
     * @return array|WebhookModel[]
     */
    public function getWebhooks();
}

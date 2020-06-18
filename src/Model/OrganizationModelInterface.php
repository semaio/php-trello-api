<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Model;

interface OrganizationModelInterface extends ModelInterface
{
    /**
     * Set name.
     *
     * @param string $name
     *
     * @return OrganizationModelInterface
     */
    public function setName($name);

    /**
     * Get name.
     *
     * @return string
     */
    public function getName();

    /**
     * Set display name.
     *
     * @param string $displayName
     *
     * @return OrganizationModelInterface
     */
    public function setDisplayName($displayName);

    /**
     * Get display name.
     *
     * @return string
     */
    public function getDisplayName();

    /**
     * Set description.
     *
     * @param string $desc
     *
     * @return OrganizationModelInterface
     */
    public function setDescription($desc);

    /**
     * Get desc.
     *
     * @return string
     */
    public function getDesciption();

    /**
     * Set description data.
     *
     * @param string $descData
     *
     * @return OrganizationModelInterface
     */
    public function setDescriptionData($descData);

    /**
     * Get description data.
     *
     * @return string
     */
    public function getDescriptionData();

    /**
     * Set board ids.
     *
     * @return OrganizationModelInterface
     */
    public function setBoardIds(array $boardIds);

    /**
     * Get board ids.
     *
     * @return array
     */
    public function getBoardIds();

    /**
     * Get boards.
     *
     * @return array|BoardModelInterface[]
     */
    public function getBoards();

    /**
     * Set invited.
     *
     * @param string $invited
     *
     * @return OrganizationModelInterface
     */
    public function setInvited(array $invited);

    /**
     * Get invited.
     *
     * @return string
     */
    public function getInvited();

    /**
     * Set invitations.
     *
     * @param string $invitations
     *
     * @return OrganizationModelInterface
     */
    public function setInvitations(array $invitations);

    /**
     * Get invitations.
     *
     * @return array
     */
    public function getInvitations();

    /**
     * Get memberships.
     *
     * @return array
     */
    public function getMemberships();

    /**
     * Set preferences.
     *
     * @return OrganizationModelInterface
     */
    public function setPreferences(array $prefs);

    /**
     * Get preferences.
     *
     * @return array
     */
    public function getPreferences();

    /**
     * Set power ups.
     *
     * @return OrganizationModelInterface
     */
    public function setPowerUps(array $powerUps);

    /**
     * Get power ups.
     *
     * @return array
     */
    public function getPowerUps();

    /**
     * Set products.
     *
     * @return OrganizationModelInterface
     */
    public function setProducts(array $products);

    /**
     * Get products.
     *
     * @return array
     */
    public function getProducts();

    /**
     * Get billable member count.
     *
     * @return int
     */
    public function getBillableMemberCount();

    /**
     * Set url.
     *
     * @param string $url
     *
     * @return OrganizationModelInterface
     */
    public function setUrl($url);

    /**
     * Get url.
     *
     * @return string
     */
    public function getUrl();

    /**
     * Set website.
     *
     * @param string $website
     *
     * @return OrganizationModelInterface
     */
    public function setWebsite($website);

    /**
     * Get website.
     *
     * @return string
     */
    public function getWebsite();

    /**
     * Set logo hash.
     *
     * @param string $logoHash
     *
     * @return OrganizationModelInterface
     */
    public function setLogoHash($logoHash);

    /**
     * Get logo hash.
     *
     * @return string
     */
    public function getLogoHash();

    /**
     * Set premium features.
     *
     * @return OrganizationModelInterface
     */
    public function setPremiumFeatures(array $premiumFeatures);

    /**
     * Get premium features.
     *
     * @return array
     */
    public function getPremiumFeatures();
}

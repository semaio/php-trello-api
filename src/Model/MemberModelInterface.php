<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Model;

interface MemberModelInterface extends ModelInterface
{
    /**
     * Set avatar hash.
     *
     * @param $avatarHash
     *
     * @return MemberModelInterface
     */
    public function setAvatarHash($avatarHash);

    /**
     * Get avatar hash.
     *
     * @return string
     */
    public function getAvatarHash();

    /**
     * Set bio.
     *
     * @param string $bio
     *
     * @return MemberModelInterface
     */
    public function setBio($bio);

    /**
     * Get bio.
     *
     * @return string
     */
    public function getBio();

    /**
     * Get bio data.
     *
     * @return string
     */
    public function getBioData();

    /**
     * Set confirmed.
     *
     * @param bool $confirmed
     *
     * @return MemberModelInterface
     */
    public function setConfirmed($confirmed);

    /**
     * Is confirmed.
     *
     * @return bool
     */
    public function isConfirmed();

    /**
     * Set full name.
     *
     * @param string $fullName
     *
     * @return MemberModelInterface
     */
    public function setFullName($fullName);

    /**
     * Get full name.
     *
     * @return string
     */
    public function getFullName();

    /**
     * Set id prem orgs admin.
     *
     * @return MemberModelInterface
     */
    public function setIdPremOrgsAdmin(array $idPremOrgsAdmin);

    /**
     * Get idPremOrgsAdmin.
     *
     * @return array
     */
    public function getIdPremOrgsAdmin();

    /**
     * Set Initials.
     *
     * @param string $initials
     *
     * @return MemberModelInterface
     */
    public function setInitials($initials);

    /**
     * Get initials.
     *
     * @return string
     */
    public function getInitials();

    /**
     * Set MemberType.
     *
     * @param string $memberType
     *
     * @return MemberModelInterface
     */
    public function setMemberType($memberType);

    /**
     * Get member type.
     *
     * @return string
     */
    public function getMemberType();

    /**
     * Set products.
     *
     * @return MemberModelInterface
     */
    public function setProducts(array $products);

    /**
     * Get products.
     *
     * @return string
     */
    public function getProducts();

    /**
     * Set status.
     *
     * @param string $status
     *
     * @return MemberModelInterface
     */
    public function setStatus($status);

    /**
     * Get status.
     *
     * @return string
     */
    public function getStatus();

    /**
     * Set url.
     *
     * @param string $url
     *
     * @return MemberModelInterface
     */
    public function setUrl($url);

    /**
     * Get url.
     *
     * @return string
     */
    public function getUrl();

    /**
     * Set username.
     *
     * @param string $username
     *
     * @return MemberModelInterface
     */
    public function setUsername($username);

    /**
     * Get username.
     *
     * @return string
     */
    public function getUsername();

    /**
     * Set avatar source.
     *
     * @param string $avatarSource
     *
     * @return MemberModelInterface
     */
    public function setAvatarSource($avatarSource);

    /**
     * Get avatar source.
     *
     * @return string
     */
    public function getAvatarSource();

    /**
     * Set email.
     *
     * @param string $email
     *
     * @return MemberModelInterface
     */
    public function setEmail($email);

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail();

    /**
     * Set gravatar hash.
     *
     * @param $gravatarHash
     *
     * @return MemberModelInterface
     */
    public function setGravatarHash($gravatarHash);

    /**
     * Get gravatar hash.
     *
     * @return string
     */
    public function getGravatarHash();

    /**
     * Set board ids.
     *
     * @return MemberModelInterface
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
     * Set pinned board ids.
     *
     * @return MemberModelInterface
     */
    public function setPinnedBoardIds(array $pinnedBoardIds);

    /**
     * Get pinned board ids.
     *
     * @return array
     */
    public function getPinnedBoardIds();

    /**
     * Get pinnedBoards.
     *
     * @return array|BoardModelInterface[]
     */
    public function getPinnedBoards();

    /**
     * Set organization ids.
     *
     * @return MemberModelInterface
     */
    public function setOrganizationIds(array $organizationIds);

    /**
     * Get organization ids.
     *
     * @return array
     */
    public function getOrganizationIds();

    /**
     * Get organizations.
     *
     * @return array\OrganizationInterface[]
     */
    public function getOrganizations();

    /**
     * Set login types.
     *
     * @param array $loginTypes
     *
     * @return MemberModelInterface
     */
    public function setLoginTypes($loginTypes);

    /**
     * Get login types.
     *
     * @return array
     */
    public function getLoginTypes();

    /**
     * Set new email.
     *
     * @param string $newEmail
     *
     * @return MemberModelInterface
     */
    public function setNewEmail($newEmail);

    /**
     * Set one time messages dismissed.
     *
     * @return MemberModelInterface
     */
    public function setOneTimeMessagesDismissed(array $messages);

    /**
     * Get one time messages dismissed.
     *
     * @return array
     */
    public function getOneTimeMessagesDismissed();

    /**
     * Set preferences.
     *
     * @return MemberModelInterface
     */
    public function setPreferences(array $prefs);

    /**
     * Get preferences.
     *
     * @return array
     */
    public function getPreferences();

    /**
     * Set trophies.
     *
     * @return MemberModelInterface
     */
    public function setTrophies(array $trophies);

    /**
     * Get trophies.
     *
     * @return array
     */
    public function getTrophies();

    /**
     * Set uploaded avatar hash.
     *
     * @param string $uploadedAvatarHash
     *
     * @return MemberModelInterface
     */
    public function setUploadedAvatarHash($uploadedAvatarHash);

    /**
     * Get uploaded avatar hash.
     *
     * @return string
     */
    public function getUploadedAvatarHash();

    /**
     * Set premium features.
     *
     * @return MemberModelInterface
     */
    public function setPremiumFeatures(array $features);

    /**
     * Get premiumFeatures.
     *
     * @return array
     */
    public function getPremiumFeatures();
}

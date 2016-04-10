<?php

namespace xREL\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\ResourceOwnerInterface;

class xRELResourceOwner implements ResourceOwnerInterface
{
    /**
     * Raw response.
     *
     * @var
     */
    protected $response;

    /**
     * Creates new resource owner.
     *
     * @param $response
     */
    public function __construct($response)
    {
        $this->response = $response;
    }

    /**
     * Get resource owner id.
     *
     * @return string|null
     */
    public function getId()
    {
        return $this->response['id'] ?: null;
    }

    /**
     * Return all of the owner details available as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->response;
    }

    /**
     * Get resource owner name.
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->response['name'] ?: null;
    }

    /**
     * Get resource owner avatar url.
     *
     * @return string|null
     */
    public function getAvatarUrl()
    {
        return $this->response['avatar_url'] ?: null;
    }
}

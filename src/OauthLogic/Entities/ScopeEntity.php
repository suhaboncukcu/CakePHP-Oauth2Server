<?php
namespace Oauth2Server\OauthLogic\Entities;

use League\OAuth2\Server\Entities\ScopeEntityInterface;
use League\OAuth2\Server\Entities\Traits\EntityTrait;

/**
 * Class ScopeEntity
 * @package Oauth2Server\OauthLogic\Entities
 */
class ScopeEntity implements ScopeEntityInterface
{
    use EntityTrait;

    /**
     * @return mixed
     */
    public function jsonSerialize()
    {
        return $this->getIdentifier();
    }
}

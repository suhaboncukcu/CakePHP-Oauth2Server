<?php
namespace Oauth2Server\OauthLogic\Entities;

use League\OAuth2\Server\Entities\Traits\EntityTrait;
use League\OAuth2\Server\Entities\UserEntityInterface;

/**
 * Class UserEntity
 * @package Oauth2Server\OauthLogic\Entities
 */
class UserEntity implements UserEntityInterface
{
    use EntityTrait;
}

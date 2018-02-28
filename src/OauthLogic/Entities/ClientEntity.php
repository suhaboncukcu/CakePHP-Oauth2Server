<?php
namespace Oauth2Server\OauthLogic\Entities;

use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Entities\Traits\ClientTrait;
use League\OAuth2\Server\Entities\Traits\EntityTrait;

/**
 * Class ClientEntity
 * @package Oauth2Server\OauthLogic\Entities
 */
class ClientEntity implements ClientEntityInterface
{
    use ClientTrait;
    use EntityTrait;
}

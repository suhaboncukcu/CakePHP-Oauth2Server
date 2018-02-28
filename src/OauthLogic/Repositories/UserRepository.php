<?php
namespace Oauth2Server\OauthLogic\Repositories;

use Cake\Core\Configure;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Repositories\UserRepositoryInterface;
use Oauth2Server\OauthLogic\Entities\UserEntity;

/**
 * Class UserRepository
 * @package Oauth2Server\OauthLogic\Repositories
 */
class UserRepository implements UserRepositoryInterface
{
    /**
     * @param string $username username
     * @param string $password password
     * @param string $grantType grant type
     * @param ClientEntityInterface $clientEntity client entity
     *
     * @return UserEntity
     */
    public function getUserEntityByUserCredentials(
        $username,
        $password,
        $grantType,
        ClientEntityInterface $clientEntity
    ) {

        /*
         * This method is called to validate a user’s credentials.
         *
         * You can use the grant type to determine if the user is permitted to use the grant type.
         *
         * You can use the client entity to determine to if the user is permitted to use the client.
         */

        $className = Configure::read('Oauth2Server.classes.userValidator');
        $userValidator = new $className();

        $validatedUser = $userValidator->validate($username, $password, $clientEntity->getIdentifier());

        if($validatedUser === false) {
            return;
        }

        $userIdentifier = Configure::read('Oauth2Server.identifiers.user');
        $user =   new UserEntity();
        $user->setIdentifier($validatedUser->{$userIdentifier});

        return $user;
    }
}

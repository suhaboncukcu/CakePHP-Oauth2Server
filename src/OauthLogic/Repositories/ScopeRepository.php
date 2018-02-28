<?php

namespace Oauth2Server\OauthLogic\Repositories;

use Cake\Core\Configure;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Repositories\ScopeRepositoryInterface;
use Oauth2Server\OauthLogic\Entities\ScopeEntity;

/**
 * Class ScopeRepository
 * @package Oauth2Server\OauthLogic\Repositories
 */
class ScopeRepository implements ScopeRepositoryInterface
{
    /**
     * @param string $identifier identifier
     *
     * This method is called to validate a scope. If the scope is valid validated you should return an instance of
     *
     * @return ScopeEntity
     */
    public function getScopeEntityByIdentifier($identifier)
    {
        $className = Configure::read('Oauth2Server.classes.scopeValidator');
        $scopeValidator = new $className();


        if($scopeValidator->getScope($identifier) === false) {
            return;
        }

        $scope =  new ScopeEntity();
        $scope->setIdentifier($identifier);

        return $scope;
    }

    /**
     * @param array $scopes scopes
     * @param string $grantType grant type
     * @param ClientEntityInterface $clientEntity client entity
     * @param null $userIdentifier user identifier
     *
     * @return array
     */
    public function finalizeScopes(
        array $scopes,
        $grantType,
        ClientEntityInterface $clientEntity,
        $userIdentifier = null
    ) {
        /*
         * This method is called right before an access token or authorization code is created.

         * Given a client, grant type and optional user identifier validate the set of scopes requested are valid and optionally append additional scopes or remove requested scopes.
         *
         * This method is useful for integrating with your own app’s permissions system.
         */

        $className = Configure::read('Oauth2Server.classes.scopeValidator');
        $scopeValidator = new $className();

        return $scopeValidator->validate($scopes, $clientEntity->getIdentifier(), $userIdentifier);

    }
}

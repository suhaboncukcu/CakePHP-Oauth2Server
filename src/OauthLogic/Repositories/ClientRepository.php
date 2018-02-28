<?php

namespace Oauth2Server\OauthLogic\Repositories;

use League\OAuth2\Server\Repositories\ClientRepositoryInterface;
use Oauth2Server\OauthLogic\Entities\ClientEntity;
use Cake\Core\Configure;

/**
 * Class ClientRepository
 * @package Oauth2Server\OauthLogic\Repositories
 */
class ClientRepository implements ClientRepositoryInterface
{
    /**
     * @param string $clientIdentifier client identifier
     * @param string $grantType grant type
     * @param null $clientSecret client secret
     * @param bool $mustValidateSecret must validate secret
     *
     * @return ClientEntity
     */
    public function getClientEntity($clientIdentifier, $grantType = null, $clientSecret = null, $mustValidateSecret = true)
    {
        /*
         * This method is called to validate a client’s credentials.
         *
         * The client secret may or may not be provided depending on the request sent by the client. The boolean $mustValidateSecret parameter will indicate whether or not the client secret must be validated. If the client is confidential (i.e. is capable of securely storing a secret) and $mustValidateSecret === true then the secret must be validated.
         *
         * You can use the grant type to determine if the client is permitted to use the grant type.
         *
         * If the client’s credentials are validated you should return an instance of \League\OAuth2\Server\Entities\Interfaces\ClientEntityInterface
         */


        /*
         * Try to get an instance of specified class for client validation
         */

        $className = Configure::read('Oauth2Server.classes.clientValidator');
        $clientValidator = new $className();


        if($mustValidateSecret === true &&
            $clientValidator->validate($clientIdentifier, $clientSecret) === false) {
            return;
        }

        $validatedClient = $clientValidator->getClient($clientIdentifier);


        $client =  new ClientEntity();
        $clientIdentifierKey =  Configure::read('Oauth2Server.identifiers.client');
        $client->setIdentifier($validatedClient->{$clientIdentifierKey});

        return $client;
    }
}

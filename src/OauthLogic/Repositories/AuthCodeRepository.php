<?php
namespace Oauth2Server\OauthLogic\Repositories;

use League\OAuth2\Server\Entities\AuthCodeEntityInterface;
use League\OAuth2\Server\Repositories\AuthCodeRepositoryInterface;
use Oauth2Server\OauthLogic\Entities\AuthCodeEntity;

/**
 * Class AuthCodeRepository
 * @package Oauth2Server\OauthLogic\Repositories
 */
class AuthCodeRepository implements AuthCodeRepositoryInterface
{

    /**
     * @return AuthCodeEntity
     */
    public function getNewAuthCode()
    {
        return new AuthCodeEntity();
    }

    /**
     * @param AuthCodeEntityInterface $authCodeEntity auth code entity
     *
     * @return void
     */
    public function persistNewAuthCode(AuthCodeEntityInterface $authCodeEntity)
    {
        /*
         * When a new auth code is created this method will be called. You don’t have to do anything here but for auditing you probably want to.
         *
         * The auth code entity passed in has a number of methods you can call which contain data worth saving to a database:
         *
         * getIdentifier() : string this is randomly generated unique identifier (of 80+ characters in length) for the auth code.
         * getExpiryDateTime() : \DateTime the expiry date and time of the auth code.
         * getUserIdentifier() : string|null the user identifier represented by the auth code.
         * getScopes() : ScopeEntityInterface[] an array of scope entities
         * getClient()->getIdentifier() : string the identifier of the client who requested the auth code.
         * The auth codes contain an expiry date and so will be rejected automatically if used when expired. You can safely clean up expired auth codes from your database.
         */
    }

    /**
     * @param string $codeId code id
     *
     * @return bool
     */
    public function isAuthCodeRevoked($codeId)
    {
        return false; //auth code is still ok.
    }

    /**
     * @param string $codeId code id
     *
     * @return void
     */
    public function revokeAuthCode($codeId)
    {
        /*
         * This method is called when an authorization code is exchanged for an access token. You can also use it in your own business logic.
         */
    }
}

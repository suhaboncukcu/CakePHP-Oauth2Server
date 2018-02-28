<?php
namespace Oauth2Server\OauthLogic\Repositories;

use League\OAuth2\Server\Entities\AccessTokenEntityInterface;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Repositories\AccessTokenRepositoryInterface;
use Oauth2Server\OauthLogic\Entities\AccessTokenEntity;

/**
 * Class AccessTokenRepository
 * @package Oauth2Server\OauthLogic\Repositories
 */
class AccessTokenRepository implements AccessTokenRepositoryInterface
{
    /**
     * @param ClientEntityInterface $clientEntity client entity
     * @param array $scopes scopes
     * @param null $userIdentifier user identifier
     *
     * @return AccessTokenEntity
     */
    public function getNewToken(ClientEntityInterface $clientEntity, array $scopes, $userIdentifier = null)
    {
        return new AccessTokenEntity();
    }

    /**
     * @param string $tokenId token id
     *
     * @return void
     */
    public function revokeAccessToken($tokenId)
    {
        /*
         * This method is called when a refresh token is used to reissue an access token. The original access token is revoked a new access token is issued.
         */
    }

    /**
     * @param AccessTokenEntityInterface $accessTokenEntity access token entity
     *
     * @return void
     */
    public function persistNewAccessToken(AccessTokenEntityInterface $accessTokenEntity)
    {
        /*
         * When a new access token is created this method will be called. You don’t have to do anything here but for auditing you probably want to.
         *
         * The access token entity passed in has a number of methods you can call which contain data worth saving to a database:
         *
         * getIdentifier() : string this is randomly generated unique identifier (of 80+ characters in length) for the access token.
         * getExpiryDateTime() : \DateTime the expiry date and time of the access token.
         * getUserIdentifier() : string|null the user identifier represented by the access token.
         * getScopes() : ScopeEntityInterface[] an array of scope entities
         * getClient()->getIdentifier() : string the identifier of the client who requested the access token.
         * JWT access tokens contain an expiry date and so will be rejected automatically when used. You can safely clean up expired access tokens from your database.
         *
         */
    }

    /**
     * @param string $tokenId token id
     *
     * @return bool
     */
    public function isAccessTokenRevoked($tokenId)
    {
        // false means token still works and true means it doesn't work anymore
        return false;
    }
}

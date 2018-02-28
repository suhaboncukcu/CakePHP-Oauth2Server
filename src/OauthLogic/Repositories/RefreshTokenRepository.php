<?php

namespace Oauth2Server\OauthLogic\Repositories;

use League\OAuth2\Server\Entities\RefreshTokenEntityInterface;
use League\OAuth2\Server\Repositories\RefreshTokenRepositoryInterface;
use Oauth2Server\OauthLogic\Entities\RefreshTokenEntity;

/**
 * Class RefreshTokenRepository
 * @package Oauth2Server\OauthLogic\Repositories
 */
class RefreshTokenRepository implements RefreshTokenRepositoryInterface
{
    /**
     * @return RefreshTokenEntity
     */
    public function getNewRefreshToken()
    {
        return new RefreshTokenEntity();
    }

    /**
     * @param RefreshTokenEntityInterface $refreshTokenEntity refresh token entity
     *
     * @return void
     */
    public function persistNewRefreshToken(RefreshTokenEntityInterface $refreshTokenEntity)
    {
        /*
         * When a new refresh token is created this method will be called. You don’t have to do anything here but for auditing you might want to.
         *
         * The refresh token entity passed in has a number of methods you can call which contain data worth saving to a database:
         *
         * getIdentifier() : string this is randomly generated unique identifier (of 80+ characters in length) for the refresh token.
         * getExpiryDateTime() : \DateTime the expiry date and time of the access token.
         * getAccessToken()->getIdentifier() : string the linked access token’s identifier.
         * JWT access tokens contain an expiry date and so will be rejected automatically when used. You can safely clean up expired access tokens from your database.
         */
    }

    /**
     * @param string $tokenId token id
     *
     * @return void
     */
    public function revokeRefreshToken($tokenId)
    {
        // This method is called when a refresh token is used to reissue an access token. The original refresh token is revoked a new refresh token is issued.
    }

    /**
     * @param string $tokenId token id
     *
     * @return bool
     */
    public function isRefreshTokenRevoked($tokenId)
    {
        // false means the token is still ok and not used.
        return false;
    }
}

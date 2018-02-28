<?php
namespace Oauth2Server\OauthLogic;

use Cake\Core\Configure;
use Cake\Http\Response;
use Cake\Http\ServerRequest;
use League\OAuth2\Server\AuthorizationServer;
use League\OAuth2\Server\Exception\OAuthServerException;
use League\OAuth2\Server\Grant\AuthCodeGrant;
use League\OAuth2\Server\Grant\ImplicitGrant;
use League\OAuth2\Server\Grant\PasswordGrant;
use League\OAuth2\Server\ResourceServer;
use Oauth2Server\OauthLogic\Entities\UserEntity;
use Oauth2Server\OauthLogic\Repositories\AccessTokenRepository;
use Oauth2Server\OauthLogic\Repositories\AuthCodeRepository;
use Oauth2Server\OauthLogic\Repositories\ClientRepository;
use Oauth2Server\OauthLogic\Repositories\RefreshTokenRepository;
use Oauth2Server\OauthLogic\Repositories\ScopeRepository;
use Oauth2Server\OauthLogic\Repositories\UserRepository;

/**
 * Class ServerUtility
 * @package Oauth2Server\OauthLogic
 */
class ServerUtility
{
    /**
     * @return AuthorizationServer
     */
    public function getPrivateServer()
    {
        $privateKey = Configure::read('Oauth2Server.privateKeyPath');
        $encryptionKey = Configure::read('Oauth2Server.encryptionKey');

        $clientRepository = new ClientRepository();
        $scopeRepository = new ScopeRepository();
        $accessTokenRepository = new AccessTokenRepository();
        $authCodeRepository = new AuthCodeRepository();
        $refreshTokenRepository = new RefreshTokenRepository();
        $userRepository = new UserRepository();

        $server = new AuthorizationServer(
            $clientRepository,
            $accessTokenRepository,
            $scopeRepository,
            $privateKey,
            $encryptionKey
        );

        $grant = new AuthCodeGrant(
            $authCodeRepository,
            $refreshTokenRepository,
            new \DateInterval('PT10M') // authorization codes will expire after 10 minutes
        );
        $grant->setRefreshTokenTTL(new \DateInterval('P1M'));
        $server->enableGrantType(
            $grant,
            new \DateInterval('PT1H') // access tokens will expire after 1 hour
        );

        $grant = new ImplicitGrant(new \DateInterval('PT1H'));
        $server->enableGrantType(
            $grant,
            new \DateInterval('PT1H') // access tokens will expire after 1 hour
        );

        $grant = new PasswordGrant(
            $userRepository,
            $refreshTokenRepository
        );
        $server->enableGrantType(
            $grant,
            new \DateInterval('PT1H')
        );

        return $server;
    }

    /**
     * @return ResourceServer
     */
    public function getPublicServer()
    {
        $accessTokenRepository = new AccessTokenRepository();

        $publicKeyPath = Configure::read('Oauth2Server.publicKeyPath');

        $server = new ResourceServer(
            $accessTokenRepository,
            $publicKeyPath
        );

        return $server;
    }

    /**
     * @param ServerRequest $request request
     * @param Response $response response
     * @param AuthorizationServer $server server
     *
     * @return \Psr\Http\Message\ResponseInterface|static
     */
    public function authorize(ServerRequest $request, Response $response, AuthorizationServer $server)
    {
        try {
            $authRequest = $server->validateAuthorizationRequest($request);
            $authRequest->setUser(new UserEntity());
            $authRequest->setAuthorizationApproved(true);

            return $server->completeAuthorizationRequest($authRequest, $response);
        } catch (OAuthServerException $exception) {
            return $exception->generateHttpResponse($response);
        } catch (\Exception $exception) {
            return $newResponse = $response->withStatus(500)->withStringBody($exception->getMessage());
        }
    }

    /**
     * @param ServerRequest $request request
     * @param Response $response response
     * @param AuthorizationServer $server server
     *
     * @return \Psr\Http\Message\ResponseInterface|static
     */
    public function accessToken(ServerRequest $request, Response $response, AuthorizationServer $server)
    {
        try {
            return $server->respondToAccessTokenRequest($request, $response);
        } catch (OAuthServerException $exception) {
            return $exception->generateHttpResponse($response);
        } catch (\Exception $exception) {
            return $newResponse = $response->withStatus(500)->withStringBody($exception->getMessage());
        }
    }
}

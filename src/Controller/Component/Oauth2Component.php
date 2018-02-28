<?php
namespace Oauth2Server\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

use Cake\Http\Response;
use Cake\Http\ServerRequest;
use Oauth2Server\OauthLogic\ServerUtility;

/**
 * Oauth2 component
 */
class Oauth2Component extends Component
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    /**
     * @var
     */
    private $server;

    /**
     * @param array $config config
     *
     * @return \League\OAuth2\Server\AuthorizationServer
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $serverUtility = new ServerUtility();

        $this->server = $serverUtility->getPrivateServer();

        return $this->server;
    }

    /**
     * @return \League\OAuth2\Server\ResourceServer
     */
    public function getPublicServer()
    {
        $serverUtility = new ServerUtility();

        $server = $serverUtility->getPublicServer();

        return $server;
    }

    /**
     * @param ServerRequest $request PSR compatible request object
     * @param Response $response PSR compatible response object
     *
     * @return \Psr\Http\Message\ResponseInterface|static
     */
    public function authorize(ServerRequest $request, Response $response)
    {
        $serverUtility = new ServerUtility();

        return $serverUtility->authorize($request, $response, $this->server);
    }

    /**
     * @param ServerRequest $request PSR compatible request object
     * @param Response $response PSR compatible response object
     *
     * @return \Psr\Http\Message\ResponseInterface|static
     */
    public function accessToken(ServerRequest $request, Response $response)
    {
        $serverUtility = new ServerUtility();

        return $serverUtility->accessToken($request, $response, $this->server);
    }
}

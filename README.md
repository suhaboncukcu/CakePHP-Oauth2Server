# Oauth2Server plugin for CakePHP

This plugin is intended to be an easy way to build an Oauth2 Server using [thephpleague/oauth2-server](http://oauth2.thephpleague.com/)

**!!Attention!!**
This plugin does not support refresh token repository yet. Access tokens are usable without any
expiration date. **use at your own risk!**

**PRs are more than welcome**

## How to use?

You can install this plugin into your CakePHP application using [composer](http://getcomposer.org).

#### 1. Use composer to install 

```
composer require suhaboncukcu/Oauth2Server
```

#### 2. Load the plugin

```
Plugin::load('Oauth2Server', ['bootstrap' => true, 'routes' => false]);
```

#### 3. Create your validators

**!!Attention!!** 

You can find example validator classes under `vendors\suhaboncukcu\Oauth2Server\src\OauthLogic\Validators`. 
You should copy and paste them to your desired location.

#### 4. Create & Update the config file

Copy & paste `vendors\suhaboncukcu\Oauth2Server\config\oauth2.php` to your config folder and update it. 

#### 5. Implement end points. 

```
// in one of your controllers

    // Auth endpoint 
    public function authorize()
    {
        $this->autoRender = false;


        $this->loadComponent('Oauth2Server.Oauth2');

        $response = $this->Oauth2->authorize($this->request, $this->response);
        $response = $response->withHeader('Content-Type', 'application/json');

        return $response;
    }
    
    // callback endpoint
    public function code()
    {
        $this->autoRender = false;
        $response = $this->response
            ->withHeader('Content-Type', 'application/json')
            ->withStringBody(json_encode([
                'code' => urldecode($this->request->getQuery('code'))
            ]));

        return $response;
    }
    
    // access token endpoint
    public function accessToken()
    {
        $this->autoRender = false;

        $this->loadComponent('Oauth2Server.Oauth2');


        $response = $this->Oauth2->accessToken($this->request, $this->response);
        $response = $response->withHeader('Content-Type', 'application/json');

        return $response;
    }
    
    
``` 

#### 6. Use middleware to secure your routes. 

```
// assuming you have a plugin named Api 

//\Api\config\routes
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

use League\OAuth2\Server\Middleware\ResourceServerMiddleware;
use Oauth2Server\OauthLogic\ServerUtility;

$serverUtility = new ServerUtility();
$server = $serverUtility->getPublicServer();


Router::plugin(
    'Api',
    ['path' => '/api'],
    function (RouteBuilder $routes) use ($server) {

        $routes->registerMiddleware('resourceServer', new ResourceServerMiddleware($server));
        $routes->middlewareGroup('Oauth2Stack', ['resourceServer']);

        $routes->applyMiddleware('Oauth2Stack');


        $routes->scope('/v1', function ($routes) {
            $routes->fallbacks(DashedRoute::class);
        });

    }
);

```

### 7. Use attributes to get total control in your actions if Validators are not enough
`$this->request->getAttributes()`






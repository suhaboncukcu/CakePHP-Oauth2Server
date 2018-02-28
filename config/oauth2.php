<?php

return [
  'Oauth2Server' => [
      'publicKeyPath' => ROOT . DS . 'keys/public.key', // openssl rsa -in private.key -pubout > public.key
      'privateKeyPath' => ROOT . DS . 'keys/private.key', // openssl genrsa -out private.key 1024
      'encryptionKey' => '+tJE/ZKz4qsViLyXX5pnQPq6kh4AflC/Nx/ULf6ag4I=', // base64_encode(random_bytes(32));
      'classes' => [
          'clientValidator' => 'Oauth2Server\OauthLogic\Validators\ClientValidator',
          'userValidator' => 'Oauth2Server\OauthLogic\Validators\UserValidator',
          'scopeValidator' => 'Oauth2Server\OauthLogic\Validators\ScopeValidator',
      ],
      'identifiers' => [
          'client' => 'id',
          'user' => 'id'
      ]
  ]
];

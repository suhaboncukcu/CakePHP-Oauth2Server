<?php
use Cake\Core\Configure;

Configure::load('Oauth2Server.oauth2');
collection((array)Configure::read('Oauth2Server.config'))->each(function ($file) {
    Configure::load($file);
});

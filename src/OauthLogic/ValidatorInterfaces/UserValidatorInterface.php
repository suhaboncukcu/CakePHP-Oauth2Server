<?php
namespace Oauth2Server\OauthLogic\ValidatorInterfaces;


/**
 * Interface UserValidatorInterface
 * @package Oauth2Server\OauthLogic\ValidatorInterfaces
 */
interface UserValidatorInterface
{

    /**
     * @param $username
     * @param $password
     * @param $clientIdentifier
     *
     * @return mixed
     */
    public function validate($username, $password, $clientIdentifier);
}
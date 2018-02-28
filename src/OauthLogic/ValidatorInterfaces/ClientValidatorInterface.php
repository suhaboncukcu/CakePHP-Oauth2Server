<?php
namespace Oauth2Server\OauthLogic\ValidatorInterfaces;


/**
 * Interface ClientValidatorInterface
 * @package Oauth2Server\OauthLogic\ValidatorInterfaces
 */
interface ClientValidatorInterface
{
    /**
     * @param $clientIdentifier
     * @param $grantType
     * @param null $clientSecret
     *
     * @return mixed
     */
    public function validate($clientIdentifier, $clientSecret = null);


    /**
     * @param $clientIdentifier
     *
     * @return mixed
     */
    public function getClient($clientIdentifier);
}
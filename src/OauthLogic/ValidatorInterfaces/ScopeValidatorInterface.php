<?php
namespace Oauth2Server\OauthLogic\ValidatorInterfaces;


/**
 * Interface ScopeValidatorInterface
 * @package Oauth2Server\OauthLogic\ValidatorInterfaces
 */
interface ScopeValidatorInterface
{

    /**
     * @param array $scopes
     * @param $clientIdentifier
     * @param $userIdentifier
     *
     * @return array
     */
    public function validate(array $scopes, $clientIdentifier, $userIdentifier);

    /**
     * @param $scopeIdentifier
     *
     * @return mixed
     */
    public function getScope($scopeIdentifier);
}
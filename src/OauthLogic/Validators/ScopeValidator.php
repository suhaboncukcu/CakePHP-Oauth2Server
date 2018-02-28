<?php
namespace Oauth2Server\OauthLogic\Validators;

use Oauth2Server\OauthLogic\ValidatorInterfaces\ScopeValidatorInterface;

/**
 * Class ScopeValidator
 * @package App\Logic
 */
class ScopeValidator implements ScopeValidatorInterface
{
    /**
     * @param array $scopes
     * @param $clientIdentifier
     * @param $userIdentifier
     *
     * @return array
     */
    public function validate(array $scopes, $clientIdentifier, $userIdentifier)
    {
        if(!is_null($scopes)
            && !is_null($clientIdentifier)
            && !is_null($userIdentifier)) {
            // @todo validate user scopes here. filter if necessary
            // each scope is Oauth2Server\OauthLogic\Entities\ScopeEntity instance

            return $scopes;
        }


        return [];
    }

    /**
     * @param $scopeIdentifier
     */
    public function getScope($scopeIdentifier)
    {
        if(!is_null($scopeIdentifier)) {
            // @todo check if this scope is a valid scope.
            return true;
        }

        return false;
    }


}
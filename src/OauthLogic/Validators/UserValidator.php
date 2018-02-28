<?php
namespace Oauth2Server\OauthLogic\Validators;

use Oauth2Server\OauthLogic\ValidatorInterfaces\UserValidatorInterface;

/**
 * Class UserValidator
 * @package App\Logic
 */
class UserValidator implements UserValidatorInterface
{
    /**
     * @param $username
     * @param $password
     * @param $clientIdentifier
     *
     * @return mixed
     */
    public function validate($username, $password, $clientIdentifier)
    {
        if(!is_null($username)
            && !is_null($password)
            && !is_null($clientIdentifier)) {
            // @todo validate user here.

            $user = new \stdClass();
            $user->id = 1;

            return $user;
        }


        return false;
    }

}
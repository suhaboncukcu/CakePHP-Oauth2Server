<?php
namespace Oauth2Server\OauthLogic\Validators;
use Oauth2Server\OauthLogic\ValidatorInterfaces\ClientValidatorInterface;

/**
 * Class ClientValidator
 * @package App\Logic
 */
class ClientValidator implements ClientValidatorInterface
{
    /**
     * @param $clientIdentifier
     * @param null $clientSecret
     *
     * @return bool
     */
    public function validate($clientIdentifier, $clientSecret = null)
    {
        if(is_null($clientSecret)) {
            return false;
        }

        //  @todo:  validate your client here.

        return true;
    }

    /**
     * @param $clientIdentifier
     *
     * @return \stdClass
     */
    public function getClient($clientIdentifier)
    {
        // @todo: get your client from your table here
        $client = new \stdClass();
        $client->id = 1;

        return $client;
    }

}
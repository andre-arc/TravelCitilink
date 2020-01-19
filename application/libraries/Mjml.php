<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
use Mjml\Client;

class Mjml {

    const applicationId = 'fe7e5cf1-73ae-4710-80d2-ea82561d1b42';
    const secretKey = '8fb09efd-0979-426c-9eb8-6eb90bd39c62';

    public function render($mjml) {
        $client = new Client($applicationId, $secretKey);
        return $client->render($mjml);
    }

}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

use Mjml\Client;

class Mjml {

    private $applicationId = 'fe7e5cf1-73ae-4710-80d2-ea82561d1b42';
    private $secretKey = '8fb09efd-0979-426c-9eb8-6eb90bd39c62';

    public function render($mjml) {
        $client = new Client($this->applicationId, $this->secretKey);
        return $client->render($mjml);
    }

}
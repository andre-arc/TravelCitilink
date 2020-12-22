<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Tiket extends RestController {
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
    }

    public function index_get()
    {
        // Users from a data store e.g. database
        $tiket = $this->db->query('select * from tiket ')->result();

        $id = $this->get( 'id' );

        if ( $id === null )
        {
            // Check if the users data store contains users
            if ( $tiket )
            {
                // Set the response and exit
                $this->response( $tiket, 200 );
            }
            else
            {
                // Set the response and exit
                $this->response( [
                    'status' => false,
                    'message' => 'No users were found'
                ], 404 );
            }
        }
        else
        {
            if ( array_key_exists( $id, $tiket ) )
            {
                $this->response( $tiket[$id], 200 );
            }
            else
            {
                $this->response( [
                    'status' => false,
                    'message' => 'No such user found'
                ], 404 );
            }
        }
    }
}
<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Users45 extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_users');
    }
    public function index_get()
    {

        $id = $this->get('id');
        // $password = $this->get('field_password');

        if ($id === null) {
            # code...
            // $customer = $this->M_users->getUsers();

            $this->response([
                'status' => FALSE,
                'message' => 'No Users'
            ], REST_Controller::HTTP_NOT_FOUND);
        } else {
            # code...
            $customer = $this->M_users->getUsers($id);
          
        }




        if ($customer) {
            $this->response([
                'Status' => true,
                'Data' => $customer
            ], REST_Controller::HTTP_OK);
        } else {

            $this->response([
                'Status' => false,
                'Message' => 'No cutomer were found'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
}

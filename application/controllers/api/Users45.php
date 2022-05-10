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
        $this->load->model('M_users','U');
    }

    public function index_get()
    {

        $email = $this->get('email');
        //$email = 'musaeri1807@gmail.com';
        $password = $this->get('password');

        // // $data['password'] = $this->M_users->getUsers($email);

        // $password = $this->M_users->getUsers($email);

        // // extract($password);
        // // print_r($field_password);

        // var_dump($password);
        // die();



        if ($email === null or $password === null) {
            # code...
            // $customer = $this->M_users->getUsers();

            $this->response([
                'status' => FALSE,
                'message' => 'No Users'
            ], REST_Controller::HTTP_NOT_FOUND);
        } else {
            # code...
            $customer = $this->U->getUsers($email, $password);
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

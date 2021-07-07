<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Customer extends REST_Controller
{
   public function __construct()
   {
       parent::__construct();
       $this->load->model('Customer_model','custm');
   }
    public function index_get()
    {

        $id=$this->get('id');
        if ($id===null) {
            // $customer =$this->custm->getCustomer();  
            $this->response([
                'Status'=>false,                
                'Message'=>'No saldo were found'
            ],REST_Controller::HTTP_NOT_FOUND);          
        }else{
            $customer =$this->custm->getCustomer($id);
        }
        // var_dump($customer);
        // if ($customer) {
        //     $this->response($customer, REST_Controller::HTTP_OK);
        // }
         if ($customer) {
            $this->response([
                'Status'=>true,                
                'Data'=>$customer
            ],REST_Controller::HTTP_OK);
         }else{

            $this->response([
                'Status'=>false,                
                'Message'=>'No cutomer were found'
            ],REST_Controller::HTTP_NOT_FOUND);
         }
         
    }


} 
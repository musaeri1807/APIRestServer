<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Saldo extends REST_Controller
{
   public function __construct()
   {
       parent::__construct();
       $this->load->model('M_Saldo','saldo');
   }
    public function customers_get()
    {

        $id=$this->get('member_id');
        if ($id===null) {
            $saldo =$this->saldo->getSaldo();  
            // $this->response([
            //     'Status'=>false,                
            //     'Message'=>'No ID saldo were found'
            // ],REST_Controller::HTTP_NOT_FOUND);          
        }else{
            $saldo =$this->saldo->getSaldo($id);
        }
        // var_dump($customer);
        // if ($customer) {
        //     $this->response($customer, REST_Controller::HTTP_OK);
        // }
         if ($saldo) {
            $this->response([
                'Status'=>true,                
                'Data'=>$saldo
            ],REST_Controller::HTTP_OK);
         }else{

            $this->response([
                'Status'=>false,                
                'Message'=>'No cutomer were found'
            ],REST_Controller::HTTP_NOT_FOUND);
         }
         
    }


} 
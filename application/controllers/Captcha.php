<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Captcha extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('captcha_model', 'model');
    }

    function index()
    {
        $this->load->view('captcha');
    }

    function validate()
    {
        $captcha_response = trim($this->input->post('g-recaptcha-response'));



        if ($captcha_response != '') {


            if ($_SERVER['SERVER_NAME'] == 'localhost') {
                $keySecret = "6LfJec4ZAAAAACG1-fmobe88erF72OdXbAFN71jj"; //local        
            } elseif ($_SERVER['SERVER_NAME'] == 'urunanmu.my.id') {
                $keySecret = "6Ldi1lsaAAAAAELsOlpS__1jUbNTuXv0bbjhpD6L"; //urunanmu.my.id
            } elseif ($_SERVER['SERVER_NAME'] == 'nyimasantam.com') {
                $keySecret = "6Lf6eR0aAAAAABFKOeUrFysV3fvrrWcoTayg3R2j"; //nyimasantam.com
            } elseif ($_SERVER['SERVER_NAME'] == 'nyimasantam.my.id') {
                $keySecret = "6Lc9f84ZAAAAAEBSnQvoHzWcPvD0Tqcn0HD0izsO"; //nyimasantam.my.id
            } elseif ($_SERVER['SERVER_NAME'] == 'musaeri.my.id') {
                $keySecret = "6LdCXhcbAAAAABj_ExKExLI_0h_1uz7tSCYdDHM-"; //musaeri.my.id
            }

            $check = array(
                'secret'          =>    $keySecret,
                'response'        =>    $this->input->post('g-recaptcha-response')
            );

            $startProcess = curl_init();
            curl_setopt($startProcess, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
            curl_setopt($startProcess, CURLOPT_POST, true);
            curl_setopt($startProcess, CURLOPT_POSTFIELDS, http_build_query($check));
            curl_setopt($startProcess, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($startProcess, CURLOPT_RETURNTRANSFER, true);
            $receiveData = curl_exec($startProcess);
            $finalResponse = json_decode($receiveData, true);

            if ($finalResponse['success']) {
                $storeData = array(
                    'first_name'         =>    $this->input->post('first_name'),
                    'last_name'          =>    $this->input->post('last_name'),
                    'age'                =>    $this->input->post('age'),
                    'gender'             =>    $this->input->post('gender')
                );
                echo $storeData['first_name'];
                echo '<br>';
                echo $storeData['last_name'];
                echo '<br>';
                echo $storeData['age'];
                echo '<br>';
                echo $storeData['gender'];
                echo '<br>';

                $customer = $this->model->getdata();

                //var_dump($customer);
                echo $customer['field_customer_id'];

                // $this->captcha_model->insert($storeData);

                // $this->session->set_flashdata('success_message', 'Data Stored Successfully');

                // redirect('captcha');
                //echo "Jika data email atau hp tidak ada insert ke database jika lain keluarkan pesan data sudah ada ";
                //echo " create Session Login";
            } else {
                $this->session->set_flashdata('message', 'Validation Fail Try Again');
                redirect('captcha');
            }
        } else {
            $this->session->set_flashdata('message', 'Validation Fail Try Again V');
            redirect('captcha');
        }
    }
}

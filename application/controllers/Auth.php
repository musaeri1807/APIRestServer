<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->model('M_auth');
        $this->load->library('form_validation');
        // $this->load->model('M_branch');
    }

    public function index()
    {
        // $session = $this->session->userdata('status');

        // if ($session == '') {
        //     $this->load->view('auth/login');
        // } else {
        //     redirect('Home');
        // }
        $this->load->view('auth/login');
    }

    public function login()
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
                    'first_name'         =>    $this->form_validation->set_rules('txt_username', 'Username', 'required|min_length[4]|max_length[15]'),
                    'last_name'          =>    $this->form_validation->set_rules('txt_password', 'Password', 'required'),
                    // 'age'                =>    $this->input->post('age'),
                    // 'gender'             =>    $this->input->post('gender')
                );

                echo $storeData['first_name'];
                echo '<br>';
                echo $storeData['last_name'];
                echo '<br>';


                //$select='SELECT * FROM tbluserlogin WHERE field_email=:uemail OR field_handphone=:uname';

                // $customer = $this->model->getdata()->result_array();

                // var_dump($customer);
                // echo $customer['field_customer_id'];

                // $this->captcha_model->insert($storeData);

                // $this->session->set_flashdata('success_message', 'Data Stored Successfully');

                // redirect('captcha');
                //echo "Jika data email atau hp tidak ada insert ke database jika lain keluarkan pesan data sudah ada ";
                //echo " create Session Login";


                // if ($this->form_validation->run() == TRUE) {
                //     $username = trim($_POST['username']);
                //     $password = trim($_POST['password']);

                //     $data = $this->M_auth->login($username, $password);

                //     if ($data == false) {
                //         $this->session->set_flashdata('error_msg', 'Username / Password Anda Salah.');
                //         redirect('Auth');
                //     } else {
                //         $session = [
                //             'userdata' => $data,
                //             'status' => "Loged in"
                //         ];
                //         $this->session->set_userdata($session);
                //         redirect('Home');
                //     }
                // } else {
                //     $this->session->set_flashdata('error_msg', validation_errors());
                //     redirect('Auth');
                // }

            } else {
                $this->session->set_flashdata('message', 'Validation Fail Try Again');
                redirect('Auth');
            }
        } else {
            $this->session->set_flashdata('message', 'Please Check reCAPTCHA');
            redirect('Auth');
        }
    }

    public function registration()
    {
        

        $sql="SELECT * FROM tblbranch WHERE field_branch_id !='3172090008'";            
        $data['branch'] = $this->db->query($sql)->result_array();
        
        if ($this->session->userdata('email')) {
            redirect('user');
        }

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'This email has already registered!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password dont match!',
            'min_length' => 'Password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'NA User Registration';
            // $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration',$data);
            // $this->load->view('templates/auth_footer');
        } else {
            $email = $this->input->post('email', true);
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($email),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 0,
                'date_created' => time()
            ];

            // siapkan token
            $token = base64_encode(random_bytes(32));
            $user_token = [
                'email' => $email,
                'token' => $token,
                'date_created' => time()
            ];

            $this->db->insert('user', $data);
            $this->db->insert('user_token', $user_token);

            $this->_sendEmail($token, 'verify');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congratulation! your account has been created. Please activate your account</div>');
            redirect('auth');
        }
    }

    public function forgotPassword()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Forgot Password';
            // $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/forgot-password');
            // $this->load->view('templates/auth_footer');
        } else {
            $email = $this->input->post('email');
            $user = $this->db->get_where('user', ['email' => $email, 'is_active' => 1])->row_array();

            if ($user) {
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];

                $this->db->insert('user_token', $user_token);
                $this->_sendEmail($token, 'forgot');

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Please check your email to reset your password!</div>');
                redirect('auth/forgotpassword');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email is not registered or activated!</div>');
                redirect('auth/forgotpassword');
            }
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('Auth');
    }
}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */
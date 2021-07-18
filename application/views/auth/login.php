<?php
defined('BASEPATH') or exit('No direct script access allowed');


//$username = $_POST['username']; nyimasantam.my.id
if ($_SERVER['SERVER_NAME'] == 'localhost') {
    $secretKey = "6LfJec4ZAAAAACG1-fmobe88erF72OdXbAFN71jj"; //local        
} elseif ($_SERVER['SERVER_NAME'] == 'urunanmu.my.id') {
    $secretKey = "6Ldi1lsaAAAAAELsOlpS__1jUbNTuXv0bbjhpD6L"; //urunanmu.my.id
} elseif ($_SERVER['SERVER_NAME'] == 'nyimasantam.com') {
    $secretKey = "6Lf6eR0aAAAAABFKOeUrFysV3fvrrWcoTayg3R2j"; //nyimasantam.com
} elseif ($_SERVER['SERVER_NAME'] == 'nyimasantam.my.id') {
    $secretKey = "6Lc9f84ZAAAAAEBSnQvoHzWcPvD0Tqcn0HD0izsO"; //nyimasantam.my.id
} elseif ($_SERVER['SERVER_NAME'] == 'musaeri.my.id') {
    $secretKey = "6LdCXhcbAAAAABj_ExKExLI_0h_1uz7tSCYdDHM-"; //musaeri.my.id
} elseif ($_SERVER['SERVER_NAME'] == 'my.musaeri.my.id') {
    $secretKey = "6LcVVqAbAAAAAD5hBRS3bm09fWt_6EKYEE6M65JE"; //musaeri.my.id
}


?>



<!DOCTYPE html>

<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Silakan Login Dengan Aman" name="descriptison">
    <meta content="Login nyimasantam" name="keywords">

    <link href="https://nyimasantam.my.id/image/iconnyimas.png" rel="icon">
    <link href="https://nyimasantam.my.id/image/iconnyimas.png" rel="apple-touch-icon">

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <!-- <link rel="stylesheet" href="fonts/icomoon/style.css"> -->

    <!-- <link rel="stylesheet" href="css/owl.carousel.min.css"> -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/assetlogin/css/bootstrap.min.css">
    <!-- Style -->
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/assetlogin/css/style.css">

    <title>NYIMASANTAM</title>
</head>

<body>
    <div class="d-lg-flex half">
        <div class="bg" style="background-image: url('https://nyimasantam.my.id/image/bg_11.jpg');"></div>
        <div class="contents">

            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-6">
                        <div class="form mx-auto">
                            <!--    <div class="form-block mx-auto"> -->

                            <div class="text-center mt-1">
                                <img src="https://nyimasantam.my.id/image/iconnyimas.png" width="100">
                                <br>

                                <?php
                                if ($this->session->flashdata('message')) {
                                ?>
                                    <div class="alert alert-danger">
                                        <?php
                                        echo $this->session->flashdata('message');
                                        ?>
                                    </div>
                                <?php
                                }

                                if ($this->session->flashdata('success_message')) {
                                ?>
                                    <div class="alert alert-success">
                                        <?php
                                        echo $this->session->flashdata('success_message');
                                        ?>
                                    </div>
                                <?php
                                }
                                ?>
                                <h3 style="text-align: left;">Hi Silakan Login</h3>

                                <br>

                            </div>

                            <form method="post" class="form-horizontal" action="<?php echo base_url('auth/login'); ?>">
                                <div class="form-group first">
                                    <!-- <label for="username">Username</label> -->
                                    <!-- <input type="text" class="form-control" placeholder="your-email@gmail.com" id="username"> -->
                                    <input type="text" name="txt_username" class="form-control" placeholder="Your Email Or Handphone" />
                                </div>
                                <div class="form-group last mb-3">
                                    <!-- <label for="password">Password</label> -->
                                    <!-- <input type="password" class="form-control" placeholder="Your Password" id="password"> -->
                                    <input type="password" name="txt_password" class="form-control" placeholder="Password" />
                                </div>

                                <div class="d-sm-flex mb-4 align-items-center">
                                    <?php
                                    if ($_SERVER['SERVER_NAME'] == 'localhost') {
                                        echo '<div class="g-recaptcha" data-sitekey="6LfJec4ZAAAAAPYZt2c-p6gu37D6weYdI8Kw1LqA"></div>';
                                    } elseif ($_SERVER['SERVER_NAME'] == 'urunanmu.my.id') {
                                        echo '<div class="g-recaptcha" data-sitekey="6Ldi1lsaAAAAALAritGVdd7xOXdf_mglkssD9RjR"></div>';
                                    } elseif ($_SERVER['SERVER_NAME'] == 'nyimasantam.com') {
                                        echo '<div class="g-recaptcha" data-sitekey="6Lf6eR0aAAAAAAXiPck77ymXUnqtLYj1dvtlli1B"></div>';
                                    } elseif ($_SERVER['SERVER_NAME'] == 'nyimasantam.my.id') {
                                        echo '<div class="g-recaptcha" data-sitekey="6Lc9f84ZAAAAANDLO3VFPiJEsa1trW4PwdE5fX0U"></div>';
                                    } elseif ($_SERVER['SERVER_NAME'] == 'musaeri.my.id') {
                                        echo '<div class="g-recaptcha" data-sitekey="6LdCXhcbAAAAAKhaHQouGGvtU6u4fJUSx8dpQUGv"></div>';
                                    } elseif ($_SERVER['SERVER_NAME'] == 'my.musaeri.my.id') {
                                        echo '<div class="g-recaptcha" data-sitekey="6LcVVqAbAAAAAAwZZhTx2O_hJx4es6gPFIpWSHBu"></div>';
                                    }

                                    ?>
                                </div>
                                <input type="submit" name="btn_login" class="btn btn-primary" value="Login">&emsp;&emsp;&emsp;&emsp;
                                <a href="<?= base_url('auth/forgotpassword'); ?>" style="text-decoration: none">Forgot Password ?</a>

                            </form>

                            <hr>
                            Belum Punya Akun Nyimas Antam ? <a href="<?= base_url('auth/registration'); ?>">Daftar Disini</a>

                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>

                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="<?= base_url('assets'); ?>/assetlogin/js/jquery-3.3.1.min.js"></script>
    <script src="<?= base_url('assets'); ?>/assetlogin/js/popper.min.js"></script>
    <script src="<?= base_url('assets'); ?>/assetlogin/js/bootstrap.min.js"></script>
    <script src="<?= base_url('assets'); ?>/assetlogin/js/main.js"></script>
</body>

</html>
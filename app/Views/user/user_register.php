<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Mochachino admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin dashboard.">
    <meta name="keywords" content="admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
    <meta name="author" content="PIXINVENT">
    <title>Mochachino System | Employee Registration</title>
    <link rel="apple-touch-icon" href="<?=base_url('/')?>/app-assets/images/logo/LogoWithoutText.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?=base_url('/')?>/app-assets/images/logo/LogoWithoutText.png">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?=base_url('/')?>/app-assets/fonts/material-icons/material-icons.css">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="<?=base_url('/')?>/app-assets/vendors/css/material-vendors.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url('/')?>/app-assets/vendors/css/forms/icheck/icheck.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url('/')?>/app-assets/vendors/css/forms/icheck/custom.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="<?=base_url('/')?>/app-assets/css/material.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url('/')?>/app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url('/')?>/app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url('/')?>/app-assets/css/material-extended.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url('/')?>/app-assets/css/material-colors.css">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="<?=base_url('/')?>/app-assets/css/core/menu/menu-types/material-vertical-compact-menu.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url('/')?>/app-assets/css/core/colors/material-palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url('/')?>/app-assets/fonts/mobiriseicons/24px/mobirise/style.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url('/')?>/app-assets/css/pages/login-register.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?=base_url('/assets/css/style.css')?>">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->
<?php 
    $errors = [];
    if(session()->getFlashData('errors') != null): 
      $errors = session()->getFlashData('errors');
    endif;
?>
<!-- BEGIN: Body-->

<body class="vertical-layout vertical-compact-menu material-vertical-layout material-layout 1-column  bg-full-screen-image blank-page" data-open="click" data-menu="vertical-compact-menu" data-col="1-column">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-header row">
        </div>
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-body">
                <section class="row flexbox-container">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="col-lg-4 col-md-8 col-10 box-shadow-2 p-0">
                            
                            <?php if (session()->getFlashData('success') != null) : ?>
                                <div class="alert bg-success alert-icon-left alert-dismissible mb-2" role="alert">
                                    <span class="alert-icon"><i class="la la-thumbs-o-up"></i></span>
                                    <strong>Well done!</strong> <?= session()->getFlashData('success') ?>
                                </div>
                                <?php elseif (session()->getFlashData('error') != null) : ?>
                                <div class="alert bg-danger alert-icon-left alert-dismissible mb-2" role="alert">
                                    <span class="alert-icon"><i class="la la-thumbs-o-down"></i></span>
                                    <strong>Oh snap!</strong> <?= session()->getFlashData('error') ?>
                                </div>
                            <?php endif ?>

                            <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
                                <div class="card-header border-0">
                                    <div class="card-title text-center">
                                        <img src="<?=base_url('/')?>/app-assets/images/logo/logo200x75.png" alt="branding logo">
                                    </div>
                                    <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2"><span>Easily Using</span></h6>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form-horizontal" action="<?=base_url('/register')."?emp_id=".$_GET['emp_id']?>" method="post">
                                            <?= csrf_field() ?>
                                            <div class="row">
                                                <div class="col-12 col-sm-12 col-md-12">
                                                    <fieldset class="form-group position-relative has-icon-left">
                                                        <input type="text" class="form-control" name="fullname" value="<?=$employee['name']?>" readonly="">
                                                        <div class="form-control-position">
                                                            <i class="la la-user"></i>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                                <div class="col-12 col-sm-6 col-md-6">
                                                    <fieldset class="form-group position-relative has-icon-left">
                                                        <input type="text" class="form-control <?= isset($errors['emp_id']) ? 'is-invalid' : ''; ?>" name="emp_id" value="<?=$employee['emp_id']?>" readonly="">
                                                        <?php if(isset($errors['emp_id'])) : ?>
                                                            <p class="invalid-feedback">
                                                              <?= $errors['emp_id'] ?>
                                                            </p>
                                                        <?php endif ?>
                                                        <div class="form-control-position">
                                                            <i class="la la-creative-commons"></i>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                                <div class="col-12 col-sm-6 col-md-6">
                                                    <fieldset class="form-group position-relative has-icon-left">
                                                        <input type="text" class="form-control <?= isset($errors['mobile']) ? 'is-invalid' : ''; ?>" name="mobile" value="<?=$employee['mobile']?>" readonly="">
                                                        <?php if(isset($errors['mobile'])) : ?>
                                                            <p class="invalid-feedback">
                                                              <?= $errors['mobile'] ?>
                                                            </p>
                                                        <?php endif ?>
                                                        <div class="form-control-position">
                                                            <i class="la la-mobile"></i>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                                <div class="col-12 col-sm-6 col-md-6">
                                                    <fieldset class="form-group position-relative has-icon-left">
                                                        <input type="email" class="form-control <?= isset($errors['email']) ? 'is-invalid' : ''; ?>" placeholder="Your email" required name="email" value="<?=old('email')?>" />
                                                        <?php if(isset($errors['email'])) : ?>
                                                            <p class="invalid-feedback">
                                                              <?= $errors['email'] ?>
                                                            </p>
                                                        <?php endif ?>
                                                        <div class="form-control-position">
                                                            <i class="la la-user"></i>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                                <div class="col-12 col-sm-6 col-md-6">
                                                    <fieldset class="form-group position-relative has-icon-left">
                                                        <input name="password" type="password" class="form-control" id="password" placeholder="password" required="true" />
                                                        <?php if(isset($errors['password'])) : ?>
                                                            <p class="invalid-feedback">
                                                              <?= $errors['password'] ?>
                                                            </p>
                                                        <?php endif ?>
                                                        <div class="form-control-position">
                                                        <i class="la la-eye-slash" id="togglePassword"></i>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                            </div>
                                            <input type="hidden" name="user_type" value="employee">
                                            <input type="hidden" name="avatar" value="<?=$employee['avatar']?>">
                                            <button type="submit" class="btn btn-outline-info btn-block"><i class="ft-unlock"></i> Register</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="<?=base_url('/')?>/app-assets/vendors/js/material-vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="<?=base_url('/')?>/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js"></script>
    <script src="<?=base_url('/')?>/app-assets/vendors/js/forms/icheck/icheck.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="<?=base_url('/')?>/app-assets/js/core/app-menu.js"></script>
    <script src="<?=base_url('/')?>/app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="<?=base_url('/')?>/app-assets/js/scripts/pages/material-app.js"></script>
    <script src="<?=base_url('/')?>/app-assets/js/scripts/forms/form-login-register.js"></script>
    <!-- END: Page JS-->

    <script type="text/javascript">
        const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#password");
        togglePassword.addEventListener("click", function () {
            // toggle the type attribute
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);
            // toggle the icon
            this.classList.toggle("la-eye");
        });
        // // prevent form submit
        // const form = document.querySelector("form");
        // form.addEventListener('submit',function(e){
        //     e.preventDefault();
        // });
    </script>

</body>
<!-- END: Body-->

</html>
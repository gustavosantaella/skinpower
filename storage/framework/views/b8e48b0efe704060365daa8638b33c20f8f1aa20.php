
<!DOCTYPE html >
<html lang="en"style="background-color:#ffe0e9!important;">

<head>

    <meta charset="utf-8">
    <meta http-equiv="Cache-Control" content="no-store" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>The Skin Power</title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo e(asset('css/fontawesome/css/all.min.css')); ?>" rel="stylesheet" type="text/css">
    <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo e(asset('css/sb-admin-2.css')); ?>" rel="stylesheet">

</head>

<body class="" style="background-color:#ffe0e9!important;">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5 ">
            <div class="card-body p-0 h-50">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Register!</h1>
                            </div>
                            <?php if($errors->any()): ?>
                           <div class="alert-danger rounded-bottom rounded-left rounded-right rounded-top p-3">
                                <ul>
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($element); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                           </div>
                           <?php elseif(session('message')): ?>
                             <div class="alert-info rounded-bottom rounded-left rounded-right rounded-top p-3">
                              <?php echo e(session('message')); ?>

                            </ul>
                           </div>
                            <?php endif; ?>
                            <form class="user" id="form" method="post" action="<?php echo e(url('User/Register')); ?>">
                               <?php echo csrf_field(); ?>

                               <fieldset class="form-group">
                                <label for="name" id="mailText">Your First</label>
                                <input required="" type="text" minlength="5" class="form-control val" id="name" name="name" placeholder="Your firt and last name...">
                                <small></small>
                            </fieldset>
                            <fieldset class="form-group">
                                <label for="name" id="mailText">Your First</label>
                                <input required="" type="text" minlength="5" class="form-control val" id="name" name="lastname" placeholder="Your last and last name...">
                                <small></small>
                            </fieldset>
                            <fieldset class="form-group">
                                <label for="mail" id="mailText">Email</label>
                                <input type="email"required="" minlength="5" class="form-control val" id="mail" name="email" placeholder="Email...">
                                <small></small>
                            </fieldset>
                            <fieldset class="form-group">
                                <label for="phone" id="mailText">Phone number</label>
                                <input type="tel"required="" class="form-control val"  minlength="13"value="+58" maxlength="13" id="phone" name="phone" placeholder="Phone number...">
                                <small>Your phone number, preferably with whatsapp </small>
                            </fieldset>
                            <fieldset class="form-group">
                                <label for="pass" id="passText">Password</label>
                                <input type="password" required=""class="form-control  val" minlength="6" name="pass" id="pass" placeholder="Password...">
                                <small>Password should be at least 6 characters</small>
                            </fieldset>
                            <input type="submit" class="btn btn-primary btn-user btn-block" name="registrar" value="Register" placeholder="">
                        </form>


                    </form>
                    <hr>

                    <div class="text-center">
                        <a class="small" href="<?php echo e(url('User/SignIn')); ?>">do u have a account?, Login!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>

<!-- Bootstrap core JavaScript-->
<script src="<?php echo e(asset('js/jquery/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/js-bootstrap/bootstrap.bundle.min.js')); ?>"></script>

<!-- Core plugin JavaScript-->
<script src="<?php echo e(asset('js/jquery/jquery-easing/jquery.easing.min.js')); ?>"></script>

<!-- Custom scripts for all pages-->
<script src="<?php echo e(asset('js/sb-admin-2.min.js')); ?>"></script>

</body>

</html><?php /**PATH /var/www/html/theskinpower/resources/views/Users/Register.blade.php ENDPATH**/ ?>
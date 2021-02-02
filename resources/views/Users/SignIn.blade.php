
<!DOCTYPE html>
<html lang="en" style="background-color:#ffe0e9!important;">
<head>

    <meta charset="utf-8">
    <meta http-equiv="Cache-Control" content="no-store" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>The Skin Power - Login</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('css/fontawesome/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet">

</head>

<body class="" style="background-color:#ffe0e9!important;">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->

                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome!</h1>
                                    </div>
                                    @if ($errors->any())
                                    <div class="alert-danger rounded-bottom rounded-left rounded-right rounded-top p-3 mb-2">
                                        <ul>
                                            @foreach ($errors->all() as $element)
                                            <li>{{$element}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @elseif(session('message'))
                                    <div class="alert-info rounded-bottom rounded-left rounded-right rounded-top p-3 font-weight-bold">
                                      {{session('message')}}
                                  </ul>
                              </div>
                              @elseif(session('resend'))
                              <div class="alert-info rounded-bottom rounded-left rounded-right rounded-top p-3 font-weight-bold">
                                     Tokken expired, <a href="{{ url('User/resendTokken') }}?id={{ session('resend')}}" title="resend email">send again</a>
                                  </ul>
                              </div>
                              @endif
                              <form class="user" method="post" id="form" action="{{ url('User/SignIn') }}">
                                @csrf
                                
                                <div class="form-group">
                                    <input type="email" required="" id="mail"  name="email" value="{{old('email')}}" class="form-control form-control-user val"
                                    id="exampleInputEmail" aria-describedby="emailHelp"
                                    placeholder="Email...">
                                </div>
                                <div class="form-group">
                                    <input type="password"required name="pass" id="pass" class="form-control form-control-user val"
                                    id="exampleInputPassword" placeholder="Password...">
                                </div>

                                <button type="submit"  class="btn btn-primary btn-user btn-block font-weight-bold" style="transition: all 1000ms" id="btn-send">

                                    Aceptar
                                </button>
                                <hr>

                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="{{ url('User/ForgotPassword') }}">¿Olvidó su contraseña?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="{{ url('User/Register') }}">Registrate</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

</div>

<!-- Bootstrap core JavaScript-->
<script src="{{ asset('js/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('js/js-bootstrap/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('js/jquery/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

</body>

</html>

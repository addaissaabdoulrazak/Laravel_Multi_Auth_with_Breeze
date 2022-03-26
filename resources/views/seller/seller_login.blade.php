<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Signin | Gull Admin Template</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
    <link href="{{(asset('dist-assets/css/themes/lite-purple.min.css'))}}" rel="stylesheet">
</head>


<div class="auth-layout-wrap" style="background-image: url(../../dist-assets/images/photo-wide-4.jpg)">

    <div class="auth-content">
        <div class="card o-hidden">
            @if(Session::has("error"))
            <div class="alert alert-danger" role="alert">
                {{session::get("error");}}

            </div>
            @elseif(Session::has("success"))
            <div class="alert alert-success" role="alert">

                {{session::get("success");}}
            </div>

            @endif
            <div class="row">
                <div class="col-md-6">
                    <div class="p-4">
                        <div class="auth-logo text-center mb-4"><img src="{{(asset('dist-assets/images/logo.png'))}}" alt=""></div>
                        <h1 class="mb-3 text-18">Sign In</h1>
                        <form method="post" action="{{route('seller.login')}}">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input name="email" class="form-control form-control-rounded" id="email" type="email">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input name="pass" class="form-control form-control-rounded" id="password" type="password">
                            </div>
                            <div class="form-group">
                                <a class="registration" href="{{route('seller.register')}}">Create new account</a><br>
                            </div>
                            <button class="btn btn-rounded btn-primary btn-block mt-2">Sign In</button>
                        </form>
                        <div class="mt-3 text-center"><a class="text-muted" href="{{route('seller.forgot')}}">
                                <u>Forgot Password?</u></a></div>
                    </div>

                </div>

                <div class="col-md-6 text-center" style="background-size: cover;background-image: url(../../dist-assets/images/photo-long-3.jpg)">
                    <div class="pr-3 auth-right"><a class="btn btn-rounded btn-outline-primary btn-outline-email btn-block btn-icon-text" href="signup.html"><i class="i-Mail-with-At-Sign"></i> Sign up with Email</a><a class="btn btn-rounded btn-outline-google btn-block btn-icon-text"><i class="i-Google-Plus"></i> Sign up with Google</a><a class="btn btn-rounded btn-block btn-icon-text btn-outline-facebook"><i class="i-Facebook-2"></i> Sign up with Facebook</a></div>
                </div>

            </div>

        </div>
    </div>
</div>
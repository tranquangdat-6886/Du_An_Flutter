<!DOCTYPE html>
<html lang="en">

<head>
    @include('backend.layouts.head')
    <title>Login</title>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-success">
            <div class="card-header text-center">
                <a href="https://www.facebook.com/profile.php?id=100033585273489" target="_black"
                    class="h1"><b>Admin</b>-CDSG</a>
            </div>
            <div class="card-body">
                <p class=" text-center text-danger" style="font-weight: bold;">
                    <?php
                    use Illuminate\Support\Facades\Session;
                    
                    $message = Session::get('message');
                    if ($message) {
                        echo $message;
                        Session::put('message', null); //chỉ cho message hiển thị một lần thôi
                    }
                    ?>
                </p>

                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="User" name="username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-success btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>




            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    @include('backend.layouts.script')
</body>

</html>

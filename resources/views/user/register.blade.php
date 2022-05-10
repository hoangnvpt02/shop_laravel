
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ $title }}</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="/assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/libs/css/style.css">
    <link rel="stylesheet" href="/assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
        }
    </style>
</head>

<body>
<form class="splash-container" action="/user/register" method="POST">
    <div class="card">
        <div class="card-header">
            <h3 class="mb-1">Registrations Form</h3>
            <p>Please enter your user information.</p>
        </div>
        <div class="card-body">
            @include('admin.alert')
            <div class="form-group">
                <input class="form-control form-control-lg" type="text" name="name" required="" placeholder="Name" autocomplete="off">
            </div>
            <div class="form-group">
                <input class="form-control form-control-lg" type="text" name="username" required="" placeholder="Username" autocomplete="off">
            </div>
            <div class="form-group">
                <input class="form-control form-control-lg" id="pass1" type="password" name="password" required="" placeholder="Password">
            </div>
            <div class="form-group">
                <input class="form-control form-control-lg" type="email" name="email" required="" placeholder="E-mail" autocomplete="off">
            </div>
            <div class="form-group">
                <input class="form-control form-control-lg" type="text" name="address" required="" placeholder="Address" autocomplete="off">
            </div>
            <div class="form-group">
                <input class="form-control form-control-lg" type="text" name="phone" required="" placeholder="Phone" autocomplete="off">
            </div>
            <div class="form-group">
                <label>Gender</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="active" name="gender" checked="">
                    <label for="active" class="custom-control-label">Male</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="no_active" name="gender">
                    <label for="no_active" class="custom-control-label">Female</label>
                </div>
            </div>
            <div class="form-group pt-2">
                <button class="btn btn-block btn-primary" type="submit">Register My Account</button>
            </div>
        </div>
        <div class="card-footer bg-white">
            <p>Already member? <a href="/user/login" class="text-secondary">Login Here.</a></p>
        </div>
    </div>
    @csrf
</form>
<!-- ============================================================== -->
<!-- end login page  -->
<!-- ============================================================== -->
<!-- Optional JavaScript -->
<script src="/assets/vendor/jquery/jquery-3.3.1.min.js"></script>
<script src="/assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
</body>

</html>

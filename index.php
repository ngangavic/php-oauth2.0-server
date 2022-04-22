<?php
require "db/Database.php";
require "db/User.php";

$user = new User();

if (isset($_POST['register'])) {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $user->email = $_POST['email'];
        $user->password = $_POST['password'];
        $user->AddUser();
    } else {
?>
        <script>
            alert("no data");
        </script>
        <?php
    }
}

if (isset($_POST['change-login'])) {
    $_SESSION['auth'] = "signin";
}

if (isset($_POST['change-register'])) {
    $_SESSION['auth'] = "signup";
}

if (isset($_POST['login'])) {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $user->email = $_POST['email'];
        $user->password = $_POST['password'];
        if ($user->Login()) {
            //
            header("location:dashboard.php");
        } else {
        ?>
            <script>
                alert("Wrong credentials");
            </script>
<?php
        }
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Sample Oauth</title>
</head>

<body>
    <div class="container">
        <?php if ($_SESSION['auth'] == 'signup') { ?>
            <h3 class="text-center">Sample Oauth Register</h3>
            <div class="card card-body">
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="exampleInputPassword1">
                    </div>

                    <button type="submit" class="btn btn-primary" name="register">Submit</button>
                    <button type="submit" class="btn btn-success" name="change-login">Login</button>
                </form>
            </div>
        <?php } else { ?>
            <h3 class="text-center">Sample Oauth Login</h3>
            <div class="card card-body">
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="exampleInputPassword1">
                    </div>

                    <button type="submit" class="btn btn-primary" name="login">Submit</button>
                    <button type="submit" class="btn btn-success" name="change-register">Register</button>
                </form>
            </div>
        <?php
        } ?>
    </div>
</body>

</html>
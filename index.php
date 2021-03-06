<?php
    include "authentication.php";
    if ($auth->isLoggedIn()) {
        header("location: displayData.php");
    }
?>
<!doctype html>
<html lang="en">
<head>
    <title>Untitled | Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body class="p-5">
<div class="container jumbotron my-5">
    <h1 class="h1">Untitled | Login</h1><hr>
    <form class="mt-5 mb-0" method="post">
        <div class="form-group">
            <label class="h5 mb-3" for="email">Email: </label><br>
            <input type="text" name="email" id="email" class="form-control">
        </div>
        <div class="form-group">
            <label class="h5 mb-3" for="password">Password: </label><br>
            <input type="password" name="password" id="password" class="form-control">
        </div>
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="rememberMe" id="rememberMe" value="checkedValue">
                Remember me
            </label>
        </div>
        <a class="form-text text-muted my-2 " href="">
            Forgot password?
        </a>
        <div class="form-group mb-0">
            <input type="submit" name="userLogin" id="userLogin" class="mt-4 mb-0 form-control btn-primary" value="Login">
        </div>
        <a type="submit" href="Register.php" name="userRegister" id="userRegister" class="mt-2 mb-0 form-control btn-info text-center text-light">Register</a>
    </form>
</div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <?php
        if(isset($_POST['userLogin'])){
            try {
                $rememberDuration = null;
                if(isset($_POST['rememberMe'])){
                    if ($_POST['rememberMe'] == 1) {
                        // keep logged in for one year
                        $rememberDuration = (int) (60 * 60 * 24 * 365.25);
                    }
                    else {
                        // do not keep logged in after session ends
                        $rememberDuration = null;
                    }
                }
                $auth->login($_POST['email'], $_POST['password'], $rememberDuration);
                echo 'User is logged in';
                header("location:displayData.php");
            }
            catch (\Delight\Auth\InvalidEmailException $e) {
                die('Wrong email address');
            }
            catch (\Delight\Auth\InvalidPasswordException $e) {
                die('Wrong password');
            }
            catch (\Delight\Auth\EmailNotVerifiedException $e) {
                die('Email not verified');
            }
            catch (\Delight\Auth\TooManyRequestsException $e) {
                die('Too many requests');
            } catch (\Delight\Auth\AttemptCancelledException $e) {
                die('Attempt cancelled');
            } catch (\Delight\Auth\AuthError $e) {
                die('Authentication error');
            }
        }
    ?>
</body>
</html>
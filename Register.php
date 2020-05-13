<?php
    include "authentication.php";
?>
<!doctype html>
<html lang="en">
<head>
    <title>Untitled | Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body class="p-5">
<div class="container jumbotron my-5">
    <h1 class="h1">Untitled | Register</h1><hr>
    <form class="mt-5 mb-0" method="post">
        <div class="form-group">
            <label class="h5 mb-3" for="username">Username: </label><br>
            <input type="text" name="username" id="username" class="form-control" required>
        </div>
        <div class="form-group">
            <label class="h5 mb-3" for="email">Email: </label><br>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label class="h5 mb-3" for="password">Password: </label><br>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <div class="form-group mb-0">
            <input type="submit" name="userRegister" id="userRegister" class="mt-4 mb-0 form-control btn-primary" value="Register">
        </div>
    </form>
</div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <?php
        if(isset($_POST['userRegister'])){
            try {
                $userId = $auth->register($_POST['email'], $_POST['password'], $_POST['username'], function ($selector, $token) {
                    echo 'Send ' . $selector . ' and ' . $token . ' to the user (e.g. via email)';
                });

                echo 'We have signed up a new user with the ID ' . $userId;
                echo "<br><a href='index.php'>To login page</a>";
            }
            catch (\Delight\Auth\InvalidEmailException $e) {
                die('Invalid email address');
            }
            catch (\Delight\Auth\InvalidPasswordException $e) {
                die('Invalid password');
            }
            catch (\Delight\Auth\UserAlreadyExistsException $e) {
                die('User already exists');
            }
            catch (\Delight\Auth\TooManyRequestsException $e) {
                die('Too many requests');
            } catch (\Delight\Auth\AuthError $e) {
                die('Authentication error');
            }
        }
    ?>
</body>
</html>
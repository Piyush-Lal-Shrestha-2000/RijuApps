<?php
    include "authentication.php";
    include "connection.php";
    if (!$auth->isLoggedIn()) {
        header("location: index.php");
    }
?>
<!doctype html>
<html lang="en">
    <head>
        <title>Untitled | Display</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <style>
            .container{
                margin-top: 100px;
            }
            #display a:hover{
                background-color: yellow;
            }
        </style>

    </head>
    <body>
        <?php
            include "header.php";
        ?>
        <div class="container">
            <div class="form-group">
                <label for="search" class="h4">Search</label>
                <input type="text" class="form-control" name="" id="search" aria-describedby="helpId" placeholder="Type a keyword to search">
                <small id="helpId" class="form-text text-muted">For test purpose, the search results are currently limited to 5.</small>
            </div>
            <div id="display"></div>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

        <!-- Including our scripting file. -->

        <script type="text/javascript" src="script.js"></script>
    </body>
    <?php
        include "footer.php";
    ?>
</html>
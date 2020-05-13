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
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<?php
    include "header.php";
?>
<div class="container">
    <?php
    $sql = "SELECT * FROM excel_data";
    $R = mysqli_query($C, $sql);
    while($row = mysqli_fetch_assoc($R)) {
        ?>

        <table class='table table-striped table-inverse table-responsive'>
            <thead class="thead-inverse">
            <tr>
                <th>ID</th>
                <th>SN</th>
                <th>Name</th>
            </tr>
            </thead>
            <?php
                foreach ($R as $row) { // ($row = mysqli_fetch_array($result))
            ?>
            <tbody>
            <tr>
                <td><?php  echo $row['excel_data_id']; ?></td>
                <td><?php  echo $row['symbol_no']; ?></td>
                <td><?php  echo $row['excel_name']; ?></td>
            </tr>
            <?php
                }
            ?>
            </tbody>
        </table>
        <?php
        }
        ?>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body><br><br><br><br>
<?php
    include "footer.php";
?>
</html>
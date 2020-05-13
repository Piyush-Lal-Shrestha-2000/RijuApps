<?php
    include "authentication.php";
    include "connection.php";
    if (!$auth->hasRole(\Delight\Auth\Role::ADMIN)) {
        header("location: index.php");
    }
?>
<!doctype html>
<html lang="en">
<head>
    <title>Untitled | Settings</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body onload="clickLink('')">
<?php
    include "header.php";
?>


<div class="container"><br>
    <div id="import" class="jumbotron">
        <p class="h3">IMPORT</p>
        <hr>
        <?php
            use Phppot\DataSource;
            use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

            require_once ('./vendor/autoload.php');
            include "Connection.php";
            if (isset($_POST["import"])) {
                //echo "<script>alert('HEY');</script>";
                $allowedFileType = [
                    'application/vnd.ms-excel',
                    'text/xls',
                    'text/xlsx',
                    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                ];

                if (in_array($_FILES["file"]["type"], $allowedFileType)) {

                    $targetPath = 'uploads/' . $_FILES['file']['name'];
                    move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);

                    $Reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

                    $spreadSheet = $Reader->load($targetPath);
                    $excelSheet = $spreadSheet->getActiveSheet();
                    $spreadSheetAry = $excelSheet->toArray();
                    $sheetCount = count($spreadSheetAry);

                    for ($i = 0; $i <= $sheetCount; $i ++) {
                        $sn = "";
                        if (isset($spreadSheetAry[$i][0])) {
                            $sn = mysqli_real_escape_string($C, $spreadSheetAry[$i][0]);
                        }
                        $name = "";
                        if (isset($spreadSheetAry[$i][1])) {
                            $name = mysqli_real_escape_string($C, $spreadSheetAry[$i][1]);
                        }
                        //echo $form_no."&nbsp;&nbsp;&nbsp;&nbsp;".$applicant_name."&nbsp;&nbsp;&nbsp;&nbsp;".$gender."&nbsp;&nbsp;&nbsp;&nbsp;".$district."&nbsp;&nbsp;&nbsp;&nbsp;".$rank."&nbsp;&nbsp;&nbsp;&nbsp;".$remarks."<br>";
                        $sql = "INSERT INTO excel_data(symbol_no, excel_name) VALUES('$sn', '$name')";
                        //echo $sql."<br>";
                        mysqli_query($C, $sql);
                    }
                    if(mysqli_affected_rows($C)>0){
                        echo "Imported Successfully.";
                    }else
                        echo "Unable to import.";
                } else {
                    $type = "error";
                    $message = "Invalid File Type. Upload Excel File.";
                }
            }
        ?>
        <div class="outer-container">
            <form action="" method="post" name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
                <div>
                    <label>Choose Excel File</label> <input type="file" name="file" id="file" accept=".xls,.xlsx">
                    <button type="submit" id="submit" name="import" class="btn-submit">Import</button>
                    <label>This is test import, so please import an excel file with at-least/at-most 2 columns.</label>
                </div>
            </form>
        </div>
        <div id="response" class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>"><?php if(!empty($message)) { echo $message; } ?></div>
    </div>
    <div id="edit" class="jumbotron">
        <p class="h3">EDIT</p><hr>
        <?php
            include "ManageEdit.php";
        ?>
    </div>
    <div id="delete" class="jumbotron">
        <p class="h3">DELETE</p><hr>
        <?php
            include "ManageDelete.php";
        ?>
    </div>
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
<script>
    function clickLink() {
        document.getElementById('clickOnLoad').click();
    }
</script>
</body>
<?php
    include "footer.php";
?>
</html>
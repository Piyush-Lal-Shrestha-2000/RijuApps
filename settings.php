<?php
    include "authentication.php";
    include "connection.php";
    include "smallAlert.php";
    if (!$auth->hasRole(\Delight\Auth\Role::ADMIN)) {
        header("location: index.php");
    }
?>
<!doctype html>
<html lang="en">
    <head>
        <title>Untitled | Settings</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="SettingsSideViewStyle.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>
        <?php
            include "header.php";
        ?>
        <div class="sidebar">
            <a href="settings.php" class="active">Import</a>
            <a href="ManageEdit.php">Edit/Delete</a>
        </div>

        <div class="container content" ><br><br><br>
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
                        $starting_index = 0;
                        if(isset($_POST['ignoreFirstRow']))
                            $starting_index = 1;
                            for ($i = $starting_index; $i <= $sheetCount; $i ++) {
                                $sn = "";
                                if (isset($spreadSheetAry[$i][0])) {
                                    $sn = mysqli_real_escape_string($C, $spreadSheetAry[$i][0]);
                                }
                                $form_no = "";
                                if (isset($spreadSheetAry[$i][1])) {
                                    $form_no = mysqli_real_escape_string($C, $spreadSheetAry[$i][1]);
                                }
                                $applicant_name = "";
                                if (isset($spreadSheetAry[$i][2])) {
                                    $applicant_name = mysqli_real_escape_string($C, $spreadSheetAry[$i][2]);
                                }
                                $gender = "";
                                if (isset($spreadSheetAry[$i][3])) {
                                    $gender = mysqli_real_escape_string($C, $spreadSheetAry[$i][3]);
                                }
                                $district = "";
                                if (isset($spreadSheetAry[$i][4])) {
                                    $district = mysqli_real_escape_string($C, $spreadSheetAry[$i][4]);
                                }
                                $rank = "";
                                if (isset($spreadSheetAry[$i][5])) {
                                    $rank = mysqli_real_escape_string($C, $spreadSheetAry[$i][5]);
                                }
                                $remarks = "";
                                if (isset($spreadSheetAry[$i][6])) {
                                    $remarks = mysqli_real_escape_string($C, $spreadSheetAry[$i][6]);
                                }
                                //echo $sn."&nbsp;&nbsp;&nbsp;&nbsp;".$form_no."&nbsp;&nbsp;&nbsp;&nbsp;".$applicant_name."&nbsp;&nbsp;&nbsp;&nbsp;".$gender."&nbsp;&nbsp;&nbsp;&nbsp;".$district."&nbsp;&nbsp;&nbsp;&nbsp;".$rank."&nbsp;&nbsp;&nbsp;&nbsp;".$remarks."<br>";
                                $sql = "INSERT INTO excel_data(s_no, form_no, applicants_name, gender, district, rank, remarks) VALUES('$sn', '$form_no', '$applicant_name', '$gender', '$district', '$rank', '$remarks')";
                                mysqli_query($C, $sql);
                                //echo $form_no."&nbsp;&nbsp;&nbsp;&nbsp;".$applicant_name."&nbsp;&nbsp;&nbsp;&nbsp;".$gender."&nbsp;&nbsp;&nbsp;&nbsp;".$district."&nbsp;&nbsp;&nbsp;&nbsp;".$rank."&nbsp;&nbsp;&nbsp;&nbsp;".$remarks."<br>";
                            }
                            if(mysqli_affected_rows($C)>0){
                                showAlert('Imported Successfully.');
                            }else
                                showAlert('Unable to import.');

                    } else {
                        $type = "error";
                        $message = "Invalid File Type. Upload Excel File.";
                        showAlert("Invalid file type. Upload Excel file.");
                    }
                }
                ?>
                <div class="outer-container">
                    <form action="" method="post" name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
                        <div>
                            <label>Choose Excel File</label> <input type="file" name="file" id="file" accept=".xls,.xlsx"><br>
                            <input type="checkbox" name="ignoreFirstRow" > Ignore first row of the excel document<br><br>
                            <button type="submit" id="submit" name="import" class="btn-submit">Import</button>
                            <label>This is test import, so please import the data similar to:</label>
                        </div><br>
                        <img src="Images/ExcelFileDemo.png"/>
                    </form>
                </div>
                <div id="response" class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>"><?php if(!empty($message)) { echo $message; } ?></div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
    <?php
        include "footer.php";
    ?>
</html>
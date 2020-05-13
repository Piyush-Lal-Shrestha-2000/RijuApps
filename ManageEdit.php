<form>
    Check if entry exists?<br>
    <input type = "text" name = "snTest" placeholder="Enter symbol no">
    <input type="submit" name = "CheckRecord" value = "Check Record">
</form>
<?php
$chk = false;
$sn = 0;
if(isset($_GET['CheckRecord'])){
    $sn = $_GET['snTest'];
    $sql = "SELECT * FROM excel_data WHERE 	symbol_no ='$sn'";
    $R = mysqli_query($C, $sql);
    if(mysqli_num_rows($R)>0){
        echo "Record with SN: ".$sn." exits!";
        $chk = true;
        drawEditForm(mysqli_fetch_assoc($R));
    }else{
        $chk = false;
        echo "Record with SN: ".$sn." does not exist.";
    }
}
function drawEditForm($R){
    ?>
    <fieldset>
        <legend>EDIT</legend>
        <form method="post">
            SN:<br><input type="number" name = "sn" placeholder="Enter SN" value = "<?php echo $R['symbol_no']; ?>" required><br>
            Name:<br><input type="text" name = "name" placeholder="Enter form number" value = "<?php echo $R['excel_name']; ?>" required><br>
            <input type="submit" name = "editRecord" value="Edit Record">
        </form>
    </fieldset>
    <?php
}
if(isset($_POST['editRecord'])){
    $sn = $_POST['sn'];
    $name = $_POST['name'];
    $sql = "UPDATE excel_data SET symbol_no = '$sn', excel_name = '$name' WHERE symbol_no = '$sn'";
    mysqli_query($C, $sql);
    if(mysqli_affected_rows($C)>0){
        echo "Edited Successfully.";
    }else
        echo "Unable to edit.";
}
?>
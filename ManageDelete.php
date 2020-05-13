<form method="post">
    <input type="text" name = "sn" placeholder="Enter symbol no" required>
    <input type = "submit" value = "Delete" name = "deleteRecord">
</form>
<?php
if(isset($_POST['deleteRecord'])){
    $sn = $_POST['sn'];
    $sql = "DELETE FROM excel_data WHERE symbol_no = '$sn'";
    mysqli_query($C, $sql);
    if(mysqli_affected_rows($C)>0){
        echo "Deleted Successfully.";
    }else
        echo "Unable to delete.";
}
?>
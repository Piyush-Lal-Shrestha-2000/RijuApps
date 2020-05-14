<?php
    include "authentication.php";
    include "connection.php";
    include "smallAlert.php";
    if (!$auth->hasRole(\Delight\Auth\Role::ADMIN)) {
        header("location: index.php");
    }
?>
<?php
    $sn=0;
    if(isset($_POST['edit'])){
        $sn = $_POST['sn_val'];
        $_SESSION['old_sn'] = $sn;
        $sql = "SELECT * FROM excel_data WHERE s_no = '".$sn."'";
        $R = mysqli_query($C, $sql);
        while($res = mysqli_fetch_assoc($R)){
?>
            <table>
                <form method="post">
                    <tr><td>SN: </td><td><input type="number" name="esn" value="<?php echo $res['s_no']; ?>" required></td></tr>
                    <tr><td>Form no: </td><td><input type="text" name="efn" value="<?php echo $res['form_no']; ?>" required></td></tr>
                    <tr><td>Applicant's name: </td><td><input type="text" name="ean" value="<?php echo $res['applicants_name']; ?>" required></td></tr>
                    <tr><td>Gender: </td><td><input type="text" name="egen" value="<?php echo $res['gender']; ?>" required></td></tr>
                    <tr><td>District: </td><td><input type="text" name="edis" value="<?php echo $res['district']; ?>" required></td></tr>
                    <tr><td>Rank: </td><td><input type="number" name="erank" value="<?php echo $res['rank']; ?>" required></td></tr>
                    <tr><td><input type="submit" value="Edit" name="EditEntry"></td><td></td></tr>
                </form>
            </table>
<?php
        }
?>

<?php
    }
    if(isset($_POST['delete'])){
        $sn = $_POST['sn_val'];
        $_SESSION['old_sn'] = $sn;
?>
        <form method="post">
            Do you wish to delete the data with the symbol no: <?php echo $sn; ?>?<br>
            <input type="submit" value="Yes" name="DeleteYes" class="btn btn-lg btn-danger">
            <input type="submit" value="No" name="DeleteNo" class="btn btn-lg btn-success">
        </form>
<?php
    }
    if(isset($_POST['EditEntry'])){
        $new_sn = $_POST['esn'];
        $new_formNo = $_POST['efn'];
        $new_applicantName = $_POST['ean'];
        $new_gender = $_POST['egen'];
        $new_distrcit = $_POST['edis'];
        $new_rank = $_POST['erank'];
        $sql = "UPDATE excel_data SET s_no = '$new_sn', form_no = '$new_formNo', applicants_name = '$new_applicantName', gender = '$new_gender', district = '$new_distrcit', rank = '$new_rank' WHERE s_no = '".$_SESSION['old_sn']."'";
        //echo $sql;
        mysqli_query($C, $sql);
        if(mysqli_affected_rows($C)>0){
            showAlert("Edited Successfully.");
        }else
            showAlert("Unable to edit.");
        unset($_SESSION["old_sn"]);
    }
    if(isset($_POST['DeleteYes'])){
        $sql = "DELETE FROM excel_data WHERE s_no = '".$_SESSION['old_sn']."'";
        //echo $sql;
        mysqli_query($C, $sql);
        if(mysqli_affected_rows($C)>0){
            showAlert("Entry deleted.");
        }else
            showAlert("Unable to delete entry.");
        unset($_SESSION["old_sn"]);
    }
    if(isset($_POST['DeleteNo'])){
        showAlert("Entry not deleted");
        unset($_SESSION["old_sn"]);
    }
?>

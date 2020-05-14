<?php
    include "connection.php";
    include "authentication.php";
    include "smallAlert.php";
    //Getting value of "search" variable from "script.js".
    if (isset($_POST['search'])) {
        //Search box value assigning to $Name variable.
        $Name = $_POST['search'];
        if ($auth->hasRole(\Delight\Auth\Role::ADMIN)) {
            //Search query.
            $Query = "SELECT * FROM excel_data WHERE s_no LIKE '%$Name%' LIMIT 5";
            //Query execution
            $ExecQuery = mysqli_query($C, $Query);
            //Creating unordered list to display result.
            displayTableSettings($Name, "SNo", $ExecQuery);

            //Search query.
            $Query = "SELECT * FROM excel_data WHERE form_no LIKE '%$Name%' LIMIT 5";
            //Query execution
            $ExecQuery = mysqli_query($C, $Query);
            //Creating unordered list to display result.
            displayTableSettings($Name, "Form No", $ExecQuery);

            //Search query.
            $Query = "SELECT * FROM excel_data WHERE applicants_name LIKE '%$Name%' LIMIT 5";
            //Query execution
            $ExecQuery = mysqli_query($C, $Query);
            //Creating unordered list to display result.
            displayTableSettings($Name, "Applicant's Name", $ExecQuery);

            //Search query.
            $Query = "SELECT * FROM excel_data WHERE gender LIKE '%$Name%' LIMIT 5";
            //Query execution
            $ExecQuery = mysqli_query($C, $Query);
            //Creating unordered list to display result.
            displayTableSettings($Name, "Gender", $ExecQuery);

            //Search query.
            $Query = "SELECT * FROM excel_data WHERE district LIKE '%$Name%' LIMIT 5";
            //Query execution
            $ExecQuery = mysqli_query($C, $Query);
            //Creating unordered list to display result.
            displayTableSettings($Name, "District", $ExecQuery);

            //Search query.
            $Query = "SELECT * FROM excel_data WHERE rank LIKE '%$Name%' LIMIT 5";
            //Query execution
            $ExecQuery = mysqli_query($C, $Query);
            //Creating unordered list to display result.
            displayTableSettings($Name, "Rank", $ExecQuery);
        }else{
            //Search query.
            $Query = "SELECT * FROM excel_data WHERE s_no LIKE '%$Name%' LIMIT 5";
            //Query execution
            $ExecQuery = mysqli_query($C, $Query);
            //Creating unordered list to display result.
            displayTable($Name, "SNo", $ExecQuery);

            //Search query.
            $Query = "SELECT * FROM excel_data WHERE form_no LIKE '%$Name%' LIMIT 5";
            //Query execution
            $ExecQuery = mysqli_query($C, $Query);
            //Creating unordered list to display result.
            displayTable($Name, "Form No", $ExecQuery);

            //Search query.
            $Query = "SELECT * FROM excel_data WHERE applicants_name LIKE '%$Name%' LIMIT 5";
            //Query execution
            $ExecQuery = mysqli_query($C, $Query);
            //Creating unordered list to display result.
            displayTable($Name, "Applicant's Name", $ExecQuery);

            //Search query.
            $Query = "SELECT * FROM excel_data WHERE gender LIKE '%$Name%' LIMIT 5";
            //Query execution
            $ExecQuery = mysqli_query($C, $Query);
            //Creating unordered list to display result.
            displayTable($Name, "Gender", $ExecQuery);

            //Search query.
            $Query = "SELECT * FROM excel_data WHERE district LIKE '%$Name%' LIMIT 5";
            //Query execution
            $ExecQuery = mysqli_query($C, $Query);
            //Creating unordered list to display result.
            displayTable($Name, "District", $ExecQuery);

            //Search query.
            $Query = "SELECT * FROM excel_data WHERE rank LIKE '%$Name%' LIMIT 5";
            //Query execution
            $ExecQuery = mysqli_query($C, $Query);
            //Creating unordered list to display result.
            displayTable($Name, "Rank", $ExecQuery);
        }
    }
?>
<?php
    function displayTable($Name, $Category, $ExecQuery){
?>
    <div class="jumbotron">
        <p class="h3">
            Searching '<?php echo $Name; ?>' in <u><?php echo $Category; ?></u>
        </p>
        <hr>
        <table class="table">
            <tr>
                <th scope="col">SN</th>
                <th scope="col">Form no.</th>
                <th scope="col">Applicant's name</th>
                <th scope="col">Gender</th>
                <th scope="col">District</th>
                <th scope="col">Rank</th>
            </tr>
            <?php
                //Fetching result from database.
                while ($Result = mysqli_fetch_array($ExecQuery)) {
            ?>
                <!-- Creating unordered list items.
                     Calling javascript function named as "fill" found in "script.js" file.
                     By passing fetched result as parameter. -->
                <tr>
                    <td><?php echo $Result['s_no'];?></td>
                    <td><?php echo $Result['form_no'];?></td>
                    <td><?php echo $Result['applicants_name'];?></td>
                    <td><?php echo $Result['gender'];?></td>
                    <td><?php echo $Result['district'];?></td>
                    <td><?php echo $Result['rank'];?></td>
                </tr>
                <!-- Below php code is just for closing parenthesis. Don't be confused. -->
            <?php
                }
            ?>
        </table>
    </div>
<?php
    }
?>
<?php
function displayTableSettings($Name, $Category, $ExecQuery){
    ?>
    <div class="jumbotron">
        <p class="h3">
            Searching '<?php echo $Name; ?>' in <u><?php echo $Category; ?></u>
        </p>
        <hr>
        <table class="table">
            <tr>
                <th scope="col">SN</th>
                <th scope="col">Form no.</th>
                <th scope="col">Applicant's name</th>
                <th scope="col">Gender</th>
                <th scope="col">District</th>
                <th scope="col">Rank</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
            <?php
            //Fetching result from database.
            while ($Result = mysqli_fetch_array($ExecQuery)) {
                ?>
                <!-- Creating unordered list items.
                     Calling javascript function named as "fill" found in "script.js" file.
                     By passing fetched result as parameter. -->
                <tr>
                    <td><?php echo $Result['s_no'];?></td>
                    <td><?php echo $Result['form_no'];?></td>
                    <td><?php echo $Result['applicants_name'];?></td>
                    <td><?php echo $Result['gender'];?></td>
                    <td><?php echo $Result['district'];?></td>
                    <td><?php echo $Result['rank'];?></td>
                    <td>
                        <form action="EditDelete.php" method="post" target="_blank">
                            <input type="text" name="sn_val" value="<?php echo $Result['s_no'];?>" style="visibility: hidden;">
                            <input type="submit" class="btn btn-primary" name="edit" value="Edit">
                        </form>
                    </td>
                    <td>
                        <form action="EditDelete.php" method="post" target="_blank">
                            <input type="text" name="sn_val" value="<?php echo $Result['s_no'];?>" style="visibility: hidden;">
                            <input type="submit" class="btn btn-danger" name="delete" value="Delete">
                        </form>
                    </td>
                </tr>
                <!-- Below php code is just for closing parenthesis. Don't be confused. -->
                <?php
            }
            ?>
        </table>
    </div>
    <?php
}
?>

<?php

session_start();
if(isset($_SESSION['tid']))
{
    echo "";
}
else{
    header('location: ../teacherlogin.php');
}
  
?>

<?php

include('header1.php');

if(isset($_POST['submit'])){
    $_POST['submit'] = false;
}
?>
<br><h1 align="center"> Add Students To The Records</h1><br>
<form method="post" action="classadd.php" enctype="multipart/form-data">
    
    <table align="center" border="1" style="width:70%; height:50%; margin-top:40px;">
        <tr>
            <th>Roll No</th>
            <td><input type="text" class="clas" name="rollno" placeholder="Enter Rollno" required></td>
        </tr>
    
        <tr>
            <th>Full Name</th>
            <td><input type="text" class="clas" name="name" placeholder="Enter Full Name" required></td>
        </tr>
        <tr>
            <th>City</th>
            <td><input type="text" class="clas" name="city" placeholder="Enter City" required></td>
        </tr>
        <tr>
            <th>Parents Contact no.</th>
            <td><input type="text" class="clas" name="pcon" placeholder="Enter Parents Contact Number" required></td>
        </tr>
        <tr>
        <th>Standard</th>
<td><input type="number" class="clas" name="standard" placeholder="<?php echo isset($_SESSION['class']) ? $_SESSION['class'] : ''; ?>" required readonly>*<i>can't change</i></td>

            
        </tr>
        <tr>
            <th>Image</th>
            <td><input type="file" class="clas" name="simg" > </td>
        </tr>
        
        <tr>
        
            <td colspan="2"  class="clas" align="center"><input type="submit" class="btn" name="submit" value="Submit"></td>
        </tr>
    </table>
</form>

</body>
</html>

<?php

if(isset($_POST['submit'])){
    $link = mysqli_connect('localhost','root','','ms');

	if($link == false){
		echo "Connection not successful";
	}
    $rollno = $_POST['rollno'];
    $name = $_POST['name'];
    $city = $_POST['city'];
    $pcon = $_POST['pcon'];
    $std = $_POST['standard'];
    $imagename = $_FILES['simg']['name'];
    $tempname = $_FILES['simg']['tmp_name'];
        
    move_uploaded_file($tempname,"../dataimg/$imagename");
   
    $std = isset($_SESSION['class']) ? $_SESSION['class'] : '';
    echo $std;
    
    
    
    
    $qry = "INSERT INTO `student`(`name`, `city`, `pcon`, `standard`, `rollno`,`image`) VALUES ('$name','$city','$pcon','$std','$rollno','$imagename')";
   
    $run = mysqli_query($link,$qry);
    
    if($run == true){
        ?>
        <script>
            alert('Data Inserted Successfully');
        </script>
        <?php
    }
    
        
}


?>
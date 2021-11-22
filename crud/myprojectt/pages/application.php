<?php

$username ="";
?>
<form>
<?php if($_SESSION['logged_in']) : ?>
                 <?php $username =  $_SESSION['username'];  ?>
            <?php endif; ?>
			
</form>


<?php 
if($_POST['application_submit']){


$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
//$username = $_POST['username'];


$errors = array();




//Check passwords match
if($password != $password2){
	$errors[] = "Your passwords do not match";
} 
//Check first name
if(empty($firstname)){
	$errors[] = "First Name is Required";
} 
//Check email
if(empty($email)){
	$errors[] = "Email is Required";
} 





//Instantiate Database object
$database = new Database;


if(empty($errors))
{

	 $target_dir="C:\ ";
	 $filename=$_FILES["fileupload"]["name"];
  
	 $tmpname=$_FILES["fileupload"]["tmp_name"];
	 $filetype=$_FILES["fileupload"]["type"];
	 $errors=[];
	 $fileextensions=["pdf"];
	  $arr=explode(".",$filename);
	 $ext=strtolower(end($arr));
  
	 $uploadpath=$target_dir.basename($filename);
     





	$database->query('INSERT INTO applications (firstname,lastname,email,filename,username)
				  VALUES(:firstname,:lastname,:email,:filename,:username)');			 
		 
	//Bind Values $userid = $_GET['id'];
	$database->bind(':firstname', $firstname);  
	$database->bind(':lastname', $lastname);   
	$database->bind(':email', $email);  
	$database->bind(':filename', $filename);  
	$database->bind(':username', $username);

	//Execute
	$database->execute();
	//$database->debugDumpParams();
	//If row was inserted
	if($database->lastInsertId()){
		echo '<p class="msg">you apply succesfully</p>';
	} else {
		echo '<p class="error">Sorry, something went wrong. Contact the site admin</p>';
	}



}


}
?>

<h3>form</h3>
<p>Please use the form below to apply for the junior php developer</p>
<?php




if(!empty($errors)){
echo "<ul>";
foreach($errors as $error){
echo "<li class=\"error\">".$error."</li>";
}
echo "</ul>";
}



?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">


			

       <input type = "file" name = "fileupload"/></br>  
        <label>First Name: </label>
		<input type="text" name="firstname" value="<?php if($_POST['firstname'])echo $_POST['firstname'] ?>" /><br />
		<label>Last Name: </label>
		<input type="text" name="lastname" value="<?php if($_POST['lastname'])echo $_POST['lastname'] ?>" /><br />

		<label>Email: </label>
		<input type="text" name="email" value="<?php if($_POST['email'])echo $_POST['email'] ?>" /><br />
		<br />
		<input type="submit" value="apply" name="application_submit" />
	 
  </form>
  
  
  
  
  
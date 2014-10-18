
<?php 
	//$email2=stripslashes($_POST["email"]);
	$connection = mysqli_connect('localhost','root','random','cs252');
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
    $email      = $_POST['email'];
    $password   = $_POST['password'];
    $query = "SELECT email FROM users where email='".md5($email)."' and password='".md5($password)."'";
    $result = mysqli_query($connection,$query);
    $numResults = mysqli_num_rows($result);
    if($numResults>=1)
    {
    	session_start();
    	$_SESSION['email_enc']=md5('email');
        $strSQL = mysqli_query($connection,"select name from information where email='".$email."'");
        $Results = mysqli_fetch_array($strSQL);
        $message = $Results['name']." You are Loggedin Sucessfully!!";
    }
    else
    {
        $message = "Error";
    }
    echo $message;    

?>

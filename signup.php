<?php
	$connection = mysqli_connect('localhost','root','random','cs252');
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	echo $name;
	$name       = $_POST['username'];
    $email      = $_POST['email'];
    $password   = $_POST['password'];
    $query = "SELECT email FROM users where email='".md5($email)."'";
    $result = mysqli_query($connection,$query);
    $numResults = mysqli_num_rows($result);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) // Validate email address
    {
        $message =  "Invalid email address please type a valid email!!";
    }
    elseif($numResults>=1)
    {
        $message = $email." Email already exist!!";
    }
    else
    {
        mysqli_query($connection,"insert into users(name,email,password) values('".$name."','".md5($email)."','".md5($password)."')");
        mysqli_query($connection,"insert into information(name,email,emailenc) values('".$name."','".$email."','".md5($email)."')");
        $message = "Signup Sucessfully!!";
        echo $message;
        header('../login.html');
    }
    echo $message;
?>
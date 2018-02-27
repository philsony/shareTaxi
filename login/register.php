<?php
  require('../connect.php');

    $success="location: login.php";
    $failure="location: register.php";
?>

<?php
//Checks if the regristration occurred
if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])){

	$pass=$_POST['password'];

	//Hash the password using sha256
	$user_pass=hash( "sha256", $_POST['password']);

    //Retrieves the current date
    $date=date('Y-m-d h:i:s');

    //Query to check if the email submitted is already in use
    $emaildraw =
        "SELECT users.email FROM users WHERE users.email='{$_POST['email']}'";
    if($drawn=mysqli_query($db, $emaildraw) or die("something went wrong! with email confirmation")){
        $checker=mysqli_num_rows($drawn);
        mysqli_free_result($drawn);
        if($checker){
            echo "<script>alert('Email is already in use!');</script> <a href=\"login/register.php\">Go Back</a>";
        }
    }
    //Adds the new account if there is no same email
		$userLocation= getUserLocation();
    if(!$checker){
        $query =
            "INSERT INTO users values(null, '{$_POST['username']}', '{$user_pass}', '{$_POST['email']}', $userLocation->latitude, $userLocation->longitude, NOW())";
        $result=mysqli_query($db, $query) or die(mysqli_error($db));
        $id=mysqli_insert_id($db);
        if($result){
					$_SESSION['id']=$id;
					$_SESSION['login_user']=$_POST['username'];

					header("location: welcome.php");
        }
    }
}

?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <title>Register Page</title>
    <link rel="stylesheet" href="css/general_style.css?<?php echo rand(0, 100); ?>" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Monoton" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body class='login'>
        <div class="blue-overlay"></div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 col-xs-10 col-xs-offset-1 col-md-offset-4">
                    <div class="title">ShareTaxi</div>
                        <form method='POST' onsubmit='return checkForm(this)' action='register.php' class='box'>
                            <br />
                            <div class='form-group'>
                                <p><label>Username:</label> <input id="user" class="form-control" type='text' name='username' title="Format:should be at least 3 min, restricted to letters, numbers, and underscore" required pattern="\w+"></p>
                            </div>
                            <div class='form-group'>
                                <p><label>Email:</label> <input id="pass" class="form-control" type='email' name='email' required></p>
                            </div>
                            <div class='form-group'>
                                <p><label>Password:</label> <input id="cpass" class="form-control" type='password' name='password' title="Format: at least 8 characters long, at least 1 lowercase character ,at least 1 uppercase character, at least 1 number" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"></p>
                            </div>
                            <div class='form-group'>
                                <p><label>Confirm Password:</label> <input  class="form-control" type='password' name='cpassword' title="Format: at least 8 characters long, at least 1 lowercase character ,at least 1 uppercase character, at least 1 number" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"></p>
                            </div>
                            <div class="form-group">    
                                <p><input type='submit' value='Register' name='submit' class='submit'></p>
                            </div>
                            <h6>Already have an account? <a href='login.php'>Login</a> here.</h6>
                        </form>
                    </div>
            </div>
		</div>
	</div>
</div>
</body>

<script type="text/javascript">
        //More Checks ought to be added here

    //Checks the password to have at least 1 lowercase,
    //1 uppercase, 1 number, and at least 8 characters long
    function checkPassword(str){
        // \d is equivalent to [0-9]
        var re=/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
        return re.test(str);
    }

    //Checker before submission of form
    function checkForm(form){

        //Checks for username of length 3 or more
        if(form.username.value.length < 3){
            alert("You cannot have a name that has less than 3 characters!");
            form.username.focus();
            return false;
        }

        //Restricts username to numbers, letters, and underscores
        re=/^\w+$/;
        if(!re.test(form.username.value)){
            alert("Username must contain only letters, numbers and underscores!");
            form.username.focus();
            return false;
        }

        //The same Username and Password checking
        if(form.password.value == form.username.value){
            alert("Username and Password should not be the same!");
            form.password.focus();
            return false;
        }

        //Password Checking
        if(form.password.value == form.cpassword.value){
            if(!checkPassword(form.password.value)) {
                alert("The password you have entered is not valid!");
                form.password.focus();
                return false;
            }
        }else{
            alert("Error: Please check that you've entered and confirmed your password!");
            form.password.focus();
            return false;
        }
        if(form.password.value != form.cpassword.value){
            alert("Password and Confirm Password are not the same. Please try again!");
            form.password.focus();
            return false;
        }

        //Email checker
        if(form.email.value == "<?php echo $checker;?>"){
            alert("Email is already in use!");
            form.email.focus();
            return false;
        }

        //Answer when there are no problems met in the conditions
        return true;

    }

</script>

</html>

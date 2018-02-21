<?php
  require('../connect.php');

   // $username = $_SESSION['name'];

    $success = "location: welcome.php";
    $failure = "location: login.php";
    $return = "location: settings.php";

//Checks if user_id is given from session.php
if(!isset($user_id)){
    header($failure);
}
//else{
////User ID is used to be able to access its account
//    $user_id = $_SESSION['id'];
//}

//Dummy Defaults
 //   $user = 'hello';//'Jack Daniels';
//    $pass = hash('sha256', 'HelloWorld1');
//    $email = 'hello@hello.com';

//This Query retrieves the name, password, and email of the user.
    $query = "SELECT name AS username, password, email FROM users WHERE user_id = {$user_id}";
    $result = mysqli_query($db, $query) or die("Something went wrong during retrieval of required data.");
    if($row = mysqli_fetch_assoc($result)){
        $user = $row['username'];
        $pass = $row['password'];
        $email = $row['email'];
    }

//Details for Username Change
    if(isset($_POST['nusername'])){
        $userchange = "UPDATE users SET name = '{$_POST['nusername']}' WHERE user_id = {$user_id} AND email = '{$email}'";
        $res = mysqli_query($db, $userchange) or die("Username failed to change.");
        if($res){
            echo "<script>alert 'username has successfully been changed!';</script>";
            $_SESSION['login_user'] = $_POST['nusername'];
            header($return);
        }
    }

//Details for Password Change
    if(isset($_POST['password']) && isset($_POST['npassword']) && isset($_POST['cpassword'])){
        $oldpassword = hash('sha256', "{$_POST['password']}");
        if($pass == $oldpassword && $_POST['npassword'] == $_POST['cpassword']){
            $newpassword = hash('sha256', "{$_POST['npassword']}");
            $passchange = "UPDATE users SET password = '{$newpassword}' WHERE user_id = {$user_id} AND email = '{$email}'";
            $res = mysqli_query($db, $passchange) or die("Password failed to change.");
            if($res){
                echo '<script>alert("password has successfully been changed!");</script>';
            }
        }else{
            echo '<script>alert("The Old Password did not match! Try again.");</script>';
        }
    }

    //It needs to check if the user is logged in otherwise this page has no value
?>
<!DOCTYPE html>
<html lang = en>
    <head>
        <title>Share Taxi | Settings</title>
        <link rel='stylesheet' href='css/bootstrap.min.css'>

        <style>
            .box{
                border: 1px solid black;
            }
        </style>
    </head>
    <body>
        <div class = 'row'>
            <div class = 'col-md-4 col-sm-8 col-xs-12 col-md-offset-4 col-sm-offset-2 text-center'>

                <form method = 'POST' onsubmit = 'return checkUser(this)' action = 'settings.php' class = 'box'>
                    <p>Old Username: <?php echo $user; ?></p>
                    <p>New Username: <input id = 'user' type = 'text' name = 'nusername' placeholder = 'New Username' required pattern="\w+"></p>
                    <p><input type = 'submit' name = 'submit' class = 'btn btn-default'></p>
                </form>

                <br>
                <p class = 'box'>Email: <?php echo $email; ?></p>

                <form method = 'POST' onsubmit = 'return checkPass(this)' action = 'settings.php' class = 'box'>
                    <p>Old Password: <input id = 'pass' type = 'password' name = 'password' placeholder = 'Old Password' required ></p>
                    <p>New Password: <input id = 'npass' type = 'password' title="Format: at least 8 characters long, at least 1 lowercase character ,at least 1 uppercase character, at least 1 number" name = 'npassword' placeholder = 'New Password' require pattern='(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}'></p>
                    <p>Confirm New Password: <input id = 'cpass' type = 'password' title="Format: at least 8 characters long, at least 1 lowercase character ,at least 1 uppercase character, at least 1 number"  name = 'cpassword' placeholder = 'Confirm Password' require pattern='(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}'></p>
                    <p><input type = 'submit' name = 'submit' class = 'btn btn-default'></p>
                </form>

                <p class = 'box'>Go back to <a href="welcome.php">Welcome Page</a></p>

            </div>
        </div>
    </body>
    <script type = 'text/javascript'>

        function checkPassword(str){
            // \d is equivalent to [0-9]
            var re = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
            return re.test(str);
        }

        //Checks for a new allowable username
        function checkUser(form){
        //Restricts username to have at least 3 characters
            if(form.nusername.value.length < 3){
                alert("You cannot have a name that has less than 3 characters!");
                form.nusername.focus();
                return false;
            }

        //Restricts username to numbers, letters, and underscores
            re = /^\w+$/;
            if(!re.test(form.nusername.value)){
                alert("Username must contain only letters, numbers and underscores!");
                form.nusername.focus();
                return false;
            }
        //If no problem has been encountered
            alert("Username has changed");
            return true;
        }
        //Password Checking
        function checkPass(form){
            var hashed = hash('sha256', form.password.value);
            if(hashed == '<?php //echo $pass; ?>'){
                if(form.npassword.value == form.cpassword.value){
                    if(!checkPassword(form.npassword.value)) {
                        alert("The password you have entered is not valid!");
                        form.npassword.focus();
                        return false;
                    }
                }else{
                    alert("Error: Please check that you've entered and confirmed your password!");
                    form.npassword.focus();
                    return false;
                }
                if(form.npassword.value != form.cpassword.value){
                    alert("Password and Confirm Password are not the same. Please try again!");
                    form.npassword.focus();
                    return false;
                }
            }else{
                alert("The Password you have entered is wrong!");
                form.password.focus();
                return false;
            }
            alert("Password has changed!");
            return true;
        }

    </script>
</html>

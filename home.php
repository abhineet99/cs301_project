<?php
    require_once 'library.php';
    if(chkLogin()){
       
        echo "Logged in!";
        $name = $_SESSION["uname"];
        echo "Welcome $name!!!";
        echo"<br>";

    }
    else{
        header("Location: login.php");
    }
    echo "<a href='update.php'>Update stuff</a> ";
    if(isset($_POST['logout'])){
        
        $var = removeall();
		session_destroy();
        if($var){
            header("Location:login.php");
        }
        else{
            echo "Error!";
        }
    
    }
?>
<html>
    <body>
        <form method="post" action="">
            <input type="submit" name="logout" value="Logout!">
        </form>
    </body>
</html>

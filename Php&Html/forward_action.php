<?php
    require_once 'library.php';
   // require_once 'login_action.php';
    if(!chkLogin()){
        header("Location: login.php");
    }
    $email = $_SESSION['email'];
?>

<?php
//assuming I hav $email and $leave_id,$comment
    $facult=pg_connect("host=localhost port =5432 dbname=prof_leave user =postgres password = mahi121");
    $query="Select post from facult.faculty where facult.faculty.email='$email'";
    $post=pg_query($query);
    $post = pg_fetch_row($post);
    $post=$post[0];
    $query="Select post from facult.next_guy where facult.next_guy.start_post='$post'";
    $next_post=pg_query($query);
    $next_post = pg_fetch_row($next_post);
    $next_post=$next_post[0];
    $query="UPDATE facult.leave SET pending_id='$next_post' where leave_id=$leave_id AND status=0";
    $execute=pg_query($query);

    $query="Select sender_id from facult.leave where facult.leave.leave_id=$leave_id";
    $sender_id=pg_query($query);
    $sender_id = pg_fetch_row($sender_id);
    $sender_id=$sender_id[0];
    if($comment!=NULL){
        $query="INSERT INTO facult.comments(leave_id,sender_id,writer_post,comment) VALUES($leave_id,'$sender_id','$post','$comment')";
        $execute=pg_query($query);

    }
    echo "Done!";
    echo "<a href='prof_loggedin.php'>Home</a>";

?>
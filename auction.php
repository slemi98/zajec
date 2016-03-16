<?php
    include_once('database.php');

    if(isset($_POST['id']) && isset($_POST['user_id']) && isset($_POST['bid'])){
        $id = $_POST['id'];
        $user_id = $_POST['user_id'];
        $bid = $_POST['bid'];

        echo $id . "   " . $user_id . "    " . $bid;

        $query = "INSERT INTO bids_users(user_id, ad_id, date_added, bid_price) VALUES ('$user_id', '$id', NOW(), '$bid')";

        $result = mysql_query($query);

        if($result == true){
            header("Location: ad_list.php");
        }
    }
?>
<?php
    include_once('database.php');

    if(isset($_GET['id']) && isset($_GET['user_id']) && isset($_GET['price'])){
        $id = $_GET['id'];
        $user_id = $_GET['user_id'];
        $bid = $_GET['price'];

        echo $id . "   " . $user_id . "    " . $bid;

        $query = "INSERT INTO bids_users(user_id, ad_id, date_added, bought) VALUES ('$user_id', '$id', NOW(), 1)";

        $result = mysql_query($query);

        if($result == true){
            header("Location: ad_list.php");
        }
    }
?>
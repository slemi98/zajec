<?php
    include_once('header.php');
    include_once ('database.php');

    $user_id = $_SESSION['user_id'];
    $query = "SELECT a.auction,bu.bought, bu.bid_price, a.title, a.price, a.date_b, a.date_e, bu.date_added FROM ads a INNER JOIN bids_users bu ON a.id = bu.ad_id INNER JOIN users u ON u.id = bu.user_id
WHERE u.id = '$user_id'";
?>
    <table id="tabela" class="table table-bordered" style="text-align:center">
        <tr>
            <th>Naziv</th>
            <th>Cena</th>
            <th>Dodan na</th>
            <th>Iztek oglasa</th>
            <th>Oddana ponudba</th>
            <th>Vrsta</th>
            <th>Status</th>
        </tr>
        <?php

    $result = mysql_query($query);

    while($row = mysql_fetch_array($result)) {

        $start = $row['date_b'];
        $end = $row['date_e'];


            echo "<tr id='tabela2'>";
            echo "<td>" . $row['title'] . "</td>";
            if($row['bid_price'] != 0){
                echo "<td>" . $row['bid_price'] . " €</td>";
            }
            else {
                echo "<td>" . $row['price'] . " €</td>";
            }

            echo "<td>" . $row['date_b'] . "</td>";
            echo "<td>" . $row['date_e'] . "</td>";
            echo "<td>" . $row['date_added'] . "</td>";
            if($row['auction'] == 1){
                echo "<td>Avkcija</td>";
            } else {
                echo "<td>Fiksna</td>";
            }
            if ($start < $end) {
                echo "<td>V poteku</td>";
            } else {
                echo "Oglas je že potekel.";
            }

    }
?>


</table>
<?php



    include_once('footer.php');
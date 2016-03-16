<?php
include_once 'header.php';
include_once 'database.php';
//kateri oglas moram prikazati
$ad_id = (int) $_GET['id'];

$query = "SELECT a.id, a.title, a.date_b, a.date_e,
                    a.price, a.description, c.name,
                    a.user_id, a.auction
                FROM ads a INNER JOIN categories c
                ON a.category_id=c.id
              WHERE a.id = $ad_id";
//pošljem podatke v bazo
$result = mysql_query($query);
//premenim rezultat v "berljivo" obliko
$ad = mysql_fetch_array($result);
?>

<div class="panel panel-default" id="ad">
    <div class="panel panel-heading">
        <div class="panel-title">
            <h4>Do konca oglasa še: <b><span id="time"></span></b></h4>
        </div>
        <script>

            $("#time")
                .countdown("<?php echo $ad['date_e']; ?>", function(event) {
                    $(this).text(
                        event.strftime('%D dni %H:%M:%S')
                    );
                });
        </script>
    </div>
    <div class="panel panel-body" id="ad_pictures">

        <?php
        //prebrat vse slike, vezane na ta oglas
        $query = "SELECT * FROM pictures
                WHERE ad_id = $ad_id";
        $result = mysql_query($query);
        //preverim, če ima oglas sploh, kakšno sliko
        if (mysql_num_rows($result) == 0) {
            //izrišem sliko "ni slike"
            echo '<img src="images/nopicture.jpg" alt="ni slike" width="120" />';
        } else {
            //oglas ima nekaj slik
            while ($picture = mysql_fetch_array($result)) {
                echo '<div class="delete_wrap">';
                if ($_SESSION['user_id'] == $ad['user_id']) {
                    echo '<a href="delete_picture.php?id='.$picture['id'].'&ad_id='.$ad_id.'"
                          class="btn btn-danger myaction"
                          onclick="return confirm(\'Ali ste prepričani?\');">Izbriši</a>';
                    //echo '<br />';
                }
                echo '<a class="fancybox" rel="group" href="' . $picture['url'] . '">
                      <img src="' . $picture['url'] . '" alt="slika" width="120" />
                      </a>';
                //echo '<br />';

                echo '</div>';
            }
        }
        ?>
        <?php
            if ($_SESSION['user_id'] == $ad['user_id']) {
        ?>
        <form action="ad_add_picture.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $ad_id; ?>" />
            <input type="file" name="file" />
            <input class="btn btn-primary" type="submit" value="Naloži" />
        </form>
        <?php
            }
        ?>
    </div>
    <div id="ad_data">
<?php
        echo '<h3>' . $ad['title'] . '</h3>';
        echo '<h4><i>' . 'Kategorija: ' . $ad['name'] . '</i></h4><br />';
    //////////////////////////////

?>

        <?php echo "<h6>Dodano: " . date('d-m-Y', strtotime($ad['date_b'])) . "</h6>"; ?>




    <?php

        echo '<p>' . "Opis: " . $ad['description'] . '</p>';
        echo '<h4>' . "Cena: " . $ad['price'] . " €" . '</h4>';
        $start = $ad['date_b'];
        $end = $ad['date_e'];

        if ($start < $end ) {
            echo '<p>Vrsta plačila: ';
            if ( $ad['auction']){
                echo "Avkcija"
                ?>
                <form class="form" action="auction.php" method="POST">
                    <div class="form-group">
                        <input type="number" name="bid" min="<?php echo $ad['price']; ?>" value="<?php echo $ad['price']; ?>">
                        <input type="hidden" name="id" value="<?php echo $ad['id']; ?>">
                        <input type="hidden" name="user_id" value="<?php echo $ad['user_id']; ?>">
                    </div>
                    <div class="form-group">
                        <input class="btn btn-default" type="submit" name="submit" value="Oddaj ponudbo">
                    </div>
                </form>
                <?php

            }else {
                echo "Fiksna cena <br/>";
                echo "<a class='btn btn-default' href='buy.php?id=" . $ad['id'] . "&user_id=" . $ad['user_id'] . "&price=" . $ad['price'] . "'>Kupi za ". $ad['price'] . " €</a>";
            }
            echo '</p>';
        } else {
            echo "Oglas je že potekel.";
        }

?>

    </div>

    <div class="panel panel-footer" id="comments">
        <hr>
        <h4>Komentiraj:</h4>
        <form class="form" action="comments_insert.php" method="post">
            <input type="hidden" name="ad_id" 
                   value="<?php echo $ad_id; ?>" />
            <textarea class="form-control" name="comment" rows="4"></textarea>
            <br />
            <input class="btn btn-primary" type="submit" name ="submit" value="Pošlji" />
        </form>
<?php
   //izpis vseh komentarjev za ta oglas
    $query = "SELECT c.*, u.first_name, u.last_name  
              FROM comments c INNER JOIN users u 
              ON c.user_id = u.id
              WHERE c.ad_id = $ad_id
              ORDER BY c.date_c DESC";
    $result = mysql_query($query);

    while ($row = mysql_fetch_array($result)) {
        echo '<div class="comment">';

        ?>

        <div class="panel panel-default">
            <div class="panel-heading">
                <?php
                if (($ad['user_id'] == $_SESSION['user_id']) ||
                ($row['user_id'] == $_SESSION['user_id'] )) {
                echo '<br />';
                echo '<a class="pull-right btn btn-xs btn-danger" href="comments_delete.php?id='.$row['id'].'&ad_id='.$ad_id.'">
                    Izbriši</a>';

                 echo $row['first_name'].' '.$row['last_name'].' - '
                .date('d. m. Y H:i:s',strtotime($row['date_c'])).'<br />';
            ?>

            </div>
            <div class="panel-body">
                <?php echo htmlspecialchars($row['content']); ?>
            </div>
        </div>
        <?php

        }
        echo '</div>';
    }
?>

    </div>
</div>

<?php
//preverim, če je oglas od trenutno prijavljenega
//uporabnika
if ($_SESSION['user_id'] == $ad['user_id']) {
    echo '<a class="btn btn-danger" href="ad_delete.php?id=' . $ad_id . '">Izbriši</a>';
    echo ' <a class="btn btn-primary" href="ad_edit.php?id=' . $ad_id . '">Uredi</a>';
}

include_once 'footer.php';
?>
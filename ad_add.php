<?php
    include_once 'header.php';
?>
<form class="form" action="ad_insert.php" method="post">
    <table border="0">
        <tr>
            <td>Naslov:</td>
            <td colspan="2"><input class="form-control" type="text" name="title" required="required" /></td>
        </tr>
        <tr>
            <td>Datum začetka:</td>
            <td colspan="2"><input class="form-control" type="date" name="date_b" required="required" /></td>
        </tr>
        <tr>
            <td>Datum konca:</td>
            <td colspan="2"><input class="form-control" type="date" name="date_e" required="required" /></td>
        </tr>
        <tr>
            <td>Cena:</td>
            <td colspan="2"><input class="form-control" type="number" name="price" required="required" /></td>
        </tr>
        <tr>
            <td>Avkcija:</td>
            <td><input type="radio" name="avkcija" checked="checked" required="required" value="0"/>Ne</td>
            <td><input type="radio" name="avkcija" required="required" value="1"/>Da</td>
        </tr>
        <tr>
            <td>Kategorija:</td>
            <td colspan="2">
                <?php 
                include_once 'database.php';
                
                $categories = mysql_query(
                        "SELECT * 
                         FROM categories");
                echo '<select name="category_id">';
                while ($category = mysql_fetch_array($categories)) {
                    echo '<option value="'
                         .$category["id"].'">'
                         .$category["name"]
                         .'</option>';
                }
                echo '</select>';
                ?>
            </td>
        </tr>
        <tr>
            <td>Opis:</td>
            <td colspan="2"><textarea class="form-control" name="description" cols="20" rows="8"></textarea></td>
        </tr>
        <tr>
            <td colspan="3">
                <input class="btn btn-primary" type="submit" value="Vnesi" />
            </td>
        </tr>
    </table>
</form>
 <?php   
    include_once 'footer.php';
?>
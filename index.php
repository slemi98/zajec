<?php
    include_once 'header.php';
    include_once 'database.php';
?>
<?php
    $sql = "SELECT * FROM users WHERE id=".$_SESSION['user_id'];
    //pošljem poizvedbo v PB in v spremenljivko query
    //se mi shrani rezultat
    $query = mysql_query($sql);
    //rezultat spremenim v "berljivo" obliko tabele oz. array-a
    $result = mysql_fetch_array($query);

    ?>
<h1>Pozdravljen <?php echo $result['first_name']  ?> </h1>

<p>


    <table id="tabela" class="table table-bordered">
        <tr>
            <th>Ime:</th>
            <td style="border:2px solid black"><?php echo $result['first_name'] ?></td>
        </tr>
        <tr>
            <th>Priimek: </th>
            <td style="border:2px solid black"><?php echo $result['last_name'] ?></td>
        </tr>
        <tr>
            <th>E-Pošta: </th>
            <td style="border:2px solid black"><?php echo $result['email'] ?></td>
        </tr>
        <tr>
            <th>Telefon: </th>
            <td style="border:2px solid black"><?php echo $result['phone'] ?></td>
        </tr>
    </table>

<?php
    include_once 'footer.php';
?>
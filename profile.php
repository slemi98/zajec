<?php
include_once 'header.php';
include_once 'database.php';

$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM users WHERE id=$user_id";
$result = mysql_query($query);
//imamo vse podatke o uporabniku
$user = mysql_fetch_array($result);

if (isset($_POST['submit'])) {
    if (!empty($_POST['pass0'])) {
        $pass0 = sha1($_POST['pass0']);
        if ($pass0 == $user['pass']) {
            //če je geslo enako staremu - spremenim v novo
            if ($_POST['pass1'] == $_POST['pass2']) {
                $pass = sha1($_POST['pass1']);
                mysql_query("UPDATE users SET pass = '$pass'
                            WHERE id = $user_id");
            }
        }
    }

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $query = sprintf("UPDATE users SET first_name='%s',
                            last_name = '%s',
                            phone = '%s',
                            email = '%s'
                           WHERE id = $user_id", 
            mysql_real_escape_string($first_name), 
            mysql_real_escape_string($last_name), 
            mysql_real_escape_string($phone), 
            mysql_real_escape_string($email));
    mysql_query($query);
}

$query = "SELECT * FROM users WHERE id=$user_id";
$result = mysql_query($query);
//imamo vse podatke o uporabniku
$user = mysql_fetch_array($result);
?>

<h1>Moj profil</h1>

<form class="form" action="profile.php" method="post">
    <div class="column">
        <div class="col-md-6">
            <div class="form-group">
                <label>Ime:</label>
                <input class="inline form-control" type="text" name="first_name" value="<?php echo $user['first_name']; ?>" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Priimek:</label>
                <input class="form-control" type="text" name="last_name" value="<?php echo $user['last_name']; ?>" />
            </div>
        </div>


    <div class="col-md-12">
        <div class="form-group">
            <label>E-pošta:</label>
            <input class="form-control" type="email" name="email" value="<?php echo $user['email']; ?>" />
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>Telefon:</label>
            <input class="form-control" type="text" name="phone" value="<?php echo $user['phone']; ?>" />
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>Geslo</label>
            <input class="form-control" type="password" name="pass0" />
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Geslo (Novo)</label>
            <input class="form-control" type="password" name="pass1" />
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Ponovno geslo (Novo)</label>
            <input class="form-control" type="password" name="pass2" />
        </div>
    </div>
    <div class="col-md-12">
        <input class="btn btn-primary" type="submit" name="submit" value="Spremeni" />
        <input class="btn btn-default" type="reset" name="reset" value="Prekliči" />
    </div>



    </div>
</form>

<?php
include_once 'footer.php';
?>

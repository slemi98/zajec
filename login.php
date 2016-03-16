<?php
    include_once 'header.php';
?>

<form class="form" action="login_check.php" method="post" onsubmit="return formCheck(this)">
   <div class="input-group">
       <label>Email</label>
       <input class="form-control" type="text" name="email" />
   </div>
    <div class="input-group">
       <label>Geslo</label>
        <input class="form-control" type="password" name="pass" onkeypress="skrij()" /><span id="error"></span>
   </div>
    <div class="input-group">
        <input class="btn btn-primary" type="submit" name="submit" value="Prijavi" />
    </div>
</form>

<?php
    include_once 'footer.php';
?>
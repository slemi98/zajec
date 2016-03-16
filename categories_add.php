<?php
    include_once 'header.php';
?>
<form action="categories_insert.php" method="post">
    <table border="0">
        <tr>
            <td><label>Ime:</label></td>
            <td><input class="form-control" type="text" name="name" required="required" /></td>
        </tr>
        <tr>
            <td colspan="2">
                <input class="btn btn-primary" type="submit" value="Vnesi" />
            </td>
        </tr>
    </table>
</form>
 <?php   
    include_once 'footer.php';
?>
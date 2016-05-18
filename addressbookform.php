<?php

$id = $_GET['id'];
if($id) {
    $data = viewById('addressbook', $id);
}
?>



<form action="addressbookorder.php?id=<?=$_GET['id']?>" method="post">
    <table border="0">
        <tr>
            <td><label for="n">name</label></td>
            <td align="center"><input type="text" name="name" id="n" value="<?=htmlentities($data['name'])?>" required size="50" maxlength="50"></td>
        </tr>
        <tr>
            <td><label for="a">address</label></td>
            <td align="center"><input type="text" name="address" id="a" value="<?=$data['address']?>"  size="50" maxlength="50"></td>
        </tr>
        <tr>
            <td><label for="c">city</label></td>
            <td align="center"><input type="text" name="city" id="c" value="<?=$data['city']?>" size="50" maxlength="50"></td>
        </tr><tr>
        <td><label for="p">phonenumber</label></td>
        <td align="center"><input type="tel" name="phonenumber" id="p" value="<?=$data['phonenumber']?>" required size="50" maxlength="50"></td>
    </tr><tr>
        <td><label for="e">email</label></td>
        <td align="center"><input type="email" name="email" id="e" value="<?=$data['email']?>" size="50" maxlength="50"></td>
    </tr>
        <tr>
            <td colspan="2" align="center"><input type="submit" value="save"></td>
        </tr>
    </table>
</form>

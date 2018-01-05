<?php
include "conn.php";



if (!isset($_GET['id_matkul'])){
	header( 'Location: home.php?page=setup_matkul');
}

$id_matkul= $_GET['id_matkul'];

$query = mysql_query("SELECT * FROM setup_matkul WHERE id_matkul='$id_matkul'");

$result = mysql_fetch_array($query);

if(mysql_num_rows($query) < 1){

	die("Data tidak ditemukan");
}
if(isset($_POST['edit'])){
  
  $nama_matkul=ucwords(htmlentities($_POST['nama_matkul']));
  echo "$nama_matkul";
  $query=mysql_query("UPDATE setup_matkul SET nama_matkul='$nama_matkul' WHERE id_matkul='$id_matkul'");
  
  
  if($query){
    ?><script language="javascript">document.location.href="?page=setup_matkul&status=25";</script><?php
  }else{
    ?><script language="javascript">document.location.href="?page=setup_matkul&status=26";</script><?php
  }
  
}else{
  unset($_POST['edit']);
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Form Edit</title>
</head>
<body>
	<header>
		<h3>Form Edit</h3>
	</header>
	<form action="" method="post">
 	        <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tr valign="top">
              <td>
                  <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tr valign="top">
              <td>
                  <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
                    <tr>
                      <th valign="top">Nama Mata Kuliah </th>
                      <td><input type="text" class="inp-form" name="nama_matkul" value="<?php $result['nama_matkul']; ?>" /></td>
                      <td></td>
                    </tr>
                    <tr>
                      <th>&nbsp;</th>
                      <td valign="top"><input type="submit" name="edit" value="edit" class="form-submit" />
                      </td>
                      <td></td>
                    </tr>
                  </table>
              </td>
              <td>
              </td>
            </tr>
            <tr>
              <td><img src="images/shared/blank.gif" width="695" height="1" alt="blank" /></td>
              <td></td>
            </tr>
        	</table>
			</form>

</body>
</html>

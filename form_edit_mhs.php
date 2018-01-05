<?php
include "conn.php";



if (!isset($_GET['id_mahasiswa'])){
  header( 'Location: home.php?page=data_mahasiswa');
}

$id_mahasiswa= $_GET['id_mahasiswa'];

$query = mysql_query("SELECT * FROM data_mahasiswa WHERE id_mahasiswa='$id_mahasiswa'");

$result = mysql_fetch_array($query);

if(mysql_num_rows($query) < 1){
  
  die("Data tidak ditemukan");
}
if(isset($_POST['edit'])){
  
  $nama_mahasiswa=ucwords(htmlentities($_POST['nama_mahasiswa']));
  $nim=htmlentities($_POST['nim']);
  $kelamin=htmlentities($_POST['kelamin']);

  $username=htmlentities($_POST['username']);
  $password=md5(htmlentities($_POST['password']));
  $foto = $_FILES['foto']['name'];
  $tmp = $_FILES['foto']['tmp_name'];
  

  $fotobaru = date('dmYHis').$foto;
  

  $path = "gambar/".$fotobaru;
   
 
  if(move_uploaded_file($tmp, $path))
    $query = mysql_query("SELECT * FROM data_mahasiswa WHERE id_mahasiswa='$id_mahasiswa'");
    $row = mysql_fetch_array($query); 

    if(is_file("gambar/".$row['foto'])) 
      unlink("gambar/".$row['foto']); 

  $query1=mysql_query("UPDATE data_mahasiswa SET nama_mahasiswa='$nama_mahasiswa', nim='$nim', kelamin='$kelamin', username='$username', password='$password', foto='$fotobaru' WHERE id_mahasiswa='$id_mahasiswa'");
  
  
  if($query1){
    ?><script language="javascript">document.location.href="?page=data_mahasiswa&status=21";</script><?php
  }else{
    ?><script language="javascript">document.location.href="?page=data_mahasiswa&status=22";</script><?php
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
  <div class="row">
          
          <div class="col-lg-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-book"></i> Edit Data Mahasiswa</h3> 
                        </div>
                        <div class="panel-body">
                        <div class="table-responsive">
  <div class="form-group">
  <div class="form-group">
  <form action="" method="post" enctype="multipart/form-data">
          <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tr valign="top">
              <td>
                  <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
                    <tr>
                      <th>Nama Mahasiswa </th>
                      <td><input type="text" class="form-control" name="nama_mahasiswa" value="<?php echo $result['nama_mahasiswa']; ?>"/></td>
                      <td></td>
                    </tr>
                     <tr>
                      <th>NIM</th>
                      <td><input style="width: 350px;" type="text" class="form-control" name="nim" value="<?php echo $result['nim']; ?>"/></td>
                      <td></td>
                    </tr>
                    <tr>
                      <th>Kelamin</th>
                      <td><select name="kelamin"  class="form-control">
                          <option value="laki-laki">Laki-laki</option>
                          <option value="perempuan">Perempuan</option>
                        </select>
                      </td>
                      <td></td>
                    </tr>

                  
                
                     <tr>
                      <th>Username</th>
                      <td><input type="text" class="form-control" name="username" value="<?php echo $result['username']; ?>"/></td>
                      <td></td>
                    </tr>
                     <tr>
                      <th>Password</th>
                      <td><input type="password" class="form-control" name="password" value="<?php echo $result['password']; ?>"/></td>
                      <td></td>
                    </tr>
                    <tr>
                    <th></th>
                    <th>
                    <?php 
                    if(empty($gambar)){
                      $gambar='nopic.jpg';
                    }else{
                      $gambar=$gambar;
                    }
                    ?>
                    <img src="./gambar/<?php echo $gambar;?>" height="101" width="83">
                    </th>
                  </tr>
                    <tr>
                    <th>Photo</th>
                    <td>            
                      <input type="file" name="foto" size="30"/>
                    </td>
                    <td></td>
                  </tr>
                    <tr>
                      <th>&nbsp;</th>
                      <td valign="top">
                        <input type="submit" name="edit" id="edit" value="Edit" class="btn btn-info" />
                      </td>
                      <td></td>
                    </tr>
                  </table>
              </td>
              <td>
              </td>
            </tr>

      </form>
    </div>
  </table>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>


</body>
</html>

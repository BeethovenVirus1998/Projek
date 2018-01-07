<?php

include "conn.php";

if(isset($_POST['submit'])){

  $nama_mahasiswa=ucwords(htmlentities($_POST['nama_mahasiswa']));
  $nim=htmlentities($_POST['nim']);
  $kelamin=htmlentities($_POST['kelamin']);
  
  $username=htmlentities($_POST['username']);
  $password=md5(htmlentities($_POST['password']));
  $foto = $_FILES['foto']['name'];
$tmp = $_FILES['foto']['tmp_name'];

$fotobaru = date('dmYHis').$foto;
$path = "gambar/".$fotobaru;
  
  if(move_uploaded_file($tmp, $path)){
  $sql= "INSERT into data_mahasiswa(nama_mahasiswa,nim,kelamin,username,password,foto) values('$nama_mahasiswa','$nim','$kelamin', '$username','$password','$fotobaru')";
    $query = mysqli_query($koneksi, $sql);
  if($query){
    ?><script language="javascript">document.location.href="?page=data_mahasiswa&status=1";</script><?php
  }else{
    ?><script language="javascript">document.location.href="?page=data_mahasiswa&status=2";</script><?php
  }
}
  
}else{
  unset($_POST['submit']);
}

if ($_GET['mode']=='delete') {
  $username=$_GET['username'];
  $id_mahasiswa=$_GET['id_mahasiswa'];

  $query1 = mysqli_query($koneksi, "SELECT * FROM data_mahasiswa WHERE id_mahasiswa='$id_mahasiswa'");
$row = mysqli_fetch_array($query1); 


if(is_file("gambar/".$row['foto'])) 
  unlink("gambar/".$row['foto']);

  $query=mysqli_query($koneksi, "DELETE from data_mahasiswa where id_mahasiswa='$id_mahasiswa'");

  if($query){
    ?><script language="javascript">document.location.href="?page=data_mahasiswa&status=7";</script><?php
  }else{
    ?><script language="javascript">document.location.href="?page=data_mahasiswa&status=8";</script><?php
  }
}

?>


        
            <?php
      if($_GET['status']=='1'){
      ?>
      
            <div id="message-green">
            <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tr>
                <td class="green-left">Data berhasil disimpan</td>
                <td class="green-right"><a class="close-green"><img src="images/table/icon_close_green.gif"   alt="" /></a></td>
            </tr>
            </table>
            </div>
            
      <?php
      }
      
      if($_GET['status']=='0'){
      ?>

            <div id="message-red">
            <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tr>
                <td class="red-left">data gagal di simpan</td>
                <td class="red-right"><a class="close-red"><img src="images/table/icon_close_red.gif"   alt="" /></a></td>
            </tr>
            </table>
            </div>
            
      <?php
      }
      ?>


      <div class="row">
            
          <div class="col-lg-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-user"></i> Data Mahasiswa</h3> 
                        </div>

                         
                        <div class="panel-body">
                        <div class="table-responsive">
    <div class="form-group">
        <form action="?page=data_mahasiswa" method="post" enctype="multipart/form-data">
           <input type='text' class="form-control" style="margin-bottom: 4px;" name='qcari' placeholder='Cari berdasarkan NIM atau Nama Mahasiswa'/> 
           <input type='submit' value='Cari Data' class="btn btn-sm btn-primary" /> <a href='?page=data_mahasiswa' class="btn btn-sm btn-success" >Refresh</i></a><br><br>

          <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tr valign="top">
              <td>
                  <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
                    <tr>
                      <th>Nama Mahasiswa </th>
                      <td><input style="width: 350px;" type="text" class="form-control" name="nama_mahasiswa"/></td>
                      <td></td>
                    </tr>
                     <tr>
                      <th>NIM </th>
                      <td><input type="text" class="form-control" name="nim"/></td>
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
                      <td><input style="width: 350px;" type="text" class="form-control" name="username"/></td>
                      <td></td>
                    </tr>
                     <tr>
                      <th>Password</th>
                      <td><input type="password" class="form-control" name="password"/></td>
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
                      <td><input type="submit" name="submit" value="Submit" class="btn btn-primary" />
                          <input type="reset" value="Reset" class="btn btn-danger"  />
                      </td>
                      <td></td>
                    </tr>
                  </table>
                
              </td>
              <td>
              </td>
            </tr>
            
          </table>
      </form>
</div>
      <center>
    <a href="javascript:;"><img src="./images/excel-icon.png" title="Export Data" width="50" height="50" border="0" onClick="window.open('./excel/export_data_mahasiswa.php','scrollwindow','top=200,left=300,width=800,height=500');"></a>
    </center><br>



        <form id="mainform" action="">
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="table table-hover table table-bordered">
        <tr>
            <th width="5%" class="info">Nomor</th>
            <th width="27%" class="info">Nama Mahasiswa</th>
            <th width="12%" class="info">NIM</th>
            <th width="7%" class="info">Kelamin</th>
            <th width="16%" class="info">Username</th>
            <th width="10%" class="info">Password</th>
             <th width="10%" class="info">Foto</th>
            <th width="15%" class="info">Aksi</th>
        </tr>
        
        
        <?php
                    $query1="select * from data_mahasiswa order by nama_mahasiswa asc";
                    
                    if(isset($_POST['qcari'])){
                 $qcari=$_POST['qcari'];
                 $query1="SELECT * FROM  data_mahasiswa
                 where nim like '%$qcari%'
                 or nama_mahasiswa like '%$qcari%'  ";
                    }
                    $view=mysqli_query($koneksi,$query1) or die(mysqli_error());
                    

    
    $no=0;
    while($row=mysqli_fetch_array($view)){
    ?>  
    <tr>
            <td><?php echo $no=$no+1;?></td>
            <td><?php echo $row['nama_mahasiswa'];?></td>
            <td><?php echo $row['nim'];?></td>
            <td><?php echo $row['kelamin'];?></td>
           
            <td><?php echo $row['username'];?></td>
            <td><?php echo $row['password'];?></td>
            <td>
              <?php 
              if(empty($row['foto'])){
                $gambar='nopic.jpg';
              }else{
                $gambar=$row['foto'];
              }
              ?>
              <img src="./gambar/<?php echo $gambar;?>" height="107" width="83">
              </td>
            <td class="options-width">
            <a href="?page=data_mahasiswa&mode=delete&id_mahasiswa=<?php echo $row['id_mahasiswa'];?>&username=<?php echo $row['username'];?>" title="Delete"><button type="button" class="btn btn-primary"> <span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button></a>
            <a href="?page=form_edit_mhs&mode=update&id_mahasiswa=<?php echo $row['id_mahasiswa'];?>&username=<?php echo $row['username'];?>" title="Edit" ><button type="button" class="btn btn-primary"> <span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button></a>            
            </td>
        </tr>
    <?php
    }
    ?>
        </table>
        
        </form>
      </div>
    </div>
  </div>
</div>
</div>
</div>


        
        
  

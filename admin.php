<?php session_start();



    include "conn.php";
?>


      
        <div class="row">
                  <div class="col-lg-9 main-chart">
                   
                    <div class="row mtbox">
                    
                    <?php $tampil=mysqli_query($koneksi,"select * from data_dosen order by id_dosen desc");
                        $total=mysqli_num_rows($tampil);
                    ?>
                        <div class="col-md-2 col-sm-2 col-md-offset-1 box0">
                            <div class="box1">
                                <h3><a href="home.php?page=data_dosen" class="btn btn-lg btn-danger">Dosen</a></h3>
                                <span class="glyphicon glyphicon-list-alt"></span>
                                <h3><?php echo "$total"; ?></h3>
                            </div>
                                <p>Terdapat <?php echo "$total"; ?> Dosen </p>
                        </div>
                        
                        <?php $tampil=mysqli_query($koneksi,"select * from data_mahasiswa order by id_mahasiswa desc");
                        $total_mahasiswa=mysqli_num_rows($tampil);
                    ?>
                        <div class="col-md-2 col-sm-2 box0">
                            <div class="box1">
                                <h3><a href="home.php?page=data_mahasiswa" class="btn btn-lg btn-primary">Mahasiswa</a></h3>
                                <span class="glyphicon glyphicon-user"></span>
                                <h3><?php echo "$total_mahasiswa"; ?></h3>
                            </div>
                                <p>Terdapat <?php echo "$total_mahasiswa"; ?> Mahasiswa</p>
                        </div>
                        <?php $tampil=mysqli_query($koneksi,"select * from setup_matkul order by id_matkul desc");
                        $total_matkul=mysqli_num_rows($tampil);
                    ?>
                        <div class="col-md-2 col-sm-2 box0">
                            <div class="box1">
                                <h3><a href="home.php?page=setup_matkul" class="btn btn-lg btn-info">Mata Kuliah</a></h3>
                                <span class="glyphicon glyphicon-book"></span>
                                <h3><?php echo "$total_matkul"; ?></h3>
                            </div>
                                <p>Terdapat <?php echo "$total_matkul"; ?> Mata Kuliah</p>
                        </div>
                        <?php $tampil=mysqli_query($koneksi,"select * from setup_kelas order by id_kelas desc");
                        $total_kelas=mysqli_num_rows($tampil);
                    ?>
                        <div class="col-md-2 col-sm-2 box0">
                            <div class="box1">
                                <h3><a href="home.php?page=setup_kelas" class="btn btn-lg btn-warning">Kelas</a></h3>
                                <span class="glyphicon glyphicon-home"></span>
                                <h3><?php echo "$total_kelas"; ?></h3>
                            </div>
                                <p>Terdapat <?php echo "$total_kelas"; ?> Kelas</p>
                        </div>
                        

             </div>
         </div>
     </div>
 

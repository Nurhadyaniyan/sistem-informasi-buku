<?php 

  include "header.php";
  include "koneksi.php";

  $isbn = $_GET['isbn'];
  $buku = mysqli_query($koneksi, "select * from buku where isbn='$isbn'");
  $row = mysqli_fetch_array($buku);


?>


        <div class="container">

            <h3>EDIT BUKU </h3>
            <form action="update_buku.php" method="POST">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">ISBN</label>
                    <div class="col-sm-10">
                        <input readonly="" type="text" name="isbn" value="<?php echo $row['isbn']; ?>" placeholder="Masukan ISBN" class="form-control">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Judul Buku</label>
                    <div class="col-sm-10">
                        <input type="text" name="judul_buku" value="<?php echo $row['judul_buku']; ?>"placeholder="Masukan Judul Buku" class="form-control">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Penulis</label>
                    <div class="col-sm-10">
                        <select name="penulis" class="form-control">
                            <?php  
                                $penulis = mysqli_query($koneksi, "select * from penulis");
                                while ($p = mysqli_fetch_array($penulis)){
                                    echo "<option value='$p[id_penulis]'";
                                    if($row['id_penulis']== $p['id_penulis']){
                                        echo "selected";
                                    }

                                    echo ">$p[nama_penulis]</option>";
                                }
                            ?>

                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">kategori</label>
                    <div class="col-sm-10">
                        <select name="kategori" class="form-control">
                            <?php  
                                $kategori = mysqli_query($koneksi, "select * from kategori");
                                while ($k = mysqli_fetch_array($kategori)){
                                    echo "<option value='$k[id_kategori]'";
                                    echo $row['id_kategori'] == $k['id_kategori']?'selected':'';

                                   echo ">".strtoupper($k['nama_kategori'])."</option>";
                                }
                            ?>

                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Deskripsi</label>
                    <div class="col-sm-10">
                        <textarea name="deskripsi" class="form-control"><?php echo $row['deskripsi']; ?></textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Harga</label>
                    <div class="col-sm-10">
                        <input type="text" name="harga" value="<?php echo $row['harga']; ?>"placeholder="Masukan harga" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-danger">Simpan Data</button>
                        <a href="index.php" class="btn btn-primary">Batal</a>
                    </div>
                </div>
            </form>
        </div>

<?php  

  include "footer.php";

?>
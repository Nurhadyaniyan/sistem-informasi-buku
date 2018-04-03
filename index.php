<?php 

  include "header.php";
  include "koneksi.php";

?>

        <div class="container">
          <div class="row">
            <div class="col-8">
              <h3>Data Buku</h3>
            </div>
            <div class="col-4">
                <form method="POST" class="form-inline" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                  <div class="form-group mx-sm-3 mb-2">
                    <label for="inputPassword2" class="sr-only">Password</label>
                 <input type="text" class="form-control" name="keyword" placeholder="Masukan Keyword">
            </div>
         <button name="pencarian" type="submit" class="btn btn-primary mb-2">Cari Data</button>
      </form>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <table class="table table-bordered">
                <tr>
                    <th>ISBN</th>
                    <th>JUDUL BUKU</th>
                    <th>PENULIS</th>
                    <th>HARGA</th>
                    <th>AKSI</th>
                </tr>

    <?php  
    //langkah pertama membuat pagination
    $batas = 2;
    $halaman = isset($_GET['hal']) ? $_GET['hal'] : 0;
    IF(isset($_POST['pencarian'])){
      //query pencarian data
      $keyword = $_POST['keyword'];
      $sql = "SELECT b.isbn,b.judul_buku,b.harga,p.nama_penulis,k.nama_kategori 
            FROM buku as b, penulis as p, kategori as k
            where b.id_penulis=p.id_penulis and k.id_kategori=b.id_kategori and b.judul_buku like '%$keyword%' limit $halaman, $batas";
    }else{
      //query menampilkan data biasa
    $sql = "SELECT b.isbn,b.judul_buku,b.harga,p.nama_penulis,k.nama_kategori 
            FROM buku as b, penulis as p, kategori as k
            where b.id_penulis=p.id_penulis and k.id_kategori=b.id_kategori limit $halaman, $batas";
    }
    $buku = mysqli_query($koneksi, $sql);
    while ($row = mysqli_fetch_array($buku)) {
      echo "<tr>
                    <td>$row[isbn]</td>
                    <td>$row[judul_buku]</td>
                    <td>$row[nama_penulis]</td>
                    <td>$row[harga]</td>
                    <td>
                    <a href='edit_buku.php?isbn=$row[isbn]' class='btn btn-success btn-sm'> EDIT </a>
                    <a href='delete_buku.php?isbn=$row[isbn]' class='btn btn-info btn-sm'> DELETE </a>
                    </td>
                </tr>";
    }

                ?>
               
            </table>
            <div class="float-right">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">

                        <?php
                          if((!isset($_GET['hal'])) or ($_GET['hal'])){
                            $prev = 1;
                          }else{
                            $prev = $_GET['hal']-1;
                          }
                        ?>
                        <li class="page-item"><a class="page-link" href="index.php?hal=<?php echo $prev; ?>">Previous</a></li>
                        <?php
                          //langkah kedua membuat pagination

                        //ini langkah sql untuk membuat pagination
                         $sql_2 = mysqli_query($koneksi,"SELECT b.isbn,b.judul_buku,b.harga,p.nama_penulis,k.nama_kategori 
                         FROM buku as b, penulis as p, kategori as k
                         where b.id_penulis=p.id_penulis and k.id_kategori=b.id_kategori order by b.isbn ASC");
                          $jumlah_data    = mysqli_num_rows($sql_2);

                          $jumlah_halaman = ceil($jumlah_data/$batas);
                          for($hal=1; $hal<=$jumlah_halaman; $hal++){
                            echo "<li class='page-item'><a class='page-link' href='index.php?hal=$hal'>$hal</a></li>";
                          }
                        ?>
                        <li class="page-item"><a class="page-link" href="index.php?hal=<?php echo $hal; ?>">Next</a></li>
                    </ul>
                </nav>
            </div>
            <a href="input_buku.php" class="btn btn-danger btn-sm">Input Data Buku </a>
            </div>
          </div>

        </div>

<?php  

  include "footer.php";

?>
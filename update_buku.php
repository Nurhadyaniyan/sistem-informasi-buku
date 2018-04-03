<?php 

    //menyimpan hasil inputan dari file input_buku
    $isbn       = $_POST['isbn'];
    $judul_buku = $_POST['judul_buku'];
    $penulis    = $_POST['penulis'];
    $kategori= $_POST['kategori'];
    $deskripsi  = $_POST['deskripsi'];
    $harga      = $_POST['harga'];

    include 'koneksi.php';
    //sintaks sql untuk insert data pada file input_buku
    $sql = "update buku set judul_buku='$judul_buku', id_kategori='$kategori', id_penulis='$penulis', deskripsi='$deskripsi', harga='$harga'
        where isbn='$isbn'";   
    //perintah untuk mengeksekusi query di atas
    $update = mysqli_query($koneksi, $sql);

    if($insert){
        echo "insert berhasil";
    }else{
        echo "insert gagal";
    }

    header("location:index.php");
?>
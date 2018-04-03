<?php 

	$isbn = $_GET['isbn'];
	if($isbn){
		include 'koneksi.php';
		$delete = mysqli_query($koneksi,"delete from buku where isbn='$isbn'");
	}else{
		echo "pesan eror";
	}

	header("location:index.php");

?>
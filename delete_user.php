<?php 

	$id_user = $_GET['id'];
	if($id_user){
		include 'koneksi.php';
		$delete = mysqli_query($koneksi,"delete from user where id_user='$id_user");
	}else{
		echo "pesan eror";
	}

	header("location:user.php");

?>
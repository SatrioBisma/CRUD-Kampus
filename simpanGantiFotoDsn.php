<?php
//panggil file fungsi
require "fungsi.php";

$id = $_POST['id'];
$uploadOk = 1;

$sql = "select * from dosen where id='$id'";
$hasil = mysqli_query($koneksi, $sql) or die($mysql_error());
$row = mysqli_fetch_assoc($hasil);

$foto_u = $row['foto'];

//Set lokasi dan nama file foto
$folderupload = "fotodosen/";
$fileupload = $folderupload . basename($_FILES['fotodosen']['name']);
$filefoto = basename($_FILES['fotodosen']['name']);                   			// A12.2018.0555.jpg


//ambil jenis file
$jenisfilefoto = strtolower(pathinfo($fileupload, PATHINFO_EXTENSION));

// Check jika file foto sudah ada
if (file_exists($fileupload)) {
	echo "Maaf, file foto sudah ada<br>";
	$uploadOk = 0;
}

// Check ukuran file
if ($_FILES["fotodosen"]["size"] > 1000000) {
	echo "Maaf, ukuran file foto harus kurang dari 1 MB<br>";
	$uploadOk = 0;
}

// Hanya file tertentu yang dapat digunakan
if (
	$jenisfilefoto != "jpg" && $jenisfilefoto != "png" && $jenisfilefoto != "jpeg"
	&& $jenisfilefoto != "gif"
) {
	echo "Maaf, hanya file JPG, JPEG, PNG & GIF yang diperbolehkan<br>";
	$uploadOk = 0;
}

// Check jika terjadi kesalahan
if ($uploadOk == 0) {
	echo "Maaf, file tidak dapat terupload<br>";
	// jika semua berjalan lancar
} else {

	if (file_exists("foto/$foto_u")) {
		unlink("foto/$foto_u");
	}

	if (move_uploaded_file($_FILES["fotodosen"]["tmp_name"], $fileupload)) {
		//membuat query
		//echo $id." - ".$fileupload;exit;
		$sql = "update dosen set foto='$filefoto' where id='$id'";
		mysqli_query($koneksi, $sql) or die(mysqli_error($koneksi));
		header("location:updateDsn.php");
	} else {
		echo "Maaf, terjadi kesalahan saat mengupload file foto<br>";
	}
}

<?php
//memanggil file pustaka fungsi
require "fungsi.php";

//memindahkan data kiriman dari form ke var biasa
$nim=$_POST["nim"];
$kode=$_POST["kodeProgdi"];
$nimTahun=$_POST["nimTahun"];
$nimOtomatis="$kode.$nimTahun.$nim";
$nama=$_POST["nama"];
$email=$_POST["email"];
$uploadOk=1;
$cekNIM=mysqli_num_rows(mysqli_query($koneksi, "select nim from mhs where nim='$nimOtomatis'"));
//Set lokasi dan nama file foto
$folderupload ="foto/";
$fileupload = $folderupload . basename($_FILES['foto']['name']); // foto/A12.2018.05555.jpg
$filefoto = basename($_FILES['foto']['name']);                  // A12.2018.0555.jpg

//ambil jenis file
$jenisfilefoto = strtolower(pathinfo($fileupload,PATHINFO_EXTENSION)); //jpg,png,gif

// Check jika file foto sudah ada
if (file_exists($fileupload)) {
    echo "Maaf, file foto sudah ada<br>";
    $uploadOk = 0;
}

// Check ukuran file
if ($_FILES["foto"]["size"] > 1000000) {
    echo "Maaf, ukuran file foto harus kurang dari 1 MB<br>";
    $uploadOk = 0;
}

// Hanya file tertentu yang dapat digunakan
if($jenisfilefoto != "jpg" && $jenisfilefoto != "png" && $jenisfilefoto != "jpeg"
&& $jenisfilefoto != "gif" ) {
    echo "Maaf, hanya file JPG, JPEG, PNG & GIF yang diperbolehkan<br>";
    $uploadOk = 0;
}

// Check jika terjadi kesalahan
if ($uploadOk == 0) {
    echo "Maaf, file tidak dapat terupload<br>";
// jika semua berjalan lancar
} else {
    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $fileupload) && $cekNIM == 0) {        
        //membuat query
		$sql="insert mhs values('','$nimOtomatis','$nama','$email','$filefoto')";
		mysqli_query($koneksi,$sql);
		header("location:addMhs.php");
		//echo "File ". basename( $_FILES["foto"]["name"]). " berhasil diupload";
    } else {
        echo '<script languange="javascript">
			alert("Data Gagal Tersimpan");
			window.location="addMhs.php";
			</script>';
			exit();
    }
}
?>
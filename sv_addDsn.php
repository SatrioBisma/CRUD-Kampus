<?php
include "fungsi.php"; // masukan konekasi DB
// ambil variable
$npp = $_POST['npp'];
$namadosen = $_POST['namadosen'];
$homebase = $_POST["homebase"];
$uploadOk = 1;
//Set lokasi dan nama file foto
$folderupload = "fotodosen/";

//basename : mengambil bagian akhir dari direktori tersebut
$fileupload = $folderupload . basename($_FILES['foto']['name']);      // foto/A12.2018.05555.jpg
//basename : mengambil bagian akhir dari direktori tersebut
$filefoto = basename($_FILES["foto"]["name"]);                       // A12.2018.0555.jpg

//ambil jenis file
//strtolower() :  mengkonversi string ke huruf kecil
//Fungsi pathinfo() : digunakan untuk mengembalikan informasi tentang jalur file.
//PATHINFO_EXTENSION untuk mendapatkan path file name
$jenisfilefoto = strtolower(pathinfo($fileupload, PATHINFO_EXTENSION)); //jpg,png,gif

// Check jika file foto sudah ada
// file_exists(): digunakan untuk memeriksa apakah file atau direktori ada.
if (file_exists($fileupload)) {
    echo "Maaf, file foto sudah ada<br>";
    $uploadOk = 0;
}
//Bahwa variabel $_FILES merupakan sebuah array asosiatif
// array asosiatif : Ia adalah suatu array di mana key atau kuncinya bukan berupa indeks integer yang dimulai dari 0, akan tetapi yang menjadi key-nya adalah suatu teks bertipe data string
//Setiap file yang dikirim dari HTML form akan menjadi item dari array $_FILES

// Check ukuran file
if ($_FILES["foto"]["size"] > 1000000) {
    echo "Maaf, ukuran file foto harus kurang dari 1 MB<br>";
    $uploadOk = 0;
}
// Hanya file tertentu yang dapat digunakan
if ($jenisfilefoto != "jpg" && $jenisfilefoto != "png" && $jenisfilefoto != "jpeg" && $jenisfilefoto != "gif") {
    echo "Maaf, hanya file JPG, JPEG, PNG & GIF yang diperbolehkan<br>";
    $uploadOk = 0;
}

// Check jika terjadi kesalahan
if ($uploadOk == 0) {
    echo "Maaf, file tidak dapat terupload<br>";
    // jika semua berjalan lancar
} else {
    //move_uploaded_file adalah fungsi bawaan PHP yang berguna untuk mengecek apakah 
    // $lokasi_file telah diupload ke $direktori
    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $fileupload)) {
        //membuat query
        $sql = "insert dosen values('','$npp','$namadosen','$homebase','$filefoto')";
        mysqli_query($koneksi, $sql);
        header("location:addDsn.php");
        //echo "File ". basename( $_FILES["foto"]["name"]). " berhasil diupload";
    } else {
        echo "Data gagal tersimpan";
    }
}
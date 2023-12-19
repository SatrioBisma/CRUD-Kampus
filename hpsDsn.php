<?php
//memanggil file pustaka fungsi
require "fungsi.php";

//memindahkan data kiriman dari form ke var biasa
$id = $_GET["kode"];

$sql = $koneksi->query("select * from dosen where id='$id'");
$data = $sql->fetch_assoc();
$foto = $data['foto'];
if (file_exists("foto/$foto")) {
    unlink("foto/$foto");
}
$sql = $koneksi->query("select * from dosen where id='$id'");
//membuat query hapus data
$sql = "delete from dosen where id=$id";
mysqli_query($koneksi, $sql);
header("location:updateDsn.php");
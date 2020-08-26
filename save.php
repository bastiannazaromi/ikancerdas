<?php
// Parameter untuk database MySQL
$host = "localhost"; // Nama host atau IP server
$user = "root";      // Username MySQL
$pass = "";          // Password MySQL
$name = "dbikan";      // Nama database MySQL
 
date_default_timezone_set("Asia/Jakarta");
$tanggal = date('Y-m-d H:i:s');
$jam_sekarang = date('H');
$hari_sekarang = date('d');
$bulan_sekarang = date('m');
$tahun_sekarang = date('Y');

// Baca parameter get  /simpan.php?tinggi_air=x <===
$pakan = $_GET["pakan"];
$kekeruhan = $_GET["kekeruhan"];


// Buat koneksi ke database MySQL
$conn = new mysqli($host, $user, $pass, $name);
 
// Periksa apakah koneksi sudah berhasil
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
 
// Perintah SQL untuk menyimpan data suhu ke tabel data_rekap
$sql = "INSERT INTO tbrekap (waktu, pakan, kekeruhan) VALUES ('$tanggal', '$pakan', '$kekeruhan)";

// $sql2 = "SELECT * FROM tbrekap ORDER BY id DESC LIMIT 1";
// $result = $conn->query($sql2);

// if ($result) {
//     $row   = $result->fetch_array(MYSQLI_ASSOC);
//     $pakan_sebelumnya = $row["pakan"];
//     $kekeruhan_sebelumnya = $row["kekeruhan"];
//     $waktu = $row["waktu"];
// }

// $waktu = strtotime($waktu);
// $jam_lalu = date('H', $waktu);
// $hari_lalu = date('d', $waktu);
// $bulan_lalu = date('m', $waktu);
// $tahun_lalu = date('Y', $waktu);

// $selisih_jam = $jam_sekarang - $jam_lalu;
// $selisih_hari = $hari_sekarang - $hari_lalu;
// $selisih_bulan = $bulan_sekarang - $bulan_lalu;
// $selisih_tahun = $tahun_sekarang - $tahun_lalu;

// if ($pakan_sebelumnya == $pakan && $kekeruhan_sebelumnya == $kekeruhan)
// {
// 	if ($selisih_jam >= 1 || $selisih_hari >= 1 || $selisih_bulan >= 1 || $selisih_tahun >= 1)
// 	{
// 	    // Jalankan dan periksa apakah perintah berhasil dijalankan
// 		if ($conn->query($sql) === TRUE)
// 		{
// 	    	echo "Sukses";
// 		}
// 		else
// 		{
// 		    echo "Error: ". $conn->error;
// 		}
// 	}
// 	else
// 	{
// 		echo "Sukses";
// 	}
// }
// else
// {
// 	// Jalankan dan periksa apakah perintah berhasil dijalankan
// 	if ($conn->query($sql) === TRUE)
// 	{
//     	echo "Sukses";
// 	}
// 	else
// 	{
// 	    echo "Error: ". $conn->error;
// 	}
// }

if ($conn->query($sql) === TRUE)
	{
    	echo "Sukses";
    }
    else {
        echo "gagal";
    }

$conn->close();
?>
<?php
#1. koneksikan file ini
include("../koneksi.php");

#2. mengambil id dari tombol hapus
$id_tamu = $_GET['xyz'];

#3. menulis query
$hapus = "DELETE FROM tb_tamu WHERE id_tamu='$id_tamu'";

#4. jalankan query
$proses = mysqli_query($koneksi, $hapus);

#5. mengalihkan halaman
// header("location:index.php");
?>
<script>
    document.location="index.php";
</script>
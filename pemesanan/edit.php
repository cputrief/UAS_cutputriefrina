<?php
#1. koneksikan file ini
include("../koneksi.php");

#2. Ambil ID pemesanan dari URL
$id_pemesanan = $_GET['id'];

#3. Ambil data pemesanan berdasarkan ID
$query = "SELECT tb_pemesanan.*, tb_tamu.nm_tamu FROM tb_pemesanan 
          INNER JOIN tb_tamu ON tb_pemesanan.tamu_id = tb_tamu.id 
          WHERE tb_pemesanan.id_pemesanan = ?";
$stmt = $koneksi->prepare($query);
$stmt->bind_param("i", $id_pemesanan);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();
} else {
    echo "Data tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Pemesanan</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
</head>
<body>
<div class="container">
    <h2>Edit Data Pemesanan</h2>
    <form action="update.php" method="POST">
        <input type="hidden" name="id_pemesanan" value="<?= $data['id_pemesanan'] ?>">
        
        <div class="mb-3">
            <label for="tgl_checkin" class="form-label">Tanggal Check-in</label>
            <input type="date" class="form-control" id="tgl_checkin" name="tgl_checkin" value="<?= $data['tgl_checkin'] ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="tgl_checkout" class="form-label">Tanggal Check-out</label>
            <input type="date" class="form-control" id="tgl_checkout" name="tgl_checkout" value="<?= $data['tgl_checkout'] ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="nm_tamu" class="form-label">Nama Tamu</label>
            <select class="form-select" id="nm_tamu" name="nm_tamu" required>
                <?php
                # Ambil semua tamu untuk dropdown
                $query_tamu = "SELECT * FROM tb_tamu";
                $result_tamu = mysqli_query($koneksi, $query_tamu);
                while ($tamu = mysqli_fetch_assoc($result_tamu)) {
                    $selected = ($tamu['id'] == $data['tamu_id']) ? 'selected' : '';
                    echo "<option value='{$tamu['id']}' $selected>{$tamu['nm_tamu']}</option>";
                }
                ?>
            </select>
        </div>
        
        <div class="mb-3">
            <label for="bukti_pembayaran" class="form-label">Bukti Pembayaran</label>
            <input type="text" class="form-control" id="bukti_pembayaran" name="bukti_pembayaran" value="<?= $data['bukti_pembayaran'] ?>" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="index.php" class="btn btn-secondary">Batal</a>
    </form>
</div>

<script src="../js/bootstrap.js"></script>
</body>
</html>
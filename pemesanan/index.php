<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pemesanan Hotel</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/all.css">
</head>
<body>
<?php 
    include_once('../navbar.php');
?>

<div class="container">
    <div class="row mt-5">
        <div class="col-12 m-auto">
            <div class="card">
            <div class="card-header">
                <h3 class="float-start">Data Pemesanan Hotel</h3>
                <span class="float-end"><a class="btn btn-primary" href="form.php"><i class="fa-solid fa-square-plus"></i> Tambah Data</a></span>
            </div>
            <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">tgl_checkin</th>
                        <th scope="col">tgl_checkout</th>
                        <th scope="col">Nama Tamu</th>
                        <th scope="col">Bukti Pembayaran</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    #1. koneksikan file ini
                    include("../koneksi.php");

                    #2. menulis query
                    $tampil = "SELECT * FROM tb_pemesanan 
                    INNER JOIN tb_tamu ON tb_pemesanan.tamu_id=tb_tamu.id";

                    #3. jalankan query
                    $proses = mysqli_query($koneksi, $tampil);

                    #4. looping data dari database
                    $nomor = 1;
                    foreach($proses as $data){
                    ?>
                    <tr>
                        <th scope="row"><?=$nomor++?></th>
                        <td><?=$data['tgl_checkin']?></td>
                        <td><?=$data['tgl_checkout']?></td>
                        <td><?=$data['nm_tamu']?></td>
                        <td><?=$data['bukti_pembayaran']?></td>
                        <td>
                            <!-- TOMBOL DETAIL -->
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#detail<?=$data['id_pemesanan']?>">
                            <i class="fa-solid fa-eye"></i>
                            </button>

                            <!-- MODAL DETAIL-->
                            <div class="modal fade" id="detail<?=$data['id_pemesanan']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Data <?=$data['nm_tamu']?> </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <img width="200"  src="foto/<?=$data['foto']?>" alt="">

                                    <table class="table">
                                        <tr>
                                            <td scope="col">tgl checkin</td>
                                            <th scope="col">: <?=$data['tgl_checkin']?></th>
                                        </tr>
                                        <tr>
                                            <td scope="col">tgl chekout</td>
                                            <th scope="col">: <?=$data['tgl_checkout']?></th>
                                        </tr>
                                        <tr>
                                            <td scope="col">Nama Tamu</td>
                                            <th scope="col">: <?=$data['tamu_id']?></th>
                                        </tr>
                                        <tr>
                                            <td scope="col">Bukti Pembayaran</td>
                                            <th scope="col">: <?=$data['bukti_pembayaran']?></th>
                                        </tr>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    
                                </div>
                                </div>
                            </div>
                            </div>

                            <!-- TOMBOL EDIT -->
                            <a class="btn btn-info btn-sm" href="edit.php?id=<?=$data['id_pemesanan']?>"><i class="fa fa-pen-to-square"></i></a>
                            
                            <!-- TOMBOL HAPUS -->
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus<?=$data['id_pemesanan']?>">
                            <i class="fa-solid fa-trash"></i>
                            </button>

                            <!-- MODAL HAPUS-->
                            <div class="modal fade" id="hapus<?=$data['id_pemesanan']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Peringatan</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Yakin data <b><?=$data['nm_tamu']?></b> ingin dihapus?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <a href="hapus.php?xyz=<?=$data['id_pemesanan']?>" class="btn btn-danger">Hapus</a>
                                </div>
                                </div>
                            </div>
                            </div>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            </div>
            </div>
        </div>
    </div>
</div>

    <script src="../js/bootstrap.js"></script>
    <script src="../js/bootstrap.bundle.js"></script>
    <script src="../js/all.js"></script>
</body>
</html>
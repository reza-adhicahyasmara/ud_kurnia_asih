<?php 
    foreach($data_detail->result() as $haha) {
        $status_pemesanan_bb = $haha->status_pemesanan_bb;
        $status_pby_pemesanan_bb = $haha->status_pby_pemesanan_bb;
?>

    <input type="hidden" id="status_pemesanan_bb" value="<?php echo $haha->status_pemesanan_bb;?>" />
    <input type="hidden" id="total_pby_pemesanan_bb" value="<?php echo $haha->total_pby_pemesanan_bb;?>" />
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-1 text-dark"><i class="nav-icon bx bx-fw bx-calendar-check"></i> Detail Pemesanan Bahan Baku</h1>
                    </div>
                    <div class="col-sm-6 float-sm-right">
                        <ol class="breadcrumb float-sm-right m-2">
                            <span class="breadcrumb-item"><a href="<?php echo base_url('gudang/dashboard'); ?>">Dashboard</a></span>
                            <span class="breadcrumb-item"><a href="<?php echo base_url('gudang/pemesanan_bahan_baku'); ?>">Data Pemesanan Bahan Baku</a></span>
                            <span class="breadcrumb-item active">Detail Pemesanan Bahan Baku</span>
                        </ol>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <div class="float-sm-right breadcrumb ">
                            <?php if($status_pemesanan_bb == 4){ ?>
                                <div class="form-group">
                                    <button class="btn btn-primary btn_terima" kode_pemesanan_bb = "<?php echo $haha->kode_pemesanan_bb; ?>" style="width:200px; margin-left:5px;"><i class="bx bx-fw bx-arrow-to-bottom"></i> Terima Produk</button>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-danger btn_retur" kode_pemesanan_bb = "<?php echo $haha->kode_pemesanan_bb; ?>" style="width:200px; margin-left:5px;"><i class="bx bx-fw bx-recycle"></i> Retur Produk</button>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <section class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h4>Data Pemesanan</h4>
                                </div>  
                                <div class="col-sm-6">
                                    <div class="float-sm-right">    
                                        <?php
                                            if($status_pemesanan_bb==1){
                                                echo "<span class='badge badge-warning text-md'>Menunggu Pembayaran</span>";
                                            } elseif($status_pemesanan_bb==2){
                                                echo "<span class='badge badge-info text-md'>Verifikasi Pembayaran</span>";
                                            } elseif($status_pemesanan_bb==3){
                                                echo "<span class='badge badge-primary text-md'>Pesanan Diproses</span>";
                                            } elseif($status_pemesanan_bb==4){
                                                echo "<span class='badge badge-info text-md'>Pesanan Dikirim</span>";
                                            } elseif($status_pemesanan_bb==5){
                                                echo "<span class='badge badge-success text-md'>Pesanan Selesai</span>";
                                            } elseif($status_pemesanan_bb==6){
                                                echo "<span class='badge badge-danger text-md'>Pesanan Dibatalkan</span>";
                                            } elseif($status_pemesanan_bb==7){
                                                echo "<span class='badge badge-danger text-md'>Diretur</span>";
                                            }  
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <table style="width:100%" class="table">
                                <caption></caption>
                                <tr>
                                    <td>Invoice</td>
                                    <td>:</td>
                                    <td><?php echo $haha->kode_pemesanan_bb;?></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Pengajuan</td>
                                    <td>:</td>
                                    <td><?php echo nice_date($haha->tanggal_pemesanan_bb,'d-m-Y H:m:s') ?></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Terima</td>
                                    <td>:</td>
                                    <td><?php if($haha->tanggal_terima_pemesanan_bb == ""){echo "-";}else{echo nice_date($haha->tanggal_terima_pemesanan_bb,'d-m-Y H:m:s');}?></td>
                                </tr>
                                <tr>
                                    <td>Transfer</td>
                                    <td>:</td>
                                    <td><?php echo $haha->no_rekening." AN ".$haha->an_rekening." (".$haha->nama_bank.")";?></td>
                                </tr>
                                <tr>
                                    <td>Total Pembayaran</td>
                                    <td>:</td>
                                    <td>Rp. <?php echo number_format($haha->total_pby_pemesanan_bb, 2, ",", ".");?></td>
                                </tr>
                                <tr>
                                    <td>Status Pembayaran</td>
                                    <td>:</td>
                                    <td>
                                        <?php
                                            if($status_pby_pemesanan_bb==1){
                                                echo "Belum Dibayarkan";
                                            } elseif($status_pby_pemesanan_bb==2){
                                                echo "Sudah Dibayarkan";
                                            } elseif($status_pby_pemesanan_bb==3){
                                                echo "Lunas";
                                            } elseif($status_pby_pemesanan_bb==4){
                                                echo "Pembayaran Dikembalikan";
                                            } 
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Keterangan</td>
                                    <td>:</td>
                                    <td><?php if($haha->keterangan_batal_pemesanan_bb == ""){echo "-";}else{echo $haha->keterangan_batal_pemesanan_bb; } ?></td>
                                </tr>
                            </table>
                            <br>
                            <br>
                            <h4>Item Pemesanan</h4>
                            <div id="content_item_pemesanan_bb">
                                <!--LOAD DATA-->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

<?php  } ?>
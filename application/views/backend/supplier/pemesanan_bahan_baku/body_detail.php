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
                            <span class="breadcrumb-item"><a href="<?php echo base_url('supplier/dashboard'); ?>">Dashboard</a></span>
                            <span class="breadcrumb-item"><a href="<?php echo base_url('supplier/pemesanan_bahan_baku'); ?>">Data Pemesanan Bahan Baku</a></span>
                            <span class="breadcrumb-item active">Detail Pemesanan Bahan Baku</span>
                        </ol>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <div class="float-sm-right breadcrumb ">
                            <?php if($status_pemesanan_bb == 1){ ?>
                                <div class="form-group">
                                    <button class="btn btn-danger" id="btn_pembatalan_pemesanan" style="width:200px; margin-left:5px;"><i class="bx bx-fw bx-x"></i> Batalkan Pemesanan</button>
                                </div>
                            <?php } if($status_pemesanan_bb > 1){ ?>
                                <div class="form-group">
                                    <button class="btn btn-success" id="btn_bukti_pembayaran" style="width:200px; margin-left:5px;"><i class="bx bx-fw bx-money"></i> Lihat Pembayaran </button>
                                </div>
                            <?php if($status_pemesanan_bb == 2){ ?>
                                <div class="form-group">
                                    <button class="btn btn-primary" id="btn_verifikasi_pembayaran" style="width:200px; margin-left:5px;"><i class="bx bx-fw bx-check"></i> Verifikasi Pembayaran</button>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-danger" id="btn_pembatalan_pembayaran" style="width:200px; margin-left:5px;"><i class="bx bx-fw bx-x"></i> Batalkan Pembayaran</button>
                                </div>
                            <?php } else if($status_pemesanan_bb == 3){ ?>
                                <div class="form-group">
                                    <button class="btn btn-primary" id="btn_pengiriman" style="width:200px; margin-left:5px;"><i class="fa fa-truck"></i> Kirim</button>
                                </div>
                            <?php } else if($status_pemesanan_bb == 7){ ?>
                                <div class="form-group">
                                    <button class="btn btn-primary" id="btn_pengiriman_retur" style="width:200px; margin-left:5px;"><i class="fa fa-truck"></i> Kirim Retur</button>
                                </div>
                            <?php
                                    }    
                                }
                            ?>
                            <div class="form-group">
                                <a href="<?php echo base_url('supplier/pemesanan_bahan_baku/invoice/').$haha->kode_pemesanan_bb;?>"target="_blank" class="btn btn-warning" style="margin-left: 5px;"><span class="bx bx-fw bx-printer"></span> Print</a>
                            </div>
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

    <form>        
        <div id="modal_bukti_pembayaran" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="alert_edit"></div>                               
                        <div class="form-group">
                            <label>Gambar</label>
                            <div style="text-align: center;">
                                <div style="border-radius:5px; border:1px solid #ced4da">
                                    <div class="dz-default dz-message" data-dz-message="">
                                        <img src="<?php echo base_url('assets/img/pemesanan_bb/').$haha->bukti_pby_pemesanan_bb;?>" class="product-image" alt="Image">
                                    </div>
                                </div>
                            <input type="hidden" name="kode_pemesanan_bb" id="kode_pemesanan_bb" value="<?php echo $haha->kode_pemesanan_bb; ?>"/>
                            <input type="hidden" name="bukti_pby_pemesanan_bb" id="bukti_pby_pemesanan_bb"/>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="bx bx-fw bx-x"></span> Batal</button>
                    </div>
                </div>
            </div>
        </div>       
    </form>

<?php  } ?>
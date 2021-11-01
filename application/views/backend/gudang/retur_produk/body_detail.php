<?php 
    foreach($data_detail->result() as $haha) {
        $status_retur_produk = $haha->status_retur_produk
?>
    <input type="hidden" id="status_retur_produk" value="<?php echo $haha->status_retur_produk;?>" />
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark"><i class="nav-icon bx bx-fw bx-recycle"></i> Detail Retur Produk</h1>
                    </div>
                    <div class="col-sm-6 float-sm-right">
                        <ol class="breadcrumb float-sm-right m-2">
                            <span class="breadcrumb-item"><a href="<?php echo base_url('gudang/dashboard'); ?>">Dashboard</a></span>
                            <span class="breadcrumb-item"><a href="<?php echo base_url('gudang/retur_produk'); ?>">Data Retur Produk</a></span>
                            <span class="breadcrumb-item active">Detail Retur Produk</span>
                        </ol>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <div class="float-sm-right breadcrumb ">
                            <?php if($status_retur_produk == 1){ ?>
                                <div class="form-group">
                                    <button class="btn btn-primary" id="btn_kirim_retur" kode_retur_produk = <?php echo $haha->kode_retur_produk; ?> style="width:200px; margin-left: 5px;"><i class="bx bx-fw bxs-truck"></i> Kirim Retur </button> 
                                </div>
                            <?php } ?>
                            <div class="form-group">
                                <a href="<?php echo base_url('gudang/retur_produk/invoice/').$haha->kode_retur_produk;?>"target="_blank" class="btn btn-warning" style="margin-left: 5px;"><span class="bx bx-fw bx-printer"></span> Print</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-outline">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h4>Data Pengajuan</h4>
                                        </div>  
                                        <div class="col-sm-6">
                                            <div class="float-sm-right">    
                                                <?php
                                                    if($status_retur_produk==1){
                                                        echo "<span class='badge badge-warning text-md'>Menunggu Konfirmasi</span>";
                                                    } elseif($status_retur_produk==2){
                                                        echo "<span class='badge badge-info text-md'>Dikirim</span>";
                                                    } elseif($status_retur_produk==3){
                                                        echo "<span class='badge badge-success text-md'>Selesai</span>";
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
                                            <td><?php echo $haha->kode_retur_produk;?></td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal</td>
                                            <td>:</td>
                                            <td><?php echo nice_date($haha->tanggal_retur_produk,'d-m-Y H:m:s') ?></td>
                                        </tr>
                                        <tr>
                                            <td>Nama Customer</td>
                                            <td>:</td>
                                            <td><?php echo $haha->nama_customer ?></td>
                                        </tr>
                                        <tr>
                                            <td>Alamat Customer</td>
                                            <td>:</td>
                                            <td><?php echo $haha->alamat_customer ?></td>
                                        </tr>
                                        <tr>
                                            <td>PIC Customer</td>
                                            <td>:</td>
                                            <td><?php echo $haha->pic_customer." (".$haha->kontak_customer.")"; ?></td>
                                        </tr>
                                    </table>
                                    <br>
                                    <br>
                                    <h4>Item Pengajuan</h4>
                                    <div id="content_item_retur_produk">
                                        <!--LOAD DATA-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

<?php  } ?>
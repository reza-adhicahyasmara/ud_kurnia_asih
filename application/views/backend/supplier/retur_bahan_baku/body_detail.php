<?php 
    foreach($data_detail->result() as $haha) {
        $status_retur_bb = $haha->status_retur_bb
?>
    <input type="hidden" id="status_retur_bb" value="<?php echo $haha->status_retur_bb;?>" />
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark"><i class="nav-icon bx bx-fw bx-recycle"></i> Detail Retur Bahan Baku</h1>
                    </div>
                    <div class="col-sm-6 float-sm-right">
                        <ol class="breadcrumb float-sm-right m-2">
                            <span class="breadcrumb-item"><a href="<?php echo base_url('supplier/dashboard'); ?>">Dashboard</a></span>
                            <span class="breadcrumb-item"><a href="<?php echo base_url('supplier/retur_bahan_baku'); ?>">Data Retur Bahan Baku</a></span>
                            <span class="breadcrumb-item active">Detail Retur Bahan Baku</span>
                        </ol>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <div class="float-sm-right breadcrumb ">
                            <?php if($status_retur_bb == 1){ ?>
                                <div class="form-group">
                                    <button class="btn btn-primary" id="btn_kirim_retur" kode_retur_bb = <?php echo $haha->kode_retur_bb; ?> style="width:200px; margin-left: 5px;"><i class="bx bx-fw bxs-truck"></i> Kirim Retur </button> 
                                </div>
                            <?php } ?>
                            <div class="form-group">
                                <a href="<?php echo base_url('supplier/retur_bahan_baku/invoice/').$haha->kode_retur_bb;?>"target="_blank" class="btn btn-warning" style="margin-left: 5px;"><span class="bx bx-fw bx-printer"></span> Print</a>
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
                                                    if($status_retur_bb==1){
                                                        echo "<span class='badge badge-warning text-md'>Menunggu Konfirmasi</span>";
                                                    } elseif($status_retur_bb==2){
                                                        echo "<span class='badge badge-info text-md'>Dikirim</span>";
                                                    } elseif($status_retur_bb==3){
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
                                            <td><?php echo $haha->kode_retur_bb;?></td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal</td>
                                            <td>:</td>
                                            <td><?php echo nice_date($haha->tanggal_retur_bb,'d-m-Y H:m:s') ?></td>
                                        </tr>
                                        <tr>
                                            <td>Nama Supplier</td>
                                            <td>:</td>
                                            <td><?php echo $haha->nama_supplier ?></td>
                                        </tr>
                                        <tr>
                                            <td>Alamat Supplier</td>
                                            <td>:</td>
                                            <td><?php echo $haha->alamat_supplier ?></td>
                                        </tr>
                                        <tr>
                                            <td>PIC Supplier</td>
                                            <td>:</td>
                                            <td><?php echo $haha->pic_supplier." (".$haha->kontak_supplier.")"; ?></td>
                                        </tr>
                                    </table>
                                    <br>
                                    <br>
                                    <h4>Item Pengajuan</h4>
                                    <div id="content_item_retur_bb">
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
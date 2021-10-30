<?php 
    foreach($data_detail->result() as $haha) {
        $status_retur_bb = $haha->status_retur_bb
?>
    <div class="content-wrapper" style="margin-left: 0px;">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-outline">
                        <div class="card-body">
                            <br>
                            <div style="text-align: center;">
                                <h2>INVOICE</h2>
                                <h4><?php echo $haha->kode_retur_bb ?></h4>
                            </div>
                            <br>
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
                            <table style="width:100%" class="table table-bordered table-striped">
                                <caption></caption>
                                <thead>
                                    <tr>
                                        <th id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
                                        <th id="" style="text-align: center; vertical-align: middle; width:10%">Gambar</th>
                                        <th id="" style="text-align: center; vertical-align: middle; width:15%">Kode</th>
                                        <th id="" style="text-align: center; vertical-align: middle; width:15%">Bahan Baku</th>
                                        <th id="" style="text-align: center; vertical-align: middle; width:10%">Jumlah</th>
                                        <th id="" style="text-align: center; vertical-align: middle; width:25%">Keterangan Retur</th>
                                        <th id="" style="text-align: center; vertical-align: middle; width:25%">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $no = 1;
                                        foreach($list_bahan_baku->result() as $row) {
                                    ?>
                                    <tr>
                                        <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
                                        <td style="text-align: center; vertical-align: middle;">
                                            <?php if($row->gambar_iretur_bb != "") { ?>
                                                <img style="margin:-5px;" class="img-thumbnail" alt="Image" src="<?php echo base_url('assets/img/retur_bb/'.$row->gambar_iretur_bb);?>" width="100px" height="100px">
                                            <?php }else{ ?>
                                                <img src="<?php echo base_url('assets/img/banner/image_alt.svg');?>" alt="Image" width="100px" height="100px">
                                            <?php } ?> 
                                        </td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->kode_bb;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_bb;?></td>
                                        <td style="text-align: center; vertical-align: middle;"><?php echo number_format($row->jumlah_iretur_bb, 0, ".", ".")." ".$row->nama_satuan;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->keterangan_iretur_bb;?></td>
                                        <td style="text-align: left; vertical-align: middle;">  
                                            <?php 
                                                $status = $row->status_iretur_bb;
                                                if($status == 2){
                                                    echo "Proses";
                                                }else if($status == 3){
                                                    echo "Diterima";
                                                }else if($status == 4){
                                                    echo "Ditolak<br>"."Keterangan : ".$row->keterangan_batal_iretur_bb;
                                                }
                                            ?>                     
                                        </td>
                                    </tr>
                                        <?php $no++; } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php  } ?>

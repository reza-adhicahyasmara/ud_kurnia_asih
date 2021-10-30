<?php  
    $menunggu_pembayaran = 0;
    $verfikasi_pemabayaran = 0;
    $proses_produk = 0;
    $proses_pengiriman = 0;
    $retur = 0;

    foreach($data_pemesanan->result() as $data1){
            if($data1->status_pemesanan_bb == "1"){
                $menunggu_pembayaran = $menunggu_pembayaran + 1;
            }
            else if($data1->status_pemesanan_bb == "2"){
                $verfikasi_pemabayaran = $verfikasi_pemabayaran + 1;
            }
            else if($data1->status_pemesanan_bb == "3"){
                $proses_produk = $proses_produk + 1;
            }
            else if($data1->status_pemesanan_bb == "4"){
                $proses_pengiriman = $proses_pengiriman + 1;
            }
            else if($data1->status_pemesanan_bb == "7"){
                $retur = $retur + 1;
            }
        }
        
  ?>
  <div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-1 text-dark"><i class="nav-icon bx bx-fw bx-calendar-check"></i> Data Pemesanan Bahan Baku</h1>
                </div>
                <div class="col-sm-6 float-sm-right">
                    <ol class="breadcrumb float-sm-right m-2">
                        <span class="breadcrumb-item"><a href="<?php echo base_url('gudang/dashboard'); ?>">Dashboard</a></span>
                        <span class="breadcrumb-item active">Data Pemesanan Bahan Baku</span>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-purple card-outline card-outline-tabs">
                <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id=" custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages4" role="tab" aria-controls="custom-tabs-one-messages4" aria-selected="false">Dikirim <?php if($proses_pengiriman != 0){ ?><span class="badge badge-danger right"> <?php echo $proses_pengiriman; ?></span><?php } ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id=" custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages7" role="tab" aria-controls="custom-tabs-one-messages7" aria-selected="false">Retur <?php if($retur != 0){ ?><span class="badge badge-danger right"> <?php echo $retur; ?></span><?php } ?></a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-one-tabContent">
                        <div class="tab-pane fade show active" id="custom-tabs-one-messages4" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                            <table style="width:100%" id="dataTable6" class="table table-bordered table-striped">
                                <caption></caption>
                                <thead>
                                    <tr>
                                        <th id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Kode</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Tanggal</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Total (Rp.)</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Transfer</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Keterangan Batal</th>
                                        <th id="" style="text-align: center; vertical-align: middle; width:5%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $no = 1;
                                        foreach($data_pemesanan->result() as $row) {
                                            if($row->status_pemesanan_bb == 4){
                                    ?>
                                    <tr>
                                        <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->kode_pemesanan_bb;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->tanggal_pemesanan_bb;?></td>
                                        <td style="text-align: Right; vertical-align: middle;"><?php echo number_format($row->total_pby_pemesanan_bb,2, ",", ".");?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->no_rekening." AN ".$row->an_rekening." (".$row->nama_bank.")";?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->keterangan_batal_pemesanan_bb;?></td>
                                        <td style="text-align: center; vertical-align: middle;" >
                                            <a class='btn btn-info btn-sm btn-rounded' href="<?php echo base_url('gudang/pemesanan_bahan_baku/detail/'.$row->kode_pemesanan_bb); ?>"><i class="bx bx-fw bx-show-alt"></i></a>
                                        </td>
                                    </tr>
                                    <?php 
                                            $no++;
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-one-messages7" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                            <table style="width:100%" id="dataTable9" class="table table-bordered table-striped">
                                <caption></caption>
                                <thead>
                                    <tr>
                                        <th id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Kode</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Tanggal</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Total (Rp.)</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Transfer</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Keterangan Batal</th>
                                        <th id="" style="text-align: center; vertical-align: middle; width:5%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $no = 1;
                                        foreach($data_pemesanan->result() as $row) {
                                            if($row->status_pemesanan_bb == 7){
                                    ?>
                                    <tr>
                                        <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->kode_pemesanan_bb;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->tanggal_pemesanan_bb;?></td>
                                        <td style="text-align: Right; vertical-align: middle;"><?php echo number_format($row->total_pby_pemesanan_bb,2, ",", ".");?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->no_rekening." AN ".$row->an_rekening." (".$row->nama_bank.")";?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->keterangan_batal_pemesanan_bb;?></td>
                                        <td style="text-align: center; vertical-align: middle;" >
                                            <a class='btn btn-info btn-sm btn-rounded' href="<?php echo base_url('gudang/pemesanan_bahan_baku/detail/'.$row->kode_pemesanan_bb); ?>"><i class="bx bx-fw bx-show-alt"></i></a>
                                        </td>
                                    </tr>
                                    <?php 
                                            $no++;
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
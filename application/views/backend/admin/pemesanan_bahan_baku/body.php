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
                        <span class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>">Dashboard</a></span>
                        <span class="breadcrumb-item active">Data Pemesanan Bahan Baku</span>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Stok Limit Gudang Saat Ini</h3>
                </div>
                <div class="card-body">
                    <table style="width:100%" id="dataTable1" class="table table-bordered table-striped">
                    <caption></caption>
                        <thead>
                            <tr>
                                <th id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
                                <th id="" style="text-align: center; vertical-align: middle; width:10%">Kode</th>
                                <th id="" style="text-align: center; vertical-align: middle; width:10%">Bahan Baku</th>
                                <th id="" style="text-align: center; vertical-align: middle; width:10%">Kategori</th>
                                <th id="" style="text-align: center; vertical-align: middle; width:10%">Supplier</th>
                                <th id="" style="text-align: center; vertical-align: middle; width:10%">Harga (Rp.)</th>
                                <th id="" style="text-align: center; vertical-align: middle; width:10%">Stok Saat Ini</th>
                                <th id="" style="text-align: center; vertical-align: middle; width:10%">Stok Limit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $no = 1;
                                foreach($bahan_baku_limit->result() as $row) {
                                    if($row->stok_gudang_pab_bb <= $row->stok_limit_pab_bb){
                            ?>
                            <tr>
                                <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
                                <td style="text-align: left; vertical-align: middle;"><?php echo $row->kode_bb;?></td>
                                <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_bb;?></td>
                                <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_kategori;?></td>
                                <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_supplier;?></td>
                                <td style="text-align: right; vertical-align: middle;"><?php echo number_format($row->harga_bb,2, ",", ".");?></td>
                                <td style="text-align: right; vertical-align: middle;"><?php echo number_format($row->stok_gudang_pab_bb,2, ",", ".")." ".$row->nama_satuan;?></td>
                                <td style="text-align: right; vertical-align: middle;"><?php echo number_format($row->stok_limit_pab_bb,2, ",", ".")." ".$row->nama_satuan;?></td>
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
            <div class="card card-purple card-outline card-outline-tabs">
                <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Pemesanan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id=" custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages1" role="tab" aria-controls="custom-tabs-one-messages1" aria-selected="false">Menunggu Pembayaran <?php if($menunggu_pembayaran != 0){ ?><span class="badge badge-danger right"> <?php echo $menunggu_pembayaran; ?></span><?php } ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id=" custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages2" role="tab" aria-controls="custom-tabs-one-messages2" aria-selected="false">Verifikasi Pembayaran <?php if($verfikasi_pemabayaran != 0){ ?><span class="badge badge-danger right"> <?php echo $verfikasi_pemabayaran; ?></span><?php } ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id=" custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages3" role="tab" aria-controls="custom-tabs-one-messages3" aria-selected="false">Diproses <?php if($proses_produk != 0){ ?><span class="badge badge-danger right"> <?php echo $proses_produk; ?></span><?php } ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id=" custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages4" role="tab" aria-controls="custom-tabs-one-messages4" aria-selected="false">Dikirim <?php if($proses_pengiriman != 0){ ?><span class="badge badge-danger right"> <?php echo $proses_pengiriman; ?></span><?php } ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id=" custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages5" role="tab" aria-controls="custom-tabs-one-messages5" aria-selected="false">Selesai </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id=" custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages6" role="tab" aria-controls="custom-tabs-one-messages6" aria-selected="false">Dibatalkan </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id=" custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages7" role="tab" aria-controls="custom-tabs-one-messages7" aria-selected="false">Retur <?php if($retur != 0){ ?><span class="badge badge-danger right"> <?php echo $retur; ?></span><?php } ?></a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-one-tabContent">
                        <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">    
                            <form role="form" id="form_item_pemesanan_bb" method="post" aria-label="">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3">
                                        <div class="form-group">
                                            <select class="form-control id_supplier" name="id_supplier" id="id_supplier">
                                                <option value="">Pilih Supplier</option>
                                                <?php foreach($supplier->result() as $row){ ?>
                                                <option value="<?php echo $row->id_supplier; ?>" ongkir_supplier = "<?php echo $row->ongkir_supplier;?>" berat_ongkir_supplier = "<?php echo $row->berat_ongkir_supplier;?>" ><?php echo $row->nama_supplier; ?></option>
                                                <?php } ?> 
                                            </select>
                                        </div>
                                    </div>   
                                    <input type="hidden" class="form-control" name="ongkir_supplier" id="ongkir_supplier" readonly>
                                    <input type="hidden" class="form-control" name="berat_ongkir_supplier" id="berat_ongkir_supplier" readonly>
                                    <div class="col-lg-3 col-md-3">
                                        <div class="form-group">
                                            <select class="form-control kode_bb" name="kode_bb" id="kode_bb"></select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="stok_gudang_sup_bb_view" id="stok_gudang_sup_bb_view" placeholder="Stok Gudang" readonly>
                                            <input type="hidden" class="form-control" name="stok_gudang_sup_bb" id="stok_gudang_sup_bb" placeholder="Stok Gudang" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="harga_ipemesanan_bb_view" id="harga_ipemesanan_bb_view" placeholder="Harga" readonly>
                                            <input type="hidden" class="form-control" name="harga_ipemesanan_bb" id="harga_ipemesanan_bb" placeholder="Harga" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="jumlah_ipemesanan_bb" id="jumlah_ipemesanan_bb" placeholder="Jumlah" minlength="1" >
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-3"> 
                                        <div class="form-group">
                                            <button type="button" class="btn btn-info" id="btn_tambah_item_pemesanan_bb"><i class="bx bx-fw bx-plus"></i> Tambah</button> 
                                        </div>
                                    </div>    
                                </div>
                            </form>
                            <div id="content_item_pemesanan_bb">
                                <!--LOAD DATA-->
                            </div>
                            <div class="mt-3">
                                <caption>Form pemesanan hanya dapat melakukan pemesanan produk di satu supplier. Pastikan form diisi dengan benar.</caption>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-one-messages1" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                            <table style="width:100%;" id="dataTable3" class="table table-bordered table-striped">
                                <caption></caption>
                                <thead>
                                    <tr>
                                        <th id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Kode</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Tanggal</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Supplier</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Alamat</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">PIC</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Total (Rp.)</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Transfer</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Keterangan Batal</th>
                                        <th id="" style="text-align: center; vertical-align: middle; width:5%">Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $no = 1;
                                        foreach($data_pemesanan->result() as $row) {
                                            if($row->status_pemesanan_bb == 1){
                                    ?>
                                    <tr>
                                        <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->kode_pemesanan_bb;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->tanggal_pemesanan_bb;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_supplier;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->alamat_supplier;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->pic_supplier." (".$row->kontak_supplier.")";?></td>
                                        <td style="text-align: Right; vertical-align: middle;"><?php echo number_format($row->total_pby_pemesanan_bb,2, ",", ".");?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->no_rekening." AN ".$row->an_rekening." (".$row->nama_bank.")";?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->keterangan_batal_pemesanan_bb;?></td>
                                        <td style="text-align: center; vertical-align: middle;" >
                                            <a class='btn btn-info btn-sm btn-rounded' href="<?php echo base_url('admin/pemesanan_bahan_baku/detail/'.$row->kode_pemesanan_bb); ?>"><i class="bx bx-fw bx-show-alt"></i></a>
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
                        <div class="tab-pane fade" id="custom-tabs-one-messages2" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                            <table style="width:100%" id="dataTable4" class="table table-bordered table-striped">
                                <caption></caption>
                                <thead>
                                    <tr>
                                        <th id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Kode</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Tanggal</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Supplier</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Alamat</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">PIC</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Total (Rp.)</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Transfer</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Keterangan Batal</th>
                                        <th id="" style="text-align: center; vertical-align: middle; width:5%">Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $no = 1;
                                        foreach($data_pemesanan->result() as $row) {
                                            if($row->status_pemesanan_bb == 2){
                                    ?>
                                    <tr>
                                        <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->kode_pemesanan_bb;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->tanggal_pemesanan_bb;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_supplier;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->alamat_supplier;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->pic_supplier." (".$row->kontak_supplier.")";?></td>
                                        <td style="text-align: Right; vertical-align: middle;"><?php echo number_format($row->total_pby_pemesanan_bb,2, ",", ".");?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->no_rekening." AN ".$row->an_rekening." (".$row->nama_bank.")";?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->keterangan_batal_pemesanan_bb;?></td>
                                        <td style="text-align: center; vertical-align: middle;" >
                                            <a class='btn btn-info btn-sm btn-rounded' href="<?php echo base_url('admin/pemesanan_bahan_baku/detail/'.$row->kode_pemesanan_bb); ?>"><i class="bx bx-fw bx-show-alt"></i></a>
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
                        <div class="tab-pane fade" id="custom-tabs-one-messages3" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                            <table style="width:100%" id="dataTable5" class="table table-bordered table-striped">
                                <caption></caption>
                                <thead>
                                    <tr>
                                        <th id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Kode</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Tanggal</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Supplier</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Alamat</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">PIC</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Total (Rp.)</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Transfer</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Keterangan Batal</th>
                                        <th id="" style="text-align: center; vertical-align: middle; width:5%">Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $no = 1;
                                        foreach($data_pemesanan->result() as $row) {
                                            if($row->status_pemesanan_bb == 3){
                                    ?>
                                    <tr>
                                        <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->kode_pemesanan_bb;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->tanggal_pemesanan_bb;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_supplier;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->alamat_supplier;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->pic_supplier." (".$row->kontak_supplier.")";?></td>
                                        <td style="text-align: Right; vertical-align: middle;"><?php echo number_format($row->total_pby_pemesanan_bb,2, ",", ".");?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->no_rekening." AN ".$row->an_rekening." (".$row->nama_bank.")";?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->keterangan_batal_pemesanan_bb;?></td>
                                        <td style="text-align: center; vertical-align: middle;" >
                                            <a class='btn btn-info btn-sm btn-rounded' href="<?php echo base_url('admin/pemesanan_bahan_baku/detail/'.$row->kode_pemesanan_bb); ?>"><i class="bx bx-fw bx-show-alt"></i></a>
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
                        <div class="tab-pane fade" id="custom-tabs-one-messages4" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                            <table style="width:100%" id="dataTable6" class="table table-bordered table-striped">
                                <caption></caption>
                                <thead>
                                    <tr>
                                        <th id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Kode</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Tanggal</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Supplier</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Alamat</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">PIC</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Total (Rp.)</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Transfer</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Keterangan Batal</th>
                                        <th id="" style="text-align: center; vertical-align: middle; width:5%">Detail</th>
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
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_supplier;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->alamat_supplier;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->pic_supplier." (".$row->kontak_supplier.")";?></td>
                                        <td style="text-align: Right; vertical-align: middle;"><?php echo number_format($row->total_pby_pemesanan_bb,2, ",", ".");?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->no_rekening." AN ".$row->an_rekening." (".$row->nama_bank.")";?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->keterangan_batal_pemesanan_bb;?></td>
                                        <td style="text-align: center; vertical-align: middle;" >
                                            <a class='btn btn-info btn-sm btn-rounded' href="<?php echo base_url('admin/pemesanan_bahan_baku/detail/'.$row->kode_pemesanan_bb); ?>"><i class="bx bx-fw bx-show-alt"></i></a>
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
                        <div class="tab-pane fade" id="custom-tabs-one-messages5" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                            <table style="width:100%" id="dataTable8" class="table table-bordered table-striped">
                                <caption></caption>
                                <thead>
                                    <tr>
                                        <th id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Kode</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Tanggal</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Supplier</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Alamat</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">PIC</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Total (Rp.)</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Transfer</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Keterangan Batal</th>
                                        <th id="" style="text-align: center; vertical-align: middle; width:5%">Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $no = 1;
                                        foreach($data_pemesanan->result() as $row) {
                                            if($row->status_pemesanan_bb == 5){
                                    ?>
                                    <tr>
                                        <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->kode_pemesanan_bb;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->tanggal_pemesanan_bb;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_supplier;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->alamat_supplier;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->pic_supplier." (".$row->kontak_supplier.")";?></td>
                                        <td style="text-align: Right; vertical-align: middle;"><?php echo number_format($row->total_pby_pemesanan_bb,2, ",", ".");?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->no_rekening." AN ".$row->an_rekening." (".$row->nama_bank.")";?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->keterangan_batal_pemesanan_bb;?></td>
                                        <td style="text-align: center; vertical-align: middle;" >
                                            <a class='btn btn-info btn-sm btn-rounded' href="<?php echo base_url('admin/pemesanan_bahan_baku/detail/'.$row->kode_pemesanan_bb); ?>"><i class="bx bx-fw bx-show-alt"></i></a>
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
                        <div class="tab-pane fade" id="custom-tabs-one-messages6" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                            <table style="width:100%" id="dataTable8" class="table table-bordered table-striped">
                                <caption></caption>
                                <thead>
                                    <tr>
                                        <th id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Kode</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Tanggal</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Supplier</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Alamat</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">PIC</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Total (Rp.)</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Transfer</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Keterangan Batal</th>
                                        <th id="" style="text-align: center; vertical-align: middle; width:5%">Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $no = 1;
                                        foreach($data_pemesanan->result() as $row) {
                                            if($row->status_pemesanan_bb == 6){
                                    ?>
                                    <tr>
                                        <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->kode_pemesanan_bb;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->tanggal_pemesanan_bb;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_supplier;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->alamat_supplier;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->pic_supplier." (".$row->kontak_supplier.")";?></td>
                                        <td style="text-align: Right; vertical-align: middle;"><?php echo number_format($row->total_pby_pemesanan_bb,2, ",", ".");?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->no_rekening." AN ".$row->an_rekening." (".$row->nama_bank.")";?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->keterangan_batal_pemesanan_bb;?></td>
                                        <td style="text-align: center; vertical-align: middle;" >
                                            <a class='btn btn-info btn-sm btn-rounded' href="<?php echo base_url('admin/pemesanan_bahan_baku/detail/'.$row->kode_pemesanan_bb); ?>"><i class="bx bx-fw bx-show-alt"></i></a>
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
                                        <th id="" style="text-align: center; vertical-align: middle; ">Supplier</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Alamat</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">PIC</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Total (Rp.)</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Transfer</th>
                                        <th id="" style="text-align: center; vertical-align: middle; ">Keterangan Batal</th>
                                        <th id="" style="text-align: center; vertical-align: middle; width:5%">Detail</th>
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
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_supplier;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->alamat_supplier;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->pic_supplier." (".$row->kontak_supplier.")";?></td>
                                        <td style="text-align: Right; vertical-align: middle;"><?php echo number_format($row->total_pby_pemesanan_bb,2, ",", ".");?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->no_rekening." AN ".$row->an_rekening." (".$row->nama_bank.")";?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->keterangan_batal_pemesanan_bb;?></td>
                                        <td style="text-align: center; vertical-align: middle;" >
                                            <a class='btn btn-info btn-sm btn-rounded' href="<?php echo base_url('admin/pemesanan_bahan_baku/detail/'.$row->kode_pemesanan_bb); ?>"><i class="bx bx-fw bx-show-alt"></i></a>
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

<form role="form" id="form_bank" method="post">
    <div id="modal_pemesanan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <strong><span class="modal-title text-lg" id="myModalLabel"></span></strong>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <table class="text-md" style="width:100%;">
                            <tbody>
                                <tr>
                                    <td style="text-align: left; vertical-align: middle;">Total Belanja</td>
                                    <td style="text-align: center; vertical-align: middle;">: Rp.</td>
                                    <td style="text-align: right; vertical-align: middle;"><span class="text-lg" id="total_belanja"></span></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left; vertical-align: middle;">Ongkir</td>
                                    <td style="text-align: center; vertical-align: middle;">: Rp.</td>
                                    <td style="text-align: right; vertical-align: middle;"><span class="text-lg" id="jumlah_ongkir"></span></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left; vertical-align: middle;">Total Pembayaran</td>
                                    <td style="text-align: center; vertical-align: middle;">: Rp.</td>
                                    <td style="text-align: right; vertical-align: middle;"><span class="text-lg" id="total_pembayaran"></span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <input type="hidden" class="form-control" name="total_pby_pemesanan_bb" id="total_pby_pemesanan_bb" placeholder="Stok Gudang" readonly>
                    <div class="form-group">
                        <label>Pilih Rekening</label>
                        <select class="form-control kode_rekening" name="kode_rekening" id="kode_rekening"></select>
                    </div>
                    <div class="mt-3">
                        <caption>
                            Keterangan
                            <ul>
                                <li>Pilih rekening yang disediakan oleh supplier</li>
                                <li>Upload bukti transfer ke sistem</li>
                            </ul>
                        </caption>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="bx bx-fw bx-x"></span> Batal</button>
                    <button type="button" id="btn_simpan_checkout" class="btn bg-purple"><span class="bx bx-fw bx-save"></span> Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>
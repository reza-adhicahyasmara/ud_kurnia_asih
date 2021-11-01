<?php  
    $proses_retur = 0;
    $retur_selesai = 0;

    foreach($data_retur->result() as $data1){
            if($data1->status_retur_produk == "1"){
                $proses_retur = $proses_retur + 1;
            }
            else if($data1->status_retur_produk == "2"){
                $retur_selesai = $retur_selesai + 1;
            }
        }
        
  ?>
  <div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><i class="nav-icon bx bx-fw bx-recycle"></i> Data Retur Bahan Baku</h1>
                </div>
                <div class="col-sm-6 float-sm-right">
                    <ol class="breadcrumb float-sm-right m-2">
                        <span class="breadcrumb-item"><a href="<?php echo base_url('customer/dashboard'); ?>">Dashboard</a></span>
                        <span class="breadcrumb-item active">Retur Produk</span>
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
                            <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Pengajuan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id=" custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages1" role="tab" aria-controls="custom-tabs-one-messages1" aria-selected="false">Diproses <?php if($proses_retur != 0){ ?><span class="badge badge-danger right"> <?php echo $proses_retur; ?></span><?php } ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id=" custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages2" role="tab" aria-controls="custom-tabs-one-messages2" aria-selected="false">Dikirim <?php if($retur_selesai != 0){ ?><span class="badge badge-danger right"> <?php echo $retur_selesai; ?></span><?php } ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id=" custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages3" role="tab" aria-controls="custom-tabs-one-messages3" aria-selected="false">Selesai </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-one-tabContent">
                        <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                            <h4>Daftar Produk</h4>
                            <div class="card-body">
                                <table style="width:100%" id="dataTable1" class="table table-bordered table-striped">
                                <caption></caption>
                                    <thead>
                                        <tr>
                                            <th id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
                                            <th id="" style="text-align: center; vertical-align: middle; width:10%">Kode</th>
                                            <th id="" style="text-align: center; vertical-align: middle; width:10%">Produk</th>
                                            <th id="" style="text-align: center; vertical-align: middle; width:10%">Kategori</th>
                                            <th id="" style="text-align: center; vertical-align: middle; width:10%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $no = 1;
                                            foreach($data_produk->result() as $row) {
                                        ?>
                                        <tr>
                                            <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
                                            <td style="text-align: left; vertical-align: middle;"><?php echo $row->kode_produk;?></td>
                                            <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_produk;?></td>
                                            <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_kategori;?></td>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <a class='btn btn-info btn-sm btn-rounded btn_retur' kode_produk = <?php echo $row->kode_produk;?>><i class="bx bx-fw bx-recycle"></i></a>
                                            </td>
                                        </tr>
                                        <?php 
                                                $no++; 
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                            <h4>Daftar Pemesanan</h4>
                            <div id="content_item_retur_produk">
                                <!--LOAD DATA-->
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
                                        <th id="" style="text-align: center; vertical-align: middle; width:5%">Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $no = 1;
                                        foreach($data_retur->result() as $row) {
                                            if($row->status_retur_produk == 1){
                                    ?>
                                    <tr>
                                        <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->kode_retur_produk;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->tanggal_retur_produk;?></td>
                                        <td style="text-align: center; vertical-align: middle;" >
                                            <a class='btn btn-info btn-sm btn-rounded' href="<?php echo base_url('customer/retur_produk/detail/'.$row->kode_retur_produk); ?>"><i class="bx bx-fw bx-show-alt"></i></a>
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
                                        <th id="" style="text-align: center; vertical-align: middle; width:5%">Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $no = 1;
                                        foreach($data_retur->result() as $row) {
                                            if($row->status_retur_produk == 2){
                                    ?>
                                    <tr>
                                        <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->kode_retur_produk;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->tanggal_retur_produk;?></td>
                                        <td style="text-align: center; vertical-align: middle;" >
                                            <a class='btn btn-info btn-sm btn-rounded' href="<?php echo base_url('customer/retur_produk/detail/'.$row->kode_retur_produk); ?>"><i class="bx bx-fw bx-show-alt"></i></a>
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
                                        <th id="" style="text-align: center; vertical-align: middle; width:5%">Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $no = 1;
                                        foreach($data_retur->result() as $row) {
                                            if($row->status_retur_produk == 3){
                                    ?>
                                    <tr>
                                        <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->kode_retur_produk;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->tanggal_retur_produk;?></td>
                                        <td style="text-align: center; vertical-align: middle;" >
                                            <a class='btn btn-info btn-sm btn-rounded' href="<?php echo base_url('customer/retur_produk/detail/'.$row->kode_retur_produk); ?>"><i class="bx bx-fw bx-show-alt"></i></a>
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

<form role="form" id="form_item_retur_produk" method="post" aria-label="">
    <div id="modal_item_retur_produk" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <strong><span class="modal-title text-lg" id="myModalLabel"></span></strong>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="isi_item">
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="bx bx-fw bx-x"></span> Batal</button>
                    <button type="submit" id="btn_tambah_item_retur_produk" class="btn bg-purple"><span class="bx bx-fw bx-check"></span> Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>
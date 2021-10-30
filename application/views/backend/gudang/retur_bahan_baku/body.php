<?php  
    $proses_retur = 0;
    $retur_selesai = 0;

    foreach($data_retur->result() as $data1){
            if($data1->status_retur_bb == "1"){
                $proses_retur = $proses_retur + 1;
            }
            else if($data1->status_retur_bb == "2"){
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
                        <span class="breadcrumb-item"><a href="<?php echo base_url('gudang/dashboard'); ?>">Dashboard</a></span>
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
                            <form role="form" id="form_item_retur_bb" method="post" aria-label="">
                                <div class="row">
                                    <div class="col-lg-2 col-md-2">
                                        <select class="form-control id_supplier" name="id_supplier" id="id_supplier">
                                            <option value="">Pilih</option>
                                            <?php foreach($supplier->result() as $row){ ?>
                                            <option value="<?php echo $row->id_supplier; ?>"><?php echo $row->nama_supplier; ?></option>
                                            <?php } ?> 
                                        </select>
                                    </div>  
                                    <div class="col-lg-2 col-md-2">
                                        <div class="form-group">
                                            <select class="form-control kode_bb" name="kode_bb" id="kode_bb"></select>
                                        </div>
                                    </div>
                                    <div class="col-lg-1 col-md-1">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="jumlah_iretur_bb" id="jumlah_iretur_bb" placeholder="Jumlah">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="text" class="custom-file-input drop_retur dz-clickable" name="gambar_iretur_bb" id="gambar_iretur_bb">
                                                    <label class="custom-file-label " id="label_gambar" for="gambar_iretur_bb">Bukti gambar retur</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <textarea type="text" class="form-control" name="keterangan_iretur_bb" id="keterangan_iretur_bb" placeholder="Keterangan" minlength="1" ></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2"> 
                                        <div class="form-group">
                                            <button type="button" id="btn_tambah_item_retur_bb" class="btn btn-info"><i class="bx bx-fw bx-plus"></i> Tambah</button> 
                                        </div>
                                    </div>   
                                </div>  
                            </form>
                            <div id="content_item_retur_bb">
                                <!--LOAD DATA-->
                            </div>
                            <div class="mt-3">
                                <caption>Form retur hanya dapat melakukan retur bahan baku di satu supplier. Pastikan form diisi dengan benar.</caption>
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
                                        <th id="" style="text-align: center; vertical-align: middle; ">PIC</th>
                                        <th id="" style="text-align: center; vertical-align: middle; width:5%">Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $no = 1;
                                        foreach($data_retur->result() as $row) {
                                            if($row->status_retur_bb == 1){
                                    ?>
                                    <tr>
                                        <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->kode_retur_bb;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->tanggal_retur_bb;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_supplier;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->pic_supplier." (".$row->kontak_supplier.")";?></td>
                                        <td style="text-align: center; vertical-align: middle;" >
                                            <a class='btn btn-info btn-sm btn-rounded' href="<?php echo base_url('gudang/retur_bahan_baku/detail/'.$row->kode_retur_bb); ?>"><i class="bx bx-fw bx-show-alt"></i></a>
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
                                        <th id="" style="text-align: center; vertical-align: middle; ">PIC</th>
                                        <th id="" style="text-align: center; vertical-align: middle; width:5%">Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $no = 1;
                                        foreach($data_retur->result() as $row) {
                                            if($row->status_retur_bb == 2){
                                    ?>
                                    <tr>
                                        <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->kode_retur_bb;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->tanggal_retur_bb;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_supplier;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->pic_supplier." (".$row->kontak_supplier.")";?></td>
                                        <td style="text-align: center; vertical-align: middle;" >
                                            <a class='btn btn-info btn-sm btn-rounded' href="<?php echo base_url('gudang/retur_bahan_baku/detail/'.$row->kode_retur_bb); ?>"><i class="bx bx-fw bx-show-alt"></i></a>
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
                                        <th id="" style="text-align: center; vertical-align: middle; ">PIC</th>
                                        <th id="" style="text-align: center; vertical-align: middle; width:5%">Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $no = 1;
                                        foreach($data_retur->result() as $row) {
                                            if($row->status_retur_bb == 3){
                                    ?>
                                    <tr>
                                        <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->kode_retur_bb;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->tanggal_retur_bb;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_supplier;?></td>
                                        <td style="text-align: left; vertical-align: middle;"><?php echo $row->pic_supplier." (".$row->kontak_supplier.")";?></td>
                                        <td style="text-align: center; vertical-align: middle;" >
                                            <a class='btn btn-info btn-sm btn-rounded' href="<?php echo base_url('gudang/retur_bahan_baku/detail/'.$row->kode_retur_bb); ?>"><i class="bx bx-fw bx-show-alt"></i></a>
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
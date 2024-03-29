<?php 
    $id_supplier = $this->session->userdata('ses_id_supplier');
    $menggu_pembayaran = 0;
    $verifikasi_pembayaran = 0;
    $proses = 0;
    $dikirim = 0;

    foreach($pemesanan_bahan_baku->result() as $data1){
        if($data1->id_supplier == $id_supplier){
            if($data1->status_pemesanan_bb == "1"){
                $menggu_pembayaran = $menggu_pembayaran + 1;
            }
            else if($data1->status_pemesanan_bb == "2"){
                $verifikasi_pembayaran = $verifikasi_pembayaran + 1;
            }
            else if($data1->status_pemesanan_bb == "3"){
                $proses = $proses + 1;
            }
            else if($data1->status_pemesanan_bb == "4"){
                $dikirim = $dikirim + 1;
            }
        }
    }
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-1 text-dark"><span class="nav-icon bx bx-fw bx-grid-alt"></span> Dashboard</h1>
                </div>
                <div class="col-sm-6 float-sm-right">
                    <ol class="breadcrumb float-sm-right m-2">
                        <span class="breadcrumb-item active">Dashboard</span>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning elevation-1"><i class="bx bx-lg bx-money"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Menuggu Pembayaran Supplier</span>
                            <span class="info-box-number"><?php echo $menggu_pembayaran; ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary elevation-1"><i class="bx bx-lg bx-time"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Verifikasi Pembayaran Supplier</span>
                            <span class="info-box-number"><?php echo $verifikasi_pembayaran; ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="bx bx-lg bx-refresh"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Pesanan Diproses Supplier</span>
                            <span class="info-box-number"><?php echo $proses; ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-success elevation-1"><i class="bx bx-lg bxs-truck"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Pesanan Dikirim Supplier</span>
                            <span class="info-box-number"><?php echo $dikirim; ?></span>
                        </div>
                    </div>
                </div>      
            </div>                 
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Stok Bahan Baku Akan Habis</h3>
                </div>
                <div class="card-body">
                    <table style="width:100%" id="dataTable1" class="table table-bordered table-striped">
                    <caption></caption>
                        <thead>
                            <tr>
                                <th id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
                                <th id="" style="text-align: center; vertical-align: middle; ">Kode</th>
                                <th id="" style="text-align: center; vertical-align: middle; ">Nama</th>
                                <th id="" style="text-align: center; vertical-align: middle; ">Kategori</th>
                                <th id="" style="text-align: center; vertical-align: middle; ">Supplier</th>
                                <th id="" style="text-align: center; vertical-align: middle; ">Harga (Rp.)</th>
                                <th id="" style="text-align: center; vertical-align: middle; ">Stok Gudang</th>
                                <th id="" style="text-align: center; vertical-align: middle; ">Stok Limit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $no = 1;
                                foreach($bahan_baku->result() as $row) {
                                    if($data1->id_supplier == $id_supplier){
                                        if($row->stok_gudang_sup_bb <= $row->stok_limit_sup_bb + 10){
                            ?>
                            <tr>
                                <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
                                <td style="text-align: left; vertical-align: middle;"><?php echo $row->kode_bb;?></td>
                                <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_bb;?></td>
                                <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_kategori;?></td>
                                <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_supplier;?></td>
                                <td style="text-align: right; vertical-align: middle;"><?php echo number_format($row->harga_bb, 0, ".", ".");?></td>
                                <td style="text-align: left; vertical-align: middle;"><?php echo number_format($row->stok_gudang_sup_bb,2,",",".")." ".$row->nama_satuan;?></td>
                                <td style="text-align: left; vertical-align: middle;"><?php echo number_format($row->stok_limit_sup_bb,2, ",", ".")." ".$row->nama_satuan;?></td>
                            </tr>
                            <?php 
                                        $no++; 
                                    }
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Grafik Transaksi Bahan Baku</h3>
                </div>
                <div class="card-body">
                    <select class="form-control kode_bb col-3" id="kode_bb">
                        <option value="">Pilih Bahan Baku</option>
                        <?php 
                            foreach($bahan_baku->result() as $row){
                                if($row->id_supplier == $id_supplier){ ?>
                                <option value="<?php echo $row->kode_bb; ?>"><?php echo $row->kode_bb." - ".$row->nama_bb; ?></option>
                        <?php 
                                }
                            } 
                        ?>
                    </select>
                    <div class="chart mt-2" style="min-height: 400px; height: 400px; max-height: 400px; max-width: 100%;">
                        <canvas id="chart_bahan_baku"><canvas id="chart"></canvas></canvas>       
                    </div>                      
                </div>
            </div>
        </div>
    </section>   
</div> 


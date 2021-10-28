<?php 
    $id_customer = $this->session->userdata('ses_id_customer');
    $menggu_pembayaran = 0;
    $verifikasi_pembayaran = 0;
    $proses = 0;
    $dikirim = 0;

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
                        

                    </table>
                </div>
            </div>
        </div>
    </section>   
</div> 


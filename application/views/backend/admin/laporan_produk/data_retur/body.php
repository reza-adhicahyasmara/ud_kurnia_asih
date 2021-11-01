<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-1 text-dark"><span class="nav-icon bx bx-fw bxs-file"></span> Laporan Retur Bahan Baku</h1>
                </div>
                <div class="col-sm-6 float-sm-right">
                    <ol class="breadcrumb float-sm-right m-2">
                        <span class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>">Dashboard</a></span>
                        <span class="breadcrumb-item active">Laporan Retur Bahan Baku</span>
                    </ol>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-12">
                    <div class="float-sm-right breadcrumb ">
                        <form role="form" id="quickForm" method="post">
                            <div class="row">                   
                                <div class="form-group" style="margin-right:10px">
                                    <select class="form-control select-custom" id="status" name="status">
                                        <option value="">Pilih Status</option>
                                        <option value="'1'">Menunggu Konfirmasi</option>
                                        <option value="'2'">Dikirim</option>
                                        <option value="'3'">Retur Diterima</option>
                                        <option value="'4'">Retur Ditolak</option>
                                        <option value="'1','2','3','4'">Semua</option>
                                    </select>
                                </div>    
                                <div class="form-group" style="margin-right:10px">
                                    <input type="text" class="form-control" id="tanggal_awal" name="tanggal_awal" placeholder="Tanggal Awal" autocomplete="off">
                                </div>            
                                <div class="form-group" style="margin-right:10px">
                                    <strong> s.d </strong>
                                </div>
                                <div class="form-group" style="margin-right:10px">
                                    <input type="text" class="form-control" id="tanggal_akhir" name="tanggal_akhir" placeholder="Tanggal Akhir" autocomplete="off">
                                </div>
                                <div class="form-group" style="margin-right:10px">
                                    <button type="submit" class="btn bg-purple btn_cari" id="btn_cari"><span class="bx bx-fw bx-search"></span> Cari Data</button>
                                </div>
                                <div class="form-group">
                                    <button type="button" target="_blank" class="btn btn-warning" onclick="window.print();"><span class="bx bx-fw bx-printer"></span> Print</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div id="content_laporan">
                        <!--LOAD DATA-->
                    </div>
                </div>
            </div>
        </div>
    </section>
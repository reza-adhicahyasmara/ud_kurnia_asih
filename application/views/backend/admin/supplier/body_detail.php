<?php foreach($supplier->result() as $row) { ?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-1 text-dark"><span class="nav-icon bx bx-fw bxs-truck"></span> Data Detail Supplier</h1>
                </div>
                <div class="col-sm-6 float-sm-right">
                    <ol class="breadcrumb float-sm-right m-2">
                        <span class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>">Dashboard</a></span>
                        <span class="breadcrumb-item"><a href="<?php echo base_url('admin/supplier'); ?>">Data Supplier</a></span>
                        <span class="breadcrumb-item active">Data Detail Supplier</span>
                    </ol>
                </div>  
            </div>
        </div>
    </div>
    
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-md-center">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body box-profile">
                            <h5 class="mb-3">Profil Supplier</h5>
                            <div class="text-center">
                                <?php if($row->foto_supplier != "") { ?>
                                    <img src="<?php echo base_url('assets/img/supplier/'.$row->foto_supplier);?>" alt="Image" class="profile-user-img img-fluid img-circle" style="width:80px; height:80px; object-fit:cover; background:white;">       
                                <?php }else{ ?>
                                    <img src="<?php echo base_url('assets/img/banner/user.svg');?>" alt="Image" alt="Image" class="profile-user-img img-fluid img-circle" style="width:80px; height:80px; object-fit:cover; background:white;"> 
                                <?php } ?>
                            </div>
                            <h3 class="profile-username text-center"><?php echo $row->nama_supplier; ?></h3>
                            <div class="text-center"><?php echo $row->username_supplier ?></div>
                            <br>
                            <strong><i class="bx bx-fw bx-phone mr-1"></i>Kontak</strong>
                            <p class="text-muted"><?php echo $row->kontak_supplier ?></p>
                            <hr>
                            <strong><i class="bx bx-fw bx-map-pin mr-1"></i>Alamat</strong>
                            <p class="text-muted"><?php echo $row->alamat_supplier; ?></p>
                            <hr>
                            <strong><i class="bx bx-fw bx-user mr-1"></i>PIC</strong>
                            <p class="text-muted"><?php echo $row->pic_supplier; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h5 class="mb-3">Daftar Bahan Baku</h5>
                                </div>
                                <div class="col-sm-6">
                                    <div class="float-sm-right">
                                        <button type="button" class="btn bg-purple" id="btn_tambah_bahan_baku"><span class="bx bx-fw bx-plus"></span> Tambah Data </a>
                                    </div>
                                </div>
                            </div>
                            <div id="content_bahan_baku">
                                <!--LOAD DATA-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php } ?>

<form role="form" id="form_bahan_baku" method="post">
    <div id="modal_bahan_baku" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <strong><span class="modal-title text-lg" id="myModalLabel"></span></strong>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- FORM -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="bx bx-fw bx-x"></span> Batal</button>
                    <button type="submit" id="btn_simpan_bahan_baku" class="btn bg-purple"><span class="bx bx-fw bx-save"></span> Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>
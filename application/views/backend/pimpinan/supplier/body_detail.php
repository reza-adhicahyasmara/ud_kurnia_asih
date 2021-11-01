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
                        <span class="breadcrumb-item"><a href="<?php echo base_url('pimpinan/dashboard'); ?>">Dashboard</a></span>
                        <span class="breadcrumb-item"><a href="<?php echo base_url('pimpinan/supplier'); ?>">Data Supplier</a></span>
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
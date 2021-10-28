<form role="form" id="form_supplier" method="post">
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-1 text-dark"><span class="nav-icon bx bx-fw bx-user"></span>Profil</h1>
                </div>
                <div class="col-sm-6 float-sm-right">
                    <ol class="breadcrumb float-sm-right m-2">
                        <span class="breadcrumb-item"><a href="<?php echo base_url('supplier/dashboard'); ?>">Dashboard</a></span>
                        <span class="breadcrumb-item active">Profil</span>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    
    <section class="content">
        <div class="container-fluid">
            <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><span class="icon fas fa-exclamation-triangle"></span> PERINGATAN!</h5>
                    Setelah data disimpan, secara otomatis akun akan melakukan logout.
            </div>
            <div class="row justify-content-md-center">
                <div class="col-lg-4 col-12">
                    <div class="card card-outline">
                        <div class="card-body">
                            <div id="alert_edit"></div>
                                <input type="hidden" id="jenis" value="Edit">
                                <?php foreach($edit->result() as $edit) { ?>
                                <div class="form-group">
                                    <div class="d-flex justify-content-center mt-3 mb-5"> 
                                        <div class="dropzone dz-clickable" id="my_drop" style="border-radius:50%; border:1px solid #ced4da; width: 150px; height: 150px">
                                            <div class="dz-default dz-message" data-dz-message="" style="margin-left: -20px; margin-right: -20px;">
                                                <?php if($edit->foto_supplier != "") { ?>
                                                    <img src="<?php echo base_url('assets/img/supplier/'.$edit->foto_supplier);?>" class="product-image" id="foto" alt="Image" style="width:150px; height:150px; margin-left: -50px; margin-right: -50px; margin-top: -50px; vertical-align: top; border-radius: 50%; object-fit: cover; overflow:hidden">
                                                    <img src="<?php echo base_url('assets/img/banner/user.svg');?>" class="product-image"  id="assets_supplier" alt="Image" style="width:100px; height:100px; margin-top: -30px; vertical-align: top; display: none;">   
                                                    </br>
                                                    <a href="#" id="teks_supplier" style="color: #007bff; display: block; margin-top: -30px; margin-bottom:15px;">Ganti</a>
                                                <?php }else{ ?>
                                                    <img src="<?php echo base_url('assets/img/banner/user.svg');?>" class="product-image" alt="Image" style="width:100px; height:100px; margin-top: -30px; vertical-align: top;">
                                                <?php } ?> 
                                                <?php if( $edit->foto_supplier != "") { ?>
                                                    <a href="#" id="hapus_gambar_supplier" style="color: #007bff; display: block; margin-top: 1px; margin-bottom:-16px;">Hapus</a>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" id="foto_supplier" name="foto_supplier" value="<?php echo $edit->foto_supplier; ?>"/>
                                </div>
                                <div class="form-group">
                                    <label>Nama Supplier</label>
                                    <input type="hidden" class="form-control" name="id_supplier" id="id_supplier" value="<?php echo $edit->id_supplier; ?>" placeholder="NIK" readonly>
                                    <input type="text" class="form-control" name="nama_supplier" id="nama_supplier" value="<?php echo $edit->nama_supplier; ?>" placeholder="Nama Supplier" readonly>
                                </div>
                                <div class="form-group">
                                    <label>PIC</label>
                                    <input type="text" class="form-control" name="pic_supplier" id="pic_supplier" value="<?php echo $edit->pic_supplier; ?>" placeholder="PIC Supplier">
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea type="text" class="form-control" name="alamat_supplier" id="alamat_supplier" placeholder="Alamat" style="height:100px;"><?php echo $edit->alamat_supplier; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>No. Telepon / HP</label>
                                    <input type="text" class="form-control" name="kontak_supplier" id="kontak_supplier" value="<?php echo $edit->kontak_supplier; ?>" placeholder="No. Telepon / HP">
                                </div>
                                </br>
                                <div class="form-group" style="text-align:center">
                                    <button type="submit" class="btn bg-purple" id="btn_simpan_supplier" style="margin-right:5px"><i class="fa fa-save"></i> Simpan</button>
                                </div>
                                <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</form>
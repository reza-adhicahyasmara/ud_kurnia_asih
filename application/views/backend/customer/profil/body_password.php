<form role="form" id="form_password" method="post">
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-1 text-dark"><span class="nav-icon bx bx-fw bx-lock"></span>Ubah Password</h1>
                </div>
                <div class="col-sm-6 float-sm-right">
                    <ol class="breadcrumb float-sm-right m-2">
                        <span class="breadcrumb-item"><a href="<?php echo base_url('customer/dashboard'); ?>">Dashboard</a></span>
                        <span class="breadcrumb-item active">Ubah Password</span>
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
                                <label>Password Lama</label>
                                <input type="hidden" class="form-control" name="id_customer" id="id_customer" value="<?php echo $edit->id_customer; ?>" placeholder="NIK" readonly>
                                <input type="hidden" class="form-control" name="username_customer" id="username_customer" value="<?php echo $edit->username_customer; ?>" placeholder="NIK" readonly>
                                <input type="password" class="form-control" name="password_lama" id="password_lama" placeholder="Password Lama">
                            </div>
                            <div class="form-group">
                                <label>Password Baru</label>
                                <input type="password" class="form-control" name="password_baru_1" id="password_baru_1" placeholder="Masukkan Password Baru">
                            </div>
                            <div class="form-group">
                                <label>Verifikasi Password Baru</label>
                                <input type="password" class="form-control" name="password_baru_2" id="password_baru_2"  placeholder="Verifikasi Password Baru">
                            </div>
                            </br>
                            <div class="form-group" style="text-align:center">
                                <button type="submit" class="btn bg-purple" id="btn_simpan_password" style="margin-right:5px"><i class="bx bx-fw bx-save"></i> Simpan</button>
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
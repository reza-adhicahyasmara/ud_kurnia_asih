<input type="hidden" id="jenis" value="Tambah">
<div class="form-group">
    <div class="d-flex justify-content-center mt-3 mb-5">
        <div class="dropzone dz-clickable" id="my_drop" style="border-radius:50%; border:1px solid #ced4da; width: 150px; height: 150px">
            <div class="dz-default dz-message" data-dz-message="">
                <img src="<?php echo base_url('assets/img/banner/user.svg');?>" class="product-image" alt="Image" style="width:150px; height:150px; margin-left: -20px; margin-right: -20px; margin-top: -50px; vertical-align: top;">
            </div>
        </div>
        <input type="hidden" name="foto_karyawan" id="foto_karyawan"/>
    </div>
</div>
<div class="form-group">
    <label for="nik_karyawan">NIK</label>
    <input type="text" class="form-control" name="nik_karyawan" id="nik_karyawan" placeholder="NIK">
</div>
<div class="form-group">
    <label for="level_karyawan">Level</label>
    <select class="form-control" name="level_karyawan" id="level_karyawan">
        <option value="">Pilih</option>
        <option value="Admin">Admin</option>
        <option value="Gudang">Gudang</option>
        <option value="Pimpinan">Pimpinan</option>
    </select>
</div>
<div class="form-group">
    <label for="nama_karyawan">Nama</label>
    <input type="text" class="form-control" name="nama_karyawan" id="nama_karyawan" placeholder="Nama">
</div>
<div class="form-group">
    <label for="alamat_karyawan">Alamat</label>
    <textarea type="text" class="form-control" name="alamat_karyawan" id="alamat_karyawan" placeholder="Alamat" style="height:100px;"></textarea>
</div>
<div class="form-group">
    <label for="kontak_karyawan">Kontak</label>
    <input type="text" class="form-control" name="kontak_karyawan" id="kontak_karyawan" placeholder="Kontak">
</div>
<div class="form-group">
    <label for="password_karyawan">Password</label>
    <input type="text" class="form-control" name="password_karyawan" id="password_karyawan" placeholder="Password">
</div>
<div class="form-group">
    <label for="username_karyawan_baru">Username</label>
    <input type="text" class="form-control" name="username_karyawan_baru" id="username_karyawan_baru" placeholder="Password">
</div>
     
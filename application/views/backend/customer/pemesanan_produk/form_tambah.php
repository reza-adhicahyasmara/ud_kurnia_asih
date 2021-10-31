<?php foreach($data->result() as $row) { ?>
    <input type="hidden" class="form-control" name="kode_produk" id="kode_produk" value="<?php echo $row->kode_produk; ?>" readonly>
    <input type="hidden" class="form-control harga_produk" name="harga_ipemesanan_produk" id="harga_ipemesanan_produk" value="<?php echo $row->harga_produk; ?>" readonly>
    <input type="hidden" class="form-control" name="subtotal_ipemesanan_produk" id="subtotal_ipemesanan_produk" readonly>
    <input type="hidden" class="form-control" name="stok_gudang_produk" id="stok_gudang_produk" value="<?php echo $row->stok_gudang_produk; ?>" readonly>
    <span class="text-lg"><?php echo $row->nama_produk; ?></span>
    <div class="form-group mb-3">
        <span class="text-md">Rp. <?php echo number_format($row->harga_produk, 0, '.', '.')."/".$row->nama_satuan; ?></span>
        <br>
        <span class="text-md">Stok <?php echo $row->stok_gudang_produk." ".$row->nama_satuan;?> </span>   
    </div> 
    <div class="row">
        <div class="col-6">
            <div class="row">
                <button type="button" class="btn bg-purple" onclick="decrement()" style="width: 15%;"><span class="fa fa-minus"></span></button>
                <input type="number" class="form-control" name="jumlah_ipemesanan_produk" id="jumlah_ipemesanan_produk"min="0" max="1000" value="0" style="width: 30%; text-align:center">
                <button type="button" class="btn bg-purple" onclick="incerment()" style="width: 15%;"><span class="fa fa-plus"></span></button>
            </div>
        </div>
        <div class="col-6">
            <h5><b><span id="jumlah">0</span> <?php echo $row->nama_satuan;?></b></h5>
            <h5> Subtotal <b>Rp. <span id="subtotal_ipemesanan_produk_text">0</span></b></h5>
        </div>
    </div>
<?php } ?>

<!-----------------------FUNGSI----------------------->
<script type="text/javascript">
    function incerment() {
        document.getElementById('jumlah_ipemesanan_produk').stepUp();
        var harga_produk = $('.harga_produk').val();
        var jumlah_ipemesanan_produk = $('#jumlah_ipemesanan_produk').val();

        var subtotal_ipemesanan_produk = harga_produk * jumlah_ipemesanan_produk;

        $('#subtotal_ipemesanan_produk').val(subtotal_ipemesanan_produk);
        
        $('#subtotal_ipemesanan_produk_text').text(new Number(subtotal_ipemesanan_produk).toLocaleString("id-ID"));
        $('#jumlah').text(jumlah_ipemesanan_produk);
    }

    function decrement() {
        document.getElementById('jumlah_ipemesanan_produk').stepDown();
        var harga_produk = $('.harga_produk').val();
        var jumlah_ipemesanan_produk = $('#jumlah_ipemesanan_produk').val();

        var subtotal_ipemesanan_produk = harga_produk * jumlah_ipemesanan_produk;

        $('#subtotal_ipemesanan_produk').val(subtotal_ipemesanan_produk);
        
        $('#subtotal_ipemesanan_produk_text').text(new Number(subtotal_ipemesanan_produk).toLocaleString("id-ID"));
        $('#jumlah').text(jumlah_ipemesanan_produk);
    }

    
    $('#jumlah_ipemesanan_produk').keyup(function(){
        var harga_produk = $('.harga_produk').val();
        var jumlah_ipemesanan_produk = $('#jumlah_ipemesanan_produk').val();

        var subtotal_ipemesanan_produk = harga_produk * jumlah_ipemesanan_produk;

        $('#subtotal_ipemesanan_produk').val(subtotal_ipemesanan_produk);
        
        $('#subtotal_ipemesanan_produk_text').text(new Number(subtotal_ipemesanan_produk).toLocaleString("id-ID"));
        $('#jumlah').text(jumlah_ipemesanan_produk);
    })
</script>
<?php foreach($data_customer->result() as $row) { 
    $ongkir = $total_berat / $row->berat_ongkir_customer;
    $jumlah_ongkir = ceil($ongkir) * $row->ongkir_customer;
    $total_pby_pemesanan_produk = $jumlah_ongkir + $total_belanja;  
    
?>
    <div class="form-group">
        <table class="text-md" style="width:100%;">
            <tbody>
                <tr>
                    <td style="text-align: left; vertical-align: middle;">Total Belanja</td>
                    <td style="text-align: center; vertical-align: middle;">: Rp.</td>
                    <td style="text-align: right; vertical-align: middle;"><span class="text-lg"><?php echo number_format($total_belanja, 0, ".", ".")?></span></td>
                </tr>
                <tr>
                    <td style="text-align: left; vertical-align: middle;">Ongkir</td>
                    <td style="text-align: center; vertical-align: middle;">: Rp.</td>
                    <td style="text-align: right; vertical-align: middle;"><span class="text-lg"><?php echo number_format($jumlah_ongkir, 0, ".", ".")?></span></td>
                </tr>
                <tr>
                    <td style="text-align: left; vertical-align: middle;">Total Pembayaran</td>
                    <td style="text-align: center; vertical-align: middle;">: Rp.</td>
                    <td style="text-align: right; vertical-align: middle;"><span class="text-lg"><?php echo number_format($total_pby_pemesanan_produk, 0, ".", ".")?></span></td>
                </tr>
            </tbody>
        </table>
    </div>
    <br>
    <input type="hidden" class="form-control" name="total_pby_pemesanan_produk" id="total_pby_pemesanan_produk" value="<?php echo $total_pby_pemesanan_produk;?>">
    <div class="form-group">
        <label>Pilih Rekening</label>
        <select class="form-control kode_rekening" name="kode_rekening" id="kode_rekening">
            <?php 
                foreach($data_rekening->result() as $row) {
                    echo "<option value='".$row->kode_rekening."'>".$row->no_rekening." AN ".$row->an_rekening." (".$row->nama_bank.")</option>"; 
                }
            ?>
        </select>
    </div>
    <div class="mt-3">
        <caption>
            Keterangan
            <ul>
                <li>Pilih rekening yang disediakan oleh UD Kurnia Asih</li>
                <li>Upload bukti transfer ke sistem</li>
            </ul>
        </caption>
    </div>
<?php } ?>

<!-----------------------FUNGSI----------------------->
<script type="text/javascript">

</script>
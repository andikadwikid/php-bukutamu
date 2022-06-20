<form action="" method="post" enctype="multipart/form-data">
    <table border="0" cellspacing="10" width="800" align="center">

    <tbody>
    <tr><td colspan="3"><?php echo $error;?></td></tr>
    <tr>
        <td>Nama Produk</td>
        <td>:</td>
        <td><input type="text" name="nama" placeholder="Nama Produk" size="50" maxlength="30" autocomplete="off" autofocus value="<?php echo $_POST['nama'];?>"/>
        </td>
    </tr>
    <tr>
        <td>Kategori Produk</td>
        <td>:</td>
        <td>
            <select name="kategori">
            <option value="">Pilih Kategori</option>
            <option value="1">Pakaian Pria</option>
            <option value="2">Pakaian Wanita</option>
            <option value="3">Pakaian Anak</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>Deskripsi Produk</td>
        <td>:</td>
        <td><textarea name="deskripsi" placeholder="Deskrippsi Produk" rows="3" cols="50"/><?php echo $_POST['deskripsi'];?></textarea></td>
    </tr>
    <tr>
        <td>Stok Produk</td>
        <td>:</td>
        <td><input type="text" name="stok" placeholder="Stok Produk" size="20" maxlength="10" value="<?php echo $_POST['stok'];?>"/></td>
    </tr>
    <tr>
        <td>Berat Produk</td>
        <td>:</td>
        <td><input type="text" name="berat" placeholder="Berat Produk" size="30" maxlength="30" value="<?php echo $_POST['berat'];?>"/></td>
    </tr>
    <tr>
        <td>Harga Produk</td>
        <td>:</td>
        <td><input type="text" name="harga" placeholder="Harga Produk" size="30" maxlength="30" value="<?php echo $_POST['harga'];?>"/></td>
    </tr>
    <tr>
        <td>Diskon Produk</td>
        <td>:</td>
        <td><input type="text" name="diskon" placeholder="Diskon Produk" size="30" maxlength="10" value="<?php echo $_POST['diskon'];?>"/></td>
    </tr>
    <tr>
        <td colspan="3"><button type="submit" name="simpan">Proses Data</button</td>
    </tr>
</tbody>

</table>
</form>
<?php

include "conn.php";

if(isset($_POST["hantar"])){
    $buku_id = $_POST["buku_id"];
    $nama_buku = $_POST["nama_buku"];
    $keterangan = $_POST["keterangan"];
    $harga = $_POST["harga"];
    $kategori = $_POST["kategori"];
    $status = 'tersedia';



    $namafail = $buku_id.".png";
	$sementara =  $_FILES["namafail"]["tmp_name"];
	move_uploaded_file($sementara, "imej/".basename($namafail));

    $sql = "INSERT INTO buku VALUES ($buku_id,'$nama_buku','$keterangan',$harga,'$kategori','$namafail','$status')";
    mysqli_query($conn, $sql);
    
}

?>
<html>
    <body>
        <form action="tambah_buku.php" method="POST" enctype="multipart/form-data">
            <label for="buku_id">BUKU ID</label>
                <input type="text" name="buku_id" require pattern="[0-9]{9}" 
                oninvalid="this.setCustomValidity('Sila masukkan 9 numbor')"
                oninput="this.setCustomValidity('')"><br>

            <label for="buku_id">NAMA BUKU</label>
                <textarea name="nama_buku" id="" rows="5" cols="30" required></textarea><br>
    
            <label for="buku_id">KETERANGAN</label>
                <textarea name="keterangan" id="" rows="5" cols="30" required></textarea><br>
            
            <label for="buku_id">HARGA</label>
                <input type="text" name="harga" required 
                oninvalid="this.setCustomValidity('Sila masukkan XX.00 numbor')"
                oninput="this.setCustomValidity('')"><br>
                <!-- pattern="[0-9]{2.2}"-->
                
                <label for="buku_id">KATEGORI</label>
                    <select name="kategori" required>
                        <option value=""></option>
                        <option value="database">database</option>
                        <option value="programing">programing</option>
                        <option value="multimedia">multimedia</option>
                        <option value="computer arceture">computer arceture</option>
                        <option value="matematic">matematic</option>
                        <option value="AI">AI</option>
                    </select><br>
    
            <label for="buku_id">GAMBAR</label>
                <input type="file" name="namafail" required><br>

            <button type="submit" name="hantar">submit</button>

        </form>
    </body>
</html>
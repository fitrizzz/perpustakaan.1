<?php
    include "conn.php";
    session_start();
    $datang = $_SESSION["datang"];

    if(isset($_GET["bukuid"])){
        $buku_id = $_GET["bukuid"];
        
        $sql = "SELECT * FROM buku WHERE buku_id = $buku_id";
        $result = mysqli_query($conn,$sql);
        $result = mysqli_fetch_assoc($result);
        // var_dump($result);
        $nama_buku = $result["nama_buku"];
        $keterangan = $result["keterangan"];
        $harga = $result["harga"];
        $kategori = $result["kategori"];
        $gambar = $result["gambar"];
        $status = $result["status"];
        
    }

    if(isset($_POST["hantar"])){
        // echo "butang hantar ditekan";
        $buku_id = $_POST["buku_id"];
        $nama_buku = $_POST["nama_buku"];
        $keterangan = $_POST["keterangan"];
        $harga = $_POST["harga"];
        $kategori = $_POST["kategori"];
        $status = $_POST["status"];
        // $gambar = $_POST["gambar"];
        $namafail = $buku_id.".png";
        $sementara =  $_FILES["namafail"]["tmp_name"];
        move_uploaded_file($sementara, "imej/".basename($namafail));

        $sql = "UPDATE buku SET nama_buku = '$nama_buku',keterangan = '$keterangan',harga=$harga,kategori='$kategori',gambar='$namafail',status='$status' 
                WHERE buku_id = $buku_id";
        mysqli_query($conn, $sql);
    }else{

    }

?>
<html>
    <body>
        <form action="update_buku.php" method="POST" enctype="multipart/form-data">
        <label for="buku_id">BUKU ID</label>
                <input type="text" name="buku_id" value="<?=$buku_id ?>"><br>

            <label for="buku_id">NAMA BUKU</label><br>
                <textarea name="nama_buku" id="" rows="5"><?=$nama_buku ?></textarea><br>
    
            <label for="buku_id">KETERANGAN</label><br>
                <textarea name="keterangan" id="" rows="10"><?=$keterangan ?></textarea><br>
            
            <label for="buku_id">HARGA</label>
                <input type="text" name="harga" value="<?=$harga ?>"><br>
                
            <label for="buku_id">KATEGORI</label>
                <input type="text" name="kategori" value="<?=$kategori ?>"><br>
    
            <label for="buku_id">GAMBAR</label>
            <th><img  width="100" src="imej/<?= $buku_id ?>.png"></th>
                <input type="file" name="namafail" src=""><br>
    
            <label for="buku_id">STATUS</label>
                <input type="text" name="status" value="<?=$status ?>" readonly><br>
            <button type="submit" name="hantar">hantar</button>
        </form>
        <?php 
            if($datang == "staff"){
                echo "<a href='home_staff.php'>Back</a>";
            }elseif($datang == "admin"){
                echo "<a href='home_admin.php'>Back</a>";
            }else{

            }
        ?>
    </body>
</html>
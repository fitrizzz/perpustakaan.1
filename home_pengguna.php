<?php
    include "conn.php";
    session_start();
    $nama = $_SESSION["nama"];
    $pid = $_SESSION["id"];
    // echo $nama;
?>

<html>
    
    <body>
        <link rel="stylesheet" href="style.css">
    <body>
        <div class="sidebar">
            <header>SYSTEM</header>
            <ul>
                <li><a href="#" class="">HOME</a></li>
                <li><a href="#" class="">SENARAI BUKU</a></li>
                <li><a href="#" class="">BUKU DIPINJAM</a></li>
                <li><a href="#" class="">PULANG BUKU</a></li>
                <li><a href="#" class="">EDIT PROFIL</a></li>
                <li><a href="#" class="">LOGOUT</a></li>

            </ul>
        </div>
        <div>
        <!-------------------------- BUKU ADA ----------------------------------------->
        <h1>SELAMAT DATANG PENGGUNA <?= $nama ?></h1>
        <table border="5px">
            <tr>
                <th>buku id</th>
                <th>nama buku</th>
                <th>gambar</th>
                <th>detail
                <th>pinjam sekarang</th>
            </tr>
            
            
            <?php $sql = "SELECT * FROM buku WHERE status = 'tersedia' AND buku_id NOT IN
                            (SELECT buku_id FROM pinjam WHERE status = 'noti_me' AND pengguna_id = $pid)";
                    $result = mysqli_query($conn,$sql);
                    while($row = mysqli_fetch_assoc($result)) : ?>
                        <tr>
                            <th><?php echo $row["buku_id"] ?></th>
                            <th><?php echo $row["nama_buku"] ?></th>
                            <th><img src="imej/<?= $row["gambar"] ?>"></th>
                            <th><a href="detail_buku.php?bukuid=<?=$row["buku_id"]?>">DETAIL</a></th>
                            <th><a href="pinjam_buku.php?bukuid=<?=$row["buku_id"]?>">PINJAM</a></th>
                        </tr>
                    <?php endwhile; ?>
        </table>
        <!-------------------------- BUKU ADA ----------------------------------------->

        <!-------------------------- BUKU pinjam ----------------------------------------->
        <h2>buku yang dipinjam</h2>
            <table border="5px">
            <tr>
                <th>buku id</th>
                <th>nama buku</th>
                <th>gambar</th>
                <th>PULANG BUKU</th>
            </tr>
            <?php $sql = "SELECT * FROM buku WHERE buku_id IN 
                            (SELECT buku_id FROM pinjam WHERE pengguna_id = $pid AND status = 'lulus')";
                    $result = mysqli_query($conn,$sql);
                    while($row = mysqli_fetch_assoc($result)) : ?>
                        <tr>
                            <th><?php echo $row["buku_id"] ?></th>
                            <th><?php echo $row["nama_buku"] ?></th>
                            <th><img src="imej/<?= $row["gambar"] ?>"></th>
                            <th><a href="pulang_buku.php?bukuid=<?=$row["buku_id"]?>&namabuku=<?=$row["nama_buku"]?>">PULANG</a></th>
                        </tr>
                    <?php endwhile; ?>
    
            </table>
        <!-------------------------- BUKU pinjam----------------------------------------->

                <!-------------------------- BUKU tiada ----------------------------------------->
                <h2>buku yang tidak tersedia</h2>
            <table border="5px">
            <tr>
                <th>buku id</th>
                <th>nama buku</th>
                <th>noti me</th>
            </tr>
            <?php $sql = "SELECT * FROM buku WHERE status = 'tidak_tersedia'";
                    $result = mysqli_query($conn,$sql);
                    while($row = mysqli_fetch_assoc($result)) : ?>
                        <tr>
                            <th><?php echo $row["buku_id"] ?></th>
                            <th><?php echo $row["nama_buku"] ?></th>
                            <th><a href="noti_buku.php?bukuid=<?=$row["buku_id"]?>">noti me</a></th>
                        </tr>
                    <?php endwhile; ?>
    
            </table>
        <!-------------------------- BUKU tiada----------------------------------------->

        <!-------------------------- NOTI ----------------------------------------->
                        <h2>NOTIFIVATION</h2>
            <table border="5px">
            <tr>
                <th>buku id</th>
                <th>nama buku</th>
                <th>terima</th>
                <th>buang noti</th>
            </tr>
            
            <?php $sql = "SELECT * FROM buku WHERE buku_id IN 
                            (SELECT buku_id FROM pinjam WHERE pengguna_id = $pid AND status = 'noti_me')";
                    $result = mysqli_query($conn,$sql);
                    while($row = mysqli_fetch_assoc($result)) : ?>
                    <?php $bid = $row["buku_id"];
                            $sqlp = "SELECT buku_id FROM buku WHERE buku_id IN 
                            (SELECT buku_id FROM pinjam WHERE buku_id = $bid AND status = 'lulus')";
                            $resultp = mysqli_query($conn,$sqlp); 
                            $resultp =  mysqli_fetch_assoc($resultp);
                            var_dump($resultp);
                            var_dump($bid);

                        if(($resultp AND $bid) == true){
                            echo "
                                <tr>
                                <th>$row[buku_id] </th>
                                <th>$row[nama_buku] </th>
                                <th><a href=terima_dari_noti_buku.php?bukuid=$row[buku_id]></a></th>
                                <th><a href=buang_noti_buku.php?bukuid=$row[buku_id]>buang</a></th>
                            </tr>
                            ";
                        }else{
                            echo "
                                <tr>
                            <th>$row[buku_id] </th>
                            <th>$row[nama_buku] </th>
                                <th><a href=terima_dari_noti_buku.php?bukuid=$row[buku_id]>terima</a></th>
                            <th><a href='buang_noti_buku.php?bukuid=$row[buku_id]'>buang</a></th>
                        </tr>
                            ";
                        }?>

                    <?php endwhile; ?>
    
            </table>
        <!-------------------------- NOTI ----------------------------------------->
        </div>
    </body>
</html>
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
        <div class="conten">
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
</html>
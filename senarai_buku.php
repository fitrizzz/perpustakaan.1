<?php

include "conn.php";
?>

<html>
    <body>
        <table border="1px">
            <tr>
                <th>buku_id</th>
                <th>nama_buku</th>
                <th>keterangan</th>
                <th>harga</th>
                <th>kategori</th>
                <th>gambar</th>
                <th>status</th>
                <th>edit</th>
                <th>padam</th>
            </tr>
            <?php $sql = "SELECT * FROM buku";
                    $result = mysqli_query($conn,$sql);
                    while($row = mysqli_fetch_assoc($result)) : ?>
                        <tr>
                            <th><?php echo $row['buku_id']; ?></th>
                            <th><?php echo $row['nama_buku']; ?></th>
                            <th><?php echo $row['keterangan']; ?></th>
                            <th><?php echo $row['harga']; ?></th>
                            <th><?php echo $row['kategori']; ?></th>
                            <td><img width="100" src="imej/<?php echo $row['buku_id']; ?>.png"></td>
                            <th><?php echo $row['status']; ?></th>
                            <th><a href="update_buku.php?buku_id=<?=$row['buku_id']?>">edit</a></th>
                            <th><a href="padam_buku.php?buku_id=<?=$row['buku_id']?>">padam</a></th>
                        </tr>
            <?php endwhile; ?>
        </table>
    </body>
</html>
<!DOCTYPE html>
<html>

<head>
    <title>Sistem Informasi Akademik::Edit Data Dosen</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="bootstrap4/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/styleku.css">
    <script src="bootstrap4/jquery/3.3.1/jquery-3.3.1.js"></script>
    <script src="bootstrap4/js/bootstrap.js"></script>
</head>

<body>
    <?php
    require "fungsi.php";
    require "head.html";

    $id = $_GET['kode'];
    $sql = "select * from dosen where id='$id'";
    $qry = mysqli_query($koneksi, $sql);
    $row = mysqli_fetch_assoc($qry);
    ?>
    <div class="utama">
        <h2 class="mb-3 text-center">EDIT DATA DOSEN</h2>
        <div class="row">
            <div class="col-sm-3 text-center">
                <img class="rounded img-thumbnail" src="fotodosen/<?php echo $row['foto'] ?>">
                <div>
                    [ <a href="gantiFotoDsn.php?id=<?php echo $row['id'] ?>">Ganti Foto</a> ]
                </div>
            </div>
            <div class="col-sm-9">
                <form enctype="multipart/form-data" method="post" action="sv_editDsn.php">

                    <div class="form-group">
                        <label for="npp">NPP:</label>
                        <input class="form-control" type="text" name="npp" id="npp" value="<?php echo $row['npp'] ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="namadosen">Nama Dosen:</label>
                        <input class="form-control" type="text" name="namadosen" id="namadosen" value="<?php echo $row['namadosen'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="homebase">HomeBase:</label>
                        <input class="form-control" type="homebase" name="homebase" id="homebase" value="<?php echo $row['homebase'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="foto">Foto:</label>
                        <input class="form-control" type="file" name="fotodosen" id="fotodosen" value="<?php echo $row['foto'] ?>">
                    </div>
                    <div>
                        <button class="btn btn-primary" type="submit" id="submit">Simpan</button>
                    </div>
                    <input type="hidden" name="id" id="id" value="<?php echo $id ?>">
                </form>
            </div>
        </div>
    </div>
    <!-- script>
		$('#submit').on('click',function(){
			var id 		= $('#id').val();
			var nama	= $('#nama').val();
			var homebase = $('#homebase').val();
			$.ajax({
				method	: "POST",
				url		: "sv_editDsn.php",
				data	: {id:id, nama:nama, homebase:homebase}
			});
		});
	</script -->
</body>

</html>
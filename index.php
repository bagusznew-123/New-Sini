<?php
//koneksi database \
$server = "localhost";
$user = "root";
$password = "";
$database = "dbcrud2025";

//koneksi
$koneksi = mysqli_connect($server, $user, $password, $database) or die(mysqli_error($koneksi));



//tombol simpan
if (isset($_POST['bInput'])) {


    //pengujian apakah data akan edit/simpan baru
    if (isset($_GET['hal']) == "edit") {
        
        //data akan diedit
        $edit = mysqli_query($koneksi, "UPDATE tbarang SET
                                               SerialModem = '$_POST[tsn]',
                                              RedamanModem = '$_POST[trdmn_modem]',
                                               RedamanOPM = '$_POST[trdmn_opm]',
                                               SelisihRedaman = '$_POST[tselisih]',
                                               Settingan = '$_POST[tsttngn]',
                                               validator = '$_POST[tvldtr]'
                                         WHERE id_barang = '$_GET[id]'                                   
                                       ");
        //uji jika edit data sukses
        if ($edit) {
            echo "<script>
           alert('Edit data Sukses!');
           document.location='index.php';
          </script>";
        } else {
            echo "<script>
           alert('Edit data Gagal!');
           document.location='index.php';
          </script>";
        }
    } else {


        //send data
        $simpan = mysqli_query($koneksi, " INSERT INTO tbarang (Tanggal, SerialModem, RedamanModem, RedamanOPM, SelisihRedaman, Settingan, Validator)
                                                    VALUES ( '$_POST[ttanggal]',
                                                            '$_POST[tsn]',
                                                            '$_POST[trdmn_modem]',
                                                            '$_POST[trdmn_opm]',
                                                            '$_POST[tselisih]',
                                                            '$_POST[tsttngn]',
                                                            '$_POST[tvldtr]')
                                                  ");
        //uji jika simpan data sukses
        if ($simpan) {
            echo "<script>
           alert('Simpan data Sukses!');
           document.location='index.php';
          </script>";
        } else {
            echo "<script>
           alert('Simpan data Gagal!');
           document.location='index.php';
          </script>";
        }

    }

}

//deklarasi var untuk yg data yg di edit
$vtanggal = "";
$vsn = "";
$vredaman_modem = "";
$vredaman_opm = "";
$vselisih_redaman = "";
$vsettingan = "";
$vvalidator = "";

//pengujian jika tombol edit/hapus di klic
if (isset($_GET['hal'])) {

    //pengujian jika edit data
    if ($_GET['hal'] == "edit") {

        //tampilkan data yang akan di edit
        $tampil = mysqli_query($koneksi, "SELECT * FROM tbarang WHERE id_barang = '$_GET[id]' ");
        $data = mysqli_fetch_array($tampil);
        if ($data) {
            $vtanggal = $data['Tanggal'];
            $vsn = $data['SerialModem'];
            $vredaman_modem = $data['RedamanModem'];
            $vredaman_opm = $data['RedamanOPM'];
            $vselisih_redaman = $data['SelisihRedaman'];
            $vsettingan = $data['Settingan'];
            $vvalidator = $data['Validator'];
        }


    } else if ($_GET['hal'] == "hapus") {
        //persiapaam hapus data
        $hapus = mysqli_query($koneksi, "DELETE FROM tbarang WHERE id_barang = '$_GET[id]'");

        //uji jika hapus data sukses
        if ($hapus) {
            echo "<script>
           alert('Hapus data Sukses!');
           document.location='index.php';
          </script>";
        } else {
            echo "<script>
           alert('Hapus data Gagal!');
           document.location='index.php';
          </script>";
        }
    }


}




?>




<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Warehouse QC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
</head>


<body>
    <!---awal container--->
    <div class="container">
        <h3 class="text-center">Data Modem</h3>
        <h3 class="text-center">Warehouse</h3>
        <!---awal row--->
        <div class="row">

            <!---awal col--->
            <div class="col-md-8 mx-auto">
                <!---awal card--->
                <div class="card">
                    <div class="card-header bg-info text-light">
                        Form Input Modem Qc
                    </div>
                    <div class="card-body">

                        <!---awal form--->

                        <form method="POST">
                            <div class="mb-3">
                                <label class="form-label">Tanggal QC</label>
                                <input type="date" name="ttanggal" value="<?= $vtanggal ?>" class="form-control"
                                    placeholder="Isi Tanggal QC">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Serial Modem</label>
                                <input type="text" name="tsn" value="<?= $vsn ?>" class="form-control"
                                    placeholder="Isi Serial Modem">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Redaman Modem</label>
                                <input type="number" step="0.01" id="r_modem" name="trdmn_modem"
                                    value="<?= $vredaman_modem ?>" class="form-control" placeholder="Isi Redaman Modem">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Redaman OPM</label>
                                <input type="number" step="0.01" id="r_opm" name="trdmn_opm" value="<?= $vredaman_opm ?>"
                                    class="form-control" placeholder="Isi Redaman OPM">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Selisih Redaman</label>
                                <input type="text" id="selisih" name="tselisih" value="<?= $vselisih_redaman ?>"
                                    class="form-control" placeholder="Otomatis Terhitung" readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Settingan</label>
                                <select class="form-select" name="tsttngn">

                                    <option value="<?= $vsettingan ?>">
                                        <?= $vsettingan ?>
                                    </option>

                                    <option selected>Pilih Settingan</option>
                                    <option value="Dasarata">Dasarata</option>
                                    <option value="GriyaNet">GriyaNet</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Validator</label>
                                <select class="form-select" name="tvldtr">

                                    <option value="<?= $vvalidator ?>">
                                        <?= $vvalidator ?>
                                    </option>

                                    <option selected>Pilih Validator</option>
                                    <option value="Greafin & Dion">Greafin & Dion</option>
                                    <option value="Greafin & Magang">Greafin & Magang</option>
                                    <option value="Dion & Magang">Dion & Magang</option>
                                    <option value="Magang & Magang">Magang & Magang</option>
                                </select>
                            </div>
                            <div>
                                <div class="text-center">
                                    <hr>
                                    <button class="btn btn-primary" name="bInput" type="submit">Input</button>
                                    <button class="btn btn-danger" name="bNo input" type="reset">Batalkan</button>
                                </div>

                                
                            </div>


                        </form>

                        <script>
                            function hitungSelisih() {
                                let modem = parseFloat(document.getElementById("r_modem").value)
                                let opm = parseFloat(document.getElementById("r_opm").value)
                                let hasil = opm - modem;
                                document.getElementById("selisih").value = hasil; // tanpa toFixed
                            }

                            document.getElementById("r_modem").addEventListener("input", hitungSelisih);
                            document.getElementById("r_opm").addEventListener("input", hitungSelisih);
                        </script>

                        <!---akhir form--->



                    </div>
                    <div class="card-footer bg-info">

                    </div>
                </div>
                <!---akhir card--->
            </div>
            <!---akhir col--->
        </div>
    </div>
    <!---akhir row--->

    <!---awal card--->
    <div class="card mt-3">
        <div class="card-header bg-info text-light">
            Data Modem Qc
        </div>
        <div class="card-body">
            <div class="col-md-5 mx-auto">
                <form method="POST">
                    <div class="input-group mb-3">
                        <input type="text" name="tcari" value="<?=@$_POST['tcari']?>" class="form-control" placeholder="Masukkan SN Modem!">
                        <button class="btn btn-primary" name="bcari" type="submit">Cari</button>
                        <button class="btn btn-danger" name="breset" type="submit">Reset</button>
                    </div>

                </form>
            </div>
            <table class="table table-striped  table-hover table-bordered">
                <tr>
                    <th>No.</th>
                    <th>Idbarang</th>
                    <th>Tanggal</th>
                    <th>Serial Modem</th>
                    <th>Redaman Modem</th>
                    <th>Redaman OPM</th>
                    <th>Selisih Redaman</th>
                    <th>Settingan</th>
                    <th>Validator</th>
                    <th>Ubah</th>

                </tr>

                <?php
                //persiapan menampilkan data
                $no = 1;

                //untuk pencarian data
                //jika tombol cari di klik
                if(isset($_POST['bcari'])){
    //tampilkan data yang di cari
    $keyword = $_POST['tcari'];
    $q = "SELECT * FROM tbarang 
          WHERE SerialModem LIKE '%$keyword%' 
             OR id_barang LIKE '%$keyword%' 
          ORDER BY SerialModem DESC";
}else{
    $q = "SELECT * FROM tbarang ORDER BY SerialModem DESC";
}




                $tampil = mysqli_query($koneksi, $q);
                while ($data = mysqli_fetch_array($tampil)):
                    ?>

                </tr>

                <td>
                    <?= $no++ ?>
                </td>
                <td>
                    <?= $data['id_barang'] ?>
                </td>
                <td>
                    <?= $data['Tanggal'] ?>
                </td>
                <td>
                    <?= $data['SerialModem'] ?>
                </td>
                <td>
                    <?= $data['RedamanModem'] ?>
                </td>
                <td>
                    <?= $data['RedamanOPM'] ?>
                </td>
                <td>
                    <?= $data['SelisihRedaman'] ?>
                </td>
                <td>
                    <?= $data['Settingan'] ?>
                </td>
                <td>
                    <?= $data['Validator'] ?>
                </td>
                <td>
                    <a href="index.php?hal=edit&id=<?= $data['id_barang'] ?>" class="btn
                    btn-warning">Edit</a>

                    <a href="index.php?hal=hapus&id=<?= $data['id_barang'] ?>" class="btn
                    btn-danger" onclick="return confirm('Apakah yakin ingin hapus data ini ?')">Hapus</a>
                </td>


                </tr>

                <?php endwhile; ?>

            </table>


        </div>
        <div class="card-footer bg-info">

        </div>
    </div>
    <!---akhir card--->







    <!---akhir container--->



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous"></script>
</body>

</html>
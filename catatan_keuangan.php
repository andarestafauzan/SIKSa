<?php 
include('koneksi.php');
include('proseslogin.php');
if(login_check()){
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Catatan Keuangan</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/noui/nouislider.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" href="css/date_style.css">
<!--===============================================================================================-->
<style type="text/css">
  option, select {
    font-family: Poppins-Regular;
  }
  .input-group-addon {
    background-color: rgb(131,146,167); 
    color: white
  }
  #ha, a, button {
    font-family: Montserrat-Medium;
    font-size: 10pt
  }
  label {
    font-family: Montserrat-SemiBold; 
    font-size: 10pt
  }
</style>
</head>
<body>
	<div class="container-fluid">
		<div class="row"><br></div>
		<div class="row">
			<div class="col-sm-2">
				<a id="ha" style="border-radius: 50px; padding-right: 36px" class="btn btn-danger" href="index.php"><i class="fa fa-long-arrow-left m-l-7"></i> Halaman Awal</a>
			</div>
			<div class="col-sm-10">
				<h2 style="font-family: Montserrat-Black; font-weight: bold;">Catatan Keuangan</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<br>
				<ul class="nav nav-tabs">
          <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#ckg">Catatan Keuangan</a>
            </li>
    				<li class="nav-item">
      					<a class="nav-link" data-toggle="tab" href="#cpj">Catatan Penjualan</a>
    				</li>
    				<li class="nav-item">
      					<a class="nav-link" data-toggle="tab" href="#cpg">Catatan Pengeluaran</a>
    				</li>
    				<li class="nav-item">
      					<a class="nav-link" data-toggle="tab" href="#lck">Laporan Catatan Keuangan</a>
    				</li>
  				</ul>
  				<div class="tab-content">
            <div id="ckg" class="container tab-pane active">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-sm-12">
                    <br>
                    <h5 style="font-family: Montserrat-SemiBold">Selamat datang...</h5>
                    <br>
                    <p style="font-family: Montserrat-Medium">Disini Anda bisa melihat catatan penjualan, melihat catatan pengeluaran, dan mencetak laporan catatan keuangan.</p>
                  </div>
                </div>
              </div>
            </div>
    				<div id="cpj" class="container tab-pane fade"><br>
    					<div class="container-fluid">
    						<div class="row">
    							<div class="col-sm-2">
                    <?php
                      $penjualan = mysqli_query($conn, "SELECT * FROM penjualan LEFT JOIN pembeli ON penjualan.id_pembeli = pembeli.id_pembeli");
                          if (isset($_POST['cpj_show'])) {
                            $cpj_b = $_POST['cpj_bln'];
                            $cpj_t = $_POST['cpj_thn'];
                          }
                          else{
                            $cpj_b = date("m");
                            $cpj_t = date("Y");
                          }
                    ?>
                    <form action="" method="post">
                      <div class="form-group">
                      <span style="border-radius: 3px; margin-bottom: 1px; width: 146px" class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </span>
                      <div class="form-inline">
                        <div>
                          <label>Bulan</label>
                          <select name="cpj_bln" class="form-control">
                          <?php 
                            if (!isset($_POST['cpj_show'])){
                          ?>
                            <option value="<?php echo date('m', time()) ?>"><?php echo date('m', time()) ?></option>
                            <option disabled value="">---</option>
                          <?php
                            for ($i=1; $i <= 12 ; $i++) { 
                          ?>
                              <option value="<?php echo date('m', mktime(0, 0, 0, $i, 10)) ?>"><?php echo date('m', mktime(0, 0, 0, $i, 10)) ?></option>
                          <?php
                            }
                          ?>
                          <?php
                            }
                            else{
                          ?>
                              <option value="<?php echo $cpj_b ?>"><?php echo $cpj_b ?></option>
                              <option disabled value="">---</option>
                          <?php
                              for ($i=1; $i <= 12 ; $i++) { 
                          ?>
                              <option value="<?php echo date('m', mktime(0, 0, 0, $i, 10)) ?>"><?php echo date('m', mktime(0, 0, 0, $i, 10)) ?></option>
                          <?php
                            }}
                          ?>
                        </select>
                        </div>
                        <div>
                          <label>Tahun</label>
                          <select name="cpj_thn" class="form-control">
                          <?php
                            if (!isset($_POST['cpj_show'])){
                          ?>
                          <option value="<?php echo date('Y', time()) ?>"><?php echo date('Y', time()) ?></option>
                          <option disabled value="">-----</option>
                          <?php
                            $thn = array();
                            while($u_thn = mysqli_fetch_array($penjualan)){
                              if (empty($thn)){
                                $thn[] = date("Y", strtotime($u_thn['tgl']));
                              }
                              elseif (!empty($thn) and end($thn) != date("Y", strtotime($u_thn['tgl']))) {
                                $thn[] = date("Y", strtotime($u_thn['tgl']));
                              }
                            }
                            array_unique($thn);
                            rsort($thn);
                            foreach($thn as $thns){
                          ?>
                          <option value="<?php echo $thns ?>"><?php echo $thns ?></option>
                          <?php
                            }}
                            else{
                          ?>
                          <option value="<?php echo $cpj_t ?>"><?php echo $cpj_t ?></option>
                          <option disabled value="">-----</option>
                          <?php
                            $thn = array();
                            while($u_thn = mysqli_fetch_array($penjualan)){
                              if (empty($thn)){
                                $thn[] = date("Y", strtotime($u_thn['tgl']));
                              }
                              elseif (!empty($thn) and end($thn) != date("Y", strtotime($u_thn['tgl']))) {
                                $thn[] = date("Y", strtotime($u_thn['tgl']));
                              }
                            }
                            array_unique($thn);
                            rsort($thn);
                            foreach($thn as $thns){
                          ?>
                          <option value="<?php echo $thns ?>"><?php echo $thns ?></option>
                          <?php
                            }}
                          ?>
                        </select>
                        </div>
                      </div>
                      <input class="btn btn-primary" style="border-radius: 50px; margin: 5px 0px 0px 15px; width: 113px; font-family: Montserrat-Medium; font-size: 10pt; cursor: pointer" type="submit" name="cpj_show" value="Tampilkan">
                  </div>
                    </form>
    							</div>
    							<div class="col-sm-10">
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <?php
                          $f_penjualan = mysqli_query($conn, "SELECT * FROM penjualan WHERE MONTH(tgl) = '".$cpj_b."' AND YEAR(tgl) = '".$cpj_t."'");
                          $cek = mysqli_num_rows($f_penjualan);
                          if ($cek <= 0) {
                            echo "<h5 style='font-family: Montserrat-SemiBold'>Maaf... :(</h5>
                                  <br>
                                  <p style='font-family: Montserrat-Medium'>Data penjualan pada bulan ".$cpj_b.", tahun ".$cpj_t." tidak ditemukan.</p>";
                          }
                        else{
                        ?>
                        <thead>
                          <tr>
                            <th>Tanggal</th>
                            <th>Kerupuk</th>
                            <th>Qty</th>
                            <th>Total</th>
                            <th>Pembeli</th>
                            <th>Info Pembeli</th>
                            <th>Catatan</th>
                          </tr> 
                        </thead>
                        <tbody>
                        <?php
                          while ($data = mysqli_fetch_array($f_penjualan)) {
                        ?>
                          <tr>
                            <td><?php echo $data['tgl']; ?></td>
                            <td><?php echo $data['jns_kerupuk'] ?></td>
                            <td><?php echo $data['jml_krupuk'] ?></td>
                            <td>Rp. <?php echo $data['jml_penjualan'] ?></td>
                            <td><?php echo "(".$data['jns_pembeli'].") ".$data['nm_pembeli'] ?></td>
                            <td><?php echo "(".$data['no_telp'].") ".$data['alamat'] ?></td>
                            <td><?php echo $data['catatan'] ?></td>
                          </tr>
                        <?php
                          }}
                        ?>
                        </tbody>
                      </table>
                    </div>
    							</div>
    						</div>
    					</div>
    				</div>
    				<div id="cpg" class="container tab-pane fade"><br>
      					<div class="container-fluid">
    						<div class="row">
    							<div class="col-sm-2">
    								<?php
                      $pengeluaran = mysqli_query($conn, "SELECT * FROM pengeluaran");
                          if (isset($_POST['cpg_show'])) {
                            $cpg_b = $_POST['cpg_bln'];
                            $cpg_t = $_POST['cpg_thn'];
                          }
                          else{
                            $cpg_b = date("m");
                            $cpg_t = date("Y");
                          }
                    ?>
                    <form action="" method="post">
                      <div class="form-group">
                      <span style="border-radius: 3px; margin-bottom: 1px; width: 146px" class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </span>
                      <div class="form-inline">
                        <div>
                          <label>Bulan</label>
                          <select name="cpg_bln" class="form-control">
                          <?php 
                            if (!isset($_POST['cpg_show'])){
                          ?>
                            <option value="<?php echo date('m', time()) ?>"><?php echo date('m', time()) ?></option>
                            <option disabled value="">---</option>
                          <?php
                            for ($i=1; $i <= 12 ; $i++) { 
                          ?>
                              <option value="<?php echo date('m', mktime(0, 0, 0, $i, 10)) ?>"><?php echo date('m', mktime(0, 0, 0, $i, 10)) ?></option>
                          <?php
                            }
                          ?>
                          <?php
                            }
                            else{
                          ?>
                              <option value="<?php echo $cpg_b ?>"><?php echo $cpg_b ?></option>
                              <option disabled value="">---</option>
                          <?php
                              for ($i=1; $i <= 12 ; $i++) { 
                          ?>
                              <option value="<?php echo date('m', mktime(0, 0, 0, $i, 10)) ?>"><?php echo date('m', mktime(0, 0, 0, $i, 10)) ?></option>
                          <?php
                            }}
                          ?>
                        </select>
                        </div>
                        <div>
                          <label>Tahun</label>
                          <select name="cpg_thn" class="form-control">
                          <?php
                            if (!isset($_POST['cpg_show'])){
                          ?>
                          <option value="<?php echo date('Y', time()) ?>"><?php echo date('Y', time()) ?></option>
                          <option disabled value="">-----</option>
                          <?php
                            $thn = array();
                            while($u_thn = mysqli_fetch_array($pengeluaran)){
                              if (empty($thn)){
                                $thn[] = date("Y", strtotime($u_thn['tgl']));
                              }
                              elseif (!empty($thn) and end($thn) != date("Y", strtotime($u_thn['tgl']))) {
                                $thn[] = date("Y", strtotime($u_thn['tgl']));
                              }
                            }
                            array_unique($thn);
                            rsort($thn);
                            foreach($thn as $thns){
                          ?>
                          <option value="<?php echo $thns ?>"><?php echo $thns ?></option>
                          <?php
                            }}
                            else{
                          ?>
                          <option value="<?php echo $cpg_t ?>"><?php echo $cpg_t ?></option>
                          <option disabled value="">-----</option>
                          <?php
                            $thn = array();
                            while($u_thn = mysqli_fetch_array($pengeluaran)){
                              if (empty($thn)){
                                $thn[] = date("Y", strtotime($u_thn['tgl']));
                              }
                              elseif (!empty($thn) and end($thn) != date("Y", strtotime($u_thn['tgl']))) {
                                $thn[] = date("Y", strtotime($u_thn['tgl']));
                              }
                            }
                            array_unique($thn);
                            rsort($thn);
                            foreach($thn as $thns){
                          ?>
                          <option value="<?php echo $thns ?>"><?php echo $thns ?></option>
                          <?php
                            }}
                          ?>
                        </select>
                        </div>
                      </div>
                      <input class="btn btn-primary" style="border-radius: 50px; margin: 5px 0px 0px 15px; width: 113px; font-family: Montserrat-Medium; font-size: 10pt; cursor: pointer" type="submit" name="cpg_show" value="Tampilkan">
                  </div>
                    </form>
    							</div>
    							<div class="col-sm-10">
                    <div class="table-responsive">
    								  <table class="table table-striped">
                      <?php
                          $f_pengeluaran = mysqli_query($conn, "SELECT * FROM pengeluaran WHERE MONTH(tgl) = '".$cpg_b."' AND YEAR(tgl) = '".$cpg_t."'");
                          $cek = mysqli_num_rows($f_pengeluaran);
                          if ($cek <= 0) {
                            echo "<h5 style='font-family: Montserrat-SemiBold'>Maaf... :(</h5>
                                  <br>
                                  <p style='font-family: Montserrat-Medium'>Data pengeluaran pada bulan ".$cpg_b.", tahun ".$cpg_t." tidak ditemukan.</p>";
                          }
                        else{
                      ?>
      									<thead>
      										<tr>
      											<th>Tanggal</th>
      											<th>Total</th>
                            <th>Peruntukan</th>
      											<th>Catatan</th>
      										</tr>	
      									</thead>
      									<tbody>
                        <?php
                          while ($data = mysqli_fetch_array($f_pengeluaran)){
                        ?>
      										<tr>
      											<td><?php echo $data['tgl']; ?></td>
      											<td>Rp. <?php echo $data['jumlah']; ?></td>
      											<td><?php echo $data['jenis']; ?></td>
                            <td><?php echo $data['catatan']; ?></td>
      										</tr>
                        <?php
                          }}
                        ?>
      									</tbody>
      								</table>
    							 </div>
                </div>
    						</div>
    					</div>
    				</div>
    				<div id="lck" class="container tab-pane fade"><br>
      					<div class="container-fluid">
    						<div class="row">
    							<div class="col-sm-2">
                  <?php
                      $cetak = mysqli_query($conn, "SELECT * FROM penjualan JOIN pengeluaran ON penjualan.tgl = pengeluaran.tgl WHERE MONTH(penjualan.tgl) = MONTH(pengeluaran.tgl) OR YEAR(penjualan.tgl) = YEAR(pengeluaran.tgl)");
                          if (isset($_POST['lck_show'])) {
                            $lck_b = $_POST['lck_bln'];
                            $lck_t = $_POST['lck_thn'];
                          }
                          else{
                            $lck_b = date("m");
                            $lck_t = date("Y");
                          }
                    ?>
    								<form action="" method="post">
                      <div class="form-group">
                      <span style="border-radius: 3px; margin-bottom: 1px; width: 146px" class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </span>
                      <div class="form-inline">
                        <div>
                          <label>Bulan</label>
                          <select name="lck_bln" class="form-control">
                          <?php 
                            if (!isset($_POST['lck_show'])){
                          ?>
                            <option value="<?php echo date('m', time()) ?>"><?php echo date('m', time()) ?></option>
                            <option disabled value="">---</option>
                          <?php
                            for ($i=1; $i <= 12 ; $i++) { 
                          ?>
                              <option value="<?php echo date('m', mktime(0, 0, 0, $i, 10)) ?>"><?php echo date('m', mktime(0, 0, 0, $i, 10)) ?></option>
                          <?php
                            }
                          ?>
                          <?php
                            }
                            else{
                          ?>
                              <option value="<?php echo $lck_b ?>"><?php echo $lck_b ?></option>
                              <option disabled value="">---</option>
                          <?php
                              for ($i=1; $i <= 12 ; $i++) { 
                          ?>
                              <option value="<?php echo date('m', mktime(0, 0, 0, $i, 10)) ?>"><?php echo date('m', mktime(0, 0, 0, $i, 10)) ?></option>
                          <?php
                            }}
                          ?>
                        </select>
                        </div>
                        <div>
                          <label>Tahun</label>
                          <select name="lck_thn" class="form-control">
                          <?php
                            if (!isset($_POST['lck_show'])){
                          ?>
                          <option value="<?php echo date('Y', time()) ?>"><?php echo date('Y', time()) ?></option>
                          <option disabled value="">-----</option>
                          <?php
                            $thn = array();
                            while($u_thn = mysqli_fetch_array($cetak)){
                              if (empty($thn)){
                                $thn[] = date("Y", strtotime($u_thn['tgl']));
                              }
                              elseif (!empty($thn) and end($thn) != date("Y", strtotime($u_thn['tgl']))) {
                                $thn[] = date("Y", strtotime($u_thn['tgl']));
                              }
                            }
                            rsort($thn);
                            foreach($thn as $thns){
                          ?>
                          <option value="<?php echo $thns ?>"><?php echo $thns ?></option>
                          <?php
                            }}
                            else{
                          ?>
                          <option value="<?php echo $lck_t ?>"><?php echo $lck_t ?></option>
                          <option disabled value="">-----</option>
                          <?php
                            $thn = array();
                            while($u_thn = mysqli_fetch_array($pengeluaran)){
                              if (empty($thn)){
                                $thn[] = date("Y", strtotime($u_thn['tgl']));
                              }
                              elseif (!empty($thn) and end($thn) != date("Y", strtotime($u_thn['tgl']))) {
                                $thn[] = date("Y", strtotime($u_thn['tgl']));
                              }
                            }
                            rsort($thn);
                            foreach($thn as $thns){
                          ?>
                          <option value="<?php echo $thns ?>"><?php echo $thns ?></option>
                          <?php
                            }}
                          ?>
                        </select>
                        </div>
                      </div>
                      <input class="btn btn-primary" style="border-radius: 50px; margin: 5px 0px 0px 15px; width: 113px; font-family: Montserrat-Medium; font-size: 10pt; cursor: pointer" type="submit" name="lck_show" value="Tampilkan">
                  </div>
                    </form>
    							</div>
    							<div class="col-sm-8">
                    </center>
                    <?php
                          $f_cetak = mysqli_query($conn, "SELECT * FROM pengeluaran WHERE MONTH(tgl) = '".$lck_b."' AND YEAR(tgl) = '".$lck_t."'");
                          $f_cetak1 = mysqli_query($conn, "SELECT * FROM penjualan WHERE MONTH(tgl) = '".$lck_b."' AND YEAR(tgl) = '".$lck_t."'");
                          $cek = mysqli_num_rows($f_cetak);
                          $cek1 = mysqli_num_rows($f_cetak1);
                          if ($cek <= 0 or $cek1 <= 0) {
                            echo "<h5 style='font-family: Montserrat-SemiBold'>Maaf... :(</h5>
                                  <br>
                                  <p style='font-family: Montserrat-Medium'>Data keuangan pada bulan ".$lck_b.", tahun ".$lck_t." tidak ditemukan.</p>";
                          }
                        else{
                      ?>
    								<center>
                      <h5>Kerupuk Sahabat</h5>
                      <br>
                      <h3>Laporan Catatan Keuangan</h3> 
                      <br>
                      <?php setlocale(LC_ALL, 'id_ID'); ?>
                      <h6>Per <?php echo strftime("%A, %e %B %G"); ?></h6>
                    </center>
                      <br>
                      <h5>Penjualan</h5>
                      <div class="table-responsive">
                        <table class="table table-sm">
                          <thead>
                            <tr>
                              <th>Tanggal</th>
                              <th>Kerupuk Terjual</th>
                              <th>Pendapatan</th>
                            </tr> 
                          </thead>
                          <tbody>
                          <?php
                            $sum_array = array();
                            $sum_tgl = array();
                            $sum_qty = $sum_cpj = 0;
                            while($r_data = mysqli_fetch_array($f_cetak1)) {
                              if($cek1 <= 1){
                                $sum_tgl = array("tgl" => $r_data['tgl'], "qty" => $r_data['jml_krupuk'], "cpj" => $r_data['jml_penjualan']);
                                $sum_array[] = $sum_tgl;
                                $sum_qty = $r_data['jml_krupuk'];
                                $sum_cpj = $r_data['jml_penjualan'];
                              }
                              elseif ($cek1 > 1) {
                                if (empty($sum_tgl)){
                                  $sum_tgl = array("tgl" => $r_data['tgl'], "qty" => $r_data['jml_krupuk'], "cpj" => $r_data['jml_penjualan']);
                                }
                                elseif ($sum_tgl['tgl'] == $r_data['tgl']) {
                                  $sum_tgl['cpj'] += $r_data['jml_penjualan'];
                                  $sum_tgl['qty'] += $r_data['jml_krupuk'];
                                }
                                else{
                                  $sum_array[] = $sum_tgl;
                                  $sum_tgl = array("tgl" => $r_data['tgl'], "qty" => $r_data['jml_krupuk'], "cpj" => $r_data['jml_penjualan']);
                                }
                                $sum_qty += $r_data['jml_krupuk'];
                                $sum_cpj += $r_data['jml_penjualan']; 
                              }
                            }
                            $sum_qty += $r_data['jml_krupuk'];
                            $sum_cpj += $r_data['jml_penjualan']; 
                            $sum_array[] = $sum_tgl;
                            foreach ($sum_array as $ctk) {
                          ?>
                            <tr>
                              <td><?php echo $ctk['tgl'] ?></td>
                              <td><?php echo $ctk['qty'] ?></td>
                              <td>Rp. <?php echo $ctk['cpj'] ?></td>
                            </tr>
                        <?php
                            }
                          ?>
                          <tr>
                            <td colspan="3"></td>
                          </tr>
                          <tr>
                            <th>
                              <center>
                              Total
                            </center>
                            </th>
                            <td>
                              <?php echo $sum_qty ?>
                            </td>
                            <td>
                              Rp. <?php echo $sum_cpj ?>
                            </td>
                          </tr>
                          </tbody>
                        </table>
                        <br>
                        <h5>Pengeluaran</h5>
                      <div class="table-responsive">
                        <table class="table table-sm">
                          <thead>
                            <tr>
                              <th>Tanggal</th>
                              <th>Peruntukan Pengeluaran</th>
                              <th>Pengeluaran</th>
                            </tr> 
                          </thead>
                          <tbody>
                          <?php
                            $sum_array = array();
                            $sum_tgl = array();
                            $sum_str = array();
                            $sum_cpg = 0;
                            while($r_data = mysqli_fetch_array($f_cetak)) {
                              if($cek <= 1){
                                $sum_tgl = array("tgl" => $r_data['tgl'], "cpg" => $r_data['jumlah'], "jen" => $r_data['jenis']);
                                $sum_array[] = $sum_tgl;
                                $sum_cpg = $r_data['jumlah'];
                              }
                              elseif ($cek > 1) {
                                if (empty($sum_tgl)){
                                  $sum_str[] = $r_data['jenis'];
                                  $sum_tgl = array("tgl" => $r_data['tgl'], "cpg" => $r_data['jumlah'], "jen" => end($sum_str));
                                }
                                elseif ($sum_tgl['tgl'] == $r_data['tgl']) {
                                  $sum_tgl['cpg'] += $r_data['jumlah'];
                                  for ($i=0; $i < sizeof($sum_str) ; $i++) { 
                                    if ($sum_str[$i] != $r_data['jenis']){
                                      $sum_tgl['jen'] = $sum_tgl['jen'].", ".$r_data['jenis'];
                                    }
                                  }
                                }
                                else{
                                  $sum_array[] = $sum_tgl;
                                  unset($sum_str);
                                  $sum_str[] = $r_data['jenis'];
                                  $sum_tgl = array("tgl" => $r_data['tgl'], "cpg" => $r_data['jumlah'], "jen" => end($sum_str));
                                }
                                $sum_cpg += $r_data['jumlah']; 
                              }
                            }
                             $sum_array[] = $sum_tgl;
                            foreach ($sum_array as $ctk) {
                          ?>
                            <tr>
                              <td><?php echo $ctk['tgl'] ?></td>
                              <td><?php echo $ctk['jen'] ?></td>
                              <td>Rp. <?php echo $ctk['cpg'] ?></td>
                            </tr>
                        <?php
                          }}
                        ?>
                        <tr>
                            <td colspan="3"></td>
                          </tr>
                          <tr>
                            <th colspan="2">
                            <center>
                              Total
                            </center>
                          </th>
                          <td>
                            Rp. <?php echo $sum_cpg ?>
                          </td>
                          </tr>
                        </tbody>
                        </table>
                      </div>
                  </div>
                  <h5>
                    Keuntungan
                  </h5>
                  <h6>
                    <p style="font-family: arial; font-size: 12pt; font-style: normal; color: black">
                    Total keuntungan pada bulan <b><?php echo strftime("%B %G", mktime(0, $lck_t, 0, $lck_b, 10)); ?></b> adalah sebesar : <b>Rp. <?php echo $sum_cpj - $sum_cpg ?></b>
                    </p>
                  </h6>
                  <br>
                  <div style="position: absolute; right: 0%; width: 200px">
                    <h6 style="position: absolute; right: 45%;">Admin</h6>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <h6 style="position: absolute; right: 100%">(</h6>
                    <h6 style="position: absolute; right: 0%">)</h6>
                    </div>
    						</div>
                <div class="col-sm-2">
                    <center>
                      <?php if($cek >= 1 or $cek1 >= 1) {?>
                    <form action="print.php" method="post">
                        <input type="hidden" name="lck_bln" value="<?php echo $lck_b ?>">
                        <input type="hidden" name="lck_thn" value="<?php echo $lck_t ?>">
                        <button style="border-radius: 50px; width: 120px; font-family: Montserrat-Medium; font-size: 10pt; cursor: pointer" class="btn btn-info" type="submit" name="lck_show" value="Cetak">
                        <i class="fa fa-print"></i> Cetak
                      </button>
                      </form>
                    <?php } ?>  
                    </center>
                  </div>
    					</div>
    				</div>
  				</div>
			</div>
		</div>
	</div>
	<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="js//jquery-ui.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<script>
		$(".js-select2").each(function(){
			$(this).select2({
				minimumResultsForSearch: 20,
				dropdownParent: $(this).next('.dropDownSelect2')
			});


			$(".js-select2").each(function(){
				$(this).on('select2:close', function (e){
					if($(this).val() == "Please chooses") {
						$('.js-show-service').slideUp();
					}
					else {
						$('.js-show-service').slideUp();
						$('.js-show-service').slideDown();
					}
				});
			});
		})
	</script>
  <script>
        //open recently visited tab, reseted when click "Halaman Awal"
        $(document).ready(function () {
            $('#ha').click(function(){
              localStorage.clear();
            });
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                localStorage.setItem('lastTab', $(this).attr('href'));
                $('h2').text($(this).text());
            });
            var lastTab = localStorage.getItem('lastTab');
            if (lastTab) {
              $('[href="' + lastTab + '"]').tab('show');
            }
        })
    </script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
	<script src="js/date_index.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="vendor/noui/nouislider.min.js"></script>
	<script>
	    var filterBar = document.getElementById('filter-bar');

	    noUiSlider.create(filterBar, {
	        start: [ 1500, 3900 ],
	        connect: true,
	        range: {
	            'min': 1500,
	            'max': 7500
	        }
	    });

	    var skipValues = [
	    document.getElementById('value-lower'),
	    document.getElementById('value-upper')
	    ];

	    filterBar.noUiSlider.on('update', function( values, handle ) {
	        skipValues[handle].innerHTML = Math.round(values[handle]);
	        $('.contact100-form-range-value input[name="from-value"]').val($('#value-lower').html());
	        $('.contact100-form-range-value input[name="to-value"]').val($('#value-upper').html());
	    });
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
	<script>
  		window.dataLayer = window.dataLayer || [];
  		function gtag(){dataLayer.push(arguments);}
  		gtag('js', new Date());
  		gtag('config', 'UA-23581568-13');
	</script>
</body>
</html>
<?php }
  else{
          echo '<script type="text/javascript">
                alert("Silahkan login terlebih dahulu.");
                window.location.href="login.php";
            </script>';
        }

 ?>
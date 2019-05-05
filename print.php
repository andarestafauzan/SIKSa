<?php 
include('koneksi.php');
include('proseslogin.php');

if(login_check()){
      if (isset($_POST['lck_show'])) {
            $lck_b = $_POST['lck_bln'];
            $lck_t = $_POST['lck_thn'];
      }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Laporan Catatan Keuangan Bulan <?php echo strftime("%B %G", mktime(0, $lck_t, 0, $lck_b, 10))."_".date("d-m-Y", time()) ?></title>
</head>
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
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-2"></div>
                  <?php
                        
                        $f_cetak = mysqli_query($conn, "SELECT * FROM pengeluaran WHERE MONTH(tgl) = '".$lck_b."' AND YEAR(tgl) = '".$lck_t."'");
                        $f_cetak1 = mysqli_query($conn, "SELECT * FROM penjualan WHERE MONTH(tgl) = '".$lck_b."' AND YEAR(tgl) = '".$lck_t."'");
                        $cek = mysqli_num_rows($f_cetak);
                        $cek1 = mysqli_num_rows($f_cetak1);
                  ?>
			<div class="col-sm-8">
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
                      <div class="table">
                        <?php if ($cek1 >= 1) {
                        ?>
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
                      </div>
                      <?php
                          }
                          else{
                            $sum_qty = $sum_cpj = 0;
                        ?>
                      <p style="font-family: arial; font-size: 12pt; font-style: normal; color: black">Tidak ditemukan adanya data penjualan pada bulan ini</p>
                          <br>
                        <?php
                          }
                          ?>
                        <br>
                        <h5>Pengeluaran</h5>
                      <div class="table-responsive">
                        <?php if ($cek >= 1) {
                        ?>
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
                          }
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
                  <?php 
                        }
                      else{
                        $sum_cpg = 0;
                    ?>
                    <p style="font-family: arial; font-size: 12pt; font-style: normal; color: black">Tidak ditemukan adanya data pengeluaran pada bulan ini</p>
                    <br>
                    <?php
                        }
                    ?>
                  <h5>
                    Keuntungan
                  </h5>
                  <h6>
                    <p style="font-family: arial; font-size: 12pt; font-style: normal; color: black">
                    Total keuntungan pada bulan <b><?php echo strftime("%B %G", mktime(0, (int)$lck_t, 0, (int)$lck_b, 10)); ?></b> adalah sebesar : <b>Rp. <?php echo $sum_cpj - $sum_cpg ?></b>
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
			<div class="col-sm-2"></div>
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
		$(document).ready(function(){
			window.print();
			window.close();
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
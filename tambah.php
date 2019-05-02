<?php
		include "koneksi.php";
	if (isset($_POST['input'])) {
	
		$query = "SELECT max(Id_pengeluaran) as maxKode FROM pengeluaran";
		$hasil = mysqli_query($conn,$query);
		$data = mysqli_fetch_array($hasil);
		$kodeBarang = $data['maxKode'];
		$noUrut = (int) substr($kodeBarang, 3, 3);
		$noUrut++;
		$char = "10";
		$kodeBarang = $char . sprintf("%03s", $noUrut);
        $jml = $_POST['jml_pengeluaran'];
        $jns = $_POST['jns_pengeluaran'];
        $cttn = $_POST['catatan'];
        $tgl = $_POST['tanggal'];
        $query= mysqli_query($conn, "INSERT INTO pengeluaran VALUES('$kodeBarang','$tgl','$jml','$jns','$cttn')");
        
        if($query){
        	echo "<script>alert('Input Data Berhasil')</script>";
			echo "<script>location.href='index.php'</script>";
		} 
		else {
			echo "<script>alert('Input Data Gagal')</script>";
			echo "<script>location.href='catat_pengeluaran.php'</script>";
		}
    }
?>
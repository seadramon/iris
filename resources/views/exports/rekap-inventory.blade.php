<table>
	<thead>
		<tr>
			<th colspan="19">
				PT WIJAYA KARYA BETON
			</th>
		</tr>
		<tr>
			<th colspan="19">
				{{ $pat }}
			</th>
		</tr>
		<tr>
			<th colspan="19">
				&nbsp;
			</th>
		</tr>
		<tr>
			<th colspan="19">
				<center>DAFTAR ALAT PT. WIKA BETON Tbk</center>
			</th>
		</tr>
		<tr>
			<th colspan="19">
				<center>PERIODE : BULAN {{ strtoupper(getMonth(date('n'))) }}</center>
			</th>
		</tr>
		<tr>
			<th colspan="19">
				&nbsp;
			</th>
		</tr>
		<tr>
			<th rowspan="2">No</th>
			<th rowspan="2">KODEFIKASI <br> (BARU)</th>
			<th rowspan="2">NAMA ALAT</th>
			<th rowspan="2">BUATAN/MERK</th>
			<th rowspan="2">KAPASITAS/SPESIFIKASI</th>
			<th rowspan="2">TYPE</th>
			<th rowspan="2">NOMOR SERI</th>
			<th rowspan="2">TAHUN PEMBUATAN</th>
			<th rowspan="2">BLN-THN <br> PEROLEHAN</th>

			<th colspan="3">I.Fungsi (a+b+c)</th>
			<th rowspan="2">II <br>Safety<br>(20%)</th>
			<th rowspan="2">III <br>Lengkap<br>(10%)</th>
			<th rowspan="2">(I+II+III) <br>Kondisi<br>(100%)</th>
			<th rowspan="2">STATUS <br>(Baik/ PK /<br>RR / Rusak)</th>

			<th colspan="2">POSISI</th>
			<th rowspan="2">KETERANGAN</th>
		</tr>
		<tr>
			<th>a.Operasi<br>(30%)</th>
			<th>b.<br>Daya</th>
			<th>c.<br>Umur</th>
			<th>JALUR / <br> LOKASI</th>
			<th>FUNGSI</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$i = 1;
		?>
		@foreach($inventories as $inventory)
			<tr>
				<td>{{ $i }}</td>
				<td>{{ $inventory->no_inventaris }}</td>
				<td>{{ !empty($inventory->category)?$inventory->category->ket:"" }}</td>
				<td>{{ !empty($inventory->brand)?$inventory->brand->ket:"" }}</td>
				<td>{{ $inventory->kapasitas }}</td> <!-- spefikasi -->
				<td>{{ $inventory->tipe }}</td>
				<td>{{ $inventory->no_seri }}</td>
				<td>{{ $inventory->th_pembuatan }}</td>
				<td>{{ getMonth($inventory->bl_perolehan).'-'.$inventory->th_perolehan }}</td>

				<td>{{ $inventory->operasi }}</td>
				<td>{{ $inventory->nilai_daya }}</td>
				<td>{{ $inventory->nilai_umur }}</td>
				
				<td>{{ $inventory->nilai_safety }}</td>
				<td>{{ $inventory->nilai_lengkap }}</td>
				<td>{{ $inventory->nilai_kondisi }}</td>
				<td>{{ $inventory->nilai_status }}</td>

				<td>{{ !empty($inventory->location)?$inventory->location->ket:"" }}</td>
				<td>{{ !empty($inventory->functional)?$inventory->functional->ket:"" }}</td>
				<td>{{ $inventory->uraian }}</td>
			</tr>
			<?php $i++; ?>
		@endforeach
	</tbody>
</table>
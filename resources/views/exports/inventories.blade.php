<table>
	<thead>
		<tr>
			<th colspan="13">
				PT WIJAYA KARYA BETON
			</th>
		</tr>
		<tr>
			<th colspan="13">
				{{ $pat }}
			</th>
		</tr>
		<tr>
			<th colspan="13">
				&nbsp;
			</th>
		</tr>
		<tr>
			<th colspan="13">
				<center>DAFTAR ALAT {{strtoupper($sumber)}} COUNTABLE</center>
			</th>
		</tr>
		<tr>
			<th colspan="13">
				&nbsp;
			</th>
		</tr>
		<tr>
			<th>No</th>
			<th>KODEFIKASI <br> (BARU)</th>
			<th>NAMA ALAT</th>
			<th>KAPASITAS / <br> BUATAN/MERK</th>
			<th>SPESIFIKASI</th>
			<th>TYPE</th>
			<th>NOMOR SERI</th>
			<th>TAHUN PEMBUATAN</th>
			<th>BLN-THN <br> PEROLEHAN</th>
			<th colspan="2">KONDISI %</th>
			<th>POSISI JALUR / <br> LOKASI</th>
			<th>FUNGSI / LOKASI</th>
			<th>KETERANGAN</th>
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
				<td>{{ $inventory->uraian }}</td>
				<td>{{ !empty($inventory->brand)?$inventory->brand->ket:"" }}</td>
				<td>{{ $inventory->kapasitas }}</td> <!-- spefikasi -->
				<td>{{ $inventory->tipe }}</td>
				<td>{{ $inventory->no_seri }}</td>
				<td>{{ $inventory->th_pembuatan }}</td>
				<td>{{ getMonth($inventory->bl_perolehan).'-'.$inventory->th_perolehan }}</td>
				<td>{{ !empty($inventory->persen_kondisi)?100*$inventory->persen_kondisi:0 }}</td>
				<td>{{ !empty($inventory->condition)?$inventory->condition->kondisi:"" }}</td>
				<td>{{ !empty($inventory->location)?$inventory->location->ket:"" }}</td>
				<td>{{ !empty($inventory->functional)?$inventory->functional->ket:"" }}</td>
				<td>{{ '' }}</td>
			</tr>
			<?php $i++; ?>
		@endforeach
	</tbody>
</table>
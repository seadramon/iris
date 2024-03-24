<table border="1">
	<thead>
		<tr>
			<th colspan="11">
				PT WIJAYA KARYA BETON
			</th>
		</tr>
		<tr>
			<th colspan="11">
				{{ $pat }}
			</th>
		</tr>
		<tr>
			<th colspan="11">
				&nbsp;
			</th>
		</tr>
		<tr>
			<th colspan="11">
				<center>MONITOR USIA ALAT</center>
			</th>
		</tr>
		<tr>
			<th colspan="11">
				<center>PERIODE BULAN : {{strtoupper($month)}} - TAHUN {{$year}}</center>
			</th>
		</tr>
		<tr>
			<th colspan="11">
				&nbsp;
			</th>
		</tr>
		<tr>
			<th rowspan="2">No</th>
			<th rowspan="2">NAMA ALAT</th>
			<th colspan="6">JUMLAH</th>
			<th colspan="2">KONDISI</th>
			<th rowspan="2">KETERANGAN</th>
		</tr>
		<tr>
			<th>1 - 2 Tahun</th>
			<th>3 - 7 Tahun</th>
			<th>8 - 10 Tahun</th>
			<th>11 - 15 Tahun</th>
			<th>16 - 20 Tahun</th>
			<th>Total</th>
			<th>Baik</th>
			<th>Rusak</th>
		</tr>
	</thead>
	<tbody>
		<?php $i = 1; ?>
		@foreach($data as $row)
		<tr>
			<td>{{$i}}</td>
			<td>{{ $row['nama'] }}</td>
			<td>{{ !empty($row['a'])?$row['a']:'-' }}</td>
			<td>{{ !empty($row['b'])?$row['b']:'-' }}</td>
			<td>{{ !empty($row['c'])?$row['c']:'-' }}</td>
			<td>{{ !empty($row['d'])?$row['d']:'-' }}</td>
			<td>{{ !empty($row['e'])?$row['e']:'-' }}</td>
			<td style="color: red;">{{ !empty($row['total'])?$row['total']:'-' }}</td>
			<td>{{ !empty($row['baik'])?$row['baik']:'-' }}</td>
			<td>{{ !empty($row['rusak'])?$row['rusak']:'-' }}</td>
			<td>{{ $row['keterangan'] }}</td>
		</tr>

		<?php 
		$i++; 

		$a[] = !empty($row['a'])?$row['a']:0;
		$b[] = !empty($row['b'])?$row['b']:0;
		$c[] = !empty($row['c'])?$row['c']:0;
		$d[] = !empty($row['d'])?$row['d']:0;
		$e[] = !empty($row['e'])?$row['e']:0;
		$total[] = !empty($row['total'])?$row['total']:0;
		$baik[] = !empty($row['baik'])?$row['baik']:0;
		$rusak[] = !empty($row['rusak'])?$row['rusak']:0;
		?>
		@endforeach

		<tr>
			<td colspan="2">TOTAL (Unit)</td>
			<td>{{ array_sum($a) }}</td>
			<td>{{ array_sum($b) }}</td>
			<td>{{ array_sum($c) }}</td>
			<td>{{ array_sum($d) }}</td>
			<td>{{ array_sum($e) }}</td>
			<td style="color: red;">{{ array_sum($total) }}</td>
			<td>{{ array_sum($baik) }}</td>
			<td>{{ array_sum($rusak) }}</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2">PROSENTASE (%)</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="11">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="8">Mengetahui,</td>
			<td colspan="3">Pasuruan,{{date('d F Y')}}<br>Dibuat oleh,</td>
		</tr>
		<tr>
			<td colspan="8">&nbsp;</td>
			<td colspan="3">&nbsp;</td>
		</tr><tr>
			<td colspan="8">&nbsp;</td>
			<td colspan="3">&nbsp;</td>
		</tr><tr>
			<td colspan="8">&nbsp;</td>
			<td colspan="3">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="8">M Suliswanto,ST</td>
			<td colspan="3">#REFI</td>
		</tr>
		<tr>
			<td colspan="8">Manajer Peralatan</td>
			<td colspan="3">Adm Peralatan</td>
		</tr>
	</tfoot>
</table>
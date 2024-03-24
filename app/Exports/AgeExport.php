<?php

namespace App\Exports;

use App\Models\Inventory;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class AgeExport implements FromView, ShouldAutoSize, WithEvents
{
	protected $period;
	protected $month;
	protected $year;
	protected $pat;
    protected $ketPat;

	public function __construct(string $year, string $month, string $pat, string $ket)
    {
        $this->pat = $pat;
        $this->ketPat = $ket;
        $this->month = $month;
        $this->year = $year;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $query = Inventory::with(['category']);

    	if (!empty($this->period)) {
    		// next
    	}

    	if (!empty($this->pat)) {
    		$query->where('pat_alat', $this->pat);
    	}

    	$arrData = $query->get();
    	$data = [];

    	$i = 1;
    	$foo = [];
    	foreach ($arrData as $row) {
    		$data[$row->kd_alat]['nama'] = !empty($row->category)?$row->category->ket:"";
    		$data[$row->kd_alat]['keterangan'] = $row->uraian;
    		$data[$row->kd_alat]['pat'] = $this->pat;

    		if (!empty($row->th_perolehan)) {
				if (is_numeric($row->th_perolehan)) {
					$range = date('Y') - $row->th_perolehan;

					if (($range >= 1) && ($range <= 2)) {
						$a = !empty($data[$row->kd_alat]['a'])?$data[$row->kd_alat]['a']:0;
						$data[$row->kd_alat]['a'] = $a + 1;
					}

					if ($range >= 3 && $range <= 7) {
						$b = !empty($data[$row->kd_alat]['b'])?$data[$row->kd_alat]['b']:0;
						$data[$row->kd_alat]['b'] = $b + 1;
					}

					if ($range >= 8 && $range <= 10) {
						$c = !empty($data[$row->kd_alat]['c'])?$data[$row->kd_alat]['c']:0;
						$data[$row->kd_alat]['c'] = $c + 1;
					}
						
					if ($range >= 11 && $range <= 15) {
						$d = !empty($data[$row->kd_alat]['d'])?$data[$row->kd_alat]['d']:0;
						$data[$row->kd_alat]['d'] = $d + 1;
					}

					if ($range >= 16 && $range <= 20) {
						$e = !empty($data[$row->kd_alat]['e'])?$data[$row->kd_alat]['e']:0;
						$data[$row->kd_alat]['e'] = $e + 1;
					}

					$total = !empty($data[$row->kd_alat]['total'])?$data[$row->kd_alat]['total']:0;
					$data[$row->kd_alat]['total'] = $total + 1;
				}
			}

			if (is_numeric($row->kondisi)) {
				if ($row->kondisi == 1) {
					$baik = !empty($data[$row->kd_alat]['baik'])?$data[$row->kd_alat]['baik']:0;
					$data[$row->kd_alat]['baik'] = $baik + 1;
				} else {
					$rusak = !empty($data[$row->kd_alat]['rusak'])?$data[$row->kd_alat]['rusak']:0;
					$data[$row->kd_alat]['rusak'] = $rusak + 1;
				}
			}
    	}

        return view('exports.ages', [
            'data' => $data,
            'month' => $this->month,
            'year' => $this->year,
            'pat' => $this->ketPat
        ]);
    }

    public function registerEvents(): array

    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A4:A5')->getFont()->setSize(14)->setBold(true);
                $event->sheet->getDelegate()->getStyle('A4:A5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                $styleArray = [
                    'font' => [
                        'bold' => true
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ]
                    ]
                ];

                $cellRange = 'A7:K8';
                $event->sheet->getDelegate()->getStyle($cellRange)->applyFromArray($styleArray);

                $foo = (int)$event->sheet->getHighestRow() - 9;
                // dd($foo);
                $contentRange = 'A9:K'.$foo;
                $borderArray = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ]
                    ]
                ];
                $event->sheet->getDelegate()->getStyle($contentRange)->applyFromArray($borderArray);

                $start = (int)$event->sheet->getHighestRow() - 8;
                $end = (int)$event->sheet->getHighestRow() - 7;
                $totalRange = 'A'.$start.':'.'K'.$end;
                $borderArray = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                        ]
                    ]
                ];
                $event->sheet->getDelegate()->getStyle($totalRange)->applyFromArray($borderArray);
            },

        ];

    }
}

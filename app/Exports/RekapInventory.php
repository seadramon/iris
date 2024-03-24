<?php

namespace App\Exports;

use App\Models\Inventory;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

use DB;

class RekapInventory implements FromView, ShouldAutoSize, WithEvents
{
	protected $pat;

	public function __construct(string $pat, string $ket)
    {
        $this->pat = $pat;
        $this->ketPat = $ket;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
    	$query = Inventory::select('*');

    	if (!empty($this->pat)) {
    		$query->where('pat_alat', $this->pat);
    	}

    	$data = $query->get();

        return view('exports.rekap-inventory', [
            'inventories' => $data,
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
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                        ]
                    ]
                ];

                $cellRange = 'A7:S8';
                $event->sheet->getDelegate()->getStyle($cellRange)->applyFromArray($styleArray);

                $contentRange = 'A9:S'.$event->sheet->getHighestRow();
                $borderArray = [
                    'borders' => [
                        'outline' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                        ],
                        'vertical' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                        ]
                    ]
                ];
                $event->sheet->getDelegate()->getStyle($contentRange)->applyFromArray($borderArray);
            },

        ];

    }
}

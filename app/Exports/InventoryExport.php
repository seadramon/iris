<?php

namespace App\Exports;

use App\Models\Inventory;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class InventoryExport implements FromView, ShouldAutoSize, WithEvents
{
	protected $sumber;
	protected $pat;
    protected $ketPat;

	public function __construct(string $sumber, string $pat, string $ket)
    {
    	$this->sumber = $sumber;
        $this->pat = $pat;
        $this->ketPat = $ket;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
    	$query = Inventory::select("*");

    	if (!empty($this->sumber)) {
    		if ($this->sumber == "ekstra") {
    			$query->where('no_inventaris', 'like', '%E');
    		} else {
    			$query->where('no_inventaris', 'not like', '%E');
    		}
    	}

    	if (!empty($this->pat)) {
    		$query->where('pat_alat', $this->pat);
    	}

    	$data = $query->get();

        return view('exports.inventories', [
            'inventories' => $data,
            'sumber' => $this->sumber,
            'pat' => $this->ketPat
        ]);
    }

    public function registerEvents(): array

    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A4')->getFont()->setSize(14)->setBold(true);
                $event->sheet->getDelegate()->getStyle('A4')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

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

                $cellRange = 'A6:N6';
                $event->sheet->getDelegate()->getStyle($cellRange)->applyFromArray($styleArray);

                $contentRange = 'A7:N'.$event->sheet->getHighestRow();
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

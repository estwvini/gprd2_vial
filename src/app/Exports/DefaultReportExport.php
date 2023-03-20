<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Throwable;

/**
 * Clase DefaultReportExport
 * @package App\Exports
 */
class DefaultReportExport implements FromView, WithEvents
{
    /**
     * @var View
     */
    private $view;

    /**
     * Constructor ReportExport.
     *
     * @param View $view
     */
    public function __construct(View $view)
    {
        $this->view = $view;
    }

    /**
     * Llama a la vista que se exportará a excel.
     *
     * @return View
     * @throws Throwable
     */
    public function view(): View
    {
        return $this->view;
    }

    /**
     * Modifica y aplica estilos a la hoja de excel.
     *
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                $highestRowAndColumn = $event->sheet->getDelegate()->getHighestRowAndColumn();

                // Apply array of styles to A1:(last cell) cell range
                $styleArray = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => 'FF000000']
                        ]
                    ],
                    'alignment' => [
                        'vertical' => Alignment::VERTICAL_CENTER
                    ]
                ];
                $event->sheet->getDelegate()->getStyle('A1:' . $highestRowAndColumn['column'] . $highestRowAndColumn['row'])->applyFromArray($styleArray);
                $event->sheet->getDelegate()->getStyle('A1:' . $highestRowAndColumn['column'] . $highestRowAndColumn['row'])->getAlignment()->setWrapText(true);

            },
        ];
    }

}
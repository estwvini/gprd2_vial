<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Throwable;

class ReportExport implements FromView, WithEvents
{
    /**
     * @var View
     */
    private $view;

    /**
     * @var array
     */
    private $gad;

    /**
     * @var string
     */
    private $reportTitle;

    /**
     * @var int
     */
    private $rowHeight;

    /**
     * @var bool
     */
    private $autoSize;

    /**
     * @var int
     */
    private $columnWidth;

    /**
     * Constructor ReportExport.
     *
     * @param View $view
     * @param array $gad
     * @param string $reportTitle
     * @param int $rowHeight
     * @param bool $autoSize
     * @param int $columnWidth
     */
    public function __construct(View $view, array $gad, string $reportTitle, int $rowHeight = 40, bool $autoSize = false, int $columnWidth = 40)
    {
        $this->view = $view;
        $this->gad = $gad;
        $this->reportTitle = $reportTitle;
        $this->rowHeight = $rowHeight;
        $this->autoSize = $autoSize;
        $this->columnWidth = $columnWidth;
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
                $titleText = new RichText();
                $titleText->createText($this->reportTitle);
                $date = new RichText();
                $date->createText(trans('reports.labels.date') . ': ' . date('d/m/Y'));
                $gadText = new RichText();
                $gadText->createText(trans('reports.labels.gad') . ' ' . $this->gad['province']);

                // Add a rows before the first row
                $event->sheet->getDelegate()->insertNewRowBefore(1, 3);

                // Add gad text
                $event->sheet->getDelegate()->getCell('A1')->setValue($gadText);

                // Add title text
                $event->sheet->getDelegate()->getCell('A2')->setValue($titleText);

                // Add current date
                $event->sheet->getDelegate()->getCell('A3')->setValue($date);

                $highestRowAndColumn = $event->sheet->getDelegate()->getHighestRowAndColumn();

                // All headers
                $headersRange = 'A1:' . $highestRowAndColumn['column'] . '4';
                $headersStyle = [
                    'font' => [
                        'bold' => true,
                        'size' => 14,
                        'color' => ['rgb' => 'FFFFFF']
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => [
                            'rgb' => '1ABB9C'
                        ]
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER
                    ]
                ];
                $event->sheet->getDelegate()->getStyle($headersRange)->applyFromArray($headersStyle);

                $gadRowRange = 'A1:' . $highestRowAndColumn['column'] . '1';
                $gadRowStyle = [
                    'font' => [
                        'size' => 18,
                        'color' => ['rgb' => 'FFFFFF']
                    ]
                ];
                $event->sheet->getDelegate()->mergeCells($gadRowRange);
                $event->sheet->getDelegate()->getStyle($gadRowRange)->applyFromArray($gadRowStyle);

                // Set styles to title
                $titleRange = 'A2:' . $highestRowAndColumn['column'] . '2';
                $titleStyle = [
                    'font' => [
                        'size' => 18,
                        'color' => ['rgb' => 'FFFFFF']
                    ]
                ];
                $event->sheet->getDelegate()->mergeCells($titleRange);
                $event->sheet->getDelegate()->getStyle($titleRange)->applyFromArray($titleStyle);

                // Set styles to date row
                $dateRowRange = 'A3:' . $highestRowAndColumn['column'] . '3';
                $dateRowStyle = [
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_LEFT
                    ]
                ];
                $event->sheet->getDelegate()->mergeCells($dateRowRange);
                $event->sheet->getDelegate()->getStyle($dateRowRange)->applyFromArray($dateRowStyle);

                // Set all columns to specific width
                for ($i = 'A'; $i <= $highestRowAndColumn['column']; $i++) {
                    if ($this->autoSize) {
                        $event->sheet->getDelegate()->getColumnDimension($i)->setAutoSize(true);
                    } else {
                        $event->sheet->getDelegate()->getColumnDimension($i)->setWidth($this->columnWidth);
                    }
                }

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

                // Set headers rows to height 30
                $event->sheet->getDelegate()->getRowDimension(1)->setRowHeight(30);
                $event->sheet->getDelegate()->getRowDimension(2)->setRowHeight(30);
                $event->sheet->getDelegate()->getRowDimension(3)->setRowHeight(30);
                $event->sheet->getDelegate()->getRowDimension(4)->setRowHeight(30);

                // Set A5:(last cell) range to wrap text in cells
                $event->sheet->getDelegate()->getStyle('A5:' . $highestRowAndColumn['column'] . $highestRowAndColumn['row'])
                    ->getAlignment()->setWrapText(true);

                // Set A5:(last cell) range to height 40
                for ($i = 5; $i <= $highestRowAndColumn['row']; $i++) {
                    $event->sheet->getDelegate()->getRowDimension($i)->setRowHeight($this->rowHeight);
                }

                // Set A5:(last cell) range to bold false
                $event->sheet->getDelegate()->getStyle('A5:' . $highestRowAndColumn['column'] . $highestRowAndColumn['row'])->getFont()->setBold(false);
            },
        ];
    }

}
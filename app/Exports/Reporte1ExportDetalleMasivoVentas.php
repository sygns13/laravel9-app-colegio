<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class Reporte1ExportDetalleMasivoVentas implements FromArray, WithColumnWidths, WithStyles
{
    protected $data;
    protected $cont;

    public function __construct(array $data, $cont)
    {
        $this->data = $data;
        $this->cont = $cont;
    }

    public function array(): array
    {
        return $this->data;
    }

    public function columnWidths(): array
    {
        return [
            'A'=>'7',
            'B'=>'12',
            'C'=>'20',
            'D'=>'35',
            'E'=>'20',
            'F'=>'18',
            'G'=>'18',
            'H'=>'30',
            'I'=>'20',
            'J'=>'45',
            'K'=>'15',
            'L'=>'12',
            'M'=>'15',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('A1:M1');

        $styleArray = [
            'font' => [
                'bold' => true,
                'size' => 15,
                'color' => ['argb' => 'FFFFFF'],

            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => '0C73E8',
                ],
                'endColor' => [
                    'argb' => '0C73E8',
                ],
            ],
        ];

        $styleArray2 = [
            'font' => [
                'bold' => true,
                'color' => ['argb' => '000000'],

            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => 'B4B9E1',
                ],
                'endColor' => [
                    'argb' => 'B4B9E1',
                ],
            ],
        ];

        $styleArray3 = [
            'font' => [
                'color' => ['argb' => '000000'],
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ];

        $filas = count($this->data);
        $cont = $this->cont;

        $celdaTitles ='A'.strval($cont).':M'.strval($cont);


        $sheet->getStyle('A1:M1')->applyFromArray($styleArray);
        $sheet->getStyle($celdaTitles)->applyFromArray($styleArray2);


        if($filas > $cont) {
            for ($i=$cont; $i < $filas; $i++) {
                foreach (range('A', 'M') as $columna) {
                    $celda = $columna.strval((1+intval($i)));
                    $sheet->getStyle($celda)->applyFromArray($styleArray3);
                }
            }
        }
    }
}

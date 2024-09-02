<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (!function_exists('export_to_excel')) {
    function export_to_excel($filename, $header, $entities)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Define the style array for the header
        $styleArray = [
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => 'F28A8C',
                ],
            ],
        ];

        // Set header row
        $column = 'A';
        foreach ($header as $headerText) {
            $sheet->setCellValue($column . '1', $headerText);
            $sheet->getColumnDimension($column)->setAutoSize(true);
            $sheet->getStyle($column . '1')->applyFromArray($styleArray);
            $column++;
        }

        // Populate data rows
        $rowNumber = 2; // Start from the second row
        foreach ($entities as $entity) {
            $column = 'A';
            foreach ($header as $keys => $property) {
                $sheet->setCellValue($column . $rowNumber, $entity->$keys);
                $column++;
            }
            $rowNumber++;
        }

        // Write the file
        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // Clear output buffer to avoid corruption
        ob_end_clean();
        $writer->save('php://output');
        exit;
    }
}

?>
<?php

namespace App\Service;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class LogService
{
    public function writeExcel(array $logData = [])
    {
        if (!empty($logData)) {
            $spreadsheet = new Spreadsheet();
            $worksheet = $spreadsheet->getActiveSheet();

            $header = ['Action', 'Log type', 'Instance type', 'Instance', 'Description'];
            $worksheet->fromArray($header, null, 'A1');

            foreach ($logData as $rowNum => $rowData) {
                $worksheet->fromArray($rowData, null, 'A' . ($rowNum + 2));
            }

            $writer = new Xlsx($spreadsheet);
            $fileName = 'output.xlsx';
            $path = __DIR__ . '/../../files/'. $fileName;

            // Output file uniqueness without overwriting existing files
            $i = 0;
            while (file_exists($path)) {
                $i++;
                $info = pathinfo($fileName);
                $name = $info['filename'];
                $ext = isset($info['extension']) ? '.' . $info['extension'] : '';
                $path =__DIR__ . '/../../files/'. $name . '_' . $i . $ext;
            }

            $writer->save($path);
        }
    }
}

<?php

namespace App\Imports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Shared\Date; // important

class OrdersImport implements ToModel
{
    public function model(array $row)
    {
        // Skip header row
        if ($row[0] === 'order_date' || empty($row[0])) {
            return null;
        }

        return new Order([
            'order_date'     => $this->transformDate($row[0]), // convert Excel number → date
            'partnername'    => $row[1],
            'amount_total'   => $row[2],
            'invoice_status' => $row[3],
            'order_number'   => $row[4],
            'user_id'        => $row[5],
            'partner_id'     => $row[6] ?? null,
        ]);
    }

    private function transformDate($value)
    {
        try {
            // If it's an Excel serial date
            if (is_numeric($value)) {
                return Date::excelToDateTimeObject($value)->format('Y-m-d');
            }
            // If it's already a normal date (string)
            return date('Y-m-d', strtotime($value));
        } catch (\Exception $e) {
            return null;
        }
    }
}

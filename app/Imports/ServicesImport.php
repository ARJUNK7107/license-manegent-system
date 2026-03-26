<?php

namespace App\Imports;

use App\Models\Service;
use Maatwebsite\Excel\Concerns\ToModel;

class ServicesImport implements ToModel
{
    public function model(array $row)
    {
        // Skip header row
        if ($row[0] === 'name') {
            return null;
        }

        return new Service([
            'name'             => $row[0],
            'description'      => $row[1],
            'default_price'    => $row[2],
            'service_type'     => $row[3],
            'service_category' => $row[4],
            'document_list'    => $row[5],
        ]);
    }
}
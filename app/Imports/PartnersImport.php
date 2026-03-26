<?php

namespace App\Imports;

use App\Models\Partner;
use Maatwebsite\Excel\Concerns\ToModel;

class PartnersImport implements ToModel
{
    public function model(array $row)
    {
       
        if ($row[0] === 'name') {
            return null;
        }

        return new Partner([
            'name'       => $row[0],
            'company_id' => $row[1],
            'comment'    => $row[2],
            'address'    => $row[3],
            'city'       => $row[4],
            'state'      => $row[5],
            'country'    => $row[6],
            'zip'        => $row[7],
            'title'      => $row[8],
            'email'      => $row[9],
            'phone'      => $row[10],
            'tax_code'   => $row[11],
            'party_type' => $row[12],
        ]);
    }
}


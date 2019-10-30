<?php

namespace App\Imports;

use App\Training;
use Maatwebsite\Excel\Concerns\ToModel;

class TrainingImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Training([
            'name' => $row[0],
            'pH' => round($row[1], 1), 
            'turbidity' => round($row[2], 1), 
            'temperature' => round($row[3], 1), 
            'classes' => round($row[4], 1)
        ]);
    }
}

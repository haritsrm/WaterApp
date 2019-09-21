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
            'pH' => $row[1], 
            'temperature' => $row[2], 
            'turbidity' => $row[3], 
            'classes' => $row[4]
        ]);
    }
}

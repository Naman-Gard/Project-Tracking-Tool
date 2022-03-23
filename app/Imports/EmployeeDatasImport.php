<?php

namespace App\Imports;

use App\Models\EmployeeDatas;
use Maatwebsite\Excel\Concerns\ToModel;

class EmployeeDatasImport implements ToModel
{
    public function startRow(): int
    {
        return 2;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new EmployeeDatas([
            'employee_id'=>$row[0],
            'name'=>$row[1],
            'designation'=>$row[2],
            'department'=>$row[3],
            'email_id'=>$row[4],
            'date_of_joining'=>$row[5],
            'reporting_to'=>$row[6]
        ]);
    }
}

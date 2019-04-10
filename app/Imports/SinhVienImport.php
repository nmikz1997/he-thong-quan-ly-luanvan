<?php

namespace App\Imports;

use App\SinhVien;
use App\NienKhoa;
use Maatwebsite\Excel\Concerns\ToModel;

class SinhVienImport implements ToModel
{
    
    public function model(array $row)
    {
        $lastNK = NienKhoa::max('id');
        return new SinhVien([
            'id'            => $row[0],
            'ten'           => $row[1], 
            'gioitinh'      => $row[2] == 'Nam' ? '1' : '0',
            'khoa'          => $row[3],
            'email'         => $row[4],
            'SDT'           => $row[5],
            //'password'      => md5($row[6]),
            'nienkhoa_id'   => $lastNK,
            'bomon_id'      => $row[7]
        ]);
    }
}

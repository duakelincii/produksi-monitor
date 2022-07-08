<?php

namespace App\Imports;

use App\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements ToCollection,WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row)
        {
            Product::updateOrCreate([
                'nama_bahan' => $row['nama_bahan'],
                'nama_product' => $row['nama_product'],
            ],[
                'stock' => $row['stock'],
                'harga_beli' => $row['harga_beli'],
                'harga_jual' => $row['harga_jual'],
            ]);
        }
    }
}

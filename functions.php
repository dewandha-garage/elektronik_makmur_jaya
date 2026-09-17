<?php

function hitungTotalNilaiStok($products)
{
    $total = 0;

    foreach ($products as $product) {
        $total += $product["harga"] * $product["stok"];
    }

    return $total;
}


function statusStok($stok)
{
    if ($stok == 0) {
        return "habis";
    } elseif ($stok < 3) {
        return "kritis";
    } else {
        return "aman";
    }
}


function namaStatusStok($stok)
{
    if ($stok == 0) {
        return "Stok Habis";
    } elseif ($stok < 3) {
        return "Stok Kritis";
    } else {
        return "Stok Aman";
    }
}

?>
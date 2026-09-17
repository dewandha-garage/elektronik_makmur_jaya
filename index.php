<?php

require_once "products.php";
require_once "functions.php";

$totalNilaiStok = hitungTotalNilaiStok($products);

$totalProduk = count($products);

$stokAman = 0;
$stokKritis = 0;
$stokHabis = 0;

foreach ($products as $product) {

    if ($product["stok"] == 0) {
        $stokHabis++;
    } elseif ($product["stok"] < 3) {
        $stokKritis++;
    } else {
        $stokAman++;
    }

}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Elektronik Makmur Jaya</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #eef3f8;
            color: #1f2937;
        }

        /* HEADER */

        .header {
            background: linear-gradient(135deg, #075985, #1687bd);
            color: white;
            padding: 32px 50px;
        }

        .header h1 {
            margin: 0;
            font-size: 30px;
        }

        .header p {
            margin: 8px 0 0;
            font-size: 15px;
            opacity: 0.9;
        }

        /* CONTAINER */

        .container {
            max-width: 1400px;
            margin: 30px auto;
            padding: 0 30px;
        }

        /* STATISTIK */

        .stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
            margin-bottom: 25px;
        }

        .card {
            background: white;
            padding: 22px;
            border-radius: 14px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.07);
            border: 1px solid #e5e7eb;
        }

        .card-title {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 10px;
        }

        .card-number {
            font-size: 28px;
            font-weight: bold;
            color: #1674a8;
        }

        .green {
            color: #16a34a;
        }

        .yellow {
            color: #d97706;
        }

        .red {
            color: #dc2626;
        }

        /* TABLE BOX */

        .table-box {
            background: white;
            padding: 25px;
            border-radius: 14px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.07);
        }

        .table-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .table-top h2 {
            margin: 0;
            font-size: 21px;
        }

        .search {
            padding: 11px 15px;
            width: 260px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            outline: none;
        }

        .search:focus {
            border-color: #1674a8;
        }

        /* TABLE */

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #1674a8;
            color: white;
            padding: 14px;
            text-align: left;
            font-size: 14px;
        }

        td {
            padding: 14px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 14px;
        }

        tr:hover {
            background: #f8fafc;
        }

        /* STOK KRITIS */

        tr.kritis {
            background: #fff8e1;
        }

        tr.kritis:hover {
            background: #ffefb5;
        }

        /* STOK HABIS */

        tr.habis {
            background: #fff1f2;
        }

        tr.habis:hover {
            background: #ffe4e6;
        }

        /* BADGE */

        .badge {
            display: inline-block;
            padding: 6px 11px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        /* KATEGORI */

        .elektronik {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .aksesoris {
            background: #ede9fe;
            color: #6d28d9;
        }

        /* STATUS */

        .status-aman {
            background: #dcfce7;
            color: #15803d;
        }

        .status-kritis {
            background: #fef3c7;
            color: #b45309;
        }

        .status-habis {
            background: #fee2e2;
            color: #dc2626;
        }

        /* TOTAL */

        .total {
            margin-top: 20px;
            padding: 18px;
            background: #eff6ff;
            border-left: 5px solid #1674a8;
            border-radius: 8px;
            font-size: 17px;
            font-weight: bold;
            color: #155a85;
        }

        /* LEGEND */

        .legend {
            display: flex;
            gap: 20px;
            margin-top: 20px;
            align-items: center;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 7px;
            font-size: 13px;
            color: #6b7280;
        }

        .dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
        }

        .dot-green {
            background: #16a34a;
        }

        .dot-yellow {
            background: #d97706;
        }

        .dot-red {
            background: #dc2626;
        }

        /* BUTTON */

        .buttons {
            margin-top: 20px;
            display: flex;
            gap: 10px;
        }

        button {
            border: none;
            padding: 11px 18px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
        }

        .btn-refresh {
            background: #1674a8;
            color: white;
        }

        .btn-info {
            background: #e5e7eb;
            color: #374151;
        }

        button:hover {
            opacity: 0.85;
        }

        /* FOOTER */

        footer {
            text-align: center;
            color: #9ca3af;
            padding: 25px;
            font-size: 13px;
        }

        /* RESPONSIVE */

        @media (max-width: 900px) {

            .stats {
                grid-template-columns: repeat(2, 1fr);
            }

            .table-box {
                overflow-x: auto;
            }

        }

        @media (max-width: 600px) {

            .stats {
                grid-template-columns: 1fr;
            }

            .table-top {
                flex-direction: column;
                align-items: stretch;
                gap: 15px;
            }

            .search {
                width: 100%;
            }

            .header {
                padding: 25px;
            }

            .container {
                padding: 0 15px;
            }

        }

    </style>

</head>

<body>

    <!-- HEADER -->

    <div class="header">

        <h1>Elektronik Makmur Jaya</h1>

        <p>
            Dashboard informasi produk dan manajemen persediaan
        </p>

    </div>


    <div class="container">

        <!-- STATISTIK -->

        <div class="stats">

            <div class="card">

                <div class="card-title">
                    Total Produk
                </div>

                <div class="card-number">
                    <?= $totalProduk ?>
                </div>

            </div>


            <div class="card">

                <div class="card-title">
                    Stok Aman
                </div>

                <div class="card-number green">
                    <?= $stokAman ?>
                </div>

            </div>


            <div class="card">

                <div class="card-title">
                    Stok Kritis
                </div>

                <div class="card-number yellow">
                    <?= $stokKritis ?>
                </div>

            </div>


            <div class="card">

                <div class="card-title">
                    Stok Habis
                </div>

                <div class="card-number red">
                    <?= $stokHabis ?>
                </div>

            </div>

        </div>


        <!-- DAFTAR PRODUK -->

        <div class="table-box">

            <div class="table-top">

                <h2>Daftar Produk</h2>

                <input
                    type="text"
                    id="search"
                    class="search"
                    placeholder="Cari produk..."
                    onkeyup="cariProduk()"
                >

            </div>


            <table id="productTable">

                <tr>

                    <th>ID</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Deskripsi</th>
                    <th>Status</th>

                </tr>


                <?php foreach ($products as $product): ?>

                    <?php

                    $status = statusStok($product["stok"]);

                    $namaStatus = namaStatusStok($product["stok"]);

                    if ($status == "aman") {

                        $rowClass = "";
                        $statusClass = "status-aman";

                    } elseif ($status == "kritis") {

                        $rowClass = "kritis";
                        $statusClass = "status-kritis";

                    } else {

                        $rowClass = "habis";
                        $statusClass = "status-habis";

                    }


                    if ($product["kategori"] == "Elektronik") {

                        $kategoriClass = "elektronik";

                    } else {

                        $kategoriClass = "aksesoris";

                    }

                    ?>


                    <tr class="<?= $rowClass ?>">

                        <td>
                            <?= $product["id"] ?>
                        </td>


                        <td>
                            <strong>
                                <?= $product["nama"] ?>
                            </strong>
                        </td>


                        <td>

                            <span class="badge <?= $kategoriClass ?>">
                                <?= $product["kategori"] ?>
                            </span>

                        </td>


                        <td>

                            Rp <?= number_format(
                                $product["harga"],
                                0,
                                ",",
                                "."
                            ) ?>

                        </td>


                        <td>

                            <strong>
                                <?= $product["stok"] ?>
                            </strong>

                        </td>


                        <td>
                            <?= $product["deskripsi"] ?>
                        </td>


                        <td>

                            <span class="badge <?= $statusClass ?>">
                                <?= $namaStatus ?>
                            </span>

                        </td>

                    </tr>


                <?php endforeach; ?>

            </table>


            <!-- TOTAL NILAI STOK -->

            <div class="total">

                Total Nilai Stok:

                Rp <?= number_format(
                    $totalNilaiStok,
                    0,
                    ",",
                    "."
                ) ?>

            </div>


            <!-- KETERANGAN STATUS -->

            <div class="legend">

                <div class="legend-item">

                    <span class="dot dot-green"></span>

                    Stok Aman (≥ 3)

                </div>


                <div class="legend-item">

                    <span class="dot dot-yellow"></span>

                    Stok Kritis (1–2)

                </div>


                <div class="legend-item">

                    <span class="dot dot-red"></span>

                    Stok Habis (0)

                </div>

            </div>


            <!-- BUTTON -->

            <div class="buttons">

                <button
                    class="btn-refresh"
                    onclick="location.reload()"
                >
                    ↻ Refresh Data
                </button>


                <button
                    class="btn-info"
                    onclick="alert('Elektronik Makmur Jaya - Sistem Informasi Produk')"
                >
                    ℹ Informasi Sistem
                </button>

            </div>

        </div>

    </div>


    <footer>

        Elektronik Makmur Jaya © 2026

    </footer>


    <!-- SEARCH -->

    <script>

        function cariProduk() {

            let input =
                document.getElementById("search");

            let filter =
                input.value.toLowerCase();

            let table =
                document.getElementById("productTable");

            let rows =
                table.getElementsByTagName("tr");


            for (let i = 1; i < rows.length; i++) {

                let text =
                    rows[i].innerText.toLowerCase();


                if (text.includes(filter)) {

                    rows[i].style.display = "";

                } else {

                    rows[i].style.display = "none";

                }

            }

        }

    </script>

</body>

</html>
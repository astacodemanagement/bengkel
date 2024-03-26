<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-size: 16px;
        }

        h1 {
            text-align: center;
            text-decoration: underline;
            font-size: 26px;
        }

        .table {
            margin-top: 32px;
            border-collapse: collapse;
        }

        .table th,
        td {
            border: 1px solid #000;
            padding: 7px 9px;
        }
    </style>
</head>

<body>
    <h1><?= strtoupper("laporan salary "); ?></h1>
    <div style="text-align:center"><?= $subtitle; ?></div>

    <table width="100%" class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Mekanik</th>
                <th>Tanggal</th>
                <th>Kode</th>
                <th>Jenis Mobil</th>
                <th>Total</th>
                <th>Hasil Bagi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            $totalBagiHasil = 0;
            foreach ($fetch as $row) :
                $i++;

                $hasilBagi = ($row->mechanic_cost * 20)/100;
                $totalBagiHasil += $hasilBagi;
            ?>

                <tr>
                    <td style="text-align:center"><?= $i; ?></td>
                    <td style="text-align:center"><?= $row->mechanic_name; ?></td>
                    <td style="text-align:center"><?= $row->date; ?></td>
                    <td style="text-align:center"><?= $row->code; ?></td>
                    <td style="text-align:center"><?= $row->car_type; ?></td>
                    <td style="text-align:center"><?= rupiah($row->total); ?></td>
                    <td style="text-align:center"><?= rupiah($hasilBagi); ?></td>
                </tr>

            <?php endforeach ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6">Total</td>
                <td style="text-align:center"><?= rupiah($totalBagiHasil); ?></td>
            </tr>
        </tfoot>
    </table>
</body>

</html>
<?php
function rupiah($angka)
{

    $hasil_rupiah = "Rp " . number_format($angka);
    return $hasil_rupiah;
}

function reformat_date($date)
{
    $date = strtotime($date);
    return date("d-m-Y", $date);
}

function math($ma)
{
    if (preg_match('/(\d+)(?:\s*)([\+\-\*\/])(?:\s*)(\d+)/', $ma, $matches) !== FALSE) {
        $operator = $matches[2];

        switch ($operator) {
            case '+':
                $p = $matches[1] + $matches[3];
                break;
            case '-':
                $p = $matches[1] - $matches[3];
                break;
            case '*':
                $p = $matches[1] * $matches[3];
                break;
            case '/':
                $p = $matches[1] / $matches[3];
                break;
        }

        return rupiah($p);
    }
}

function showSparepartImageTable($image)
{
    $sparePartImage = '';

    if ($image != null) {
        $filepath = 'uploads/sparepart/' . $image;

        if (file_exists($filepath)) {
            $sparePartImage = '<div class="text-center"><a href="' . $filepath . '" target="_blank"><img src="' . $filepath . '" style="object-fit:cover;object-position:center;width:50px;height:50px"/></a></div>';
        }
    }

    return $sparePartImage;
}

function showSparepartImage($image)
{
    $sparePartImage = '';

    if ($image != null) {
        $filepath = 'uploads/sparepart/' . $image;

        if (file_exists($filepath)) {
            $sparePartImage = $filepath;
        }
    }

    return $sparePartImage;
}

function bengkelLogo()
{
    $CI = &get_instance();
    $shopInfo = $CI->db->order_by('id', 'asc')->get('shop_info')->row();

    return $shopInfo ? base_url('uploads/images/' . $shopInfo->image) : base_url('img/1.png');
}

function bengkelLogoBase64()
{
    $path = bengkelLogo();

    $info = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $base64 = 'data:image/' . $info . ';base64,' . base64_encode($data);

    return $base64;
}

function statusAbsen($status)
{
    if ($status == 'MASUK') {
        return '<b class="text-success">MASUK</b>';
    } else {
        return '<b class="text-danger">TERLAMBAT</b>';
    }
}

function waktuAbsen($waktu)
{
    return date('H:i', strtotime($waktu));
}

function bagiHasilMekanik($cost)
{
    $bagiHasil = ($cost * 20)/100;
    return "Rp " . number_format($bagiHasil);
}

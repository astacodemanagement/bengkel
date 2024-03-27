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

function hitungUmur($tanggalLahir)
{
    if ($tanggalLahir != null | $tanggalLahir != '') {
        $tanggalLahir = new DateTime($tanggalLahir);
        $hariIni = new DateTime("today");
        
        if ($tanggalLahir > $hariIni) { 
            $thn = "0";
            $bln = "0";
            $tgl = "0";
        }

        $thn = $hariIni->diff($tanggalLahir)->y;

        return $thn ." Tahun ";
    }

    return '';
}

function user()
{
    $CI = &get_instance();

    return $CI->db->get_where('users', ['id' => $CI->session->userdata('auth')['id']])->row();
}

function userRole()
{
    return user() ? user()->level : null;
}

function isSuperadmin()
{
    return userRole() == 'Superadmin' ? true : false;
}

function isAdmin()
{
    return userRole() == 'Admin' ? true : false;
}

function isKasir()
{
    return userRole() == 'Kasir' ? true : false;
}

function userRoleInitial()
{
    if (isSuperadmin()) {
        return 's';
    }
    if (isAdmin()) {
        return 'a';
    }
    if (isKasir()) {
        return 'k';
    }
}

function hasPermission($menu, $action)
{
    $userRole = userRoleInitial();

    return $userRole != 's' ? in_array($userRole, roleMenu()[$menu][$action]) ? true : false : true;
}

function roleMenu()
{
    /**
     * a = Admin
     * k = Kasir
     * Super admin semua role menu
     */
    return [
        'karyawan' => [
            'index' => ['a', 'k'],
            'add' => ['a', 'k'],
            'edit' => [],
            'delete' => [],
            'detail' => [],
            'search' => []
        ],
        'supplier' => [
            'index' => ['a'],
            'add' => ['a'],
            'edit' => ['a'],
            'delete' => ['a'],
            'detail' => ['a'],
            'search' => ['a', 'k']
        ],
        'konsumen' => [
            'index' => ['a', 'k'],
            'add' => ['a', 'k'],
            'edit' => [],
            'delete' => [],
            'detail' => ['a', 'k'],
            'search' => []
        ],
        'sparepart' => [
            'index' => ['a'],
            'add' => ['a'],
            'edit' => [],
            'delete' => [],
            'detail' => [],
            'search' => ['a', 'k']
        ],
        'jasa' => [
            'index' => ['a', 'k'],
            'add' => ['a', 'k'],
            'edit' => [],
            'delete' => [],
            'detail' => ['a', 'k'],
            'search' => ['a', 'k']
        ],
        'pembelian stok' => [
            'index' => ['a'],
            'add' => ['a'],
            'edit' => ['a'],
            'delete' => ['a'],
            'detail' => ['a'],
            'search' => ['a']
        ],
        'estimasi biaya' => [
            'index' => ['a', 'k'],
            'add' => ['a', 'k'],
            'edit' => ['a', 'k'],
            'delete' => ['a', 'k'],
            'detail' => ['a', 'k'],
            'search' => ['a', 'k']
        ],
        'transaksi' => [
            'index' => ['k'],
            'add' => ['k'],
            'edit' => ['k'],
            'delete' => ['k'],
            'detail' => ['k'],
            'search' => ['k']
        ],
        'history jual sparepart' => [
            'index' => ['a', 'k'],
            'add' => ['a', 'k'],
            'edit' => ['a', 'k'],
            'delete' => ['a', 'k'],
            'detail' => ['a', 'k'],
            'search' => ['a', 'k']
        ],
        'history service' => [
            'index' => ['a', 'k'],
            'add' => ['a', 'k'],
            'edit' => ['a', 'k'],
            'delete' => ['a', 'k'],
            'detail' => ['a', 'k'],
            'search' => ['a', 'k']
        ],
        'absensi' => [
            'index' => ['k'],
            'add' => ['k'],
            'edit' => ['k'],
            'delete' => ['k'],
            'detail' => ['k'],
            'search' => ['k']
        ],
        'laporan salary' => [
            'index' => ['k'],
            'add' => ['k'],
            'edit' => ['k'],
            'delete' => ['k'],
            'detail' => ['k'],
            'search' => ['k']
        ],
        'laporan penjualan' => [
            'index' => [],
            'add' => [],
            'edit' => [],
            'delete' => [],
            'detail' => [],
            'search' => []
        ],
        'laporan service' => [
            'index' => [],
            'add' => [],
            'edit' => [],
            'delete' => [],
            'detail' => [],
            'search' => []
        ],
        'laporan pembelian' => [
            'index' => ['a'],
            'add' => ['a'],
            'edit' => ['a'],
            'delete' => ['a'],
            'detail' => ['a'],
            'search' => ['a']
        ],
        'pengaturan umum' => [
            'index' => [],
            'add' => [],
            'edit' => [],
            'delete' => [],
            'detail' => [],
            'search' => []
        ]
    ];
}
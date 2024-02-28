<?php
function rupiah($angka){
	
    $hasil_rupiah = "Rp " . number_format($angka);
    return $hasil_rupiah;
} 

function reformat_date($date) {
    $date = strtotime($date);
    return date("d-m-Y",$date);
}


function math($ma) {
    if(preg_match('/(\d+)(?:\s*)([\+\-\*\/])(?:\s*)(\d+)/', $ma, $matches) !== FALSE){
        $operator = $matches[2];

        switch($operator){
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

function showSparepartImageTable($image) {
    $sparePartImage = '';

    if ($image != null) {
        $filepath = 'uploads/sparepart/'.$image;

        if (file_exists($filepath)) {
            $sparePartImage = '<div class="text-center"><a href="'.$filepath.'" target="_blank"><img src="'.$filepath.'" style="object-fit:cover;object-position:center;width:50px;height:50px"/></a></div>';
        }
    }

    return $sparePartImage;
}

function showSparepartImage($image) {
    $sparePartImage = '';

    if ($image != null) {
        $filepath = 'uploads/sparepart/'.$image;

        if (file_exists($filepath)) {
            $sparePartImage = $filepath;
        }
    }

    return $sparePartImage;
}
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css" integrity="sha512-34s5cpvaNG3BknEWSuOncX28vz97bRI59UnVtEEpFX536A7BtZSJHsDyFoCl8S7Dt2TPzcrCEoHBGeM4SUBDBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Dashboard</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li class="active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content mt-3">
    <div class="row">
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-success">
                <div class="card-body pb-0">
                    <div class="float-right">
                        <i class="fa fa-dollar"></i>
                    </div>
                    <h4 class="mb-0">
                        <span class="count"><?= rupiah($today_income); ?></span>
                    </h4>
                    <p class="text-light">Pendapatan Hari Ini</p>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-info">
                <div class="card-body pb-0">
                    <div class="float-right">
                        <i class="fa fa-cogs"></i>
                    </div>
                    <h4 class="mb-0">
                        <span class="count"><?= $today_service; ?></span>
                    </h4>
                    <p class="text-light">Service Selesai Hari Ini</p>
                </div>
            </div>
        </div>
        
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-warning">
                <div class="card-body pb-0">
                    <div class="float-right">
                        <i class="fa fa-share"></i>
                    </div>
                    <h4 class="mb-0">
                        <span class="count"><?= $today_items_sold; ?></span>
                    </h4>
                    <p class="text-light">Item Terjual Hari Ini</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-danger">
                <div class="card-body pb-0">
                    <div class="float-right">
                        <i class="fa fa-warning"></i>
                    </div>
                    <h4 class="mb-0">
                        <span class="count"><?= $items_sold_out; ?></span>
                    </h4>
                    <p class="text-light">Stock Telah Habis</p>
                </div>
            </div>
        </div>
    </div>
    <div class="form-inline">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                </div>
                <input type="text" class="form-control start-monthrange">
                <input type="hidden" class="form-control filter-start-month" value="<?= date('Y-m-d') ?>">
            </div>
        </div>
        <div class="form-group mx-sm-3">
            -
        </div>
        <div class="form-group mr-sm-3">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                </div>
                <input type="text" class="form-control end-monthrange">
                <input type="hidden" class="form-control filter-end-month" value="<?= date('Y-m-d') ?>">
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-filter"><i class="fa fa-filter"></i> Filter</button>
    </div>
    <div class="row">
        <div class="col-6 mt-4">
            <div class="card h-100">
                <div class="card-header">
                    Pendapatan Hari Ini
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table pendapatan-hari-ini-datatable w-100">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Transaksi</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 mt-4">
            <div class="card h-100">
                <div class="card-header">
                    Service Selesai
                </div>
                <div class="card-body">
                    <table class="table servis-selesai-datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Kode Tarnsaksi</th>
                                <th>Servis</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-6 mt-4">
            <div class="card h-100">
                <div class="card-header">
                    Item Terjual
                </div>
                <div class="card-body">
                    <table class="table item-terjual-datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama Produk</th>
                                <th>Jumlah Terjual</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-6 mt-4">
            <div class="card h-100">
                <div class="card-header">
                    Item Terlaris
                </div>
                <div class="card-body">
                    <table class="table item-terlaris-datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama Produk</th>
                                <th>Jumlah Terjual</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

        <?php if (isSuperadmin() | isAdmin()): ?>
            <div class="col-6 mt-4">
                <div class="card h-100">
                    <div class="card-header">
                        Stock Menipis
                    </div>
                    <div class="card-body">
                        <table class="table stok-menipis-datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Nama Produk</th>
                                    <th>Stok</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        <?php endif ?>

        <div class="col-6 mt-4">
            <div class="card h-100">
                <div class="card-header">
                    Stock Habis
                </div>
                <div class="card-body">
                    <table class="table stok-habis-datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama Produk</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-6 mt-4">
            <div class="card h-100">
                <div class="card-header">
                    Konsumen Ulang Tahun
                </div>
                <div class="card-body">
                    <table class="table konsumen-ultah-datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama Konsumen</th>
                                <th>Tanggal Lahir</th>
                                <th>Ulang Tahun Ke</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-6 mt-4">
            <div class="card h-100">
                <div class="card-header">
                    Pegawai Absen
                </div>
                <div class="card-body">
                    <table class="table absensi-datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pegawai</th>
                                <th>Tanggal</th>
                                <th>Waktu Absen</th>
                                <th>Status Absen</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        
        <?php if (isSuperadmin()): ?>
            <div class="col-6 mt-4">
                <div class="card h-100">
                    <div class="card-header">
                        Income
                    </div>
                    <div class="card-body">
                        <table class="table income-datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Transaksi</th>
                                    <th>Nama Konsumen</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        <?php endif ?>
    </div>
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Grafik Jasa Service
                </div>
                <div class="card-body">
                    <canvas id="myChart1" width="400" height="100"></canvas>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Grafik Penjualan Sparepart
                </div>
                <div class="card-body">
                    <canvas id="myChart2" width="400" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Grafik Income
                </div>
                <div class="card-body">
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Grafik Revenue
                </div>
                <div class="card-body">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="compose-stok" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="largeModalLabel">Tambah Sparepart</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="compose-form" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Kode Sparepart</label>
                        <input type="text" name="kode" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Nama Sparepart</label>
                        <input type="text" name="name" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Harga Beli Sparepart</label>
                        <input type="number" name="price" class="form-control" id="price" value="0">
                    </div>
                    <div class="form-group">
                        <label>Harga Sparepart 1</label>
                        <input type="number" name="price1" class="form-control" id="price1" value="0">
                    </div>
                    <div class="form-group">
                        <label>Harga Sparepart 2</label>
                        <input type="number" name="price2" class="form-control" id="price2" value="0">
                    </div>
                    <div class="form-group">
                        <label>Harga Sparepart 3</label>
                        <input type="number" name="price3" class="form-control" id="price3" value="0">
                    </div>
                    <div class="form-group">
                        <label>Lokasi</label>
                        <input type="text" name="location" id="location" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="description" id="description" cols="30" rows="2" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Gambar</label>
                        <input type="file" name="gambar" class="form-control dropify" id="gambar">
                    </div>
                    <div class="image-preview"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal" style="border-radius: 1rem;"><i class="fa fa-undo"></i> Cancel</button>
                <button type="button" class="btn btn-primary btn-submit" style="border-radius: 1rem;"><i class="fa fa-save"></i> Simpan</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js" integrity="sha512-LsnSViqQyaXpD4mBBdRYeP6sRwJiJveh2ZIbW41EBrNmKxgr/LFZIiWT6yr+nycvhvauz8c2nYMhrP80YhG7Cw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $('.start-monthrange').datepicker({
        format: "MM yyyy",
        startView: "months", 
        minViewMode: "months",
        setDate: new Date(),
        autoclose: true
    }).on('changeDate', function (e) {
        $('.filter-start-month').val(e.format(0,"yyyy-mm-dd"))
    }).datepicker("setDate",'now')

    $('.end-monthrange').datepicker({
        format: "MM yyyy",
        startView: "months", 
        minViewMode: "months",
        setDate: new Date(),
        autoclose: true
    }).on('changeDate', function (e) {
        $('.filter-end-month').val(e.format(0,"yyyy-mm-dd"))
    }).datepicker("setDate",'now')

    var ctx1 = document.getElementById('myChart1').getContext('2d');
    var ctx2 = document.getElementById('myChart2').getContext('2d');
    var myChart1 = new Chart(ctx1, {
        type: 'line',
        data: {
            labels: [<?= implode(",", $title); ?>],
            datasets: [{
                label: 'Service',
                data: [<?= implode(",", $valueService); ?>],
                backgroundColor: "rgba(255, 99, 132, 0.2)",
                borderColor: "rgba(255, 99, 132, 1)",
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
    var myChart2 = new Chart(ctx2, {
        type: 'line',
        data: {
            labels: [<?= implode(",", $title); ?>],
            datasets: [{
                label: 'Sparepart',
                data: [<?= implode(",", $valueSparepart); ?>],
                backgroundColor: "rgba(99, 255, 132, 0.2)",
                borderColor: "rgba(99, 255, 132, 1)",
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    let pendapatanDatatable = $(".pendapatan-hari-ini-datatable").DataTable({
        "processing": true,
        "serverSide": true,
        "autoWidth": true,
        "order": [],
        "ajax": {
            "async": false,
            "url": "<?= base_url("dashboard/datatable_pendapatan_hari_ini"); ?>",
        }
    })

    let absensiDatatable = $(".absensi-datatable").DataTable({
        "processing": true,
        "serverSide": true,
        "autoWidth": true,
        "order": [],
        "ajax": {
            "async": false,
            "url": "<?= base_url("dashboard/datatable_pegawai_absen"); ?>",
            "data": function (d) {
                d.start_month = $('.filter-start-month').val()
                d.end_month = $('.filter-end-month').val()
            }
        }
    })
    
    let incomeDatatable = $(".income-datatable").DataTable({
        "processing": true,
        "serverSide": true,
        "autoWidth": true,
        "order": [],
        "ajax": {
            "async": false,
            "url": "<?= base_url("dashboard/datatable_income"); ?>",
        }
    })
    
    let stokMenipisDatatable = $(".stok-menipis-datatable").DataTable({
        "processing": true,
        "serverSide": true,
        "autoWidth": true,
        "order": [],
        "ajax": {
            "async": false,
            "url": "<?= base_url("dashboard/datatable_stok_menipis"); ?>",
        }
    })
    
    let konsumentUltahDatatable = $(".konsumen-ultah-datatable").DataTable({
        "processing": true,
        "serverSide": true,
        "autoWidth": true,
        "order": [],
        "ajax": {
            "async": false,
            "url": "<?= base_url("dashboard/datatable_konsumen_ultah"); ?>",
            "data": function (d) {
                d.start_month = $('.filter-start-month').val()
                d.end_month = $('.filter-end-month').val()
            }
        }
    })
    
    let serviceSelesaiDatatable = $(".servis-selesai-datatable").DataTable({
        "processing": true,
        "serverSide": true,
        "autoWidth": true,
        "order": [],
        "ajax": {
            "async": false,
            "url": "<?= base_url("dashboard/datatable_servis_selesai"); ?>",
            "data": function (d) {
                d.start_month = $('.filter-start-month').val()
                d.end_month = $('.filter-end-month').val()
            }
        }
    })
    
    let itemTerjualDatatable = $(".item-terjual-datatable").DataTable({
        "processing": true,
        "serverSide": true,
        "autoWidth": true,
        "order": [],
        "ajax": {
            "async": false,
            "url": "<?= base_url("dashboard/datatable_item_terjual"); ?>",
        }
    })
    
    let itemTerlarisDatatable = $(".item-terlaris-datatable").DataTable({
        "processing": true,
        "serverSide": true,
        "autoWidth": true,
        "order": [
            [3, 'desc'],
        ],
        "ajax": {
            "async": false,
            "url": "<?= base_url("dashboard/datatable_item_terjual"); ?>",
        }
    })
    
    let stockHabisDatatable = $(".stok-habis-datatable").DataTable({
        "processing": true,
        "serverSide": true,
        "autoWidth": true,
        "order": [],
        "ajax": {
            "async": false,
            "url": "<?= base_url("dashboard/datatable_stok_habis"); ?>",
        }
    })

    $('.btn-filter').on('click', function(){
        absensiDatatable.ajax.reload()
        incomeDatatable.ajax.reload()
        konsumentUltahDatatable.ajax.reload()
        serviceSelesaiDatatable.ajax.reload()
        itemTerjualDatatable.ajax.reload()
    })

    $("body").on("click", ".btn-detail", function() {
        var id = jQuery(this).attr("data-id");
        var name = jQuery(this).attr("data-name");
        var kode = jQuery(this).attr("data-kode");
        var price = jQuery(this).attr("data-price");
        var price1 = jQuery(this).attr("data-price1");
        var price2 = jQuery(this).attr("data-price2");
        var price3 = jQuery(this).attr("data-price3");
        var location = jQuery(this).attr("data-location");
        var description = jQuery(this).attr("data-description");
        var gambar = jQuery(this).attr("data-gambar");
        var showGambar = '';

        if (gambar != '') {
            showGambar = `<img src="${gambar}" style="height:240px" />`
        }

        jQuery("#compose .modal-title").html("Detail Sparepart");
        jQuery("#compose-form").find('input, select, textarea').prop('disabled', true).addClass('bg-white')
        jQuery("input[name=kode]").val(kode);
        jQuery("input[name=name]").val(name);
        jQuery("input[name=price]").val(price);
        jQuery("input[name=price1]").val(price1);
        jQuery("input[name=price2]").val(price2);
        jQuery("input[name=price3]").val(price3);
        jQuery("input[name=location]").val(location);
        jQuery("textarea[name=description]").val(description);
        jQuery(".image-preview").html(showGambar);

        jQuery("#compose-stok").find('.btn-submit').addClass('d-none')
        jQuery("#compose-stok").modal("toggle");
    });
</script>
        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Absensi</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
                            <li class="active">Absensi</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-3">
                            <select id="selectedUser" name="user" class="form-control select2 user" style="width:100%">
                                <option value="">PILIH KARYAWAN</option>
                            </select>
                        </div>
                        <div class="col-md-2 pt-1">
                            <button type="button" class="btn btn-sm btn-success w-100 btn-check-in" style="border-radius: 1rem;">CHECK IN</button>
                        </div>
                        <div class="col-md-2 pt-1">
                            <button type="button" class="btn btn-sm btn-primary w-100 btn-view" style="border-radius: 1rem;">VIEW</button>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-7">
                            <textarea name="keterangan" id="keterangan" class="form-control keterangan" placeholder="Keterangan"></textarea>
                        </div>
                        <input type="hidden" class="d-none action" value="show">
                        <input type="hidden" class="d-none user-name">
                    </div>
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="form-inline">
                                <input type="date" class="form-control start-date">
                                <span class="mx-2">-</span>
                                <input type="date" class="form-control end-date">
                                <button class="btn btn-danger btn-sm ml-3 btn-pdf" style="border-radius: 1rem;">EXPORT PDF</button>
                                <button class="btn btn-success btn-sm ml-3 btn-excel" style="border-radius: 1rem;">EXPORT EXCEL</button>
                                <label for="" class="ml-3">Bonus Absen</label>
                                <input type="number" class="form-control ml-3 bonus-absen">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="data" style="width:100%">
                            <thead>
                                <tr>
                                    <th width="2%" class="text-center">No</th>
                                    <th width="23%" class="text-center">TANGGAL</th>
                                    <th width="25%" class="text-center">WAKTU</th>
                                    <th width="25%" class="text-center">STATUS</th>
                                    <th width="25%" class="text-center">KETERANGAN</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th class="text-center">JUMLAH MASUK</th>
                                    <th class="text-jumlah-masuk text-center">0</th>
                                    <th class="text-bonus-absen text-center">0</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
        <script>
            $(document).ready(function() {
                let datatable = $("#data").DataTable({
                    "processing": true,
                    "serverSide": true,
                    "autoWidth": true,
                    "order": [],
                    "ajax": {
                        "async": false,
                        "url": "<?= base_url("absensi/json"); ?>",
                        "data": function(d) {
                            d.user = $('.user').val()
                            d.start_date = $('.start-date').val()
                            d.end_date = $('.end-date').val()
                            d.action = $('.action').val()
                        }
                    },
                    buttons: [{
                        extend: 'excel',
                        footer: true,
                        filename: function() {
                            return '<?= strtotime(date('Y-m-d H:i:s')) ?> - Absensi ' + $('.user-name').val()
                        },
                        title: function() {
                            return 'Absensi ' + $('.user-name').val()
                        }
                    }, {
                        extend: 'pdfHtml5',
                        orientation: 'potrait',
                        pageSize: 'A4',
                        footer: true,
                        customize: function(doc) {
                            doc.content[1].table.widths =
                                Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                        },
                        filename: function() {
                            return '<?= strtotime(date('Y-m-d H:i:s')) ?> - Absensi ' + $('.user-name').val()
                        },
                        title: function() {
                            return 'Absensi ' + $('.user-name').val()
                        }
                    }]
                });

                $('.btn-view').on('click', function() {
                    $('.action').val('show')

                    hitungAbsen()
                    datatable.ajax.reload()
                })

                $('.btn-check-in').on('click', function() {
                    $('.action').val('show')

                    jQuery.ajax({
                        url: '<?= base_url('absensi/checkin') ?>',
                        method: "POST",
                        data: {
                            user: $('.user').val(),
                            bonus_absen: $('.bonus-absen').val(),
                            keterangan: $('.keterangan').val()
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data.status) {
                                datatable.ajax.reload()
                                hitungAbsen()

                                Swal.fire(
                                    "Berhasil",
                                    data.msg,
                                    "success"
                                );
                            } else {
                                Swal.fire(
                                    "Gagal",
                                    data.msg,
                                    "error"
                                );
                            }
                        }
                    });
                })

                $('#selectedUser').select2({
                    ajax: {
                        url: '<?= base_url("absensi/getUserData") ?>',
                        dataType: 'json',
                        delay: 250,
                        processResults: function(data) {
                            return {
                                results: $.map(data, function(item) {
                                    return {
                                        text: `${item.name} (${item.telephone})`,
                                        id: item.id,
                                        name: item.name,
                                        phone: item.telephone
                                    };
                                })
                            };
                        },
                        cache: true
                    },
                    minimumInputLength: 2
                }).on('select2:select', function(e) {
                    var data = e.params.data;

                    $('.user-name').val(data.name)
                });

                $('.btn-pdf').on('click', function() {
                    if ($('.user').val() === '') {
                        Swal.fire(
                            "Gagal",
                            "Silahkan pilih karyawan terlebih dahulu",
                            "error"
                        )
                        return false
                    }

                    $('.action').val('filter')
                    hitungAbsen()
                    datatable.ajax.reload()
                    datatable.button('.buttons-pdf').trigger();
                })

                $('.btn-excel').on('click', function() {
                    if ($('.user').val() === '') {
                        Swal.fire(
                            "Gagal",
                            "Silahkan pilih karyawan terlebih dahulu",
                            "error"
                        )
                        return false
                    }

                    $('.action').val('filter')
                    hitungAbsen()
                    datatable.ajax.reload()
                    datatable.button('.buttons-excel').trigger();
                })

                function hitungAbsen() {
                    $.ajax({
                        url: '<?= base_url("absensi/hitung_absen") ?>',
                        type: 'GET',
                        async: false,
                        data: {
                            user: $('.user').val(),
                            start_date: $('.start-date').val(),
                            end_date: $('.end-date').val(),
                            action: $('.action').val()
                        },
                        success: function(response) {
                            $('.text-jumlah-masuk').text(numeral(response.jumlah_masuk).format('0,0'))
                            $('.text-bonus-absen').text(numeral(response.bonus_absen).format('0,0'))
                        },
                        error: function() {
                            console.error('Error fetching transaction details');
                        }
                    });
                }
            });
        </script>



        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
        <link rel="stylesheet" href="<?= base_url('assets/css/custom-select2.css') ?>">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
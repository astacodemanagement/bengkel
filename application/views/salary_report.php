        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Laporan Pembelian</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="<?= base_url("dashboard"); ?>">Dashboard</a></li>
                            <li class="active">Laporan Pembelian</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="card">
                <div class="card-header">
                    <form class="date form-inline">
                        <input type="date" name="start_date" id="start_date" class="form-control form-control-sm datepicker" placeholder="Start Date">
                        <span class="mx-2">-</span>
                        <input type="date" name="end_date" id="end_date" class="form-control form-control-sm datepicker" placeholder="End Date">

                        <div style="margin-left: 5px;">
                            <select id="selectedUser" name="user" class="form-control form-control-sm select2 user">
                                <option value="" disabled selected hidden>--Pilih mekanik--</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary btn-sm ml-3 btn-filter" style="border-radius: 1rem;">
                            <i class="fa fa-filter"></i> Filter
                        </button>

                        <button type="button" onclick="location.href='<?= base_url('report/salary') ?>'" class="btn btn-primary btn-sm ml-3 btn-reset" style="border-radius: 1rem;">
                            <i class="fa fa-refresh"></i> Reset
                        </button>

                        <button type="button" class="btn btn-primary btn-sm ml-3 btn-print" style="border-radius: 1rem;">
                            <i class="fa fa-print"></i> Export PDF
                        </button>

                        <button type="button" class="btn btn-success btn-sm ml-3 btn-excel" style="border-radius: 1rem;">
                            <i class="fa fa-file-excel-o"></i> Export Excel
                        </button>
                    </form>
                    <div class="card-body">
                        <div class="table-responsive">


                            <?php
                            $totalHasilBagi = 0;
                            ?>

                            <table id="data" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="3%">No</th>
                                        <th width="5%">Mekanik</th>
                                        <th width="5%">Tanggal</th>
                                        <th width="5%">Kode</th>
                                        <th width="5%">Jenis Mobil</th>
                                        <th width="5%">Total</th>
                                        <th width="5%">Hasil bagi</th>
                                        <th class="text-center" width="5%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($transactions as $index => $transaction) : ?>
                                        <?php
                                        // Hitung hasil bagi dari total dikurangi 20%
                                        $hasilBagi = $transaction->total * 0.8;
                                        $totalHasilBagi += $hasilBagi;
                                        ?>
                                        <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td><?= $transaction->mechanic_name ?></td>
                                            <td><?= $transaction->date ?></td>
                                            <td><?= $transaction->code ?></td>
                                            <td><?= $transaction->car_type ?></td>
                                            <td><?= number_format($transaction->total, 0, ',', '.') ?></td>
                                            <td><?= number_format($hasilBagi, 0, ',', '.') ?></td>
                                            <td class="text-center">
                                                <a style="color: rgb(242, 236, 236)" href="#" class="btn btn-sm btn-primary btn-detail" data-toggle="modal" data-target="#modal-detail" data-id="<?= $transaction->id ?>" style="color: black">
                                                    <i class="fa fa-eye"></i> Detail
                                                </a>
                                            </td>

                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <!-- Baris tambahan untuk total hasil bagi -->
                                <tfoot>
                                    <tr>
                                        <td colspan="5"></td>
                                        <td>Total</td>
                                        <td><b><?= number_format($totalHasilBagi, 0, ',', '.') ?></b></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Detail Transaksi -->
            <div class="modal fade" id="modal-detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Detail Transaksi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Tambahkan konten modal di sini -->
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Product ID</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                    </tr>
                                </thead>
                                <tbody id="detail-table-body">
                                    <!-- Isi tabel detail di sini -->
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                $(document).ready(function() {
                    // Inisialisasi Select2 dengan opsi pencarian
                    $('#selectedUser').select2({
                        ajax: {
                            url: '<?= base_url("report/getUserMekanikData") ?>',
                            dataType: 'json',
                            delay: 250,
                            processResults: function(data) {
                                return {
                                    results: $.map(data.results, function(item) {
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

                        // $('#user').val(data.name)
                        // $('#phone').val(data.phone)
                    });

                });
            </script>



            <!-- ... Your existing JavaScript code ... -->

            <script>
                $(document).ready(function() {

                    // Event klik pada tombol detail
                    $('.btn-detail').on('click', function() {
                        var transactionId = $(this).data('id');

                        // Kirim data ke server untuk detail
                        $.ajax({
                            url: '<?= base_url("report/getTransactionDetails") ?>',
                            type: 'POST',
                            data: {
                                transaction_id: transactionId
                            },
                            success: function(response) {
                                // Replace the content of tbody with the updated transaction details
                                $('#detail-table-body').html(response);
                            },
                            error: function() {
                                console.error('Error fetching transaction details');
                            }
                        });
                    });
                    // Inisialisasi datepicker
                    // $('.datepicker').datepicker();

                    // Inisialisasi Select2 untuk filter user
                    $('.user').select2({
                        ajax: {
                            url: '<?= base_url("report/getUserData") ?>',
                            dataType: 'json',
                            delay: 250,
                            processResults: function(data) {
                                return {
                                    results: $.map(data.results, function(item) {
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
                    });

                    // Event klik pada tombol filter
                    $('.btn-filter').on('click', function() {
                        // Ambil nilai dari input filter
                        var start_date = $('#start_date').val();
                        var end_date = $('#end_date').val();
                        var user_id = $('[name="user"]').val();

                        // Kirim data ke server untuk filtering
                        $.ajax({
                            url: '<?= base_url("report/filterTransactions") ?>',
                            type: 'POST',
                            data: {
                                start_date: start_date,
                                end_date: end_date,
                                user_id: user_id
                            },
                            success: function(response) {
                                // Replace the content of tbody with the updated transactions
                                $('#data tbody').html(response);

                                // Reinitialize DataTables after updating the content
                                $('#data').DataTable();
                            },
                            error: function() {
                                console.error('Error fetching data');
                            }
                        });
                    });

                    // Event klik pada tombol reset
                    $('.btn-reset').on('click', function() {
                        // Reset nilai input filter
                        $('#start_date').val('');
                        $('#end_date').val('');
                        $('#selectedUser').val(null).trigger('change'); // Reset Select2
                        // Kirim data ke server untuk reset
                        $.ajax({
                            url: '<?= base_url("report/resetTransactions") ?>',
                            type: 'POST',
                            success: function(response) {
                                // Replace the content of tbody with the original transactions
                                $('#data tbody').html(response);

                                // Reinitialize DataTables after updating the content
                                $('#data').DataTable();
                            },
                            error: function() {
                                console.error('Error fetching data');
                            }
                        });
                    });
                });
            </script>

            <!-- ... Your existing libraries ... -->



            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
            <!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
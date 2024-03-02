        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Estimasi</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="<?= base_url("dashboard"); ?>">Dashboard</a></li>
                            <li class="active">Estimasi</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="row">
                <div class="col-md-7 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-services-tab" data-toggle="tab" href="#nav-services" role="tab" aria-controls="nav-services" aria-selected="true">Services</a>
                                    <a class="nav-item nav-link" id="nav-sparepart-tab" data-toggle="tab" href="#nav-sparepart" role="tab" aria-controls="nav-sparepart" aria-selected="false">Sparepart</a>
                                    <!-- <a class="nav-item nav-link" id="nav-mekanik-tab" data-toggle="tab" href="#nav-mekanik" role="tab" aria-controls="nav-mekanik" aria-selected="false">Mekanik</a> -->

                                </div>
                            </nav>
                            <div class="tab-content pt-3" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-services" role="tabpanel" aria-labelledby="nav-services-tab">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-sm" id="dataTable">
                                            <thead>
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>Kode</th>
                                                    <th>Harga</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-sm-12">

                    <div class="card" id="customerContainer">
                        <!-- <div class="card" id="customerContainer" style="display:none;background:#000"> -->
                        <div class="card-header">
                            <b>Data Pelanggan</b>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <!-- <label>Cari Pelanggan</label> -->
                                <select name="selectedConsumer" id="selectedConsumer" class="form-control form-control-sm select2 customer">
                                    <option value="" disabled selected hidden>--Pilih Pelanggan--</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Nama Pelanggan</label>
                                <input type="text" id="customer" class="form-control form-control-sm" readonly>
                            </div>
                            <div class="form-group">
                                <label>No. Telephone</label>
                                <input type="text" id="phone" class="form-control form-control-sm" readonly>
                            </div>
                        </div>



                    </div>

                    <div class="card" id="serviceCartContainer" style="display:none">
                        <div class="card-header">
                            <b>Services</b>
                        </div>
                        <div class="card-body">
                            <table class="table table-sm table-bordered" id="serviceCart">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Harga</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card" id="sparepartCartContainer" style="display:none">
                        <div class="card-header">
                            <b>Sparepart</b>
                        </div>
                        <div class="card-body">
                            <table class="table table-sm table-bordered" id="sparepartCart">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Harga</th>
                                        <th class="text-center">Qty</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card" id="mekanikCartContainer" style="display:none">
                        <div class="card-header">
                            <b>Mekanik</b>
                        </div>
                        <div class="card-body">
                            <table class="table table-sm table-bordered" id="mekanikCart">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th width="35%">Upah</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <b>Detail Pembayaran</b>
                        </div>
                        <div class="card-body">
                            <div style="border-bottom: 1px dashed #aaa" class="d-flex py-2">
                                <span>Total</span>
                                <span class="total ml-auto">Rp. 0</span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex mb-4" style="box-sizing:border-box">
                        <div class="col-6 p-0 pr-1">
                            <button type="button" class="btn btn-warning btn-block" onclick="reset()" style="border-radius: 1rem;"><i class="fa fa-undo"></i> Batal</button>
                        </div>
                        <div class="col-6 p-0 pl-1">
                            <button type="button" class="btn btn-primary btn-block" onclick="saveModal()" style="border-radius: 1rem;"><i class="fa fa-print"></i> Print</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" id="purchaseModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="largeModalLabel">Pembayaran</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Bayar</label>
                            <input type="number" id="money" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Kembalian</label>
                            <input type="text" id="change" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary btn-save-confirm" disabled>Lanjutkan</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tambahkan di bagian head atau sebelum penutup tag body -->
        <!-- Pada bagian head atau sebelum penutup tag body -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
        <!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

        <script>
            $(document).ready(function() {
                // Inisialisasi Select2 dengan opsi pencarian
                $('#selectedConsumer').select2({
                    ajax: {
                        url: '<?= base_url("estimation/getConsumerData") ?>',
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

                    $('#customer').val(data.name)
                    $('#phone').val(data.phone)
                });

            });
        </script>

        <script>
            $("#dataTable").DataTable({
                "processing": true,
                "serverSide": true,
                "autoWidth": false,
                "order": [],
                "info": false,
                "language": {
                    search: "<span style='margin-right: 26px'>Cari :</span>"
                },
                "lengthChange": false,
                "ajax": {
                    "url": "<?= base_url("transaction/json_service"); ?>"
                }
            });

            $('#nav-services-tab').on("click", function() {
                jQuery("#dataTable").DataTable().ajax.url("<?= base_url("estimation/json_service"); ?>").load();
                jQuery("#dataTable").DataTable().columns([1]).visible(true);
            });
            $('#nav-sparepart-tab').on("click", function() {
                jQuery("#dataTable").DataTable().ajax.url("<?= base_url("estimation/json_sparepart"); ?>").load();
                jQuery("#dataTable").DataTable().columns([1]).visible(true);
            });
            $('#nav-mekanik-tab').on("click", function() {
                jQuery("#dataTable").DataTable().ajax.url("<?= base_url("estimation/json_mekanik"); ?>").load();
                jQuery("#dataTable").DataTable().columns([1]).visible(false);
            });

            var ServiceCart = [];
            var SparepartCart = [];
            var MekanikCart = [];
            var total = 0;
            var totalUpah = 0;
            var type = "";

            function addServiceCart(data) {
                var before = ServiceCart;
                var qty = 1;

                if (before[data.id]) {
                    qty = before[data.id]["qty"] + 1;
                } else {
                    before[data.id] = data;
                }

                before[data.id]["qty"] = qty;
                ServiceCart = before;

                refreshServiceCart(ServiceCart, SparepartCart, MekanikCart);
            }

            function addSparepartCart(data) {
                var before = SparepartCart;
                var qty = 1;

                if (before[data.id]) {
                    qty = before[data.id]["qty"] + 1;
                }

                if (qty <= data.stock) {
                    if (!before[data.id]) {
                        before[data.id] = data;
                    }
                    before[data.id]["qty"] = qty;
                } else {
                    Swal.fire(
                        'Gagal',
                        'Stok tidak cukup',
                        'error'
                    )
                }

                SparepartCart = before;

                refreshServiceCart(ServiceCart, SparepartCart, MekanikCart);
            }

            function addMekanikCart(data) {
                var before = MekanikCart;
                var qty = 1;

                if (before[data.id]) {
                    qty = before[data.id]["qty"] + 1;
                }

                if (qty <= data.stock) {
                    if (!before[data.id]) {
                        before[data.id] = data;
                    }
                    before[data.id]["qty"] = qty;
                } else {
                    Swal.fire(
                        'Gagal',
                        'Stok tidak cukup',
                        'error'
                    )
                }

                MekanikCart = before;

                refreshServiceCart(ServiceCart, SparepartCart, MekanikCart);
            }

            function refreshServiceCart(data1, data2, data3) {
                var html1 = "";
                var html2 = "";
                var html3 = "";
                var countTotal = 0;
                var countUpah = 0;

                data1 = data1.filter(function(el) {
                    return el != null;
                });
                data2 = data2.filter(function(el) {
                    return el != null;
                });
                data3 = data3.filter(function(el) {
                    return el != null;
                });

                data1.forEach(function(item, index) {
                    html1 += '<tr><td>' + item.name + '</td><td >Rp ' + item.price.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') + '</td><td class="text-center"><button type="button" class="btn btn-sm btn-danger" onclick="deleteServiceCart(' + item.id + ')"><i class="fa fa-times"></i></button></td></tr>';
                    countTotal = (countTotal + (item.price * item.qty));
                })
                data2.forEach(function(item, index) {
                    html2 += '<tr><td>' + item.name + '</td><td >Rp ' + item.price.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') + '</td><td class="text-center"><input type="number" style="width:52px" value="' + item.qty + '" class="change-qty" data-id="' + item.id + '" data-stock="' + item.stock + '"/></td></tr>';
                    countTotal = (countTotal + (item.price * item.qty));
                })
                data3.forEach(function(item, index) {
                    html3 += '<tr><td>' + item.name + '</td><td><input type="number" class="form-control change-upah" min="0" value="' + item.price + '" data-id="' + item.id + '"></td><td class="text-center"><button type="button" class="btn btn-sm btn-danger" onclick="deleteMekanikCart(' + item.id + ')"><i class="fa fa-times"></i></button></td></tr>';
                    countUpah = (countUpah + item.price);
                })

                total = countTotal;
                totalUpah = countUpah;

                if (data1.length) {
                    jQuery("#serviceCartContainer").attr("style", "display:block");
                    // jQuery("#customerContainer").attr("style", "display:block");
                    type = "service";
                } else {
                    jQuery("#serviceCartContainer").attr("style", "display:none");
                    // jQuery("#customerContainer").attr("style", "display:none");
                    type = "sparepart";
                }

                if (data2.length) {
                    jQuery("#sparepartCartContainer").attr("style", "display:block");
                } else {
                    jQuery("#sparepartCartContainer").attr("style", "display:none");
                }

                if (data3.length) {
                    jQuery("#mekanikCartContainer").attr("style", "display:block");
                } else {
                    jQuery("#mekanikCartContainer").attr("style", "display:none");
                }

                jQuery("#serviceCart tbody").html(html1);
                jQuery("#sparepartCart tbody").html(html2);
                jQuery("#mekanikCart tbody").html(html3);
                jQuery('.total').html("Rp " + total.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,'));
            }

            function deleteServiceCart(id) {
                delete ServiceCart[id];

                refreshServiceCart(ServiceCart, SparepartCart, MekanikCart);
            }

            function deleteMekanikCart(id) {
                delete MekanikCart[id];

                refreshServiceCart(ServiceCart, SparepartCart, MekanikCart);
            }

            $("body").on('change', '.change-qty', function() {
                var before = SparepartCart;
                var qty = jQuery(this).val();
                var id = jQuery(this).attr("data-id");
                var stock = parseInt(jQuery(this).attr("data-stock"));

                if (qty <= stock) {
                    before[id]["qty"] = qty;
                } else {
                    Swal.fire(
                        'Gagal',
                        'Stok tidak cukup',
                        'error'
                    )
                }
                if (qty <= 0) {
                    delete before[id];
                }
                SparepartCart = before;

                refreshServiceCart(ServiceCart, SparepartCart, MekanikCart);
            })

            $("body").on('change', '.change-upah', function() {
                var before = MekanikCart;
                var upah = jQuery(this).val();
                var id = jQuery(this).attr("data-id");
                let totalUpah = 0

                $('#mekanikCart tbody tr').each(function() {
                    totalUpah += parseFloat($(this).find('.change-upah').val())
                })

                if (parseFloat(totalUpah) > parseFloat(total)) {
                    Swal.fire(
                        'Gagal',
                        'Upah mekanik tidak boleh lebih besar dari total',
                        'error'
                    )

                    jQuery(this).val(0)
                } else {
                    before[id]["price"] = parseFloat(upah);
                }

                MekanikCart = before;

                refreshServiceCart(ServiceCart, SparepartCart, MekanikCart);
            })

            function reset() {
                jQuery("#customerContainer input").val("");
                ServiceCart = [];
                SparepartCart = [];

                jQuery("#dataTable").DataTable().ajax.reload(null, true);

                refreshServiceCart(ServiceCart, SparepartCart, MekanikCart);
            }

            function saveModal() {
                if (!total) {
                    Swal.fire(
                        'Gagal',
                        'Keranjang kosong',
                        'error'
                    )
                } else {
                    // jQuery("#purchaseModal").modal("toggle");
                    if (type == "sparepart") {
                        var url = "<?= base_url("estimation/insert/sparepart"); ?>";
                    } else {
                        var url = "<?= base_url("estimation/insert/service"); ?>";
                    }

                    var itemSparepart = SparepartCart.filter(function(el) {
                        return el != null;
                    });

                    var itemMekanik = MekanikCart.filter(function(el) {
                        return el != null;
                    });

                    var form = {};
                    form["total"] = total;
                    form["sparepart"] = itemSparepart;
                    form["mekanik"] = itemMekanik;

                    if (type == "service") {
                        form["customer"] = jQuery("input[name=customer]").val();
                        form["plat"] = jQuery("input[name=plat]").val();
                        form["service"] = ServiceCart.filter(function(el) {
                            return el != null;
                        });
                    }

                    form = JSON.stringify(form);

                    jQuery.ajax({
                        url: url,
                        method: "POST",
                        data: form,
                        dataType: "json",
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            if (data.status) {
                                reset();
                                jQuery("#change").val("");
                                jQuery("#money").val("");
                                jQuery(".customer").val("").change();

                                location.href = "<?= base_url("estimation/print"); ?>"
                            }
                        }
                    })
                }
            }

            $("#money").on("keyup", function() {
                var value = jQuery(this);

                var change = parseInt(value.val()) - total;

                if (change < 0) {
                    change = "Belum cukup";
                    jQuery(".btn-save-confirm").prop("disabled", true);
                } else {
                    jQuery(".btn-save-confirm").prop("disabled", false);
                }

                jQuery("#change").val(change.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,'));
            })
        </script>
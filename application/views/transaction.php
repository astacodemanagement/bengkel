        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Transaksi</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="<?= base_url("dashboard"); ?>">Dashboard</a></li>
                            <li class="active">Transaksi</li>
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
                                <div class="nav nav-tabs" id="nav-tab" role="tablist" data-recent-tab="1">
                                    <a class="nav-item nav-link active" id="nav-services-tab" data-toggle="tab" href="#nav-services" role="tab" aria-controls="nav-services" aria-selected="true">Services</a>
                                    <a class="nav-item nav-link" id="nav-sparepart-tab" data-toggle="tab" href="#nav-sparepart" role="tab" aria-controls="nav-sparepart" aria-selected="false">Sparepart</a>
                                    <a class="nav-item nav-link" id="nav-mekanik-tab" data-toggle="tab" href="#nav-mekanik" role="tab" aria-controls="nav-mekanik" aria-selected="false">Mekanik</a>

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
                                                    <th>Keterangan</th>
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
                                <label>Tanggal Transaksi</label>
                                <input type="date" class="form-control form-control-sm date" id="transactionDate">
                            </div>

                            <script>
                                // Mendapatkan tanggal hari ini
                                var today = new Date();

                                // Mendapatkan tanggal dalam format YYYY-MM-DD
                                var formattedDate = today.toISOString().split('T')[0];

                                // Set nilai default pada input tanggal
                                document.getElementById('transactionDate').value = formattedDate;
                            </script>

                            <div class="form-group">
                                <!-- <label>Cari Pelanggan</label> -->
                                <select id="selectedConsumer" name="customer" class="form-control form-control-sm select2 customer">
                                    <option value="" disabled selected hidden>--Pilih Pelanggan--</option>
                                </select>
                                <input type="hidden" class="tipe-pelanggan">
                            </div>
                            <div class="form-group">
                                <label>Nama Pelanggan</label>
                                <input type="text" id="customer" class="form-control form-control-sm" readonly>
                            </div>
                            <div class="form-group">
                                <label>No. Telephone</label>
                                <input type="text" id="phone" class="form-control form-control-sm" readonly>
                            </div>
                            <div class="form-group">
                                <label>KM</label>
                                <input type="number" class="form-control form-control-sm km" min="0">
                            </div>
                            <div class="form-group">
                                <label>Nomor Polisi</label>
                                <input type="text" class="form-control form-control-sm plat">
                            </div>
                            <div class="form-group">
                                <label>Jenis Mobil</label>
                                <input type="text" class="form-control form-control-sm car-type">
                            </div>
                            <div class="form-group">
                                <label>Keterangan</label>
                                <textarea class="form-control description"></textarea>
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
                                <span class="pt-1">Diskon</span>
                                <span class="ml-auto"><input type="number" class="form-control text-right diskon"></span>
                            </div>
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
                            <button type="button" class="btn btn-success btn-block" onclick="saveModal()" style="border-radius: 1rem;"><i class="fa fa-save"></i> Simpan</button>
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


        <!-- modal detail -->
        <div id="detailModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Detail Sparepart</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <img id="modalImage" src="" alt="Image" style="max-width: 100%;">
                        <hr>
                        <p id="modalName">Nama: </p>
                        <p id="modalLokasi">Lokasi: </p>
                        <p id="modalPrice">Harga Beli : </p>
                        <p id="modalPrice1">Harga Jual 1: </p>
                        <p id="modalPrice2">Harga Jual 2: </p>
                        <p id="modalKeterangan">Keterangan: </p>
                    </div>

                </div>
            </div>
        </div>

        <div id="detailServiceModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Detail Services</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p id="modalServiceName">Nama: </p>
                        <p id="modalServicePrice">Harga Service : </p>
                        <p id="modalServiceJenisMobil">Jenis Mobil: </p>
                        <p id="modalServiceKeterangan">Keterangan: </p>
                    </div>

                </div>
            </div>
        </div>

        <!-- Tambahkan di bagian head atau sebelum penutup tag body -->
        <!-- Pada bagian head atau sebelum penutup tag body -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
        <link rel="stylesheet" href="<?= base_url('assets/css/custom-select2.css') ?>">
        <!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

        <script>
            $(document).ready(function() {

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
            }).columns([1, 3]).visible(false);

            $('#nav-services-tab').on("click", function() {
                jQuery("#dataTable").DataTable().ajax.url("<?= base_url("transaction/json_service"); ?>").load();
                jQuery("#dataTable").DataTable().columns([1, 3]).visible(false);
                $('.nav-tabs').attr('data-recent-tab', 1)
            });
            $('#nav-sparepart-tab').on("click", function() {
                let customerType = $('.tipe-pelanggan').val()

                jQuery("#dataTable").DataTable().ajax.url("<?= base_url("transaction/json_sparepart?type="); ?>" + customerType).load();
                jQuery("#dataTable").DataTable().columns([1, 2, 3]).visible(true);
                $('.nav-tabs').attr('data-recent-tab', 2)
            });
            $('#nav-mekanik-tab').on("click", function() {
                jQuery("#dataTable").DataTable().ajax.url("<?= base_url("transaction/json_mekanik"); ?>").load();
                jQuery("#dataTable").DataTable().columns([2, 3]).visible(false);
                jQuery("#dataTable").DataTable().columns([1]).visible(true);
                $('.nav-tabs').attr('data-recent-tab', 3)
            });


            // Inisialisasi Select2 dengan opsi pencarian
            $('#selectedConsumer').select2({
                ajax: {
                    url: '<?= base_url("transaction/getConsumerData") ?>',
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        return {
                            results: $.map(data.results, function(item) {
                                return {
                                    text: `${item.name} (${item.telephone})`,
                                    id: item.id,
                                    name: item.name,
                                    phone: item.telephone,
                                    type: item.tipe
                                };
                            })
                        };
                    },
                    cache: true
                },
                minimumInputLength: 2
            }).on('select2:select', function(e) {
                var data = e.params.data;

                let recentTab = $('.nav-tabs').attr('data-recent-tab')

                $('.tipe-pelanggan').val(data.type)
                $('#customer').val(data.name)
                $('#phone').val(data.phone)

                refreshServiceCart(ServiceCart, SparepartCart, MekanikCart);

                if (recentTab === '2') {
                    jQuery("#dataTable").DataTable().ajax.url("<?= base_url("transaction/json_sparepart?type="); ?>" + data.type).load();
                }
            });

            var ServiceCart = [];
            var SparepartCart = [];
            var MekanikCart = [];
            var total = 0;
            var discount = 0;
            var totalMechanicCost = 0;
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

            function detailData(data) {
                // Set modal content
                document.getElementById('modalName').innerHTML = 'Nama : ' + data.name;
                document.getElementById('modalLokasi').innerHTML = 'Lokasi : ' + data.location;
                document.getElementById('modalKeterangan').innerHTML = 'Keterangan : ' + data.description;

                // Format prices with thousand separators
                document.getElementById('modalPrice').innerHTML = 'Harga Beli : ' + 'Rp. ' + formatNumber(parseInt(data.price));
                document.getElementById('modalPrice1').innerHTML = 'Harga Jual 1 : ' + 'Rp. ' + formatNumber(parseInt(data.price1));
                document.getElementById('modalPrice2').innerHTML = 'Harga Jual 2 : ' + 'Rp. ' + formatNumber(parseInt(data.price2));

                document.getElementById('modalImage').src = data.gambar;

                // Show the modal
                $('#detailModal').modal('show');
            }

            function detailDataService(data) {
                // Set modal content
                document.getElementById('modalServiceName').innerHTML = 'Nama : ' + data.name;
                document.getElementById('modalServiceKeterangan').innerHTML = 'Keterangan : ' + data.description;

                // Format prices with thousand separators
                document.getElementById('modalServicePrice').innerHTML = 'Harga Service : ' + 'Rp. ' + formatNumber(parseInt(data.price));
                document.getElementById('modalServiceJenisMobil').innerHTML = 'Jenis Mobil : ' + data.jenismobil;

                // Show the modal
                $('#detailServiceModal').modal('show');
            }

            // Function to format number with thousand separators
            function formatNumber(number) {
                return number.toLocaleString('id-ID'); // Adjust 'id-ID' based on your desired locale
            }




            function addMekanikCart(data) {
                var before = MekanikCart;

                if (!before[data.id]) {
                    before[data.id] = data;
                }

                MekanikCart = before;

                refreshServiceCart(ServiceCart, SparepartCart, MekanikCart);
            }

            function refreshServiceCart(data1, data2, data3) {
                var html1 = "";
                var html2 = "";
                var html3 = "";
                var countTotal = 0;
                var countMechanicCost = 0;
                const customerType = $('.tipe-pelanggan').val()

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
                    let price = item.price3
                    let priceText = item.price3.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')

                    if (customerType == 'Platinum') {
                        price = item.price1
                        priceText = item.price1.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
                    } else if (customerType == 'Gold') {
                        price = item.price2
                        priceText = item.price2.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
                    }

                    html2 += '<tr><td>' + item.name + '</td><td >Rp ' + priceText + '</td><td class="text-center"><input type="number" style="width:52px" value="' + item.qty + '" class="change-qty" data-id="' + item.id + '" data-stock="' + item.stock + '"/></td></tr>';
                    countTotal = (countTotal + (price * item.qty));
                })
                data3.forEach(function(item, index) {
                    html3 += '<tr><td>' + item.name + '</td><td><input type="number" class="form-control change-cost" min="0" value="' + item.cost + '" data-id="' + item.id + '"></td><td class="text-center"><button type="button" class="btn btn-sm btn-danger" onclick="deleteMekanikCart(' + item.id + ')"><i class="fa fa-times"></i></button></td></tr>';
                    countMechanicCost = (countMechanicCost + item.cost);
                })

                discount = $('.diskon').val() === '' ? 0 : parseFloat($('.diskon').val())
                total = countTotal - discount;
                totalMechanicCost = countMechanicCost;

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

            $("body").on('change', '.change-cost', function() {
                var before = MekanikCart;
                var cost = jQuery(this).val();
                var id = jQuery(this).attr("data-id");
                let totalMechanicCost = 0

                $('#mekanikCart tbody tr').each(function() {
                    totalMechanicCost += parseFloat($(this).find('.change-cost').val())
                })

                if (parseFloat(totalMechanicCost) > parseFloat(total)) {
                    Swal.fire(
                        'Gagal',
                        'Upah mekanik tidak boleh lebih besar dari total',
                        'error'
                    )

                    jQuery(this).val(0)
                } else {
                    before[id]["cost"] = parseFloat(cost);
                }

                MekanikCart = before;

                refreshServiceCart(ServiceCart, SparepartCart, MekanikCart);
            })

            function reset() {
                jQuery("#customerContainer input,#customerContainer textarea").val("");
                $('.diskon').val('')
                
                ServiceCart = [];
                SparepartCart = [];

                jQuery("#dataTable").DataTable().ajax.reload(null, true);

                refreshServiceCart(ServiceCart, SparepartCart, MekanikCart);
            }

            function saveModal() {
                var selectedConsumer = document.getElementById('selectedConsumer');
                var customerName = document.getElementById('customer').value;

                // Memeriksa apakah consumer telah dipilih atau kosong
                if (!selectedConsumer.value) {
                    Swal.fire(
                        'Gagal',
                        'Harap pilih pelanggan',
                        'error'
                    );
                }
                // Memeriksa apakah nama pelanggan telah diisi atau kosong
                else if (!customerName.trim()) {
                    Swal.fire(
                        'Gagal',
                        'Nama pelanggan harus diisi',
                        'error'
                    );
                } else {
                    // Lanjutkan jika semua validasi terpenuhi
                    jQuery("#purchaseModal").modal("toggle");
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

            $(".btn-save-confirm").on("click", function() {

                if (type == "sparepart") {
                    var url = "<?= base_url("transaction/insert/sparepart"); ?>";
                } else {
                    var url = "<?= base_url("transaction/insert/service"); ?>";
                }

                var itemSparepart = SparepartCart.filter(function(el) {
                    return el != null;
                });

                var itemMekanik = MekanikCart.filter(function(el) {
                    return el != null;
                });

                var itemService = ServiceCart.filter(function(el) {
                    return el != null;
                });

                var form = {};
                form["total"] = total;
                form["discount"] = discount;
                form["mechanical_costs"] = totalMechanicCost;
                form["sparepart"] = itemSparepart;
                form["mechanic"] = itemMekanik;
                form["service"] = itemService
                form["customer"] = $(".customer").val();
                form["description"] = $(".description").val();
                form["km"] = $(".km").val();
                form["car_type"] = $(".car-type").val();
                form["plat"] = $(".plat").val();
                form["date"] = $(".date").val();

                // if (type == "service") {
                //     form["customer"] = jQuery("input[name=customer]").val();
                //     form["plat"] = jQuery("input[name=plat]").val();
                //     form["service"] = ServiceCart.filter(function(el) {
                //         return el != null;
                //     });
                // }

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
                            jQuery("#purchaseModal").modal("toggle");
                            jQuery("#change").val("");
                            jQuery("#money").val("");
                            jQuery(".customer").val("").change();
                            Swal.fire({
                                title: 'Berhasil',
                                text: data.msg,
                                icon: 'success',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                cancelButtonText: 'Lanjutkan',
                                confirmButtonText: 'Cetak Invoice'
                            }).then((result) => {
                                if (result.value === true) {
                                    location.href = "<?= base_url("service_sales/print"); ?>/" + data.id;
                                }
                            })
                        }
                    }
                });
            })

            $('.diskon').on('change keyup keydown', function() {
                refreshServiceCart(ServiceCart, SparepartCart, MekanikCart);
            })
        </script>
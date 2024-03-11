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
                    <button type="button" class="btn btn-sm btn-success btn-add" style="border-radius: 1rem;"><i class="fa fa-plus"></i> Tambah Absensi</button>
                    <input type="hidden" value="<?= $uangHarian ?>" id="uang_harian_asal" class="form-control uang-harian" />
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="data">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Jumlah Hari Kerja</th>
                                    <th>Jumlah Masuk Kerja</th>
                                    <th>Jumlah Absen Kerja</th>
                                    <th>Uang Harian</th>
                                    <th>Bonus</th>
                                    <th>Kasbon</th>
                                    <th>Total Gaji</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" id="compose" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="largeModalLabel">Tambah Absensi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="date" name="tanggal" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Nama Karyawan</label>
                                <br>
                                <select id="selectedUser" name="user" class="form-control select2 user" style="width:100%">
                                    <option value="" disabled selected hidden>--Pilih karyawan--</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Jumlah Hari Kerja</label>
                                <input type="number" name="jumlah_hari_kerja" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Jumlah Masuk Kerja</label>
                                <input type="number" name="jumlah_masuk_kerja" class="form-control hari-masuk" />
                            </div>
                            <div class="form-group">
                                <label>Jumlah Absen Kerja</label>
                                <input type="number" name="jumlah_absen_kerja" class="form-control" />
                            </div>

                            <script>
                                $(document).ready(function() {
                                    // Fungsi untuk menghitung jumlah_absen_kerja saat nilai jumlah_masuk_kerja berubah
                                    $(".hari-masuk").on("change", function() {
                                        // Ambil nilai dari jumlah_hari_kerja
                                        var jumlahHariKerja = parseInt($("[name='jumlah_hari_kerja']").val()) || 0;

                                        // Ambil nilai dari jumlah_masuk_kerja
                                        var jumlahMasukKerja = parseInt($(this).val()) || 0;

                                        // Hitung jumlah_absen_kerja
                                        var jumlahAbsenKerja = jumlahHariKerja - jumlahMasukKerja;

                                        // Set nilai jumlah_absen_kerja pada input
                                        $("[name='jumlah_absen_kerja']").val(jumlahAbsenKerja);
                                    });
                                });
                            </script>



                            <div class="form-group">
                                <label>Uang Harian</label>
                                <input type="number" name="uang_harian" id="uang_harian" class="form-control" />
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Bonus</label>
                                        <input type="number" name="bonus" class="form-control bonus" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Kasbon</label>
                                        <input type="number" name="kasbon" class="form-control kasbon" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Total Gaji</label>
                                <input type="text" class="form-control total-gaji" readonly />
                            </div>
                            <div class="form-group">
                                <label>Keterangan</label>
                                <textarea name="keterangan" id="keterangan" cols="30" rows="2" class="form-control"></textarea>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal" style="border-radius: 1rem;"><i class="fa fa-undo"></i> Cancel</button>
                        <button type="button" class="btn btn-primary btn-confirm" style="border-radius: 1rem;"><i class="fa fa-save"></i> Simpan</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" id="delete" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="largeModalLabel">Konfirmasi?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary btn-del-confirm">Hapus</button>
                    </div>
                </div>
            </div>
        </div>





        <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#telephone').on('input', function() {
                    var code = $(this).val().toLowerCase().replace(/\s+/g, '-');
                    $('#code').val(code);
                });
            });
        </script>
        <script>
            $("#data").DataTable({
                "processing": true,
                "serverSide": true,
                "autoWidth": true,
                "order": [],
                "ajax": {
                    "url": "<?= base_url("absensi/json"); ?>"
                }
            });

            $(".btn-add").on("click", function() {
                // Set judul modal dan action form
                jQuery("#compose .modal-title").html("Tambah Absensi");
                jQuery("#compose form").attr("action", "<?= base_url("absensi/insert"); ?>");

                // Kosongkan semua input dan textarea pada modal
                jQuery("#compose form input, textarea").val("");

                // Isi input dengan nilai dari input asal
                var nilaiAsal = jQuery("#uang_harian_asal").val();
                jQuery("#uang_harian").val(nilaiAsal);

                // Tampilkan modal
                jQuery("#compose").modal("toggle");
            });


            $("body").on("click", ".btn-edit", function() {
                var id = jQuery(this).attr("data-id");
                jQuery("#compose .modal-title").html("Edit Absensi");

                jQuery.getJSON("<?= base_url("absensi/get"); ?>/" + id, function(data) {
                    jQuery("#compose form").attr("action", "<?= base_url("absensi/edit"); ?>/" + id);
                    jQuery("#compose form input[name=tanggal]").val(data.tanggal);
                    jQuery("#compose form input[name=name]").val(data.name);
                    jQuery("#compose form input[name=telephone]").val(data.telephone);
                    jQuery("#compose form textarea[name=address]").val(data.address);
                    jQuery("#compose form textarea[name=description]").val(data.description);
                    jQuery("#compose form select[name=tipe]").val(data.tipe);

                    jQuery("#compose").modal("toggle");
                })
            })

            $(".btn-confirm").on("click", function() {
                var form = {
                    "tanggal": jQuery("#compose input[name=tanggal]").val(),
                    "user": jQuery("#compose select[name=user]").val(),
                    "jumlah_hari_kerja": jQuery("#compose input[name=jumlah_hari_kerja]").val(),
                    "jumlah_masuk_kerja": jQuery("#compose input[name=jumlah_masuk_kerja]").val(),
                    "jumlah_absen_kerja": jQuery("#compose input[name=jumlah_absen_kerja]").val(),
                    "uang_harian": jQuery("#compose input[name=uang_harian]").val(),
                    "bonus": jQuery("#compose input[name=bonus]").val(),
                    "kasbon": jQuery("#compose input[name=kasbon]").val(),
                    "keterangan": jQuery("#compose textarea[name=keterangan]").val()
                }

                var action = jQuery("#compose form").attr("action");

                jQuery.ajax({
                    url: action,
                    method: "POST",
                    data: form,
                    dataType: "json",
                    success: function(data) {
                        if (data.status) {
                            jQuery("#data").DataTable().ajax.reload(null, true);
                            jQuery("#compose").modal("toggle");
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

            function deleteData(id) {
                jQuery.getJSON("<?= base_url("absensi/delete"); ?>/" + id, function(data) {
                    if (data.status) {
                        jQuery("#data").DataTable().ajax.reload(null, true);
                        jQuery("#delete").modal("toggle");
                        Swal.fire(
                            "Berhasil",
                            data.msg,
                            "success"
                        );
                    }
                });
            }

            $('body').on("click", ".btn-delete", function() {
                var id = jQuery(this).attr("data-id");
                var name = jQuery(this).attr("data-name");
                jQuery("#delete .modal-body").html("Anda yakin ingin menghapus absensi?");
                jQuery("#delete").modal("toggle");

                jQuery("#delete .btn-del-confirm").attr("onclick", "deleteData(" + id + ")");
            })

            $('.hari-masuk, .uang-harian, .bonus, .kasbon').on('change', function() {
                hitungGaji();
            })

            function hitungGaji() {
                let hariMasuk = $('.hari-masuk').val() !== '' ? $('.hari-masuk').val() : 0;
                let uangHarian = $('.uang-harian').val() !== '' ? $('.uang-harian').val() : 0
                let bonus = $('.bonus').val() !== '' ? $('.bonus').val() : 0
                let kasbon = $('.kasbon').val() !== '' ? $('.kasbon').val() : 0
                let totalUangHarian = (parseFloat(hariMasuk) * parseFloat(uangHarian))
                let totalUangHarianPersen = (totalUangHarian * 20) / 100
                let totalGaji = totalUangHarian - totalUangHarianPersen + parseFloat(bonus) - parseFloat(kasbon)

                console.log(totalUangHarian, totalUangHarianPersen, totalGaji)
                $('.total-gaji').val(numeral(totalGaji).format('0,0'))
            }
        </script>


        <script>
            $(document).ready(function() {
                // Inisialisasi Select2 dengan opsi pencarian
                $('#selectedUser').select2({
                    ajax: {
                        url: '<?= base_url("absensi/getUserData") ?>',
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



        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
        <link rel="stylesheet" href="<?= base_url('assets/css/custom-select2.css') ?>">
        <!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
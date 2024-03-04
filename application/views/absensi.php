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
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="data">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kode Absensi</th>
                                    <th>Nama Absensi</th>
                                    <th>Alamat</th>
                                    <th>No. Telp</th>
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
                                <label>Nama Karyawan</label>
                                <br>
                                <select id="selectedUser" name="user" class="form-control select2 user">
                                    <option value="" disabled selected hidden>--Pilih karyawan--</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Jumlah Hari Kerja</label>
                                <input type="number" name="jumlah_hari_kerja" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Jumlah Masuk Kerja</label>
                                <input type="number" name="jumlah_masuk_kerja" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Jumlah Absesn Kerja</label>
                                <input type="number" name="jumlah_absen_kerja" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Uang Harian</label>
                                <input type="number" name="uang_harian" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Bonus</label>
                                <input type="number" name="bonus" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Kasbon</label>
                                <input type="number" name="kasbon" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Total Gaji</label>
                                <input type="number" name="total_gaji" class="form-control" readonly/>
                            </div>
                            <div class="form-group">
                                <label>Keterangan</label>
                                <textarea name="description" id="description" cols="30" rows="3" class="form-control"></textarea>
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
                jQuery("#compose .modal-title").html("Tambah Absensi");
                jQuery("#compose form").attr("action", "<?= base_url("absensi/insert"); ?>");
                jQuery("#compose form input,textarea").val("");
                jQuery("#compose").modal("toggle");
            })

            $("body").on("click", ".btn-edit", function() {
                var id = jQuery(this).attr("data-id");
                jQuery("#compose .modal-title").html("Edit Absensi");

                jQuery.getJSON("<?= base_url("absensi/get"); ?>/" + id, function(data) {
                    jQuery("#compose form").attr("action", "<?= base_url("absensi/edit"); ?>/" + id);
                    jQuery("#compose form input[name=code]").val(data.code);
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
                    "code": jQuery("#compose input[name=code]").val(),
                    "name": jQuery("#compose input[name=name]").val(),
                    "address": jQuery("#compose textarea[name=address]").val(),
                    "description": jQuery("#compose textarea[name=description]").val(),
                    "tipe": jQuery("#compose select[name=tipe]").val(),
                    "telephone": jQuery("#compose input[name=telephone]").val()
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
                jQuery("#delete .modal-body").html("Anda yakin ingin menghapus <b>" + name + "</b>");
                jQuery("#delete").modal("toggle");

                jQuery("#delete .btn-del-confirm").attr("onclick", "deleteData(" + id + ")");
            })
        </script>


        <script>
            $(document).ready(function() {
                // Inisialisasi Select2 dengan opsi pencarian
                $('#selectedUser').select2({
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
                }).on('select2:select', function(e) {
                    var data = e.params.data;

                    // $('#user').val(data.name)
                    // $('#phone').val(data.phone)
                });

            });
        </script>



        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
        <!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
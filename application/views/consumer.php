        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Konsumen</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
                            <li class="active">Konsumen</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="card">
                <div class="card-header">
                    <button type="button" class="btn btn-sm btn-success btn-add" style="border-radius: 1rem;"><i class="fa fa-plus"></i> Tambah Konsumen</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="data">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kode Konsumen</th>
                                    <th>Nama Konsumen</th>
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
                        <h5 class="modal-title" id="largeModalLabel">Tambah Konsumen</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label>Kode Konsumen</label>
                                <input type="text" name="code" id="code" class="form-control" placeholder="Kode Konsumen Sama Dengan Inputan No Telephone" />
                            </div>
                            <div class="form-group">
                                <label>Nama Konsumen</label>
                                <input type="text" name="name" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Tempat Lahir</label>
                                <input type="text" name="birthplace" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <input type="date" name="birthdate" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea name="address" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label>No. Telp</label>
                                <input type="text" name="telephone" id="telephone" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Keterangan</label>
                                <textarea name="description" id="description" cols="30" rows="3" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Tipe</label>
                                <select name="tipe" id="tipe" class="form-control">
                                    <option value="">--Pilih Tipe--</option>
                                    <option value="Platinum">Platinum</option>
                                    <option value="Gold">Gold</option>
                                    <option value="Non Member">Non Member</option>
                                </select>
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
                    "url": "<?= base_url("consumer/json"); ?>"
                }
            });

            $(".btn-add").on("click", function() {
                jQuery("#compose .modal-title").html("Tambah Konsumen");
                jQuery("#compose form").attr("action", "<?= base_url("consumer/insert"); ?>");
                jQuery("#compose form input,textarea").val("");
                jQuery("#compose").modal("toggle");
            })

            $("body").on("click", ".btn-edit", function() {
                var id = jQuery(this).attr("data-id");
                jQuery("#compose .modal-title").html("Edit Konsumen");

                jQuery.getJSON("<?= base_url("consumer/get"); ?>/" + id, function(data) {
                    jQuery("#compose form").attr("action", "<?= base_url("consumer/edit"); ?>/" + id);
                    jQuery("#compose form input[name=code]").val(data.code);
                    jQuery("#compose form input[name=birthplace]").val(data.birthplace);
                    jQuery("#compose form input[name=birthdate]").val(data.birthdate);
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
                    "birthplace": jQuery("#compose input[name=birthplace]").val(),
                    "birthdate": jQuery("#compose input[name=birthdate]").val(),
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
                jQuery.getJSON("<?= base_url("consumer/delete"); ?>/" + id, function(data) {
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
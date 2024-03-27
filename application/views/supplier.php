        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Supplier</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
                            <li class="active">Supplier</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="card">
                <div class="card-header">
                    <?php if (hasPermission('supplier', 'add')) : ?>
                        <button type="button" class="btn btn-sm btn-success btn-add" style="border-radius: 1rem;"><i class="fa fa-plus"></i> Tambah Supplier</button>
                    <?php endif ?>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="data">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
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
                        <h5 class="modal-title" id="largeModalLabel">Tambah Supplier</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label>Nama Supplier</label>
                                <input type="text" name="name" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea name="address" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label>No. Telp</label>
                                <input type="text" name="telephone" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Keterangan</label>
                                <textarea name="description" id="description" cols="30" rows="4" class="form-control"></textarea>
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
            $("#data").DataTable({
                "processing": true,
                "serverSide": true,
                "autoWidth": true,
                "order": [],
                "searching": allowSearching(),
                "ajax": {
                    "url": "<?= base_url("supplier/json"); ?>"
                }
            });

            function allowSearching() {
                return <?= hasPermission('supplier', 'search') ? 'true' : 'false' ?>
            }

            $(".btn-add").on("click", function() {
                jQuery("#compose .modal-title").html("Tambah Supplier");
                jQuery("#compose form").attr("action", "<?= base_url("supplier/insert"); ?>");
                jQuery("#compose form input,textarea").val("");
                jQuery("#compose form").find('input, select, textarea').prop('disabled', false).removeClass('bg-white')
                jQuery("#compose").find('.btn-confirm').removeClass('d-none')
                jQuery("#compose").modal("toggle");
            })

            $("body").on("click", ".btn-edit", function() {
                var id = jQuery(this).attr("data-id");
                jQuery("#compose .modal-title").html("Edit Supplier");

                jQuery.getJSON("<?= base_url("supplier/get"); ?>/" + id, function(data) {
                    jQuery("#compose form").attr("action", "<?= base_url("supplier/edit"); ?>/" + id);
                    jQuery("#compose form input[name=name]").val(data.name);
                    jQuery("#compose form input[name=telephone]").val(data.telephone);
                    jQuery("#compose form textarea[name=address]").val(data.address);
                    jQuery("#compose form textarea[name=description]").val(data.description);

                    jQuery("#compose form").find('input, select, textarea').prop('disabled', false).removeClass('bg-white')
                    jQuery("#compose").find('.btn-confirm').removeClass('d-none')
                    jQuery("#compose").modal("toggle");
                })
            })

            $("body").on("click", ".btn-detail", function() {
                var id = jQuery(this).attr("data-id");
                jQuery("#compose .modal-title").html("Detail Supplier");

                jQuery.getJSON("<?= base_url("supplier/get"); ?>/" + id, function(data) {
                    jQuery("#compose form input[name=name]").val(data.name);
                    jQuery("#compose form input[name=telephone]").val(data.telephone);
                    jQuery("#compose form textarea[name=address]").val(data.address);
                    jQuery("#compose form textarea[name=description]").val(data.description);

                    jQuery("#compose form").find('input, select, textarea').prop('disabled', true).addClass('bg-white')
                    jQuery("#compose").find('.btn-confirm').addClass('d-none')
                    jQuery("#compose").modal("toggle");
                })
            })

            $(".btn-confirm").on("click", function() {
                var form = {
                    "name": jQuery("#compose input[name=name]").val(),
                    "address": jQuery("#compose textarea[name=address]").val(),
                    "description": jQuery("#compose textarea[name=description]").val(),
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
                jQuery.getJSON("<?= base_url("supplier/delete"); ?>/" + id, function(data) {
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
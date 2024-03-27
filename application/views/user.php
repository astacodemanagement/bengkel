        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>User</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
                            <li class="active">User</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="card">
                <div class="card-header">
                    <?php if (hasPermission('karyawan', 'add')): ?>
                        <button type="button" class="btn btn-sm btn-success btn-add" style="border-radius: 1rem;"><i class="fa fa-plus"></i> Tambah User</button>
                    <?php endif ?>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="data">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kode User</th>
                                    <th>Nama User</th>
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
                        <h5 class="modal-title" id="largeModalLabel">Tambah User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="row">
                                <!-- Bagian pertama -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Kode User</label>
                                        <input type="text" name="code" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama User</label>
                                        <input type="text" name="name" class="form-control" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>No Telepon</label>
                                        <input type="text" name="telephone" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Posisi</label>
                                        <select name="position" id="position" class="form-control">
                                            <option value="Mekanik">Mekanik</option>
                                            <option value="Karyawan">Karyawan</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tempat Lahir</label>
                                        <input type="text" name="birthplace" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Lahir</label>
                                        <input type="date" name="birthdate" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <textarea class="form-control" name="address" id="address" cols="30" rows="4"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Level</label>
                                        <select name="level" id="level" class="form-control">
                                            <option value="Superadmin">Superadmin</option>
                                            <option value="Admin">Admin</option>
                                            <option value="Kasir">Kasir</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal masuk</label>
                                        <input type="date" name="joindate" id="joindate" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" name="username" id="username" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="text" name="password" id="password" class="form-control" autocomplete="off" />
                                    </div>
                                </div>
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
                "searching" : allowSearching(),
                "ajax": {
                    "url": "<?= base_url("user/json"); ?>"
                }
            });

            function allowSearching() {
                return <?= hasPermission('karyawan', 'search') ? 'true' : 'false' ?>
            }

            $(".btn-add").on("click", function() {
                jQuery("#compose .modal-title").html("Tambah User");
                jQuery("#compose form").attr("action", "<?= base_url("user/insert"); ?>");
                jQuery("#compose form input,textarea").val("");
                jQuery("#compose").modal("toggle");
            })

            $("body").on("click", ".btn-edit", function() {
                var id = jQuery(this).attr("data-id");
                jQuery("#compose .modal-title").html("Edit User");

                jQuery.getJSON("<?= base_url("user/get"); ?>/" + id, function(data) {
                    jQuery("#compose form").attr("action", "<?= base_url("user/edit"); ?>/" + id);
                    jQuery("#compose form input[name=code]").val(data.code);
                    jQuery("#compose form input[name=name]").val(data.name);
                    jQuery("#compose form input[name=telephone]").val(data.telephone);
                    jQuery("#compose form select[name=position]").val(data.position);
                    jQuery("#compose form input[name=birthplace]").val(data.birthplace);
                    jQuery("#compose form input[name=birthdate]").val(data.birthdate);
                    jQuery("#compose form input[name=joindate]").val(data.joindate);
                    jQuery("#compose form input[name=username]").val(data.username);
                    jQuery("#compose form input[name=password]").val('');
                    jQuery("#compose form select[name=level]").val(data.level);
                    jQuery("#compose form textarea[name=address]").val(data.address);

                    jQuery("#compose").modal("toggle");
                })
            })

            $(".btn-confirm").on("click", function() {
                var form = {
                    "code": jQuery("#compose input[name=code]").val(),
                    "name": jQuery("#compose input[name=name]").val(),
                    "telephone": jQuery("#compose input[name=telephone]").val(),
                    "position": jQuery("#compose select[name=position]").val(),
                    "birthplace": jQuery("#compose input[name=birthplace]").val(),
                    "birthdate": jQuery("#compose input[name=birthdate]").val(),
                    "joindate": jQuery("#compose input[name=joindate]").val(),
                    "username": jQuery("#compose input[name=username]").val(),
                    "password": jQuery("#compose input[name=password]").val(),
                    "address": jQuery("#compose textarea[name=address]").val(),
                    "level": jQuery("#compose select[name=level]").val()


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
                jQuery.getJSON("<?= base_url("user/delete"); ?>/" + id, function(data) {
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
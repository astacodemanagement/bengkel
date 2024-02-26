        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Sparepart</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="<?= base_url("dashboard"); ?>">Dashboard</a></li>
                            <li class="active">Sparepart</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-success btn-sm btn-show-add" data-toggle="modal" data-target="#compose" style="border-radius: 1rem;"><i class="fa fa-plus"></i> Tambah Sparepart</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="data">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th style="width:10%">Kode</th>
                                    <th style="width:20%">Nama</th>
                                    <th style="width:10%">Harga Beli</th>
                                    <th style="width:10%">Harga Jual 1</th>
                                    <th style="width:10%">Harga Jual 2</th>
                                    <th style="width:10%">Harga Jual 3</th>
                                    <th>Stok</th>
                                    <th style="width:10%">Aksi</th>
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
                                <input type="text" name="location"  id="location" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Keterangan</label>
                                <textarea name="description" id="description" cols="30" rows="2" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Gambar</label>
                                <input type="file" name="gambar" class="form-control dropify" id="gambar">
                                
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal" style="border-radius: 1rem;"><i class="fa fa-undo"></i> Cancel</button>
                        <button type="button" class="btn btn-primary btn-submit" style="border-radius: 1rem;"><i class="fa fa-save"></i> Simpan</button>
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
            $(".btn-show-add").on("click", function() {
                jQuery("input[name=kode]").val("");
                jQuery("input[name=name]").val("");
                jQuery("input[name=price]").val("");
                jQuery("input[name=price1]").val("");
                jQuery("input[name=price2]").val("");
                jQuery("input[name=price3]").val("");
                jQuery("input[name=location]").val("");
                jQuery("textarea[name=description]").val("");
                jQuery("#compose .modal-title").html("Tambah Sparepart");
                jQuery("#compose-form").attr("action", "<?= base_url("spare/insert"); ?>");
            });

            $("#data").DataTable({
                "processing": true,
                "serverSide": true,
                "autoWidth": true,
                "order": [],
                "ajax": {
                    "url": "<?= base_url("spare/json"); ?>"
                }
            });


            $('.btn-submit').on("click", function() {
                var form = {
                    "kode": jQuery("input[name=kode]").val(),
                    "name": jQuery("input[name=name]").val(),
                    "price": jQuery("input[name=price]").val(),
                    "price1": jQuery("input[name=price1]").val(),
                    "price2": jQuery("input[name=price2]").val(),
                    "price3": jQuery("input[name=price3]").val(),
                    "location": jQuery("input[name=location]").val(),
                    "description": jQuery("textarea[name=description]").val(),
                    "gambar": jQuery("input[name=gambar]").val()
                    
                }

                var action = jQuery("#compose-form").attr("action");

                jQuery.ajax({
                    url: action,
                    method: "POST",
                    data: form,
                    dataType: "json",
                    success: function(data) {
                        if (data.status) {
                            jQuery("input[name=kode]").val("");
                            jQuery("input[name=name]").val("");
                            jQuery("input[name=price]").val("");
                            jQuery("input[name=price1]").val("");
                            jQuery("input[name=price2]").val("");
                            jQuery("input[name=price3]").val("");
                            jQuery("input[name=location]").val("");
                            jQuery("textarea[name=description]").val("");
                            jQuery("input[name=gambar]").val("");

                            jQuery("#compose").modal('toggle');
                            jQuery("#data").DataTable().ajax.reload(null, true);

                            Swal.fire(
                                'Berhasil',
                                data.msg,
                                'success'
                            )
                        } else {
                            Swal.fire(
                                'Gagal',
                                data.msg,
                                'error'
                            )
                        }
                    }
                });
            });

            $('body').on("click", ".btn-delete", function() {
                var id = jQuery(this).attr("data-id");
                var name = jQuery(this).attr("data-name");
                jQuery("#delete .modal-body").html("Anda yakin ingin menghapus <b>" + name + "</b>");
                jQuery("#delete").modal("toggle");

                jQuery("#delete .btn-del-confirm").attr("onclick", "deleteData(" + id + ")");
            })

            function deleteData(id) {
                jQuery.getJSON("<?= base_url(); ?>spare/delete/" + id, function(data) {
                    if (data.status) {
                        jQuery("#delete").modal("toggle");
                        jQuery("#data").DataTable().ajax.reload(null, true);
                        Swal.fire(
                            'Berhasil',
                            data.msg,
                            'success'
                        )
                    } else {
                        Swal.fire(
                            'Berhasil',
                            data.msg,
                            'success'
                        )
                    }
                })
            }

            $("body").on("click", ".btn-edit", function() {
                var id = jQuery(this).attr("data-id");
                var name = jQuery(this).attr("data-name");
                var kode = jQuery(this).attr("data-kode");
                var price = jQuery(this).attr("data-price");
                var price1 = jQuery(this).attr("data-price1");
                var price2 = jQuery(this).attr("data-price2");
                var price3 = jQuery(this).attr("data-price3");
                var location = jQuery(this).attr("data-location");
                var description = jQuery(this).attr("data-description");

                jQuery("#compose .modal-title").html("Edit Sparepart");
                jQuery("#compose-form").attr("action", "<?= base_url(); ?>spare/update/" + id);
                jQuery("input[name=kode]").val(kode);
                jQuery("input[name=name]").val(name);
                jQuery("input[name=price]").val(price);
                jQuery("input[name=price1]").val(price1);
                jQuery("input[name=price2]").val(price2);
                jQuery("input[name=price3]").val(price3);
                jQuery("input[name=location]").val(location);
                jQuery("textarea[name=description]").val(description);

                jQuery("#compose").modal("toggle");
            });
        </script>
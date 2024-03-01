<style>
    .dt-buttons {
        display: none;
    }
</style>
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Laporan Penjualan</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="<?= base_url("dashboard"); ?>">Dashboard</a></li>
                    <li class="active">Laporan Penjualan</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content mt-3">
    <div class="card">
        <div class="card-header">
            <div class="date form-inline">
                <input type="text" name="start" class="form-control form-control-sm" placeholder="YYYY-MM-DD">
                <span class="mx-2">-</span>
                <input type="text" name="end" class="form-control form-control-sm" placeholder="YYYY-MM-DD">
                <button type="button" class="btn btn-primary btn-sm ml-3 btn-print" style="border-radius: 1rem;"><i class="fa fa-print"></i> Export PDF</button>
                <button type="button" class="btn btn-success btn-sm ml-3 btn-excel" style="border-radius: 1rem;"><i class="fa fa-file-excel-o"></i> Export Excel</button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="data">
                    <thead>
                        <tr>
                            <th style="width:10%">#</th>
                            <th>Tanggal</th>
                            <th>Items</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script>
    const elem = document.querySelector('.date');
    const datepicker = new DateRangePicker(elem, {
        format: "yyyy-mm-dd"
    });

    $("input[name=end]").on("change", function() {
        var start = jQuery("input[name=start]").val();
        var end = jQuery("input[name=end]").val();

        jQuery("#data").DataTable().ajax.url("<?= base_url("report/json/sparepart"); ?>/" + start + "/" + end).load();
    });

    let dataTable = $("#data").DataTable({
        "processing": true,
        "serverSide": true,
        "autoWidth": true,
        "order": [],
        "ajax": {
            "url": "<?= base_url("report/json/sparepart"); ?>"
        },
        "columnDefs": [{
                'targets': 0,
                'className': "text-center"
            },
            {
                'targets': 1,
                'className': "text-center"
            },
            {
                'targets': 2,
                'className': "text-center"
            },
            {
                'targets': 3,
                'className': "text-right"
            }
        ],
        buttons: [{
            extend: 'excel'
        }]
    });

    $(".btn-excel").on("click", function() {
        dataTable.button('.buttons-excel').trigger();
    });

    $(".btn-print").on("click", function() {
        var start = jQuery("input[name=start]").val();
        var end = jQuery("input[name=end]").val();

        if (start && end) {
            var url = "<?= base_url("report/report_pdf"); ?>/sparepart/" + start + "/" + end;
        } else {
            var url = "<?= base_url("report/report_pdf"); ?>/sparepart";
        }

        location.href = url;
    })
</script>
<!-- MODAL TUJUAN -->
<div class="modal fade" data-bs-backdrop="static" style="overflow-y: scroll;" id="modalTujuan">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Pilih Tujuan5</h6>
                <button onclick="resetB('tambah')" aria-label="Close" class="btn-close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4 pb-5">
                <input type="hidden" value="tambah" name="param">
                <input type="hidden" id="randkey">
                <div class="table-responsive">
                    <table id="table-tujuan" width="100%"
                        class="table table-bordered text-nowrap border-bottom dataTable no-footer dtr-inline collapsed">
                        <thead>
                            <th class="border-bottom-0" width="1%">No</th>
                            <th class="border-bottom-0">Kode Tujuan</th>
                            <th class="border-bottom-0">Nama Tujuan</th>
                            <th class="border-bottom-0">Alamat Tujuan</th>
                            <th class="border-bottom-0" width="1%">Action</th>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('randkey').value = makeid(10);

    function resetB() {
        param = $('input[name="param"]').val();
        if (param == 'tambah') {
            $('#modalTujuan').modal('hide');
            // Ganti dengan ID modal yang sesuai untuk ditampilkan setelah menutup modal tujuan
            $('#modaldemo8').removeClass('d-none');
        } else {
            $('#modalTujuan').modal('hide');
            // Ganti dengan ID modal yang sesuai untuk ditampilkan setelah menutup modal tujuan
            $('#Umodaldemo8').removeClass('d-none');
        }
    }

    function pilihTujuan(data) {
        const keyTujuan = $("#randkey").val();
        $("#status").val("true");
        $("input[name='kdbarang']").val(data.tujuan_kode);
        $("#nmbarang").val(data.tujuan_nama.replace(/_/g, ' '));
        //$("#alamattujuan").val(data.alamat_tujuan.replace(/_/g, ' '));
        // Ganti dengan ID modal yang sesuai untuk ditampilkan setelah memilih tujuan
        $('#modaldemo8').removeClass('d-none');
        $('#modalTujuan').modal('hide');
    }

    function pilihTujuanU(data) {
        const keyTujuan = $("#randkey").val();
        $("#statusU").val("true");
        $("input[name='kdbarangU']").val(data.tujuan_kode);
        $("#nmbarangU").val(data.tujuan_nama.replace(/_/g, ' '));
        //$("#alamattujuanU").val(data.alamat_tujuan.replace(/_/g, ' '));
        // Ganti dengan ID modal yang sesuai untuk ditampilkan setelah memilih tujuan
        $('#Umodaldemo8').removeClass('d-none');
        $('#modalTujuan').modal('hide');
    }

    var table2;
    $(document).ready(function () {
        // datatables
        table2 = $('#table-2').DataTable({
            "processing": true,
            "serverSide": true,
            "info": false,
            "order": [],
            "ordering": false,
            "scrollX": false,
            "pageLength": 10,
            "lengthChange": true,
            "ajax": {
                "url": "{{url('admin/tujuan/listtujuan')}}/param",
                "data": function (d) {
                    d.param = $('input[name="param"]').val();
                }
            },
            "columns": [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    searchable: false
                },
                {
                    data: 'kode_tujuan',
                    name: 'kode_tujuan',
                },
                {
                    data: 'nama_tujuan',
                    name: 'nama_tujuan',
                },
                {
                    data: 'alamat_tujuan',
                    name: 'alamat_tujuan',
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
        });
    });

    function makeid(length) {
        var result = '';
        var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var charactersLength = characters.length;
        for (var i = 0; i < length; i++) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        return result;
    }
</script>

{{-- @section('formOtherJS')
<script>
    document.getElementById('randkeyTujuan').value = makeid(10);

    function resetT() {
        param = $('input[name="param"]').val();
        if (param == 'tambah') {
            $('#modalTujuan').modal('hide');
            // Ganti dengan ID modal yang sesuai untuk ditampilkan setelah menutup modal tujuan
            $('#modaldemo8').removeClass('d-none');
        } else {
            $('#modalTujuan').modal('hide');
            // Ganti dengan ID modal yang sesuai untuk ditampilkan setelah menutup modal tujuan
            $('#Umodaldemo8').removeClass('d-none');
        }
    }

    function pilihTujuan(data) {
        const keyTujuan = $("#randkeyTujuan").val();
        $("#statusTujuan").val("true");
        $("input[name='kdtujuan']").val(data.kode_tujuan);
        $("#namatujuan").val(data.nama_tujuan.replace(/_/g, ' '));
        $("#alamattujuan").val(data.alamat_tujuan.replace(/_/g, ' '));
        // Ganti dengan ID modal yang sesuai untuk ditampilkan setelah memilih tujuan
        $('#modaldemo8').removeClass('d-none');
        $('#modalTujuan').modal('hide');
    }

    function pilihTujuanU(data) {
        const keyTujuan = $("#randkeyTujuan").val();
        $("#statusTujuanU").val("true");
        $("input[name='kdtujuanU']").val(data.kode_tujuan);
        $("#namatujuanU").val(data.nama_tujuan.replace(/_/g, ' '));
        $("#alamattujuanU").val(data.alamat_tujuan.replace(/_/g, ' '));
        // Ganti dengan ID modal yang sesuai untuk ditampilkan setelah memilih tujuan
        $('#Umodaldemo8').removeClass('d-none');
        $('#modalTujuan').modal('hide');
    }

    var tableTujuan;
    $(document).ready(function () {
        // datatables
        tableTujuan = $('#table-tujuan').DataTable({
            "processing": true,
            "serverSide": true,
            "info": false,
            "order": [],
            "ordering": false,
            "scrollX": false,
            "pageLength": 10,
            "lengthChange": true,
            "ajax": {
                "url": "{{url('admin/tujuan/listtujuan')}}/param",
                "data": function (d) {
                    d.param = $('input[name="param"]').val();
                }
            },
            "columns": [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    searchable: false
                },
                {
                    data: 'kode_tujuan',
                    name: 'kode_tujuan',
                },
                {
                    data: 'nama_tujuan',
                    name: 'nama_tujuan',
                },
                {
                    data: 'alamat_tujuan',
                    name: 'alamat_tujuan',
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
        });
    });

    function makeid(length) {
        var result = '';
        var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var charactersLength = characters.length;
        for (var i = 0; i < length; i++) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        return result;
    }
</script>
@endsection --}}

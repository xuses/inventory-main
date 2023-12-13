<!-- MODAL TUJUAN -->
<div class="modal fade" data-bs-backdrop="static" style="overflow-y:scroll;" id="modalTujuan">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Pilih Tujuan</h6><button onclick="resetB('tambah')" aria-label="Close" class="btn-close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body p-4 pb-5">
                <input type="hidden" value="tambah" name="param">
                <input type="hidden" id="randkey">
                <div class="table-responsive">
                    <table id="table-2" width="100%" class="table table-bordered text-nowrap border-bottom dataTable no-footer dtr-inline collapsed">
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

@section('formOtherJS')
<script>
    document.getElementById('randkey').value = makeid(10);

    function resetB() {
        param = $('input[name="param"]').val();
        if (param == 'tambah') {
            $('#modalTujuan').modal('hide');
            $('#modaldemo8').removeClass('d-none');
        } else {
            $('#modalTujuan').modal('hide');
            $('#Umodaldemo8').removeClass('d-none');
        }

    }

    function pilihTujuan(data) {
        const key = $("#randkey").val();
        $("#status").val("true");
        $("input[name='kdtujuan']").val(data.tujuan_kode);
        $("#nmtujuan").val(data.tujuan_nama.replace(/_/g, ' '));
        $("#alttujuan").val(data.tujuan_alamat.replace(/_/g, ' '));
        //$("#jenis").val(data.jenistujuan_nama.replace(/_/g, ' '));
        $('#modaldemo8').removeClass('d-none');
        $('#modalTujuan').modal('hide');
    }

    function pilihTujuanU(data) {
        const key = $("#randkey").val();
        $("#statusU").val("true");
        $("input[name='kdtujuanU']").val(data.tujuan_kode);
        $("#nmtujuanU").val(data.tujuan_nama.replace(/_/g, ' '));
        $("#alttujuanU").val(data.tujuan_alamat.replace(/_/g, ' '));
        //$("#jenisU").val(data.jenistujuan_nama.replace(/_/g, ' '));
        $('#Umodaldemo8').removeClass('d-none');
        $('#modalTujuan').modal('hide');
    }

    var table2;
    $(document).ready(function() {
        //datatables
        table2 = $('#table-2').DataTable({

            "processing": true,
            "serverSide": true,
            "info": false,
            "order": [],
            "ordering": false,
            "scrollX": false,
            // "lengthMenu": [
            //     [5, 10, 25, 50, 100],
            //     [5, 10, 25, 50, 100]
            // ],
            "pageLength": 10,

            "lengthChange": true,

            "ajax": {
                "url": "{{url('admin/tujuan/listtujuan')}}/param",
                "data": function(d) {
                    d.param = $('input[name="param"]').val();
                }
            },

            "columns": [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    searchable: false
                },
                // {
                //     data: 'img',
                //     name: 'tujuan_foto',
                //     searchable: false,
                //     orderable: false
                // },
                {
                    data: 'tujuan_kode',
                    name: 'tujuan_kode',
                },
                {
                    data: 'tujuan_nama',
                    name: 'tujuan_nama',
                },
                {
                    data: 'tujuan_alamat',
                    name: 'tujuan_alamat',
                },
                // {
                //     data: 'satuan',
                //     name: 'satuan_nama',
                // },
                // {
                //     data: 'merk',
                //     name: 'merk_nama'
                // },
                // {
                //     data: 'totalstok',
                //     name: 'tujuan_stok'
                // },
                // {
                //     data: 'currency',
                //     name: 'tujuan_harga'
                // },
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
@endsection
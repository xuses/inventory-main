@extends('Master.Layouts.app', ['title' => $title])

@section('content')
<!-- PAGE-HEADER -->
<div class="page-header">
    <h1 class="page-title">{{$title}}</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item text-gray">Master Data</li>
            <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->

<!-- ROW -->
<div class="row row-sm">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header justify-content-between">
                <h3 class="card-title">Data</h3>
                @if($hakTambah > 0)
                <div>
                    <a class="modal-effect btn btn-primary-light" onclick="generateID()" data-bs-effect="effect-super-scaled" data-bs-toggle="modal" href="#modaldemo8">Tambah Data <i class="fe fe-plus"></i></a>
                </div>
                @endif
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table-1" class="table table-bordered text-nowrap border-bottom dataTable no-footer dtr-inline collapsed">
                        <thead>
                            <th class="border-bottom-0" width="1%">No</th>
                            <th class="border-bottom-0">Kode Tujuan</th>
                            <th class="border-bottom-0">Nama Tujuan</th>
                            <th class="border-bottom-0">Alamat</th>
                            <th class="border-bottom-0" width="1%">Action</th>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END ROW -->

@include('Admin.Tujuan.tambah')
@include('Admin.Tujuan.edit')
@include('Admin.Tujuan.hapus')

<script>
    function generateID(){
        id = new Date().getTime();
        $("input[name='kode']").val("TJN-"+id);
    }
    function update(data){
        $("input[name='idtujuanU']").val(data.tujuan_id);
        $("input[name='kodeU']").val(data.tujuan_kode);
        $("input[name='namaU']").val(data.tujuan_nama.replace(/_/g, ' '));
        $("input[name='alamatU']").val(data.tujuan_alamat.replace(/_/g, ' '));
    }
    function hapus(data) {
        $("input[name='idtujuan']").val(data.tujuan_id);
        $("#vtujuan").html("tujuan " + "<b>" + data.tujuan_nama.replace(/_/g, ' ') + "</b>");
    }
    function validasi(judul, status) {
        swal({
            title: judul,
            type: status,
            confirmButtonText: "Iya"
        });
    }
</script>
@endsection

@section('scripts')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var table;
    $(document).ready(function() {
        //datatables
        table = $('#table-1').DataTable({
            "processing": true,
            "serverSide": true,
            "info": true,
            "order": [],
            "stateSave":true,
            "scrollX": true,
            "lengthMenu": [
                [5, 10, 25, 50, 100],
                [5, 10, 25, 50, 100]
            ],
            "pageLength": 10,
            lengthChange: true,
            "ajax": {
                "url": "{{route('tujuan.gettujuan')}}",
            },
            "columns": [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    searchable: false
                },
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
                    name: 'tujuan_alamat'
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
</script>
@endsection
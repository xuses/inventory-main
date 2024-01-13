<!-- MODAL TAMBAH -->
<div class="modal fade" data-bs-backdrop="static" id="modaldemo8">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Tambah Tujuan</h6><button onclick="reset()" aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-7">
                        <div class="form-group">
                            <label for="bk_tujuan" class="form-label">Kode Tujuan <span class="text-danger">*</span></label>
                            <input type="text" name="bk_tujuan" readonly class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="lokasi_nama" class="form-label">Nama Tujuan <span class="text-danger">*</span></label>
                            <input type="text" name="lokasi_nama" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="lokasi_alamat" class="form-label">Alamat Tujuan <span class="text-danger">*</span></label>
                            <input type="text" name="lokasi_alamat" class="form-control">
                        </div>
                        
                        
                        
                    </div>
                    
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary d-none" id="btnLoader" type="button" disabled="">
                    <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
                    Loading...
                </button>
                <a href="javascript:void(0)" onclick="checkForm()" id="btnSimpan" class="btn btn-primary">Simpan <i class="fe fe-check"></i></a>
                <a href="javascript:void(0)" class="btn btn-light" onclick="reset()" data-bs-dismiss="modal">Batal <i class="fe fe-x"></i></a>
            </div>
        </div>
    </div>
</div>

@section('formTambahJS')
<script>
    function checkForm() {
        const kode = $("input[name='bk_tujuan']").val();
        const nama = $("input[name='lokasi_nama']").val();
        const alamat = $("input[name='lokasi_alamat']").val();
        setLoading(true);
        resetValid();
        if (kode == "") {
            validasi('Kode Tujuan wajib di isi!', 'warning');
            $("input[name='kode']").addClass('is-invalid');
            setLoading(false);
            return false;
        } else if (nama == "") {
            validasi('Nama Tujuan wajib di isi!', 'warning');
            $("input[name='nama']").addClass('is-invalid');
            setLoading(false);
            return false;
        } else if (alamat == "") {
            validasi('Alamat Tujuan wajib di isi!', 'warning');
            $("input[name='alamat']").addClass('is-invalid');
            setLoading(false);
            return false;
        } else {
            submitForm();
        }
    }
    function submitForm() {
        const kode = $("input[name='bk_tujuan']").val();
        const nama = $("input[name='lokasi_nama']").val();
        const alamat = $("input[name='lokasi_alamat']").val();
        //const foto = $('#GetFile')[0].files;
        var fd = new FormData();
        // Append data 
        fd.append('bk_tujuan', kode);
        fd.append('lokasi_nama', nama);
        fd.append('lokasi_alamat', alamat);
        $.ajax({
            type: 'POST',
            url: "{{route('tujuan.store')}}",
            processData: false,
            contentType: false,
            dataType: 'json',
            data: fd,
            success: function(data) {
                $('#modaldemo8').modal('toggle');
                swal({
                    title: "Berhasil ditambah!",
                    type: "success"
                });
                table.ajax.reload(null, false);
                reset();
            }
        });
    }
    function resetValid() {
        $("input[name='bk_tujuan']").removeClass('is-invalid');
        $("input[name='lokasi_nama']").removeClass('is-invalid');
        $("input[name='lokasi_alamat']").removeClass('is-invalid');
    };
    function reset() {
        resetValid();
        $("input[name='bk_tujuan']").val('');
        $("input[name='lokasi_nama']").val('');
        $("input[name='lokasi_alamat']").val('');
        setLoading(false);
    }
    
    function setLoading(bool) {
        if (bool == true) {
            $('#btnLoader').removeClass('d-none');
            $('#btnSimpan').addClass('d-none');
        } else {
            $('#btnSimpan').removeClass('d-none');
            $('#btnLoader').addClass('d-none');
        }
    }
</script>
@endsection
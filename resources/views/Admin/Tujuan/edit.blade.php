<!-- MODAL EDIT -->
<div class="modal fade" data-bs-backdrop="static" id="Umodaldemo8">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Ubah Tujuan</h6><button onclick="resetU()" aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="idtujuanU">
                <div class="row">
                    <div class="col-md-7">
                        <div class="form-group">
                            <label for="kodeU" class="form-label">Kode Tujuan <span class="text-danger">*</span></label>
                            <input type="text" name="kodeU" readonly class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="namaU" class="form-label">Nama Tujuan <span class="text-danger">*</span></label>
                            <input type="text" name="namaU" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="alamatU" class="form-label">Alamat Tujuan <span class="text-danger">*</span></label>
                            <input type="text" name="alamatU" class="form-control">
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success d-none" id="btnLoaderU" type="button" disabled="">
                    <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
                    Loading...
                </button>
                <a href="javascript:void(0)" onclick="checkFormU()" id="btnSimpanU" class="btn btn-success">Simpan Perubahan <i class="fe fe-check"></i></a>
                <a href="javascript:void(0)" class="btn btn-light" onclick="resetU()" data-bs-dismiss="modal">Batal <i class="fe fe-x"></i></a>
            </div>
        </div>
    </div>
</div>

@section('formEditJS')
<script>
    function checkFormU() {
        const kode = $("input[name='kodeU']").val();
        const nama = $("input[name='namaU']").val();
        const alamat = $("input[name='alamatU']").val();
        //const stok = $("input[name='stokU']").val();
        setLoadingU(true);
        resetValidU();
        if (kode == "") {
            validasi('Kode Tujuan wajib di isi!', 'warning');
            $("input[name='kodeU']").addClass('is-invalid');
            setLoadingU(false);
            return false;
        } else if (nama == "") {
            validasi('Nama Tujuan wajib di isi!', 'warning');
            $("input[name='namaU']").addClass('is-invalid');
            setLoadingU(false);
            return false;
        } else if (alamat == "") {
            validasi('Alamat Tujuan wajib di isi!', 'warning');
            $("input[name='alamatU']").addClass('is-invalid');
            setLoadingU(false);
            return false;
        }else {
            submitFormU();
        }
    }
    function submitFormU() {
        const id = $("input[name='idtujuanU']").val();
        const kode = $("input[name='kodeU']").val();
        const nama = $("input[name='namaU']").val();
        //const jenistujuan = $("select[name='jenistujuanU']").val();
        //const satuan = $("select[name='satuanU']").val();
        //const merk = $("select[name='merkU']").val();
        const alamat = $("input[name='alamatU']").val();
        //const stok = $("input[name='stokU']").val();
        //const foto = $('#GetFileU')[0].files;

        var fd = new FormData();

        // Append data 
        //fd.append('foto', foto[0]);
        fd.append('kode', kode);
        fd.append('nama', nama);
        //fd.append('jenistujuan', jenistujuan);
        //fd.append('satuan', satuan);
        //fd.append('merk', merk);
        fd.append('alamat', alamat);
        //fd.append('stok', stok);
        $.ajax({
            type: 'POST',
            url: "{{url('admin/tujuan/proses_ubah')}}/" + id,
            processData: false,
            contentType: false,
            dataType: 'json',
            data: fd,
            success: function(data) {
                swal({
                    title: "Berhasil diubah!",
                    type: "success"
                });
                $('#Umodaldemo8').modal('toggle');
                table.ajax.reload(null, false);
                resetU();
            }
        });
    }
    function resetValidU() {
        $("input[name='kodeU']").removeClass('is-invalid');
        $("input[name='namaU']").removeClass('is-invalid');
        //$("select[name='jenistujuanU']").removeClass('is-invalid');
        //$("select[name='satuanU']").removeClass('is-invalid');
        //$("select[name='merkU']").removeClass('is-invalid');
        $("input[name='alamatU']").removeClass('is-invalid');
        //$("input[name='stokU']").removeClass('is-invalid');
    };
    function resetU() {
        resetValidU();
        $("input[name='idtujuanU']").val('');
        $("input[name='noU']").val('');
        $("input[name='namaU']").val('');
        //$("select[name='jenistujuanU']").val('');
        //$("select[name='satuanU']").val('');
        //$("select[name='merkU']").val('');
        $("input[name='alamatU']").val('');
        $("input[name='kodeU']").val('');
        //$("#outputImgU").attr("src", "{{url('/assets/default/tujuan/image.png')}}");
        //$("#GetFileU").val('');
        setLoadingU(false);
    }
    function setLoadingU(bool) {
        if (bool == true) {
            $('#btnLoaderU').removeClass('d-none');
            $('#btnSimpanU').addClass('d-none');
        } else {
            $('#btnSimpanU').removeClass('d-none');
            $('#btnLoaderU').addClass('d-none');
        }
    }
    // function fileIsValidU(fileName) {
    //     var ext = fileName.match(/\.([^\.]+)$/)[1];
    //     ext = ext.toLowerCase();
    //     var isValid = true;
    //     switch (ext) {
    //         case 'png':
    //         case 'jpeg':
    //         case 'jpg':
    //         case 'svg':
    //             break;
    //         default:
    //             this.value = '';
    //             isValid = false;
    //     }
    //     return isValid;
    // }
    // function VerifyFileNameAndFileSizeU() {
    //     var file = document.getElementById('GetFileU').files[0];
    //     if (file != null) {
    //         var fileName = file.name;
    //         if (fileIsValidU(fileName) == false) {
    //             validasi('Format bukan gambar!', 'warning');
    //             document.getElementById('GetFileU').value = null;
    //             return false;
    //         }
    //         var content;
    //         var size = file.size;
    //         if ((size != null) && ((size / (1024 * 1024)) > 3)) {
    //             validasi('Ukuran Maximum 1 MB', 'warning');
    //             document.getElementById('GetFileU').value = null;
    //             return false;
    //         }
    //         var ext = fileName.match(/\.([^\.]+)$/)[1];
    //         ext = ext.toLowerCase();
    //         document.getElementById('outputImgU').src = window.URL.createObjectURL(file);
    //         return true;
    //     } else
    //         return false;
    // }
</script>
@endsection
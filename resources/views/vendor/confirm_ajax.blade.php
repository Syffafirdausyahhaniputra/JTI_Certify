@empty($vendor) 
    <div id="modal-master" class="modal-dialog modal-lg" vendor="document"> 
        <div class="modal-content"> 
            <div class="modal-header"> 
                <h5 class="modal-title" id="exampleModalLabel">Kesalahan</h5> 
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> 
            </div> 
            <div class="modal-body"> 
                <div class="alert alert-danger"> 
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!!!</h5> 
                    Data yang anda cari tidak ditemukan
                </div> 
                <a href="{{ url('/vendor') }}" class="btn btn-warning">Kembali</a> 
            </div> 
        </div> 
    </div> 
@else 
<form action="{{ url('/vendor/' . $vendor->vendor_id . '/delete_ajax') }}" method="POST" id="form-delete-vendor"> 
    @csrf 
    @method('DELETE') 
    <div id="modal-master" class="modal-dialog modal-lg" vendor="document"> 
        <div class="modal-content"> 
            <div class="modal-header"> 
                <h5 class="modal-title" id="exampleModalLabel">Hapus Vendor</h5> 
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> 
            </div> 
            <div class="modal-body"> 
                <div class="alert alert-warning"> 
                    <h5><i class="icon fas fa-ban"></i> Konfirmasi !!!</h5> 
                    Apakah Anda ingin menghapus data berikut? 
                </div> 
                <table class="table table-sm table-bordered table-striped">
                    <tr><th class="text-right col-3">Nama Vendor :</th><td class="col-9">{{ $vendor->vendor_nama }}</td></tr>
                    <tr><th class="text-right col-3">Alamat Vendor :</th><td class="col-9">{{ $vendor->vendor_alamat }}</td></tr>
                    <tr><th class="text-right col-3">Kota Vendor :</th><td class="col-9">{{ $vendor->vendor_kota }}</td></tr>
                    <tr><th class="text-right col-3">No Telfon Vendor :</th><td class="col-9">{{ $vendor->vendor_no_telf }}</td></tr>
                    <tr><th class="text-right col-3">Alamat Web Vendor :</th><td class="col-9">{{ $vendor->vendor_alamat_web }}</td></tr>
                </table> 
            </div> 
            <div class="modal-footer"> 
                <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button> 
                <button type="submit" class="btn btn-primary">Ya, Hapus</button> 
            </div> 
        </div> 
    </div> 
</form> 
<script> 
    $(document).ready(function() { 
        $("#form-delete-vendor").validate({ 
            rules: {}, 
            submitHandler: function(form) { 
                $.ajax({
                    url: form.action, 
                    type: form.method, 
                    data: $(form).serialize(), 
                    success: function(response) { 
                        if(response.status){ 
                            $('#myModal').modal('hide'); 
                            Swal.fire({ 
                                icon: 'success', 
                                title: 'Berhasil', 
                                text: response.message 
                            }); 
                            datavendor.ajax.reload(); 
                        }else{ 
                            Swal.fire({ 
                                icon: 'error', 
                                title: 'Terjadi Kesalahan', 
                                text: response.message 
                            }); 
                        } 
                    }             
                }); 
                return false; 
            }, 
            errorElement: 'span', 
            errorPlacement: function (error, element) { 
                error.addClass('invalid-feedback'); 
                element.closest('.form-group').append(error); 
            }, 
            highlight: function (element, errorClass, validClass) { 
                $(element).addClass('is-invalid'); 
            }, 
            unhighlight: function (element, errorClass, validClass) { 
                $(element).removeClass('is-invalid'); 
            } 
        }); 
    }); 
</script> 
@endempty
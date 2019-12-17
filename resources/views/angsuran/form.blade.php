<div class="modal" id="modal-form" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data">
                {{ csrf_field() }} {{ method_field('POST') }}

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"> &times; </span>
                    </button>
                    <h3 class="modal-title"></h3>
                </div>

                <div class="modal-body">
                    
                    <input type="hidden" id="idAngsuran" name="idAngsuran">

                    <div class="form-group">
                        <label for="idPinjaman" class="col-md-3 control-label">ID Pinjaman</label>
                        <div class="col-md-6">
                            {{-- <input type="number" id="idNasabah" name="idNasabah" class="form-control" autofocus required> --}}
                            <select id="idPinjaman" name="idPinjaman" class="form-control" id="exampleFormControlSelect1">
                                
                              </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="jmlAngsuran" class="col-md-3 control-label">Jumlah Angsuran (Rp)</label>
                        <div class="col-md-6">
                            <input type="number" id="jmlAngsuran" name="jmlAngsuran" class="form-control" autofocus required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="keterangan" class="col-md-3 control-label">Keterangan</label>
                        <div class="col-md-6">
                            <input type="text" id="keterangan" name="keterangan" class="form-control" autofocus required>
                            <span class="help-block with-errors"></span>
                        </div>
                </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-save">Submit</button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
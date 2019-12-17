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
                    
                    <input type="hidden" id="idPinjaman" name="idPinjaman">

                    <div class="form-group">
                        <label for="idNasabah" class="col-md-3 control-label">Nama Nasabah</label>
                        <div class="col-md-6">
                            {{-- <input type="number" id="idNasabah" name="idNasabah" class="form-control" autofocus required> --}}
                            <select id="idNasabah" name="idNasabah" class="form-control" id="exampleFormControlSelect1">
                                
                              </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group">
                            <label for="bunga" class="col-md-3 control-label">Bunga (%)</label>
                            <div class="col-md-6">
                                <input type="number" id="bunga" name="bunga" class="form-control" autofocus required>
                                <span class="help-block with-errors"></span>
                            </div>
                    </div>

                    <div class="form-group">
                        <label for="jmlPinjam" class="col-md-3 control-label">Jumlah Pinjaman (Rp)</label>
                        <div class="col-md-6">
                            <input type="number" id="jmlPinjam" name="jmlPinjam" class="form-control" autofocus required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group">
                            <label for="phone" class="col-md-3 control-label">Status</label>
                            <div class="col-md-6">
                                <select id="status" name="status" class="form-control" id="status">
                                    <option value="aktif" name="aktif"> aktif </option>
                                    <option value="nonaktif" name="nonaktif"> nonaktif </option>
                                  </select>
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
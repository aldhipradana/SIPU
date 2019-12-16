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
                    
                    <input type="hidden" id="idNasabah" name="idNasabah">

                    <div class="form-group">
                        <label for="firstname" class="col-md-3 control-label">First Name</label>
                        <div class="col-md-6">
                            <input type="text" id="firstname" name="firstname" class="form-control" autofocus required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group">
                            <label for="lastname" class="col-md-3 control-label">Last Name</label>
                            <div class="col-md-6">
                                <input type="text" id="lastname" name="lastname" class="form-control" autofocus required>
                                <span class="help-block with-errors"></span>
                            </div>
                    </div>

                    <div class="form-group">
                            <label for="email" class="col-md-3 control-label">Email</label>
                            <div class="col-md-6">
                                <input type="email" id="email" name="email" class="form-control" autofocus required>
                                <span class="help-block with-errors"></span>
                            </div>
                    </div>

                    <div class="form-group">
                            <label for="phone" class="col-md-3 control-label">Phone</label>
                            <div class="col-md-6">
                                <input type="tel" id="phone" name="phone" class="form-control" autofocus required>
                                <span class="help-block with-errors"></span>
                            </div>
                    </div>

                    <div class="form-group">
                            <label for="alamat" class="col-md-3 control-label">Alamat</label>
                            <div class="col-md-6">
                                <input type="text" id="alamat" name="alamat" class="form-control" autofocus required>
                                <span class="help-block with-errors"></span>
                            </div>
                    </div>

                    <div class="form-group">
                        <label for="photo" class="col-md-3 control-label">Photo</label>
                        <div class="col-md-6">
                            <input type="file" id="photo" name="photo" class="form-control">
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
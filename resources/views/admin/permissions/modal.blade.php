<!-- Modal -->
<div class="modal fade modalEditPermission" id="modalEditPermission" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="container">
                    <div class="row">
                        <div class="col-md-9">
                            <div>
                                <h4>Edit User</h4>
                            </div>
                        </div>
                        <div class="col-md-3" style="text-align: right;">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-body" id="modalEditPermissionContent">


            </div>
            <div class="modal-footer">
                <button type="button" id="close" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" onclick="editPermissionInModal()" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
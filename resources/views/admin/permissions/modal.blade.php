<!-- Modal -->
<div class="modal fade modalEditPermission" id="modalEditPermission" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: none;">
                <div style="text-align: right;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div>
                    <h3>Edit Permission</h3>
                </div>
            </div>
            <div class="modal-body" id="modalEditPermissionContent" style="padding: 0px">


            </div>
            <div class="modal-footer">
                <button type="button" id="close" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" onclick="editPermissionInModal()" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
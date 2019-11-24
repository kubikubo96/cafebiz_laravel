<!-- Modal -->
<div class="modal fade editUserModal" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: none;">
                <div style="text-align: right;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div>
                    <h3>Edit User</h3>
                </div>
            </div>
            <div class="modal-body" id="modalEditUserContent" style="padding: 0;">


            </div>
            <div class="modal-footer">
                <button type="button" id="close" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" onclick="editUserInModal()" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade modalEditRole" id="modalEditRole" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <form action="{{route('admin.roles.edit')}}" id="editRole" name="editRole" method="POST">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="border-bottom: none;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div>
                        <h3>Edit Role</h3>
                    </div>

                </div>
                <div class="modal-body" id="modalEditRoleContent" style="padding: 0;">


                </div>
                <div class="modal-footer">
                    <button type="button" id="close" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </form>
</div>
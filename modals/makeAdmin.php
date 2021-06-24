<div class="modal fade w-100 d-flex align-items-center justify-content-center" id="makeAdmin" tabindex="-1" role="dialog" aria-labelledby="confirmModalTitle"
    aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered backdrop-filter" role="document">
        <div class="modal-content rounded-0 shadow-md">
            <div class="modal-header bg-danger text-white rounded-0 d-flex justify-content-between px-1 py-1">
                <h4 class="modal-title" id="confirmModalTitle">
                    <i class="fas fa-user-shield fa-fw"></i> Change User Role
                </h4>

                <a href="#" class="h4" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </a>

            </div>
            <div class="modal-body bg-white justify-content-center align-items-center p-1">
<!--
                <div class="form-group d-flex flex-column">
                    <label>User Role</label>
                    <select id="isAdmin" class="form-control w-100">
                        <option value="user">Member</option>
                        <option value="admin">Administrator</option>
                    </select>
                </div>
-->
                <h4>Make User Administrator?</h4>
                <div class="d-flex justify-content-start m-1">
                    <div class="form-group">
                        <input type="radio" name="isAdmin" value="YES" id="yesAdmin"/>
                        <label>YES</label>
                    </div>
                     <div class="form-group">
                        <input type="radio" name="isAdmin" value="NO" id="noAdmin"/>
                        <label>NO</label>
                    </div>
                </div>
                <input type="text" name="adminPassword" class="form-control w-100 d-none" placeholder="Password"/>
            </div>
            <div class="modal-footer bg-white d-flex justify-content-end pt-1">
                <a href="#" class="btn btn-light shadow text-dark" data-dismiss="modal">Close</a>
                <button type="submit" class="ml-1 btn btn-danger text-white shadow">
                    <i class="fas fa-check-circle"></i> Change
                </button>
            </div>
        </div>
    </div>
</div>

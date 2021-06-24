<div class="modal overflow-y-auto w-100 d-flex align-items-center justify-content-center" id="userModal" tabindex="-1"
    role="dialog" aria-labelledby="confirmModalTitle" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered backdrop-filter" role="document">
        <div class="modal-content w-80 rounded-0 shadow-md">
            <div class="modal-header bg-danger text-white rounded-0 d-flex justify-content-between px-1 py-1">
                <h4 class="modal-title" id="confirmModalTitle">
                    <i class="fas fa-exclamation-circle fa-fw"></i> <span class="modal-title-text">Registration Form</span>
                </h4>

                <a href="#" class="fs-1em" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </a>

            </div>
            <div class="modal-body w-100 overflow-y-auto bg-white">
                <div class="pb-2 px-1 mb-1">
                    <form action="/redcross/members/add.php" method="POST" id="memberForm">
			<div class="d-flex m-flex-wrap justify-content-between">
			    <div class="d-flex flex-wrap justify-content-between">
	                        <input type="text" class="form-control mr-1 mt-1" name="userid" placeholder="ID Number" required>
	                        <input type="text" class="form-control mr-1 mt-1" name="firstname" placeholder="First Name" required>
	                        <input type="text" class="form-control mr-1 mt-1" name="lastname" placeholder="Last Name" required>
	                        <input type="text" class="form-control mr-1 mt-1" name="phonenumber" inputmode="numeric" placeholder="Phone Number" required>
	                        <input type="email" class="form-control mr-1 mt-1" name="email" placeholder="Email Address" required>
	                        <input type="text" class="form-control mr-1 mt-1" name="residence" placeholder="Residence" required>
	                        <select class="form-control mr-1 mt-1" name="gender" required>
	                            <option selected>Gender</option>
	                            <?php
	                                foreach($genders as $gender){
	                                    echo "<option value='$gender'>".ucfirst(strtolower($gender))."</option>";
	                                }
	                            ?> 
	                        </select>
	                        <select class="form-control mr-1 mt-1" name="district_id" required>
	                            <option selected>District</option>
	                            <?php
	                                foreach($districts as $district){
	                                    echo "<option value='".$district['id']."'>".ucfirst(strtolower($district['name']))."</option>";
	                                }
	                            ?> 
	                        </select>
	                        <select class="form-control mr-1 mt-1" name="rank_id" required>
	                            <option selected>Rank</option>
	                            <?php
	                                foreach($ranks as $rank){
	                                    echo "<option value='".$rank['id']."'>".ucfirst(strtolower($rank['name']))."</option>";
	                                }
	                            ?> 
	                        </select>
	                        <select class="form-control mr-1 mt-1" name="designation" required> 
	                            <option selected>Designation</option>
	                            <?php
	                                foreach($users as $user){
	                                    if (!in_array($user['designation'], $designations)){
	                                        $user_designation = $user['designation'];
	                                        array_push($designations, $user_designation);
	                                        echo "<option value='$user_designation'>".ucfirst(strtolower($user_designation))."</option>";
	                                    }
	                                }
	                            ?> 
	                        </select>
	                        <select class="form-control mr-1 mt-1" name="educationLevel" required>
	                            <option selected>Education Level</option>
	                            <?php
	                                foreach($educationLevels as $level){
	                                    echo "<option value='$level'>".ucfirst(strtolower($level))."</option>";
	                                }
	                            ?> 
	                        </select>
	                     
			    </div>
			    <div class="mt-1 w-100 d-flex flex-wrap justify-content-center align-items-end">
				<div class="picture-box" id="pictureBox">
	                            <img src="/redcross/pic/cloud-upload.png" alt="upload icon" onclick="getImage()">
	                            <input type="file" name="picture" accept="image/*" style="display:none" id="pictureInput"
	                                onchange="handleFiles(this)">
	                        </div>
							    </div>
			</div>
</div>
<hr>
<div class="filter mt-1 d-flex justify-content-end">
	                            <a href="#"
	                                class="btn mr-1 d-flex align-items-center rounded-0 text-dark shadow">
	                                <i class="fas fa-times fa-fw"></i> <span class="fw-700">Close</span>
	                            </a>
	                            <button type="submit" onclick="addMember()" 
	                                class="btn btn-primary rounded-0 d-flex align-items-center text-white shadow">
	                                <i class="fas fa-save fa-fw"></i> <span class="fw-700">Submit</span>
	                            </button>
                        	</div>

                      
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

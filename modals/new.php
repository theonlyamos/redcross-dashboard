<div class="modal fade w-100 d-flex align-items-center justify-content-center" id="userModal" tabindex="-1"
    role="dialog" aria-labelledby="confirmModalTitle" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered backdrop-filter" role="document">
        <div class="modal-content rounded-0 shadow-md">
            <div class="modal-header bg-danger text-white rounded-0 d-flex justify-content-between px-1 py-1">
                <h4 class="modal-title" id="confirmModalTitle">
                    <i class="fas fa-exclamation-circle fa-fw"></i> Registration Form
                </h4>

                <a href="#" class="h4" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </a>

            </div>
            <div class="modal-content w-100 overflow-y-auto">
                <section class="registration-form">
                    <?php 

            if(isset($_SESSION['error']) && $_SESSION['error']) {
                echo "<h5 class='error-message'><b>Error adding record to database</b></h5>";
            }  
        $_SESSION['error'] = false;
        ?>
                    <form id="registration" method="post" action="/redcross/members/add/registration.php"
                        enctype="multipart/form-data">

                        <div class="left">
                            <input type="text" name="userid" id="userid" placeholder="Enter ID" required
                                class="in-left">

                            <input type="text" name="firstname" id="name" placeholder="Enter first Name" required
                                class="in-left">

                            <input type="text" name="lastname" id="name" placeholder="Enter last Name" required
                                class="in-left">
                        </div>

                        <div class="picture-box" id="pictureBox">
                            <img src="/redcross/pic/cloud-upload.png" alt="upload icon" onclick="getImage()">
                            <input type="file" name="picture" accept="image/*" style="display:none" id="pictureInput"
                                onchange="handleFiles(this)">
                        </div>

                        <input type="text" name="email" id="name" placeholder="Enter E-mail" required>
                        <input type="text" style="visibility: hidden">

                        <input type="text" name="designation" id="name" placeholder="Enter Designation" required>

                        <input type="text" name="residence" id="name" placeholder="Enter name of Residence" required>

                        <input type="text" name="phonenumber" inputmode="numeric" placeholder="Enter phone number"
                            required>

                        <select id="box" name="district_id" required>
                            <option value="">Choose District </option>
                            <?php
											foreach($districts as $district){
										?>
                            <option value="<?=$district['id']?>"><?=ucfirst($district['name'])?></option>
                            <?php
												}
										?>
                        </select>

                        <select name="gender" id="gender" required>
                            <option value="">Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="others">Others</option>
                        </select>

                        <select id="certification" name="educationLevel" required>
                            <option value="">Level of Education</option>
                            <option value="NONE">NONE</option>
                            <option value="PRIMARY">PRIMARY</option>
                            <option value="JHS">JHS</option>
                            <option value="SHS">SHS</option>
                            <option value="DIPLOMA">DIPLOMA</option>
                            <option value="HND">HND</option>
                            <option value="DEGREE">DEGREE</option>
                            <option value="MASTERS">MASTERS</option>
                            <option value="PHD">PHD</option>
                            <option value="DOCTORATE">DOCTORATE</option>
                            <option value="PROFESSOR">PROFESSOR</option>
                        </select>


                        <select name="rank" id="rank" class="rank" required>
                            <option value="">Select Rank</option>
                            <?php
											foreach($ranks as $rank){
										?>
                            <option value="<?=$rank['id']?>"><?=ucfirst($rank['name'])?></option>
                            <?php
												}
										?>

                        </select>

                        <input type="text" style="visibility:hidden">

                        <button type="submit" class="submit" id="submit" name="SUBMIT">Submit</button>
                    </form>
                </section>
            </div>
        </div>
    </div>
</div>
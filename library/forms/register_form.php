<div class="container">
        <div class="row main">
            <div class="text-dark ml-5">
                <h1 class="text-center"><img style="border-radius: 50%; " src="img/logo/cot.jpg" alt="Theology" height="80" width="80"> Sign Up In the College of Theology</h1>
                <h5 class="text-center">Join In Our Community Now <br><br>We have <?php echo htmlspecialchars($user_count); ?> registered users now</h5>
                <br>
                    <form class="form-horizontal" method="post" action="Register.php" enctype="multipart/form-data">
                    <div class="row">   
                        <div class="form-group col-md-6">
                            <label for="lastname" class="cols-sm-2 control-label">Last Name</label>
                            <div class="cols-sm-10">
                                    <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last Name" required>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="firstname" class="cols-sm-2 control-label">First Name</label>
                            <div class="cols-sm-10">
                                    <input type="text" class="form-control" name="firstname" id="firstname"  placeholder="First Name" required />
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="midname" class="cols-sm-2 control-label">Middle Name</label>
                            <div class="cols-sm-10">
                                    <input type="text" class="form-control" name="midname" id="book_title"  placeholder="Middle Name" required />
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="gender" class="cols-sm-2 control-label">Type</label>
                            <div class="cols-sm-10">
                                <select id="type" class="form-control" name="type" required>
                                    <option value="">Type</option>
                                    <option value="Student">Student</option>
                                    <option value="Teacher">Teacher</option>
                                    <option value="Alumni">Alumni</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="gender" class="cols-sm-2 control-label">Gender</label>
                            <div class="cols-sm-10">
                                <select id="gender" class="form-control" name="gender" required>
                                    <option value="">Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                         <div class="form-group col-md-6">
                            <label for="gender" class="cols-sm-2 control-label">Birthday</label>
                            <div class="cols-sm-10">
                                <input class="form-control" type="date" name="birthday" id="birthday" required>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email" class="cols-sm-2 control-label">Email</label>
                            <div class="cols-sm-10">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" required />
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="contact_num" class="cols-sm-2 control-label">Contact Number</label>
                            <div class="cols-sm-10">
                                    <input type="text" class="form-control" name="contact_num" id="contact_num"  placeholder="Contact Number" maxlength="11" required />
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="username" class="cols-sm-2 control-label">Username</label>
                            <div class="cols-sm-10">
                                    <input class="form-control" type="text" name="username" id="username" placeholder="Username" required>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password" class="cols-sm-2 control-label">Password</label>
                            <div class="cols-sm-10">
                                    <input class="form-control" type="password" name="password" id="password" placeholder="Password" required>
                            </div>
                        </div>
                            <div class="form-group col-md-6">
                                <label for="confirm_pass" class="cols-sm-2 control-label">Confirm Password</label>
                                <div class="cols-sm-10">
                                        <input class="form-control" type="password" name="confirm_pass" id="confirm_pass" placeholder="Confirm Password" required>
                                </div>
                            </div>
                        <div class="form-group mx-auto col-md-6">
                            <button class="btn btn-success btn-lg col-md-10"  name="register" id="register">REGISTER</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    <script>
        var type = document.getElementById('type').value;
        var gender = document.getElementById('gender').value;

        if (type == " ") {
            alert('Please specify your type ');
        } else if(gender == " ") {
            alert('Please specify your gender');
        }
    </script>
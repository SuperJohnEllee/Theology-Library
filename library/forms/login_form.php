<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center text-dark mb-4">College of Theology Library</h2>
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="card rounded-0">
                        <div class="card-header mdb-color darken-4">
                            <h3 class="text-center text-white mb-0">Sign In To Avail Our Services</h3>
                        </div>
                        <div class="card-body">
                            <form class="form" action="login.php" method="post" role="form" autocomplete="off" id="formLogin">
                                <div class="md-form">
                                    <i class="fa fa-user prefix text-dark"></i>
                                    <input id="username" type="text" class="form-control form-control-lg rounded-0" name="username" required>
                                    <label for="user">Username</label>
                                </div>
                                <div class="md-form">
                                    <i class="fa fa-lock prefix text-dark"></i>
                                    <input id="password" type="password" name="password" class="form-control form-control-lg rounded-0" required>
                                    <label for="password">Password</label>
                                     <a id="show_pass" href="#" style="text-decoration: none;" class="btn btn-default text-white"><i class="fa fa-eye"></i>&nbsp;Show</a>
                                </div>
                                <button value="Login" type="submit" class="btn btn-success btn-lg float-right" name="login" id="login" data-loading-text="Logging in..."><i class="fa fa-sign-in"></i>&nbsp;Login</button>
                            </form>
                            <div class="form-group">
                                <div class="col-md-4">
                                    <p><a class="text-info font-weight-bold" href="forgot_pass.php">Forgot Password?</a></p>
                                </div>
                            </div>
                            <div class="form-group font-weight-bold">
                                <p class="text-dark">Don't Have an Account? <a class="text-info" href="Register.php">Sign Up here</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    </div>
</div>
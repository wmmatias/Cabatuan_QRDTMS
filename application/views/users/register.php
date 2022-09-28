    <div class="container-fluid px-4">
        <div id="signup" class="row">
            <div class="alert"><?=$this->session->flashdata('input_errors');?></div>
            <div class="form col-md-5 offset-md-4 mt-5 border">
                <h1>Register</h1>              
                <form action="register/validate" method="POST">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                    <div class="form-group row mt-3">
                        <label for="email_Address" class="col-sm-4 col-form-label">Email Address:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="email">
                        </div>
                    </div>
                    <div class="form-group row mt-3">
                        <label for="first_Name" class="col-sm-4 col-form-label">First Name:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="first_name">
                        </div>
                    </div>
                    <div class="form-group row mt-3">
                        <label for="last_Name" class="col-sm-4 col-form-label">Last Name:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="last_name">
                        </div>
                    </div>
                    <div class="form-group row mt-3">
                        <label for="password" class="col-sm-4 col-form-label">Password:</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                    </div>
                    <div class="form-group row mt-3">
                        <label for="Confirm_password" class="col-sm-4 col-form-label">Confirm Password:</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" name="Confirm_password">
                        </div>
                    </div>
                    <div class="form-group row mt-3">
                        <label for="" class="col-sm-4 col-form-label"></label>
                        <div class="col-sm-8">
                            <input type="hidden" name="action" value="signup">
                            <input type="submit" class="btn btn-success float-end" value="Submit">
                        </div>
                    </div>
                    <div class="form-group row mt-1">
                        <label for="question" class="col-sm-10 col-form-label"><a id="loginhere" href="signin">Already have an account? Login.</a></label>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
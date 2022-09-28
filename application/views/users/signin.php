<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
    <div class="container-fluid px-4">
        <div id="login" class="row">
            <div class="form row align-items-start mt-5">
                <div class="col-md-4 offset-md-1 border bg-light bg-gradient">
                    <h1>Login</h1>
                    <?=$this->session->flashdata('input_errors');?>          
                    <form action="signin/validate" method="POST">
                        <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" />
                        <div class="form-group row mt-3">
                            <label for="user_name" class="col-sm-4 col-form-label">User Name:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="user_name" required>
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <label for="password" class="col-sm-4 col-form-label">Password:</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" name="password" required>
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <label for="" class="col-sm-4 col-form-label"></label>
                            <div class="col-sm-8">
                                <input type="submit" class="btn btn-success float-end" value="Login">
                            </div>
                        </div>
                        <div class="form-group row mt-1">
                            <label for="question" class="col-sm-10 col-form-label">You dont have an account? <span class="d-block">Please contact your system administrator.</span></label>
                        </div>
                    </form>
                </div>
                <div class="logo_container col-md-7 text-center position-relative">
                    <div class="">
                        <img src="/assets/images/isabela animated.gif" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
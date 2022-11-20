<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Credential</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"> <a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item active">Credential</li>
                        </ol>
<?php                   if($this->session->flashdata('success')){
?>                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <?=$this->session->flashdata('success');?> 
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
<?php                   }
?>                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <!-- <div class="col">
                                        <p>User Details</p>
                                        <hr>
                                        <form action="" method="post">
                                            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" />
                                            <div class="mb-2 row">
                                                <div class="col">
                                                    <input type="text" name="firstname" class="form-control" placeholder="First Name" value="<?=$details['first_name']?>">
                                                </div>
                                            </div>
                                            <div class="mb-2 row">
                                                <div class="col">
                                                    <input type="text" name="lastname" class="form-control" placeholder="Last Name" value="<?=$details['last_name']?>">
                                                </div>
                                            </div>
                                            <div class="mb-2 row">
                                                <div class="col">
                                                    <input type="text" name="username" class="form-control" placeholder="User Name" value="<?=$details['user_name']?>">
                                                </div>
                                            </div>
                                            <div class="mb-2 row">
                                                <div class="col">
                                                    <input type="email" name="email" class="form-control" placeholder="Email" value="<?=$details['email']?>">
                                                </div>
                                            </div>
                                            <input type="hidden" name="id" value="<?=$details['id']?>">
                                            <button type="submit" class="btn btn-primary">Update Details</button>
                                        </form>
                                    </div> -->
                                    <div class="col">
                                        <p>Change Password</p>
                                        <hr>
                                        <form action="/users/credentials" method="post">
                                            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" />
                                            <div class="mb-2 row">
                                                <div class="col">
                                                    <input type="password" name="current" class="form-control" placeholder="Current Password">
                                                    <?php echo form_error('current') ?>
                                                    <?=$this->session->flashdata('old_pass');?>
                                                </div>
                                            </div>
                                            <div class="mb-2 row">
                                                <div class="col">
                                                    <input type="password" name="new" class="form-control" placeholder="New Password">
                                                    <?php echo form_error('new') ?>
                                                </div>
                                            </div>
                                            <div class="mb-2 row">
                                                <div class="col">
                                                    <input type="password" name="cnew" class="form-control" placeholder="Confirm New Password">
                                                    <?php echo form_error('cnew') ?>
                                                </div>
                                            </div>
                                            <input type="hidden" name="id" value="<?=$details['id']?>">
                                            <button type="submit" class="btn btn-primary">Update Credentials</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                
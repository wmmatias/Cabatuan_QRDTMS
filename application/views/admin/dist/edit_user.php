<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Edit User</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"> <a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item"> <a href="/dashboard/users">Users</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
<?php                   if($this->session->flashdata('success')){
?>                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <?=$this->session->flashdata('success');?> 
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
<?php                   }
?>                        <div class="card mb-4">
                            <div class="card-body">
                                <?=$this->session->flashdata('input_errors');?>
                                <form action="/users/edit/(:any)/validate" method="POST">
                                    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" />
                                    <div class="mb-2 row">
                                        <label for="firstname" class="col-sm-2 col-form-label">First Name:</label>
                                        <div class="col-sm-4">
                                            <input type="text" value="<?=$list['first_name']?>" name="firstname" class="form-control">
                                        </div>
                                    </div>
                                    <div class="mb-2 row">
                                        <label for="lastname" class="col-sm-2 col-form-label">Last Name:</label>
                                        <div class="col-sm-4">
                                            <input type="text" value="<?=$list['last_name']?>" name="lastname" class="form-control">
                                        </div>
                                    </div>
                                    <div class="mb-2 row">
                                        <label for="username" class="col-sm-2 col-form-label">User Name:</label>
                                        <div class="col-sm-4">
                                            <input type="text" value="<?=$list['user_name']?>" name="username" class="form-control">
                                        </div>
                                    </div>
                                    <div class="mb-2 row">
                                        <label for="email" class="col-sm-2 col-form-label">Email:</label>
                                        <div class="col-sm-4">
                                            <input type="email" value="<?=$list['email']?>" name="email" class="form-control">
                                        </div>
                                    </div>
                                    <div class="mb-2 row">
                                        <label for="userlevel" class="col-sm-2 col-form-label">User Level:</label>
                                        <div class="col-sm-4">
                                            <select name="userlevel" class="form-select">
                                                <option>Select Level</option>
                                                <option value="0" <?=($list['user_level'] === '0' ? 'selected' : '')?>>Admin</option>
                                                <option value="1" <?=($list['user_level'] === '1' ? 'selected' : '')?>>User</option>
                                                <option value="2" <?=($list['user_level'] === '2' ? 'selected' : '')?>>Approver</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mt-2 row">
                                        <div class="col-sm-4 offset-sm-2">
                                            <input type="hidden" name="id" value="<?=$list['id']?>">
                                            <input type="submit" class="btn btn-primary w-100" value="Update User">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
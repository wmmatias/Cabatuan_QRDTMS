<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Add Users</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"> <a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item"> <a href="/dashboard/users">Users</a></li>
                            <li class="breadcrumb-item active">Add</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                                    <?=$this->session->flashdata('input_errors');?> 
                                    <form action="/dashboard/create" method="POST">
                                    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" />
                                        <div class="col-md-4 mb-2">
                                            <label for="firstname" class="form-label">First Name:</label>
                                            <input type="text" name="firstname" class="form-control">
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <label for="lastname" class="form-label">Last Name:</label>
                                            <input type="text" name="lastname" class="form-control">
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <label for="username" class="form-label">User Name:</label>
                                            <input type="text" name="username" class="form-control">
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <label for="userlevel" class="form-label">User Level:</label>
                                            <select name="userlevel" class="form-select">
                                                <option>Select Level</option>
                                                <option value="0">Admin</option>
                                                <option value="1">User</option>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <input type="submit" class="btn btn-primary" value="Add User">
                                        </div>
                                    </form>
                            </div>
                        </div>
                    </div>
                
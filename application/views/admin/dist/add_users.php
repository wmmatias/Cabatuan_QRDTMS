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
                                <?=$this->session->flashdata('userlevel');?> 
                                <form action="/dashboard/create" method="POST">
                                    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" />
                                    <div class="mb-2 row">
                                        <label for="firstname" class="col-sm-2 col-form-label">First Name:</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="firstname" class="form-control">
                                        </div>
                                    </div>
                                    <div class="mb-2 row">
                                        <label for="lastname" class="col-sm-2 col-form-label">Last Name:</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="lastname" class="form-control">
                                        </div>
                                    </div>
                                    <div class="mb-2 row">
                                        <label for="username" class="col-sm-2 col-form-label">User Name:</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="username" class="form-control">
                                        </div>
                                    </div>
                                    <div class="mb-2 row">
                                        <label for="username" class="col-sm-2 col-form-label">Email:</label>
                                        <div class="col-sm-4">
                                            <input type="email" name="email" class="form-control">
                                        </div>
                                    </div>
                                    <div class="mb-2 row">
                                        <label for="userlevel" class="col-sm-2 col-form-label">User Level:</label>
                                        <div class="col-sm-4">
                                            <select id="user_level" name="userlevel" class="form-select">
                                                <option value="empty">Select Level</option>
                                                <option value="0">Admin</option>
                                                <option value="1">User</option>
                                                <option value="2">Approver</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-2 row">
                                        <label for="userlevel" class="col-sm-2 col-form-label">Approver Level:</label>
                                        <div class="col-sm-4">
                                            <select id="approver_level" name="approverlevel" class="form-select">
                                                <option value="empty">Select Level</option>
                                                <option value="0">MBO</option>
                                                <option value="1">MT</option>
                                                <option value="2">MA</option>
                                                <option value="3">MM</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mt-2 row">
                                        <div class="col-sm-4 offset-sm-2">
                                            <input type="submit" class="btn btn-primary w-100" value="Add User">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                
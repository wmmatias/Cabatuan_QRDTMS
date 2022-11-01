<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Purchace Request Item Staging</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"> <a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item active">Purchase Request</li>
                        </ol>
                        <p><strong>Note:</strong> Please set 1 vendor in every PR number, selected item may delete if you change vendor in the middle of your process</p>
                        <div class="movement_form">
                            <form class="search d-inline-block" action="requests/search" method="post">
                                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                                <div class="form-group d-inline-block align-middle m-2">
                                    <input class="form-control" type="text" id="vendorcode" name="vendorcode"  placeholder="Search by Vendor Code" value="<?=$this->session->userdata('vendor_code')?>" autofocus>
                                </div>
                                <div class="form-group d-inline-block align-middle m-2">
									<input type="hidden" name="user_id" value="<?= $this->session->userdata('user_id') ?>">
                                    <input class="form-control" type="text" id="description" name="description" placeholder="Item Description">
                                </div>
                            </form>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-table"></i> Pick items
                                    </div>
                                    <div class="pick card-body pt-0">
                                        <table class="table table-striped table-hover">
                                            <thead class="head-stick text-white bg-success">
                                                <tr>
                                                    <th>Code</th>
                                                    <th>Description</th>
                                                    <th>Unit Cost</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="item">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-table"></i> Item Staging
                                    </div>
                                    <div id="request" class="card-body pt-0">
                                    </div>
                                    <div class="card-footer text-muted">
                                        <?=$this->session->flashdata('input_errors');?>
                                        <form action="requests/generate_PR" method="post">
                                            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>"/>
                                            <input type="hidden" name="user_id" value="<?= $this->session->userdata('user_id') ?>">
                                            <button class="btn btn-success float-end">Create Request</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
<?php var_dump($_SESSION);?>
                        

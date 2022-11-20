<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Vendor</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"> <a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="/dashboard/vendor">Vendor</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                        <div class="movement_form">
                            <p>Add new vendor</p>
                            <?=$this->session->flashdata('input_errors');?> 
                            <form action="/vendors/edit/(:any)/validate" method="post">
                                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" />
                                <div class="row mb-2">
                                    <div class="col-md">
                                        <div class="col-md-4 input-group input-group-outline my-1">
                                            <input type="text" name="name" class="form-control" placeholder="Vendor Name" value="<?=$details['name']?>">
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="col-md-4 input-group input-group-outline my-1">
                                            <input type="text" name="address" class="form-control" placeholder="Vendor Address" value="<?=$details['address']?>">
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="col-md-4 input-group input-group-outline my-1">
                                            <input type="hidden" name="id" value="<?=$details['vendor_code']?>">
                                            <a href="/dashboard/vendor" class="btn btn-danger me-2 rounded"><strong>X</strong></a>
                                            <button type="submit" class="btn btn-success rounded"><i class="fas fa-save"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">
                                <p class="d-inline-block"><i class="fas fa-table"></i> List of vendors</p>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Vendor Code</th>
                                            <th>Vendor Name</th>
                                            <th>Address</th>
                                            <th>Created By</th>
                                            <th>Date Created</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php                                   for($i=0; $i<count($list); $i++){
                                            $date = date('m-d-Y', strtotime($list[$i]['created_at']));
?>                                        <tr>
                                            <td><?=$list[$i]['vendor_code']?></td>
                                            <td><?=$list[$i]['name']?></a></td>
                                            <td><?=$list[$i]['address']?></td>
                                            <td><?=$list[$i]['first_name'].' '.$list[$i]['last_name']?></td>
                                            <td><?=$date?></td>
                                            <td>
                                                <a href="/vendors/edit/<?=$list[$i]['vendor_code']?>" class="btn btn-primary">Edit</a>
                                                <a href="/vendors/delete/<?=$list[$i]['vendor_code']?>" onclick="return confirm('Are you sure you want to DELETE <?=$list[$i]['name']?>?')" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
<?php                                   }
?>                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                
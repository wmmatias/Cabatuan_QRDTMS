<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$admin = $this->session->userdata('auth');
?>            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Vendors</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"> <a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item active">Vendor</li>
                        </ol>
<?php                   if($this->session->flashdata('success')){
?>                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <?=$this->session->flashdata('success');?> 
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
<?php                   }
?>                        <div class="movement_form">
                            <p>Add new vendor</p>
                            <form action="/vendors/create" method="post">
                                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" />
                                <div class="row mb-2">
                                    <div class="col-md">
                                        <div class="col-md-4 input-group input-group-outline my-1">
                                            <input type="text" name="name" class="form-control" placeholder="Vendor Name">
                                        </div>
                                            <?php echo form_error('name') ?>
                                    </div>
                                    <div class="col-md">
                                        <div class="col-md-4 input-group input-group-outline my-1">
                                            <input type="text" name="address" class="form-control" placeholder="Vendor Address">
                                        </div>
                                            <?php echo form_error('address') ?>
                                    </div>
                                    <div class="col-md">
                                        <div class="col-md-4 input-group input-group-outline my-1">
                                            <input type="hidden" name="id" value="<?=$this->session->userdata('user_id')?>">
                                            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i></button>
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
?>                                        <tr class="<?=($list[$i]['status'] != '0' ? 'bg-info':'')?>">
                                            <td><?=$list[$i]['vendor_code']?></td>
                                            <td><?=$list[$i]['name']?></a></td>
                                            <td><?=$list[$i]['address']?></td>
                                            <td><?=$list[$i]['first_name'].' '.$list[$i]['last_name']?></td>
                                            <td><?=$date?></td>
                                            <td>
                                                <a href="/vendors/edit/<?=$list[$i]['vendor_code']?>" class="btn btn-primary">Edit</a>
<?php                                       if($admin){
                                                if($list[$i]['status'] === '0'){
?>                                                    <a href="/vendors/block/<?=$list[$i]['vendor_code']?>" class="btn btn-danger">Block</a>
<?php                                           }
                                                else{
?>                                                    <a href="/vendors/unblock/<?=$list[$i]['vendor_code']?>" class="btn btn-success">Unblock</a>
<?php                                           }
                                            }
?>                                            </td>
                                        </tr>
<?php                                   }
?>                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <!-- <?php $test = $test; var_dump($test)?> -->
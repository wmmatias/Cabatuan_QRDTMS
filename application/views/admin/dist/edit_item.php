<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Items</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"> <a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="/dashboard/item">Item</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
<?php                   if($this->session->flashdata('success')){
?>                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <?=$this->session->flashdata('success');?> 
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
<?php                   }
?>                        <div class="movement_form">
                            <p>Add new item</p>
                            <form action="/items/edit/(:any)/validate" method="post">
                                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" />
                                <div class="row mb-2">
                                    <div class="col-md">
                                        <div class="col-md-4 input-group input-group-outline my-1">
                                            <input type="text" name="vendorcode" class="form-control" placeholder="Vendor Code" value="<?=$details['vendor_code']?>">
                                            <?php echo form_error('vendorcode') ?>
                                        </div>
                                            <?=$this->session->flashdata('vendor');?>
                                    </div>
                                    <div class="col-md">
                                        <div class="col-md-4 input-group input-group-outline my-1">
                                            <input type="text" name="itemname" class="form-control" placeholder="Item Name" value="<?=$details['description']?>">
                                            <?php echo form_error('itemname') ?>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="col-md-4 input-group input-group-outline my-1">
                                            <input type="text" name="uom" class="form-control" placeholder="Unit of Measure(PC, BOX)"  value="<?=$details['uom']?>">
                                            <?php echo form_error('uom') ?>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="col-md-4 input-group input-group-outline my-1">
                                            <input type="text" name="unitcost" class="form-control" placeholder="Unit Cost(10.00)"  value="<?=$details['unit_cost']?>">
                                            <?php echo form_error('unitcost') ?>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="col-md-4 input-group input-group-outline my-1">
                                            <input type="hidden" name="id" value="<?=$details['id']?>">
                                            <a href="/dashboard/item" class="btn btn-danger me-2 rounded"><strong>X</strong></a>
                                            <button type="submit" class="btn btn-success rounded"><i class="fas fa-save"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">
                                <p class="d-inline-block"><i class="fas fa-table"></i> List of items</p>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Use In</th>
                                            <th>Item Name</th>
                                            <th>Unit of Measure</th>
                                            <th>Unit Cost</th>
                                            <th>Vendor Code</th>
                                            <th>Created By</th>
                                            <th>Date Created</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php                                   for($i=0; $i<count($list); $i++){
                                            $date = date('m-d-Y', strtotime($list[$i]['created_at']));
?>                                        <tr>
                                            <td><?=$list[$i]['pr_no']?></td>
                                            <td><?=$list[$i]['description']?></a></td>
                                            <td><?=$list[$i]['uom']?></td>
                                            <td><?=$list[$i]['unit_cost']?></td>
                                            <td><?=$list[$i]['vendor_code']?></td>
                                            <td><?=$list[$i]['first_name'].' '.$list[$i]['last_name']?></td>
                                            <td><?=$date?></td>
                                            <td>
                                                <a href="/items/edit/<?=$list[$i]['id']?>" class="btn btn-primary">Edit</a>
                                                <a href="/items/delete/<?=$list[$i]['id']?>" onclick="return confirm('Are you sure you want to DELETE <?=$list[$i]['name']?>?')" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
<?php                                   }
?>                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
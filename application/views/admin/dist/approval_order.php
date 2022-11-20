<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// var_dump($_SESSION)
?>            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Order for Approval</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"> <a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item active">Order for Approval</li>
                        </ol>
<?php                   if($this->session->flashdata('success')){
?>                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <?=$this->session->flashdata('success');?> 
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
<?php                   }
?>                        <div class="card mb-4">
                            <div class="card-header">
                                <p class="d-inline-block"><i class="fas fa-table"></i> List of purchase order</p>
                                <a href="/dashboard/pr_details" class="float-end btn btn-primary"><i class="fas fa-plus"></i> Add PR</a>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>PO Number</th>
                                            <th>PR Number</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Created by</th>
                                            <th>Created at</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php                                   foreach($list as $data){
                                            $create = date('m-d-Y', strtotime($data['created_at']));
?>                                        <tr>
                                            <td><?=$data['order_no']?></td>
                                            <td><?=$data['pr_no']?></td>
                                            <td><?=$data['description']?></td>
                                            <td>
<?php                                           if($data['approver_1'] === '0'){
?>                                                  Pending <span class="badge bg-info text-dark">MM</span>
<?php                                           }
                                                else{
?>                                                  <span class="badge bg-success">APPROVED</span>
<?php                                           }                                                                                          
?>                                            </td>
                                            <td><?=$data['first_name'].' '.$data['last_name']?></td>
                                            <td><?=$create?></td>
                                            <td>
                                                <a href="/orders/view_docu/<?=$data['order_no']?>" class="btn btn-success">View</a>
                                            </td>
                                        </tr>
<?php                                   }
?>                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                
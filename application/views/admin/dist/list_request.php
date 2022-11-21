<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$approver = $this->session->userdata('approver');
?>            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Purchase Request List</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"> <a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item active">Purchase Request List</li>
                        </ol>
<?php                   if($this->session->flashdata('warning')){
?>                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <?=$this->session->flashdata('warning');?> 
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
<?php                   }
?>                        <div class="card mb-4">
                            <div class="card-header">
                                <p class="d-inline-block"><i class="fas fa-table"></i> List of purchase request</p>
                                <a href="/dashboard/pr_details" class="float-end btn btn-primary"><i class="fas fa-plus"></i> Add PR</a>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>PR Number</th>
                                            <th>Department</th>
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
                                            <td><?=$data['pr_no']?></td>
                                            <td><?=$data['department']?></td>
                                            <td><?=$data['description']?></td>
                                            <td>
                                                <?=($data['status'] === '0'? 'Pending' : ($data['status'] === '2'? 'Disapprove': ''))?>
<?php                                           if($data['approver_1'] === '0'){
?>                                                  <span class="badge bg-info text-dark">MBO</span>
<?php                                           }
                                                elseif($data['approver_2'] === '0'){
?>                                                  <span class="badge bg-info text-dark">MT</span>
<?php                                           }
                                                elseif($data['approver_3'] === '0'){
?>                                                  <span class="badge bg-info text-dark">MA</span>
<?php                                           }
                                                elseif($data['approver_4'] === '0'){
?>                                                  <span class="badge bg-info text-dark">MM</span>
<?php                                           }
                                                else{
?>                                                  <span class="badge bg-success">APPROVED</span>
<?php                                           }                                                                                          
?>                                            </td>
                                            <td><?=$data['first_name'].' '.$data['last_name']?></td>
                                            <td><?=$create?></td>
                                            <td>
                                                <a href="/requests/view/<?=$data['pr_no']?>" class="btn btn-success">View</a>
<?php                                           if($approver){
                                                }
                                                else{
                                                    if($data['approver_4'] != '0'){
?>                                                  <a href="/orders/view/<?=$data['pr_no']?>" class="btn btn-primary">Create PO</a>
<?php                                               }
                                                }
?>                                            </td>
                                        </tr>
<?php                                   }
?>                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                
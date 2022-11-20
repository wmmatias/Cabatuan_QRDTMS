<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$create = date('m-d-Y', strtotime($data[0]['created_at']));
$approver = $this->session->userdata('approver');
$admin = $this->session->userdata('auth');
?>            
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 id="print_hide" class="mt-4">View Purchace Request</h1>
                        <ol id="print_hide" class="breadcrumb mb-4">
                            <li class="breadcrumb-item"> <a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="/dashboard/list_request">Purchase Request</a></li>
                            <li class="breadcrumb-item active">View</li>
                        </ol><div class="movement_form">
                        </div>
                        <div class="row mb-2">
                            <div class="col-md">
                                <div class="card mb-4">
<?php                               if($approver || $admin){
?>                                    <div id="print_hide" class="card-header">
                                        <!-- <a href="/dashboard/approval_request" class="btn btn-primary"><i class="fas fa-arrow-left"></i></a> -->
<?php                                   if($approver === '1' && $data[0]['approver_1'] === '0'){
?>                                        <div class="float-end <?=$data[0]['status'] === '2'? 'd-none':''?>">
                                            <a href="/requests/approved/<?=$data[0]['pr_no']?>" class="btn btn-success"><i class="fas fa-check"></i>Approve</a>
                                            <a href="/requests/disapproved/<?=$data[0]['pr_no']?>" class="btn btn-danger"><i class="fas fa-ban"></i>Disapprove</a>
                                        </div>
<?php                                   }
                                        elseif($approver === '2' && $data[0]['approver_1'] === '1' && $data[0]['approver_2'] === '0'){
?>                                        <div class="float-end <?=$data[0]['status'] === '2'? 'd-none':''?>">
                                            <a href="/requests/approved/<?=$data[0]['pr_no']?>" class="btn btn-success"><i class="fas fa-check"></i>Approve</a>
                                            <a href="/requests/disapproved/<?=$data[0]['pr_no']?>" class="btn btn-danger"><i class="fas fa-ban"></i>Disapprove</a>
                                        </div>
<?php                                   }
                                        elseif($approver === '3' && $data[0]['approver_1'] === '1' && $data[0]['approver_2'] === '1' && $data[0]['approver_3'] === '0'){
?>                                        <div class="float-end <?=$data[0]['status'] === '2'? 'd-none':''?>">
                                            <a href="/requests/approved/<?=$data[0]['pr_no']?>" class="btn btn-success"><i class="fas fa-check"></i>Approve</a>
                                            <a href="/requests/disapproved/<?=$data[0]['pr_no']?>" class="btn btn-danger"><i class="fas fa-ban"></i>Disapprove</a>
                                        </div>
<?php                                   }
                                        elseif($approver === '4' && $data[0]['approver_1'] === '1' && $data[0]['approver_2'] === '1' && $data[0]['approver_3'] === '1' && $data[0]['approver_4'] === '0'){
?>                                        <div class="float-end <?=$data[0]['status'] === '2'? 'd-none':''?>">
                                            <a href="/requests/approved/<?=$data[0]['pr_no']?>" class="btn btn-success"><i class="fas fa-check"></i>Approve</a>
                                            <a href="/requests/disapproved/<?=$data[0]['pr_no']?>" class="btn btn-danger"><i class="fas fa-ban"></i>Disapprove</a>
                                        </div>
<?php                                   }
                                        elseif($admin && $data[0]['approver_1'] === '0' || $admin && $data[0]['approver_2'] === '0' || $admin && $data[0]['approver_3'] === '0' || $admin && $data[0]['approver_4'] === '0'){
?>                                        <div class="float-end <?=$data[0]['status'] === '2'? 'd-none':''?>">
                                            <a href="/requests/approved/<?=$data[0]['pr_no']?>" class="btn btn-success"><i class="fas fa-check"></i>Approve</a>
                                            <a href="/requests/disapproved/<?=$data[0]['pr_no']?>" class="btn btn-danger"><i class="fas fa-ban"></i>Disapprove</a>
                                        </div>
<?php                                   }
?>                                      </div>
<?php                               }
?>                                    <div class="card-body">
                                        <div class="mb-4 row">
                                            <div id="logo" class="col d-inline-block align-top">
                                                <img src="/assets/images/cabatuan logo.png" alt="logo" style="width: 100px;">
                                            </div>
                                            <div class="col-6 text-center text-center fw-bold align-top">
                                                <p>
                                                    PURCHASE REQUESTS <br>
                                                    LOCAL GOVERNMENT UNIT OF CABATUAN <br>
                                                    CABATUAN ISABELA
                                                </p>
                                            </div>
                                            <div id="logo" class="col d-inline-block align-top">
                                                <img src="/requests/qrcode/<?=$data[0]['pr_no']?>" alt="qrcode" class="float-end">
                                            </div>
                                        </div>
                                        <div class="mb-1 row">
                                            <div class="col d-inline-block align-top">
                                                <label for="pr_no" class="col-form-label"> <strong>PR No.: </strong><?=$data[0]['pr_no']?></label>
                                            </div>
                                            <div class="col d-inline-block align-top">
                                                <label for="date" class="col-form-label float-end"> <strong>Date: </strong><?=$create?></label>
                                            </div>
                                        </div>
                                        <div class="mb-1 row">
                                            <div class="col">
                                                <label for="department" class="col-form-label"> <strong>Description: </strong><?=$data[0]['description']?></label>
                                            </div>
                                            <div class="col">
                                                <label for="department" class="col-form-label float-end"> <strong>Department: </strong><?=$data[0]['department']?></label>
                                            </div>
                                        </div>
                                        <?=$this->session->flashdata('input_errors');?> 
                                        <table class="table table-bordered table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Item Description</th>
                                                    <th>Qty</th>
                                                    <th>Unit of Measure</th>
                                                    <th>Unit Price</th>
                                                    <th>Total Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
<?php                                           foreach($data as $items){
?>                                                <tr>
                                                    <td><?=$items['item_name']?></td>
                                                    <td><?=$items['qty']?></td>
                                                    <td><?=$items['uom']?></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
<?php                                           }
?>                                      </tbody>
                                        </table>

                                        <div class="row mt-5 ms-3">
                                            <div class="row mt-5 mb-5">
                                                <div class="col">
                                                    <p>
                                                        Requested By: <br>
                                                        <strong><?=strtoupper($data[0]['first_name'].' '.$data[0]['last_name'])?></strong><br>
                                                        <small><?=$data[0]['department']?></small>
                                                    </p>
                                                </div>
                                                <div class="col">
                                                    <p>
                                                        Cash Availability: <br>
                                                        <strong>CRISANTO G. JAMES</strong>
                                                        <br> 
                                                        <small>Municipal Treasurer</small><br>
<?php                                                   if($data[0]['approver_3'] != '0'){
?>                                                        <span class="badge bg-info text-dark">Approved</span>
<?php                                                   }
?>                                                   </p>
                                                </div>
                                                <div class="col">
                                                    <p>
                                                        Approved By:<br>
                                                        <strong id="mayor">BERNARDO A. GARCIA JR.</strong><br>
                                                        <small>Municipal Mayor</small><br>
<?php                                                   if($data[0]['approver_4'] != '0'){
?>                                                        <span class="badge bg-info text-dark">Approved</span>
<?php                                                   }
?>                                                  </p>
                                                </div>
                                            </div>
                                            <div class="row mb-5">
                                                <div class="col md">
                                                    <!-- <p>Approved By:</p> -->
                                                    <p>
                                                        <strong>EVA D. MANIBOG</strong><br>
                                                        <small>Municipal Budget Officer</small><br>
<?php                                                   if($data[0]['approver_1'] != '0'){
?>                                                        <span class="badge bg-info text-dark">Approved</span>
<?php                                                   }
?>                                                  </p>
                                                </div>
                                                <div class="col md">
                                                    <!-- <p>Approved By:</p> -->
                                                    <p>
                                                        <strong>CHRISTINE V. ENTERA</strong><br>
                                                        <small>Municipal Accountant</small><br>
<?php                                                   if($data[0]['approver_3'] != '0'){
?>                                                        <span class="badge bg-info text-dark">Approved</span>
<?php                                                   }
?>                                                  </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
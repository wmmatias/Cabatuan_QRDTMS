<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$create = date('m-d-Y', strtotime($data[0]['created_at']));
$approver = $this->session->userdata('approver');
$admin = $this->session->userdata('auth');
?>            
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 id="print_hide" class="mt-4">View Purchace Order</h1>
                        <ol id="print_hide" class="breadcrumb mb-4">
                            <li class="breadcrumb-item"> <a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="/dashboard/list_order">Purchase Order</a></li>
                            <li class="breadcrumb-item active">View</li>
                        </ol><div class="movement_form">
                        </div>
                        <div class="row mb-2">
                            <div class="col-md">
                                <div class="card mb-4">
<?php                               if($approver || $admin){
?>                                    <div id="print_hide" class="card-header">
 <?php                                   if($approver === '4' && $data[0]['approver_1'] === '0'){
?>                                        <div class="float-end <?=$data[0]['approver_1'] === '2'? 'd-none':''?>">
                                            <a href="/requests/approved_po/<?=$data[0]['order_no']?>" class="btn btn-success"><i class="fas fa-check"></i>Approve</a>
                                            <a href="/requests/disapproved_po/<?=$data[0]['order_no']?>" class="btn btn-danger"><i class="fas fa-ban"></i>Disapprove</a>
                                        </div>
<?php                                   }
                                        elseif($admin && $data[0]['approver_1'] === '0'){
?>                                        <div class="float-end <?=$data[0]['approver_1'] === '2'? 'd-none':''?>">
                                            <a href="/requests/approved_po/<?=$data[0]['order_no']?>" class="btn btn-success"><i class="fas fa-check"></i>Approve</a>
                                            <a href="/requests/disapproved_po/<?=$data[0]['order_no']?>" class="btn btn-danger"><i class="fas fa-ban"></i>Disapprove</a>
                                        </div>
<?php                                   }
?>                                      </div>
<?php                               }
?>                                    <div id="card-body" class="card-body">
                                        <div class="mb-4 row">
                                            <div class="col d-inline-block align-top">
                                                <img src="/assets/images/cabatuan logo.png" alt="logo" style="width: 100px;">
                                            </div>
                                            <div class="col-6 d-inline-block text-center fw-bold align-top">
                                                <p>
                                                    PURCHASE ORDER <br>
                                                    LOCAL GOVERNMENT UNIT OF CABATUAN <br>
                                                    CABATUAN ISABELA
                                                </p>
                                            </div>
                                            <div class="col d-inline-block align-top">
                                                <img src="/requests/qrcode/<?=$id?>" alt="qrcode" class="float-end">
                                            </div>
                                        </div>
                                        <div class="mb-1 row">
                                            <div class="col d-inline-block align-top">
                                                <label for="pr_no" class="col-form-label fw-bold">PO No.: <?=$id?></label>
                                            </div>
                                            <div class="col d-inline-block align-top">
                                                <label for="date" class="col-form-label fw-bold float-end">Date: <?=$create?></label>
                                            </div>
                                        </div>
                                        <div class="mb-1 row">
                                            <div class="col d-inline-block align-top">
                                                <p class="col-form-label fw-bold">
                                                    Vendor: <?=$data[0]['name']?> <br>
                                                    Address: <?=$data[0]['address']?>
                                                </p>
                                            </div>
                                            <div class="col d-inline-block align-top float-end">
                                                <div class="float-end">
                                                    <p class="col-form-label fw-bold text-end">
                                                        Municipal Hall <br>
                                                        Santiago-Tugegarao Road<br>
                                                        Cabatuan, Isabela, 3315, PH<br>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <?=$this->session->flashdata('input_errors');?> 
                                        <table class="table table-bordered table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Item Description</th>
                                                    <th>Qty</th>
                                                    <th>Unit of Measure</th>
                                                    <th>Unit Cost</th>
                                                    <th>Total Unit Cost</th>
                                                </tr>
                                            </thead>
                                            <tbody>
<?php                                           foreach($data as $items){
?>                                                <tr>
                                                    <td><?=$items['description']?></td>
                                                    <td><?=$items['qty']?></td>
                                                    <td><?=$items['uom']?></td>
                                                    <td><?=$items['unit_cost']?></td>
                                                    <td><?= number_format($items['total_unit_cost'],2)?></td>
                                                </tr>
<?php                                           }
?>                                      </tbody>
                                        </table>
                                        <p>Total Cost: <strong><?= number_format($sum['total_price'],2)?></strong><br>
                                        Total Qty: <strong><?=$sum['total_qty']?></strong></p>
                                        <div class="row mt-5 ms-3">
                                            <div class="row mt-5 mb-5">
                                                <div class="col md">
                                                    <p>Vendor Representative: <br><br>   
                                                    <small class="border-top">Fullname and Signature</small></p>
                                                </div>
                                                <div class="col md">
                                                    <p>Approved By: <br>
                                                    <strong>BERNARDO A. GARCIA JR.</strong> <br>
                                                    <small>Municipal Mayor</small><br>
<?php                                                   if($data[0]['approver_1'] != '0'){
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
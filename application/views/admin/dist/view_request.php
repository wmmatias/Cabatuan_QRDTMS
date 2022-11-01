<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$create = date('m-d-Y', strtotime($data[0]['created_at']));
?>            
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">View Purchace Request</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"> <a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="/dashboard/list_request">Purchase Request</a></li>
                            <li class="breadcrumb-item active">View</li>
                        </ol><div class="movement_form">
                        </div>
                        <div class="row mb-2">
                            <div class="col-md">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <form action="/requests/items" method="POST">
                                            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" />
                                            <div class="mb-2 row">
                                                <label for="pr_no" class="col-sm-2 col-form-label">PR No.:</label>
                                                <div class="col-sm-3">
                                                    <input type="text" name="pr_no" class="form-control" value="<?=$data[0]['pr_no']?>" readonly>
                                                </div>
                                                <div class="col-sm-3 offset-sm-4">
                                                    <input type="text" name="date" class="form-control" value="<?=$create?>" readonly>
                                                </div>
                                            </div>
                                            <div class="mb-2 row">
                                                <label for="vendor" class="col-sm-2 col-form-label">Vendor:</label>
                                                <div class="col-sm-3">
                                                    <input type="text" name="vendor" class="form-control" value="<?=$data[0]['name']?>" readonly>
                                                </div>
                                            </div>
                                            <div class="mb-2 row">
                                                <label for="description" class="col-sm-2 col-form-label">Description:</label>
                                                <div class="col">
                                                    <input type="text" name="description" class="form-control" value="<?=$data[0]['description']?>" readonly>
                                                </div>
                                            </div>
                                            <?=$this->session->flashdata('input_errors');?> 
                                            <div class="card mt-2">
                                                <div class="card-header">
                                                    <i class="fas fa-table"></i> Items
                                                </div>
                                                <div class="card-body">
                                                    <table class="table table-bordered table-striped table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>Item Description</th>
                                                                <th>Qty</th>
                                                                <th>Unit of Measure</th>
                                                                <th>Unit Price</th>
                                                                <th>Total Unit Price</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
<?php                                                       foreach($data as $items){
?>                                                            <tr>
                                                                <td><?=$items['item_name']?></td>
                                                                <td><?=$items['qty']?></td>
                                                                <td><?=$items['uom']?></td>
                                                                <td><?=$items['unit_price']?></td>
                                                                <td><?=$items['total_unit_price']?></td>
                                                            </tr>
                    <?php                                   }
                    ?>                                    </tbody>
                                                    </table>
                                                    <div class="mb-2 row">
                                                        <label for="total_cost" class="col-sm-6 col-form-label"><strong>Total Cost: <?=number_format($sum[0]['total_cost'],2)?></strong></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
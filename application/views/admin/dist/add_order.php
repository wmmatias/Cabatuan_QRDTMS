<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$date = date('m-d-Y', strtotime($data[0]['created_at']));
?>            
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Create Purchace Order</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"> <a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item"> <a href="/dashboard/list_request">PR List</a></li>
                            <li class="breadcrumb-item active">Purchase Order</li>
                        </ol><div class="movement_form">
                        </div>
                        <div class="row mb-2">
                            <div class="col-md">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <div class="mb-2 row border bg-dark bg-gradient">
                                            <div class="col-md-2 float-end">
                                            <form action="/orders/create_po" method="post">
                                                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" />
                                                <input type="hidden" value="<?=$po?>" name="po_no">
                                                <button type="submit" class="btn text-white"><i class="fas fa-save"></i></button>
                                                <!-- <a href="/requests/cancel_requests/<?=$data[0]['pr_no']?>" class="btn text-white"><i class="fas fa-times"></i></a> -->
                                            </div>
                                        </div>
                                        <div class="mb-2 row">
                                            <label for="pr_no" class="col-sm-2 col-form-label">PR No.:</label>
                                            <div class="col-sm-3">
                                                <input type="text" name="pr_no" class="form-control" value="<?=$data[0]['pr_no']?>" readonly>
                                            </div>
                                            <div class="col-sm-3 offset-sm-4">
                                                <input type="text" name="date" class="form-control" value="<?=$date?>" readonly>
                                            </div>
                                        </div>
                                        <div class="mb-2 row">
                                            <label for="department" class="col-sm-2 col-form-label">Department:</label>
                                            <div class="col-sm-3">
                                                <input type="text" name="department" class="form-control" value="<?=$data[0]['department']?>" readonly>
                                            </div>
                                            <label for="vendor" class="col-sm-2 offset-sm-2 col-form-label">Vendor Code:</label>
                                            <div class="col-sm-3">
                                                <input type="text" name="vendor" class="form-control" value="<?=$items[0]['name']?>" readonly>
                                            </div>
                                        </div>
                                        <div class="mb-2 row">
                                            <label for="description" class="col-sm-2 col-form-label">Description:</label>
                                            <div class="col">
                                                <input type="text" name="description" class="form-control" value="<?=$data[0]['description']?>" readonly>
                                            </div>
                                        </div>
                                        </form>
                                        <p><strong>Note:</strong>Please do not forget to save your document by clicking the save button <i class="fas fa-save"></i></p>
                                        <div class="card mt-2">
                        <div class="card-body">
                            <table id="item_list" class="table table-bordered table-striped table-hover">
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
<?php                               foreach($items as $item){
?>                                    <tr>
                                        <td>
                                            <?=$item['description']?>
                                        </td>
                                        <td>
                                            <?=$item['qty']?>
                                        </td>
                                        <td>
                                            <?=$item['uom']?>
                                        </td>
                                        <td>
                                            <?=$item['unit_cost']?>
                                        </td>
                                        <td>
                                            <?= number_format($item['total_cost'])?>
                                        </td>
                                    </tr>
<?php                               }                                  
?>                                </tbody>
                            </table>
                            <h5>Total Cost: <?= number_format($sum['total_cost'],2)?></h5>
                            <h5>Total Qty: <?=$sum['total_qty']?></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>       

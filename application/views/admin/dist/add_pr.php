<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$date = date('m-d-Y', strtotime($date));
?>            
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Purchace Request</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"> <a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item active">Purchase Request</li>
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
                                                    <input type="text" name="pr_no" class="form-control" value="<?=$pr_no?>" readonly>
                                                </div>
                                                <div class="col-sm-3 offset-sm-4">
                                                    <input type="text" name="date" class="form-control" value="<?=$date?>" readonly>
                                                </div>
                                            </div>
                                            <div class="mb-2 row">
                                                <label for="vendor" class="col-sm-2 col-form-label">Vendor:</label>
                                                <div class="col-sm-3">
                                                    <select name="vendor" id="vendor" class="form-select" onchange="getvalue()">
                                                        <option>Select Vendor</option>
<?php                                                   foreach($vendor as $data){
?>                                                        <option value="<?= $data['id']?>" ><?=$data['name']?></option>
<?php                                                   }
?>                                                    </select>
                                                <div id="test"></div>
                                                </div>
                                            </div>
                                            <div class="mb-2 row">
                                                <label for="description" class="col-sm-2 col-form-label">Description:</label>
                                                <div class="col">
                                                    <input type="text" name="description" class="form-control">
                                                </div>
                                            </div>
                                            <?=$this->session->flashdata('input_errors');?> 
                                            <div class="card mt-2">
                                                <div class="card-header">
                                                    <p class="d-inline-block"><i class="fas fa-table"></i> Items</p>
                                                    <input type="submit" class="float-end btn btn-primary" value="Add items">
                                                </div>
                                                <div class="card-body">
                                                    <table class="table table-bordered table-striped table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>Vendor Code</th>
                                                                <th>Item Description</th>
                                                                <th>Qty</th>
                                                                <th>Unit of Measure</th>
                                                                <th>Unit Price</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
<?php                                                       foreach($items as $item){
?>                                                            <tr>
                                                                <td><?=$item['vendor_code']?></td>
                                                                <td><?=$item['name']?></a></td>
                                                                <td><?=$item['qty']?></td>
                                                                <td><?=$item['uom']?></td>
                                                                <td><?=$item['unit_price']?></td>
                                                            </tr>
                    <?php                                   }
                    ?>                                    </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>       

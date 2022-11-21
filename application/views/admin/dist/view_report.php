<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Reports</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"> <a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item active">Reports</li>
                        </ol>
<?php                   if($this->session->flashdata('success')){
?>                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <?=$this->session->flashdata('success');?> 
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
<?php                   }
?>                        <div class="card mb-4">
                            <div class="card-body">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Daily</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Weekly</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="messages-tab" data-bs-toggle="tab" data-bs-target="#messages" type="button" role="tab" aria-controls="messages" aria-selected="false">Monthly</button>
                                    </li>
                                </ul>
                                <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col-md-10 offset-md-1 mt-2">
                                        <div class="card mb-4">
                                            <div class="card-header">
                                                <i class="fas fa-chart-bar me-1"></i>
                                                Daily Chart
                                            </div>
                                            <div class="card-body"><canvas id="daily" width="100%" height="40"></canvas></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="card col-md-6 mt-2">
                                        <div class="card-header">
                                            Daily Approved Purchase Request 
                                            <a href="/reports/export_csv_drequests" class="float-end"><i class="fas fa-file-excel"></i> Export</a>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="datatable" class="table table-striped table-bordered table-hover text-nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>PR No.</th>
                                                            <th>Department</th>
                                                            <th>Description</th>
                                                            <th>Total Price</th>
                                                            <th>Created At</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
<?php                                               if(count($dtable) > '0'){
                                                        foreach($dtable as $data){
?>                                                    <tr>
                                                        <td><?=$data['pr_no']?></td>
                                                        <td><?=$data['department']?></td>
                                                        <td><?=$data['description']?></td>
                                                        <td><?= number_format($data['total_price'],2)?></td>
                                                        <td><?= date('m-d-Y', strtotime($data['created_at']))?></td>
                                                    </tr>
<?php                                               }
                                                    }
                                                    else{
?>                                                      <tr>
                                                            <td colspan="6" class="text-center fw-bold">No Recods Found</td>
                                                        </tr>    
<?php                                               }
?>                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card col-md-6 mt-2">
                                        <div class="card-header">
                                            Daily Approved Purchase Order
                                            <a href="/reports/export_csv_dorders" class="float-end"><i class="fas fa-file-excel"></i> Export</a>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="datatable" class="table table-striped table-bordered table-hover text-nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>PO No.</th>
                                                            <th>PR No.</th>
                                                            <th>Department</th>
                                                            <th>Description</th>
                                                            <th>Total Price</th>
                                                            <th>Created At</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
<?php                                               if(count($po_dtable) > '0'){
                                                        foreach($po_dtable as $data){
?>                                                    <tr>
                                                        <td><?=$data['order_no']?></td>
                                                        <td><?=$data['pr_no']?></td>
                                                        <td><?=$data['department']?></td>
                                                        <td><?=$data['description']?></td>
                                                        <td><?= number_format($data['total_price'],2)?></td>
                                                        <td><?= date('m-d-Y', strtotime($data['created_at']))?></td>
                                                    </tr>
<?php                                                   }
                                                    }
                                                    else{
?>                                                      <tr>
                                                            <td colspan="6" class="text-center fw-bold">No Recods Found</td>
                                                        </tr>    
<?php                                               }
?>                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="row">
                                    <div class="col-md-10 offset-md-1 mt-2">
                                        <div class="card mb-4">
                                            <div class="card-header">
                                                <i class="fas fa-chart-bar me-1"></i>
                                                Weekly Chart
                                            </div>
                                            <div class="card-body"><canvas id="weekly" width="100%" height="40"></canvas></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="card col-md-6 mt-2">
                                        <div class="card-header">
                                            Weekly Approved Purchase Request 
                                            <a href="/reports/export_csv_wrequests" class="float-end"><i class="fas fa-file-excel"></i> Export</a>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="datatable" class="table table-striped table-bordered table-hover text-nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>PR No.</th>
                                                            <th>Department</th>
                                                            <th>Description</th>
                                                            <th>Total Price</th>
                                                            <th>Created At</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
<?php                                               if(count($wtable) > '0'){
                                                        foreach($wtable as $data){
?>                                                    <tr>
                                                        <td><?=$data['pr_no']?></td>
                                                        <td><?=$data['department']?></td>
                                                        <td><?=$data['description']?></td>
                                                        <td><?= number_format($data['total_price'],2)?></td>
                                                        <td><?= date('m-d-Y', strtotime($data['created_at']))?></td>
                                                    </tr>
<?php                                               }
                                                    }
                                                    else{
?>                                                      <tr>
                                                            <td colspan="6" class="text-center fw-bold">No Recods Found</td>
                                                        </tr>    
<?php                                               }
?>                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card col-md-6 mt-2">
                                        <div class="card-header">
                                            Weekly Approved Purchase Order
                                            <a href="/reports/export_csv_worders" class="float-end"><i class="fas fa-file-excel"></i> Export</a>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="datatable" class="table table-striped table-bordered table-hover text-nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>PO No.</th>
                                                            <th>PR No.</th>
                                                            <th>Department</th>
                                                            <th>Description</th>
                                                            <th>Total Price</th>
                                                            <th>Created At</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
<?php                                               if(count($po_wtable) > '0'){
                                                        foreach($po_wtable as $data){
            ?>                                        <tr>
                                                        <td><?=$data['order_no']?></td>
                                                        <td><?=$data['pr_no']?></td>
                                                        <td><?=$data['department']?></td>
                                                        <td><?=$data['description']?></td>
                                                        <td><?= number_format($data['total_price'],2)?></td>
                                                        <td><?= date('m-d-Y', strtotime($data['created_at']))?></td>
                                                    </tr>
            <?php                                   }
                                                    }
                                                    else{
?>                                                      <tr>
                                                            <td colspan="6" class="text-center fw-bold">No Recods Found</td>
                                                        </tr>    
<?php                                               }
?>                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="messages" role="tabpanel" aria-labelledby="messages-tab">
                                <div class="row">
                                    <div class="col-md-10 offset-md-1 mt-2">
                                        <div class="card mb-4">
                                            <div class="card-header">
                                                <i class="fas fa-chart-bar me-1"></i>
                                                Monthly Chart
                                            </div>
                                            <div class="card-body"><canvas id="monthly" width="100%" height="40"></canvas></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="card col-md-6 mt-2">
                                        <div class="card-header">
                                            Monthly Approved Purchase Request 
                                            <a href="/reports/export_csv_mrequests" class="float-end"><i class="fas fa-file-excel"></i> Export</a>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="datatable" class="table table-striped table-bordered table-hover text-nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>PR No.</th>
                                                            <th>Department</th>
                                                            <th>Description</th>
                                                            <th>Total Price</th>
                                                            <th>Created At</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
<?php                                               if(count($mtable) > '0'){
                                                        foreach($mtable as $data){
?>                                                    <tr>
                                                        <td><?=$data['pr_no']?></td>
                                                        <td><?=$data['department']?></td>
                                                        <td><?=$data['description']?></td>
                                                        <td><?= number_format($data['total_price'],2)?></td>
                                                        <td><?= date('m-d-Y', strtotime($data['created_at']))?></td>
                                                    </tr>
<?php                                               }
                                                    }
                                                    else{
?>                                                      <tr>
                                                            <td colspan="6" class="text-center fw-bold">No Recods Found</td>
                                                        </tr>    
<?php                                               }
?>                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card col-md-6 mt-2">
                                        <div class="card-header">
                                            Monthly Approved Purchase Order
                                            <a href="/reports/export_csv_morders" class="float-end"><i class="fas fa-file-excel"></i> Export</a>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="datatable" class="table table-striped table-bordered table-hover text-nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>PO No.</th>
                                                            <th>PR No.</th>
                                                            <th>Department</th>
                                                            <th>Description</th>
                                                            <th>Total Price</th>
                                                            <th>Created At</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
<?php                                               if(count($po_mtable) > '0'){
                                                        foreach($po_mtable as $data){
            ?>                                        <tr>
                                                        <td><?=$data['order_no']?></td>
                                                        <td><?=$data['pr_no']?></td>
                                                        <td><?=$data['department']?></td>
                                                        <td><?=$data['description']?></td>
                                                        <td><?= number_format($data['total_price'],2)?></td>
                                                        <td><?= date('m-d-Y', strtotime($data['created_at']))?></td>
                                                    </tr>
            <?php                                   }
                                                    }
                                                    else{
?>                                                      <tr>
                                                            <td colspan="6" class="text-center fw-bold">No Recods Found</td>
                                                        </tr>    
<?php                                               }
?>                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                
                
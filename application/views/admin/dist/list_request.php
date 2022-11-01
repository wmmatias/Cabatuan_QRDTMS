<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// var_dump($list)
?>            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Purchase Request List</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"> <a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item active">Purchase Request List</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <p class="d-inline-block"><i class="fas fa-table"></i> List of pending purchase request</p>
                                <a href="/dashboard/pr_details" class="float-end btn btn-primary"><i class="fas fa-plus"></i> Add PR</a>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>PR Number</th>
                                            <th>Description</th>
                                            <th>Vendor</th>
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
                                            <td><?=$data['description']?></td>
                                            <td><?=$data['name']?></a></td>
                                            <td><?=($data['status'] === '0'? 'Pending' : 'Approved')?></td>
                                            <td><?=$data['first_name'].' '.$data['last_name']?></td>
                                            <td><?=$create?></td>
                                            <td>
                                                <a href="/requests/view/<?=$data['pr_no']?>" class="btn btn-success">View</a>
                                            </td>
                                        </tr>
<?php                                   }
?>                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                
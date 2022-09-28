<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Users list</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"> <a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item active">Users</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <p class="d-inline-block"><i class="fas fa-table"></i> List of users</p>
                                <a href="/dashboard/add" class="float-end btn btn-primary"><i class="fas fa-plus"></i> Add User</a>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Full Name</th>
                                            <th>User Name</th>
                                            <th>User Level</th>
                                            <th>Date Created</th>
                                            <th>Date Updated</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Full Name</th>
                                            <th>User Name</th>
                                            <th>User Level</th>
                                            <th>Date Created</th>
                                            <th>Date Updated</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
<?php                                   for($i=0; $i<count($list); $i++){
                                            $create = date('m-d-Y', strtotime($list[$i]['created_at']));
                                            $update = date('m-d-Y', strtotime($list[$i]['updated_at']));
?>                                        <tr>
                                            <td><?=$list[$i]['first_name'] .' '. $list[$i]['last_name']?></td>
                                            <td><?=$list[$i]['user_name']?></a></td>
                                            <td><?=$list[$i]['user_level']?></td>
                                            <td><?=$create?></td>
                                            <td><?=$update?></td>
                                            <td>
                                                <a href="" class="btn btn-primary">Edit</a>
                                                <a href="" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
<?php                                   }
?>                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                
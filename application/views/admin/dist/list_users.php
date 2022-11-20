<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$user = $this->session->userdata('user');
?>            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Users list</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"> <a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item active">Users</li>
                        </ol>
<?php                   if($this->session->flashdata('success')){
?>                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <?=$this->session->flashdata('success');?> 
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
<?php                   }
?>                        <div class="card mb-4">
                            <div class="card-header">
                                <p class="d-inline-block"><i class="fas fa-table"></i> List of users</p>
                                <a href="/dashboard/add" class="float-end btn btn-primary <?=($user ? 'd-none': '')?>"><i class="fas fa-plus"></i> Add User</a>
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
                                            <th class="<?=($user ? 'd-none': '')?>">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php                                   for($i=0; $i<count($list); $i++){
                                            $create = date('m-d-Y', strtotime($list[$i]['created_at']));
                                            $update = date('m-d-Y', strtotime($list[$i]['updated_at']));
?>                                        <tr class="<?=($list[$i]['status'] === '1' ? 'bg-info': '')?>">
                                            <td><?=$list[$i]['first_name'] .' '. $list[$i]['last_name']?></td>
                                            <td><?=$list[$i]['user_name']?></a></td>
                                            <td>
<?php                                           if($list[$i]['user_level'] === '0'){
?>                                                    Admin
<?php                                           }
                                                elseif($list[$i]['user_level'] === '1'){
?>                                                    User
<?php                                           }
                                                else{
?>                                                      Approver
<?php                                           }
?>                                            </td>
                                            <td><?=$create?></td>
                                            <td><?=$update?></td>
<?php                                       if(!$user){
?>                                            <td>
                                                <a href="/users/edit/<?=$list[$i]['id']?>" class="btn btn-primary">Edit</a>
<?php                                             if($list[$i]['status'] === '0'){
?>                                                    <a href="/users/block/<?=$list[$i]['id']?>" class="btn btn-danger">Block</a>
<?php                                           }
                                                else{
?>                                                    <a href="/users/unblock/<?=$list[$i]['id']?>" class="btn btn-success">Unblock</a>
<?php                                           }
?>                                            </td>
<?php                                       }
?>                                        </tr>
<?php                                   }
?>                                    </tbody>
<!-- <?php var_dump($list);?> -->
                                </table>
                            </div>
                        </div>
                    </div>
                
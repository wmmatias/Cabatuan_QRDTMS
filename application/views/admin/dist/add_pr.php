<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$date = date('m-d-Y', strtotime($date));
$dept = $this->session->userdata('department');
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
                                        <form action="/requests/items/<?=$details['pr_no']?>" method="POST">
                                            <div class="mb-2 row border bg-dark bg-gradient">
                                                <div class="col-md-2 float-end">
                                                    <button type="submit" class="btn text-white"><i class="fas fa-save"></i></button>
                                                    <a href="/requests/cancel_requests/<?=$pr_no?>" class="btn text-white"><i class="fas fa-times"></i></a>
                                                </div>
                                            </div>
                                            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" />
                                            <div class="mb-2 row">
                                                <label for="pr_no" class="col-sm-2 col-form-label">PR No.:</label>
                                                <div class="col-sm-3">
                                                    <input type="text" name="pr_no" class="form-control" value="<?=$details['pr_no']?>" readonly>
                                                    <?php echo form_error('pr_no') ?>
                                                </div>
                                                <div class="col-sm-3 offset-sm-4">
                                                    <input type="text" name="date" class="form-control" value="<?=$date?>" readonly>
                                                    <?php echo form_error('date') ?>
                                                </div>
                                            </div>
                                            <div class="mb-2 row">
                                                <label for="department" class="col-sm-2 col-form-label">Department:</label>
                                                <div class="col-sm-4">
                                                <select id="department" name="department" class="form-select">
                                                <option value="empty">Select Department</option>
<?php                                           foreach($department as $data){
?>                                              <option value="<?=$data['id']?>" <?=($dept === $data['id'] ? 'selected' : '')?>><?=$data['name']?></option>
<?php                                           }
?>                                            </select>
                                                    <?php echo form_error('department') ?>
                                                </div>
                                            </div>
                                            <div class="mb-2 row">
                                                <label for="description" class="col-sm-2 col-form-label">Description:</label>
                                                <div class="col">
                                                    <input type="text" name="description" class="form-control">
                                                    <?php echo form_error('description') ?>
                                                </div>
                                            </div>
                                        </form>
                                        <p><strong>Note:</strong>Please do not forget to save your document by clicking the save button <i class="fas fa-save"></i> and don't forget to cancel <i class="fas fa-times"></i> the document if you don't want to continue processing it to reserve the document number and to delete all added items on it.</p>
                                            <div id="details">

                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>       

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// $date = date('m-d-Y', strtotime($date));
?>                                               
                    <div class="card mt-2">
                        <div class="card-header">
                            <form action="/requests/initial_item_validation" method="post" id="initial_item">
                                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" />
                                <div class="row">
                                    <div class="col-md mb-3">
                                        <input type="text" name="description" class="form-control" placeholder="Description">
                                        <?php echo form_error('description') ?>
                                    </div>
                                    <div class="col-md mb-3">
                                        <input type="number" name="qty" class="form-control" min="1" value="1" placeholder="Qty">
                                        <?php echo form_error('qty') ?>
                                    </div>
                                    <div class="col-md mb-3">
                                        <input type="text" name="uom" class="form-control" placeholder="Unit of Measure">
                                        <?php echo form_error('uom') ?>
                                    </div>
                                    <div class="col-md mb-3">
                                        <input type="hidden" name="pr_no" value="<?=$this->session->userdata('last_save_pr');?>">
                                        <button type="submit" class="btn btn-primary float-end">Add Item</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <table id="item_list" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Item Description</th>
                                        <th>Qty</th>
                                        <th>Unit of Measure</th>
                                        <th>Unit Cost</th>
                                    </tr>
                                </thead>
                                <tbody>
<?php                               foreach($items as $item){
?>                                    <tr id="<?=$item['id']?>">
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
                                            <form id="delete_item" action="/requests/initial_item_delete" method="post">
                                                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" />
                                                <input type="hidden" name="id" value="<?=$item['id']?>">
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to DELETE?')"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
<?php                               }                                  
?>                                </tbody>
                            </table>
                        </div>
                    </div>
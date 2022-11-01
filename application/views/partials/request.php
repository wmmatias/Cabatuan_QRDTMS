<table class="table table-striped table-hover">
    <thead class="head-stick text-white bg-success">
        <tr>
            <th>Description</th>
            <th>Unit Cost</th>
            <th>Quantity</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>

<?php   if(count($list)<1){
?>		  <tr>
            <td colspan="4"><?php echo "No Records Found"; ?></td>
        </tr>
<?php						}
        else{
            foreach($list as $data){
?>        <tr>
            <td><?=$data['item_name']?></td> 
            <td><?=$data['unit_price']?></td>
            <td>
                <form class="input_qty" action="/requests/update" method="post">
                    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                    <input type="hidden" name="id" value="<?=$data['id']?>">
                    <input type="hidden" name="tempid" value="<?=$data['temp_id']?>">
                    <input type="number" name="qty" class="editqty" id="edit_qty" min="1" value="<?=$data['qty']?>">
				</form>
            </td> 
            <td>
                <form class="inlide_del" action="requests/delete_line" method="post">
                    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                    <input type="hidden" name="id" value="<?=$data['id']?>">
                    <input type="hidden" name="tempid" value="<?=$data['temp_id']?>">
                    <input type="submit" class="del btn btn-danger" id="del" value="Remove">
                </form>
            </td>  
        </tr>
<?php						
            }
        }				
?>  
    </tbody>
</table>
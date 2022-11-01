<?php
	date_default_timezone_set("Asia/Manila");
	$today = date('mdyg');
	$key = $today.rand(10,100);
?>
<?php               	if(count($list)<1){
?>						  <tr>
							<td colspan="4"><?php echo "No Records Found"; ?></td>
						</tr>
<?php						}
						else{
							foreach($list as $data){
?>                  	  <tr>
                            <td><?=$data['vendor_code']?></td> 
                            <td><?=$data['item_name']?></td>
                            <td><?=$data['unit_price']?></td> 
                            <td>
								<form class="requested_item" action="/requests/requested_item" method="post">
                                	<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
									<input type="hidden" name="itemid" value="<?= $data['id']?>">
									<input type="hidden" name="vendorid" value="<?= $data['vendor_id']?>">
									<input type="hidden" name="user_id" value="<?= $this->session->userdata('user_id') ?>">
									<input type="hidden" name="temp" value="<?= $key.$this->session->userdata('user_id').$data['vendor_code']?>">
									<input type="submit" class="btn btn-primary" value="Add"/>
								</form>
							</td>  
                        </tr>
<?php						
							}
						}			
?>                   
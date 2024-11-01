<?php 

?>





<div class="wrap" id="all_categories">
</br>
<h4> subscribed Users are</h4>
</br>
	<?php
/* 	
	$table_name=$wpdb->prefix."coupon_category";
 $sql="SELECT * FROM $table_name ORDER BY category_id DESC";
	$results=$wpdb->get_results($sql);

	
	$table_name1=$wpdb->prefix."sub_category_1";

$table_name2=$wpdb->prefix."sub_category_2";
 */
 $table_name=$wpdb->prefix."subscribed_users";
  $sql="SELECT * FROM $table_name ORDER BY id DESC";
 $results=$wpdb->get_results($sql);
	?>
	
	<table class="table table-striped table-responsive" cellspacing="0" id="subscriber_id">
		<thead>
			
		<th class="checkbox_heading"><input type="checkbox" class='checkbox_all'></th> 
			
				<th><?php _e('S.NO'); ?></th>
				<th><?php _e('Email'); ?></th>
			
				<th><?php _e('Created Time'); ?></th>
				
				
		
		</thead>
		
		<tbody id="subscribers_list">
		
			<?php if($results):?>
				<?php 
					
					
					$count = 1;
					$start = ($pagenum - 1) * $per_page;
					$end = $start + $per_page;
					foreach ($results as $result){						
							echo "<tr id='merchant_$result->id' class='alternate author-self status-publish format-default'>";
							echo "<td  width='10px'><input type='checkbox' class='check_box'/></td>";
						
							echo "<td>$count</td>";	
							echo "<td>$result->email</td>";
							
							$t1=date_create($result->created_at);
							$date_format=date_format($t1,"d-M-Y H:i:s");
							echo "<td>$date_format</td>";
							
							echo "</tr>";							
						    
						$count++;
					}
				?>
			<?php else:?>
				<tr>
					<td align="center" colspan="6" class="empty">No Merchants are Added</td>
				</tr>
			<?php endif;?>			
		</tbody>
		<?php if($results):?>
			<tfoot>
				<tr>
				 <th class="checkbox_heading"><input type="checkbox" class='checkbox_all'></th> 
					<th ><?php _e('S.No'); ?></th>
					<th><?php _e('Email'); ?></th>
					
				
					<th><?php _e('Created Time'); ?></th>
					
				</tr>
			</tfoot>
		<?php endif;?>	
	</table>
	
  
</div>


<script>

jQuery(document).ready(function ($) {
    $(document).ready(function () {
		  $(".checkbox_heading").removeClass(".sorting_asc");
					  $(".checkbox_heading").removeClass(".sorting_desc");
	});
});

  jQuery(function () {
	  
    jQuery('#subscriber_id').DataTable({
      'paging'      : true,
    // 'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
	   'pageLength': 5
	  
    });
  });
</script>  
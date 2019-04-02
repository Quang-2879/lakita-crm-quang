<style type="text/css" media="screen">
	.cost-errors, .cost-success {
		font-size: 18px;
		border: 1px solid white;
		padding: 5px;
	}
</style>


<div class="row">
	<h1 class="text-center">Nhập chi phí hàng ngày cho Campain Google adword</h1>
	<div class="container" style="max-width: 910px;">
		<form id="cost-form" method="post" action="<?php echo base_url('MANAGERS/campaign/action_add_cost'); ?>">
		  <div class="form-group col-md-3">
		    <label for="campaign">Chọn campaign</label>
		    <select class="form-control" id="campaign" name="campaign">
		    	<option value="0" selected>< Chọn campaign ></option>
		    	<?php if (isset($campaignes) && !empty($campaignes)): ?>
		    		<?php foreach ($campaignes as $item): ?>
		    			<option value="<?php echo $item['id']; ?>"><?php echo $item['name']; ?></option>
		    		<?php endforeach ?>
		    	<?php endif ?>
		    </select>
		  </div>
		  <div class="form-group col-md-3">
		    <label for="date">Chọn ngày:</label>
		    <input class="form-control pull-left" id="date" type="date" />
		  </div>
		  <div class="form-group col-md-3">
		    <label for="value">Lượng tiền (vnđ)</label>
		    <input class="form-control" id="value" type="text" onkeyup="oneDot(this)" />
		  </div>
		  <div class="form-group col-md-3">
		  	<input id="submit" type="submit" class="btn btn-success" value="Nhập" style="margin-top: 23px; padding: 5px 30px;">
		  </div>
		  <input type="hidden" name="creater" id="creater" value="<?php echo $this->session->userdata('name'); ?>">
		</form>
		<div id="cost-notify" style="display: none;">
		</div>
	</div>
</div>
<hr>
<div class="row">
<h1 class="text-center">Nhật ký đã nhập</h1>
	<div class="container" style="max-width: 910px">
		<table>
			<thead>
				<tr>
					<th>Campain</th>
					<th>Ngày</th>
					<th>Lượng tiền (Vnđ)</th>
					<th>Người nhập</th>
					<th>Ngày nhập</th>
				</tr>
			</thead>
			<tbody id="log-body">
				<?php if (isset($logs) && !empty($logs)): ?>
					<?php foreach ($logs as $item): ?>
						<tr>
							<td>
								<?php 
							 	foreach ($campaignes as $campaign) {
							 		if ($item['campaign_id'] == $campaign['id']) {
							 			echo $campaign['name'];
							 		}
							 	}
							 	?>
							 	
							 </td>
							<td>
								<?php echo $item['date']; ?>
							</td>
							<td>
								<?php echo number_format($item['value'], 0, ",", "."); ?>
							</td>
							<td><?php echo $item['creater']; ?></td>
							<td><?php echo $item['created']; ?></td>

						</tr>
					<?php endforeach ?>
				<?php endif ?>
			</tbody>
		</table>
	</div>
</div>
<script type="text/javascript">
	$('#cost-form').submit(function(e) {
		e.preventDefault();

		var campaign_id = $('#campaign').val();
		var notify = '';
		if (campaign_id == 0) {
			notify = '<p class="cost-errors text-danger">Hãy chọn campain!</p>';
		}

		var date = $('#date').val();

		if ($.trim(date) == '') {
			notify = '<p class="cost-errors text-danger">Hãy chọn tháng!</p>';
		}

		var value = $('#value').val();
		value = value.split('.').join('');

		if (isNaN(Number(value)) || value <= 0) {
			notify = '<p class="cost-errors text-danger">Hãy nhập đúng định dạng lượng tiền!</p>';
		}

		if (notify == '') {
			$.ajax({
				method: 'post',
				url: $(this).prop('action'),
				data: {
					campaign_id: campaign_id,
					date: date,
					value: value,
					creater: $('#creater').val()
				},
				dataType: "json",
				success: function(result) {
					var currentdate = new Date(); 
					var datetime = currentdate.getFullYear() + "-"
					                + (currentdate.getMonth()+1)  + "-" 
					                + currentdate.getDate() + " "  
					                + currentdate.getHours() + ":"  
					                + currentdate.getMinutes() + ":" 
					                + currentdate.getSeconds();
					var tr = '<tr><td>' + result.warehouse_name.name + '</td> <td>' + result.date + '</td> <td>' + VNcurrency(result.value) + '</td> <td>' + result.creater + '</td> <td>' + datetime + '</td> </tr>';
					$('#log-body').prepend(tr);

					$('#cost-notify').html(result.notify);
					$('#cost-notify').fadeIn();

					setTimeout(function(){
						$('#cost-notify').fadeOut();			
					}, 5000);
				},
				error: function(xhr, status, error) {
					$('#cost-notify').html('<p class="cost-errors text-danger">Có lỗi xảy ra! Có vẻ như đã nhập trùng rồi :(</p>');
					$('#cost-notify').fadeIn();

					setTimeout(function(){
						$('#cost-notify').fadeOut();			
					}, 5000);
				}
			});
		}

		$('#cost-notify').html(notify);
		$('#cost-notify').fadeIn();

		setTimeout(function(){
			$('#cost-notify').fadeOut();			
		}, 5000);

	});

	function oneDot(input) {
	    var value = input.value,
	        value = value.split('.').join('');

	    if (value.length > 3) {
	    	var count = Math.floor((value.length - 1)/3);
	    	var arr = [];
	    	for (i = count; i > 0; i--) {
	    		arr.push(value.substring(0, value.length - 3*i));
	    		value = value.slice(value.length - 3*i)
	    	}
	    	arr.push(value);
	    	var str = arr[0];
	    	for (i = 1; i < arr.length; i++) {
	    		str = str + '.' + arr[i];
	    	}
	      	value = str;
	    }

	    input.value = value;
  	}

  	function VNcurrency(input) {
  		if (input.length > 3) {
	    	var count = Math.floor((input.length - 1)/3);
	    	var arr = [];
	    	for (i = count; i > 0; i--) {
	    		arr.push(input.substring(0, input.length - 3*i));
	    		input = input.slice(input.length - 3*i)
	    	}
	    	arr.push(input);
	    	var str = arr[0];
	    	for (i = 1; i < arr.length; i++) {
	    		str = str + '.' + arr[i];
	    	}
	      	input = str;
	    }

	    return input;
  	}
</script>
<td class="center tbl_name">	
	<?php 
	if (isset($value['campaign_id']) && !empty($value['campaign_id'])) {
		$input = [];
        $input['select'] = 'name';
        $input['where'] = array('id' => $value['campaign_id']);
		$campaignName = $this->campaign_model->load_all($input);
		echo $campaignName[0]['name'];
    } else {
        echo 'Không có chiến dịch';
    }
	?>
</td>
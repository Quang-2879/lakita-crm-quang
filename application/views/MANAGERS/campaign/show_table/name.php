<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
echo '<td class="tbl_campaign_name campaign-detail" '
 . 'campaign-id="' . $row['id'] . '"'
 . 'data-url="' . base_url('MANAGERS/campaign/GetAdsetsModal') . '"'
 . 'data-modal-name="campaign-detail-modal"> ' . $row['name'] . '</td>';

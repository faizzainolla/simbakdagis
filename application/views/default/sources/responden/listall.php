<?php

$results['sEcho'] = $sEcho;
$results['iTotalRecords'] = $results['iTotalDisplayRecords'] = $iTotalRecords;
if(count($respondens)) {
	$i=0;
	foreach($respondens as $responden)
	{
		$showtarget = ($responden['data_map_latitude']!='' && $responden['data_map_longitude']!='')?true:false;
		$results['aData'][$i] = array(
			'<div class="aLignCenter">'.(++$start).'</div>',
			$responden['data_nomor_identitas'],
			$responden['data_responden_nik'],
			$responden['data_responden_nama'],
			$responden['data_responden_alamat'],
			'<div class="aLignCenter">'.$responden['data_responden_rt'].'</div>',
			'<div class="aLignCenter">'.$responden['data_responden_rw'].'</div>',
			'<div class="aLignCenter">
			<i class="icon-pencil-5" style="font-size:14px;cursor:pointer;" onClick="showRespondenEdit('.$responden['data_id'].')"></i>
			<i class="icon-file" style="font-size:14px;cursor:pointer;" onClick="showRespondenDetil('.$responden['data_id'].')"></i>
			'.(($showtarget)?'<i class="icon-target-2" style="font-size:14px;cursor:pointer;" onClick="showRespondenMap('.$responden['data_id'].')"></i>':'<i class="icon-target-2" style="font-size:14px;color:#ccc;"></i>').'
			</div>'
			);

		++$i;
	}
} else {
	for($i=0;$i<7;++$i) {
		$results['aaData'][0][$i] = '';
	}

}

print($callback.'('.json_encode($results).')');
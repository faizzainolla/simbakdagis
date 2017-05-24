<?php

$results['sEcho'] = $sEcho;
$results['iTotalRecords'] = $results['iTotalDisplayRecords'] = $iTotalRecords;
if(count($users)) {
	$i=0;
	foreach($users as $user)
	{
		$results['aaData'][$i] = array(
			'<div class="aLignCenter">'.(++$start).'</div>',
			$user['pegawai_nama_depan'],
			$user['pengguna_nama'],
			$user['kelurahan_nama'],
			'<div class="aLignCenter"><span style="cursor:pointer;" ref="'.$user['pengguna_id'].'" rel="'.$user['pengguna_status'].'" id="changepenggunastatus_'.$user['pengguna_id'].'" class="label changepenggunastatus label-'.(($user['pengguna_status']==1)?'success':'important').'">'.(($user['pengguna_status']==1)?'Aktif':'Tidak aktif').'</span></div>',
			/*'<div class="aLignCenter">'.(($user['pengguna_status']==1)?'Aktif':'Tidak aktif').'</div>',*/
			'<div class="aLignCenter">
			<i class="icon-pencil-5" style="font-size:14px;cursor:pointer;" onClick="showPenggunaEdit('.$user['pengguna_id'].')"></i>
			</div>'
			);

		++$i;
	}
} else {
	for($i=0;$i<5;++$i) {
		$results['aaData'][0][$i] = '';
	}

}

print($callback.'('.json_encode($results).')');
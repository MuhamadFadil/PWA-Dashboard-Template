<?php namespace App\Controllers;
class Nilai extends BaseController{
	public function index(){
    $tmp = Users::check();
		if($tmp==0){ return redirect()->to('login'); }
		if(!in_array($_SESSION['DATA_SESSION']['role'],array('Admin'))){
			return redirect()->to('dashboard');
		}
		$o['title'] = 'Skor &amp; Ranking';
		
		$d = \Config\Database::connect();
		$r = $d->query("select id, name, kode, status from kuesioner where status != 'draft'")->getResult();
		$kues = array_column((array)$r,'id');
		$kue = 0;
		if(isset($_POST['q'])){
			$kue = $_POST['q'];
		}
		if(!in_array($kue,$kues)){
			//cari kuesioner yg paling recently ada orang yg submit
			$terakhir = $d->query("select kuesioner from jawaban_final order by date desc limit 1")->getRow();
			$kue = $terakhir->kuesioner;
		}
			
		if(isset($r)){
			$tmp = '';
			foreach($r as $a){
				$s = '';
				if($kue == $a->id){
					$s = ' selected ';
				}
				$tmp .= "<option $s value='$a->id'>$a->name - $a->kode ($a->status)</option>";
			}
			$o['beforeOutput'] = "
				<div class='row'>
					<div class='col-xs-4'>
						<form action='".base_url('nilai/index')."' method='post'>
							<select name='q' class='form-control' onchange='submit()'>$tmp</select>
						</form>
					</div>
					<div class='col-xs-3'>
						<a href='".base_url('nilai/calc/'.$kue)."' class='btn btn-primary'>Recalculate Ranks</a>
						<a href='".base_url('nilai/raw/'.$kue)."' class='btn btn-primary'>Get raw data</a>
					</div>
					<div class='col-xs-5'></div>
				</div>";
		}
		// TODO: bikin dropdown filter, lihat rank per grup
    $c = $this->_getGroceryCrudEnterprise();
		$c->setTable('nilai');
		$c->where(['kuesioner' => $kue]);
		// $c->where('kuesioner',$kue);
		$c->unsetAdd();
		$c->displayAs('kota_kabupaten','Kota/Kabupaten');
		$c->unsetEdit();
		$c->unsetExport();
		$c->unsetDelete();
		$c->setRelation('kuesioner','kuesioner','{kode} - {name} ({status})');
		$c->setRelation('kota_kabupaten','users','{provinsi} - {kota}');
		$output = $c->render();
		return $this->_example_output($output,$o);
	}
	public function calc($q=0){ //param: kuesionerid
    $tmp = Users::check();
		if($tmp==0){ return redirect()->to('login'); }
		if(!in_array($_SESSION['DATA_SESSION']['role'],array('Admin'))){
			return redirect()->to('dashboard');
		}
		if($q==0){
			return redirect()->to(base_url('nilai'));
		}
		$d = \Config\Database::connect();
		
		$r = $d->query("select id, skor from nilai where kuesioner = $q and skor is not null order by skor desc")->getResult();
		$tmp = array();
		$i = 0;
		$prevScore = 0;
		if(isset($r)){
			foreach($r as $a){
				if($prevScore != $a->skor){
					$i++; 
				}
				$prevScore = $a->skor;
				$tmp[] = ['id' => $a->id, 'rank' => $i];
			}
		}
		$r = $d->query("select id from nilai where kuesioner = $q and skor is null")->getResult();
		if(isset($r)){
			foreach($r as $a){
				$tmp[] = ['id' => $a->id, 'rank' => null];
			}
		}
		$d->table('nilai')->updateBatch($tmp, 'id');

		$r = $d->query("select id, skor_reviewer from nilai where kuesioner = $q and skor_reviewer is not null order by skor_reviewer desc")->getResult();
		$tmp = array();
		$i = 0;
		$prevScore = 0;
		if(isset($r)){
			foreach($r as $a){
				if($prevScore != $a->skor_reviewer){
					$i++; 
				}
				$prevScore = $a->skor_reviewer;
				$tmp[] = ['id' => $a->id, 'rank_reviewer' => $i];
			}
		}
		$r = $d->query("select id from nilai where kuesioner = $q and skor_reviewer is null")->getResult();
		if(isset($r)){
			foreach($r as $a){
				$tmp[] = ['id' => $a->id, 'rank_reviewer' => null];
			}
		}
		$d->table('nilai')->updateBatch($tmp, 'id');
		return redirect()->to(base_url('nilai'));
	}
	public function grup_rank($q=0){
    $tmp = Users::check();
		if($tmp==0){ return redirect()->to('login'); }
		if(!in_array($_SESSION['DATA_SESSION']['role'],array('Admin'))){
			return redirect()->to('dashboard');
		}
		if($q==0){
			return redirect()->to(base_url('nilai'));
		}
		$d = \Config\Database::connect();
		
		/* isi kolom
		kota/nama reviewer
		tgl submit
		total skor
		rank overall
		grup 1 (kota (skor, rank), reviewer (skor, rank))
		grup 2 (kota (skor, rank), reviewer (skor, rank))
		...
		
		tampilkan tombol copy to excel
		*/
	}
	public function raw($q=0){
    $tmp = Users::check();
		if($tmp==0){ return redirect()->to('login'); }
		if(!in_array($_SESSION['DATA_SESSION']['role'],array('Admin'))){
			return redirect()->to('dashboard');
		}
		if($q==0){
			return redirect()->to(base_url('nilai'));
		}
		$d = \Config\Database::connect();
		$t = '';
		$r = $d->query("
			select u.kota, u.provinsi, jf.date submit, u2.name reviewer, jf2.date submit_review, u.id id_kota, u2.id id_reviewer, u2.id id_reviewer, n.skor, n.skor_reviewer, n.rank, n.rank_reviewer
			from jawaban_final jf
			join users u on u.id = jf.user
			left join review_assignment ra on ra.user = jf.user and ra.kuesioner = $q
			left join users u2 on u2.id = ra.reviewer
			left join jawaban_final jf2 on jf2.user = ra.reviewer
			left join nilai n on n.kuesioner = jf.kuesioner and n.kota_kabupaten = jf.user
			where 
			jf.kuesioner = $q
			and u.role = 'Kota'
		")->getResult();
		
		$r2 = $d->query("
			select g.id, g.name, g.kode, count(*) num_p
			from grup g
			join pertanyaan p on p.grup = g.id
			where g.kuesioner = $q
			group by g.id
			order by g.urutan asc, g.name asc
		")->getResult();
		
		$r3 = $d->query("
			select p.id, p.kode, p.visibility v, p.teks, p.max_score
			from grup g
			join pertanyaan p on p.grup = g.id
			where g.kuesioner = 7
			order by g.urutan asc, g.name asc,
			p.urutan asc, p.visibility asc, p.teks
		")->getResult();
		
		$maxNilai = $d->query("select sum(max_score) t from pertanyaan where grup in (select id from grup where kuesioner = $q)")->getRow()->t;
		
		// $r4 = $d->query("")->getResult();
		// $r5 = $d->query("")->getResult();
		// $r6 = $d->query("")->getResult();
		// $r7 = $d->query("")->getResult();
		// $r8 = $d->query("")->getResult();
		
		$bg1 = " class='bg1' ";
		$bg2 = " class='bg2' ";
		$bg3 = " class='bg3' ";
		
		$t .= "
			<table id='rawtable' border=1 cellpadding=0 cellspacing=0 style=''>
			 <thead>
				 <tr>
					<td rowspan=4 ><b>Kota</b></td>
					<td rowspan=4 ><b>Provinsi</b></td>
					<td rowspan=4 ><b>Tgl submit</b></td>
					<td rowspan=4 ><b>Reviewer</b></td>
					<td rowspan=4 ><b>Tgl submit review</b></td>
					<td colspan=2 rowspan=2 $bg1><b>Total Skor [100]</b></td>
					<td colspan=2 rowspan=2 $bg1><b>Total Nilai [$maxNilai]</b></td>
		";
		//TODO: rank
		
		foreach($r2 as $a){ $t .= "<td colspan=2 rowspan=2 $bg2><b>Nilai Grup $a->kode</b></td>"; }
		foreach($r2 as $a){ $t .= "<td colspan=".$a->num_p * 4 ." $bg3><b>Grup $a->kode</b></td>"; }
		$t .= "</tr><tr>";
		foreach($r3 as $a){ 
			$v = $a->v=='hidden' ? ' <small><i>(hidden)</i></small>' : '';
			$s = is_null($a->max_score) ? 0 : $a->max_score;
			$t .= "<td colspan=4 $bg3><b>".strip_tags($a->teks)."$v [$s]</b></td>"; }
		$t .= "</tr><tr>";
		$t .= "<td rowspan=2 $bg1><b>Kota</b></td><td rowspan=2 $bg1><b>Reviewer</b></td>"; //total skor
		$t .= "<td rowspan=2 $bg1><b>Kota</b></td><td rowspan=2 $bg1><b>Reviewer</b></td>"; //total nilai
		foreach($r2 as $a){ $t .= "<td rowspan=2 $bg2><b>Kota</b></td><td rowspan=2 $bg2><b>Reviewer</b></td>"; }
		foreach($r3 as $a){ $t .= "<td colspan=2 $bg3><b>Kota</b></td><td colspan=2 $bg3><b>Reviewer</b></td>"; }
		$t .= "</tr><tr>";
		foreach($r3 as $a){ $t .= "<td $bg3><b>Isian</b></td><td $bg3><b>Nilai</b></td><td $bg3><b>Isian</b></td><td $bg3><b>Nilai</b></td>"; }
		$t .= "</tr></thead><tbody>";
		
		foreach($r as $a){
			$t .= "<tr>
				<td>$a->kota</td>
				<td>$a->provinsi</td>
				<td>$a->submit</td>
				<td>$a->reviewer</td>
				<td>$a->submit_review</td>
				<td $bg1>$a->skor</td>
				<td $bg1>$a->skor_reviewer</td>";
				
			$totAll = 0;
			$totAllR = 0;
			$t2 = '';
			foreach($r2 as $a2){
				$g = $d->query("
					select j.pengisi, sum(nilai) tot
					from jawaban j
					left join pertanyaan p on p.id = j.pertanyaan
					where p.grup = $a2->id
					and j.user = $a->id_kota
					group by j.pengisi
				")->getResult();
				$gk = '';
				$gr = '';
				foreach($g as $gru){
					if($gru->pengisi == 'Kota'){
						$gk = $gru->tot;
						$totAll += $gk;
					}else{
						$gr = $gru->tot;
						$totAllR += $gr;
					}					
				}
				$t2 .= "<td $bg2>$gk</td><td $bg2>$gr</td>";
			}
			$t .= "<td $bg1>$totAll</td><td $bg1>$totAllR</td>".$t2;
			
			foreach($r3 as $a3){
				$j = $d->query("
					select j.jawaban, j.nilai, p.kode, p.formula, p.max_score, p.jenis_jawaban, p.visibility, j.pengisi
					from jawaban j
					join pertanyaan p on p.id = j.pertanyaan
					where j.pertanyaan = $a3->id
					and j.user = $a->id_kota
				")->getResult();
				$ik = '';
				$nk = '';
				$ir = '';
				$nr = '';
				foreach($j as $jw){
					if($jw->pengisi == 'Kota'){
						$ik = $jw->jawaban == '[]' ? '' : $jw->jawaban;
						$nk = $jw->nilai;
					}else{
						$ir = $jw->jawaban == '[]' ? '' : $jw->jawaban;
						$nr = $jw->nilai;
					}
				}
				$t .= "<td $bg3>$ik</td><td $bg3>$nk</td><td $bg3>$ir</td><td $bg3>$nr</td>";
			}
			$t .= "</tr>";
		}
		$t .= "</tbody></table>";
		

/*
TODO: sembunyikan kolom:
	isian utk pertanyaan hidden
	skor utk pertanyaan yg max_skornya 0
*/		
		// echo $t;
		$output = null;
		$o['endOfContentWrapper'] = "
			<script>
				function takeit(e){
					var text = document.getElementById('rawtable');
					var selection = window.getSelection();
					var range = document.createRange();
					range.selectNodeContents(text);
					selection.removeAllRanges();
					selection.addRange(range);
					document.execCommand('copy');
					alert('Done. Now open your spreadsheet editor (e.g. Ms. Excel) and press CTRL+V');
				}
			</script>
		";
		$o['title'] = 'Exporting Raw Data';
		$style = 'width:1px;height:1px;overflow:hidden';
		// $style = 'overflow:scroll';
		$o['beforeOutput'] = '
			Raw data is ready to be exported.
			<br>You can export it to your spreadsheet editor (e.g. Ms. Excel) by doing this:
			<ol>
				<li>Click the button below</li>
				<li>Open your spreadsheet editor</li>
				<li>Click Paste on your spreadsheet editor (or click CTRL+V on your keyboard)</li>
			</ol>
			<a href="#" onclick="takeit(this)" class="btn btn-primary">Copy raw data</a>
			<br><br>
			<div style="'.$style.'">'.$t.'</div>';
		return $this->_example_output($output,$o);
	}
}
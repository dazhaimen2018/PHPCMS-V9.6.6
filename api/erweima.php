<?php
defined('IN_CMS') or exit('No permission resources.'); 
include CMS_PATH.'/api/phpqrcode.php';

$content_db = pc_base::load_model('content_model');
if ($_GET['callback']=='jsonpCallback') {
	if($_GET['modelid'] && $_GET['id']) {
		$content_db->set_model($_GET['modelid']);
		$data = $content_db->get_one(array('id'=>$_GET['id'],'status'=>99));
		// 纠错级别：L、M、Q、H
		$errorCorrectionLevel = 'L';
		// 点的大小：1到10
		$matrixPointSize = 4;
		$logo = APP_PATH.'statics/css/img/erweimalogo.png';
		if(!preg_match('|^http://|',$data['url'])){
			QRcode::png(substr(APP_PATH, 0, -1).$data['url'], false, $errorCorrectionLevel, $matrixPointSize, 2);
		}else{
			QRcode::png($data['url'], false, $errorCorrectionLevel, $matrixPointSize, 2);
		}
	}
}
?>
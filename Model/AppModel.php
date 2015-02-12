<?php

App::uses('Model', 'Model');

class AppModel extends Model {
	public $actsAs = array(
		'Form'
	);

	public function afterFind($results, $primary = false)
	{
		// foreach ($results as $key => $val) {
		// 	if (isset($results[$key]['date'])) {					
		// 		$results[$key]['date'] = $this->dateFormatAfterFind($val['date']);
		// 		continue;
		// 	}
		// 	foreach ($val as $k => $v) {
		// 		if (isset($results[$key][$k]['date'])) {					
		// 			$results[$key][$k]['date'] = $this->dateFormatAfterFind($v['date']);
		// 			break;
		// 		}
		// 	}
		// }
		// // pr($results); exit;
		return $results;
	}

	public function dateFormatAfterFind($dateString) {
		return date('d/m/Y H:i:s', strtotime($dateString));
	}

}

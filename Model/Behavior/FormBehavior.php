<?php 
class FormBehavior extends ModelBehavior { 
	protected $Model = null;
	protected $data = array();
	protected $pagination = array();


	public function action(Model &$Model, $data = array(), $pagination = array()) {
		$this->Model = $Model;
		$this->data = $data;
		$this->pagination = $pagination;
		return $this->search();
	}

	public function statusAjax(Model &$Model, $id, $status, $column){

		$toggle = $Model->find("first", array(
			'recursive'=>-1, 
			'conditions'=>array(
				$Model->name.".id" => $id
			)
		));
		if(!empty($toggle[$Model->name])){
			echo $status = ($toggle[$Model->name][$column]) ? 0 : 1;
			$Model->id = $id;
			$Model->saveField('status', $status);
		}
		return $status;
	}

	public function sendEmail(Model &$Model, $email, $message=''){

		// pr($email); exit();
	
		if(!empty($email)){
			$Email = new CakeEmail('smtp');
			$Email->to($email);
			// $Email->bcc($email);
			// $Email->emailFormat('html');
			$Email->subject($message);
			if($Email->send($message)){
				return true;
			}else{
				return false;
			}
		}

	}

	public function pagination(Model &$Model) {
		return $this->pagination;
	}
	
	private function search()
	{
		//pr($this->data);
		if(!empty($this->data['Filter'])){

			foreach ($this->data['Filter'] as $column => $filter) {
				

				$this->pagination += empty($this->data['Pagination']) ? array() : $this->data['Pagination'];
				
				if (is_array($this->data['conditions'][$column])) {
					foreach ($this->data['conditions'][$column] as $key => $value) {
						$conditions = $value;
					}
				} else {
					$conditions = $this->data['conditions'][$column];
				}

				if(empty($this->data['conditions'][$column]))
					continue;
				
				if(is_array($filter)) {
					foreach ($filter as $key => $value) {
						$column = $column.".".$key;
						$filter = $value;
					}
				} else {
					$column = $this->Model->name.".".$column;
				}
				//echo $column." - ".$filter."<br>";
				if (empty($filter))
					continue;


				switch ($conditions) {
					case 'LIKE':
						$this->pagination['conditions']['OR']['AND']["$column LIKE"] = "%$filter%";
						break;
					case 'NOT LIKE':
						$this->pagination['conditions']['OR']['AND']["$column NOT LIKE"] = "%$filter%";
						break;
					case 'LIKE BEGIN':
						$this->pagination['conditions']['OR']['AND']["$column LIKE"] = "$filter%";
						break;
					case 'LIKE END':
						$this->pagination['conditions']['OR']['AND']["$column LIKE"] = "%$filter";
						break;
					case '!=':
						$this->pagination['conditions']['OR']['AND']["$column !="] = "$filter";
						break;
					case '>':
						$this->pagination['conditions']['OR']['AND']["$column >"] = "$filter";
						break;
					case '<':
						$this->pagination['conditions']['OR']['AND']["$column <"] = "$filter";
						break;
					case '<=':
						$this->pagination['conditions']['OR']['AND']["$column <="] = "$filter";
						break;
					case '>=':
						$this->pagination['conditions']['OR']['AND']["$column >="] = "$filter";
					case '=':
					default:
						$this->pagination['conditions']['OR']['AND']["$column"] = "$filter";
						break;
						break;
				}

			}

			//exit;

			if (!empty($this->data['Date'])) {				
				$v = -1;
				foreach ($this->data['Date'] as $key => $value) {
					foreach ($value as $column => $filter) {
						$v+=1;
						if(empty($filter))
							continue;
						
						$filter = date('Y/m/d H:i:s', strtotime($filter));
							
						if($v % 2 == 0){
							$this->pagination['conditions']['OR']['AND'][$this->Model->name.".$column >="] = "$filter*";
						} else {
							$this->pagination['conditions']['OR']['AND'][$this->Model->name.".$column <="] = "$filter*";
						}
					}
				}
			}
		}

		if (!empty($this->data['row'])) {
			foreach ($this->data['row'] as $id => $value) {
				if ($value)
					$this->pagination['conditions']['OR']['OR'][] = array("{$this->Model->name}.id"=>$id);
			}
		}
		// pr($this->pagination); exit;
		$this->pagination['limit'] = 999999999999999;
		return $this->pagination;
	}

	private function __delete( ) { 
		$return = '';
		if(!empty($this->data['row']))
		{
			foreach ($this->data['row'] as $id => $value) { 
				if($value){
					$user = $this->Model->read(null,$id);
					if ($this->Model->delete($id)){
						$return .= '</br>'.
						$user[$this->Model->name][$this->Model->displayField].
						' excluido!';
					}else{
						echo $return .= '</br>'.
						$user[$this->Model->name][$this->Model->displayField].
						' não excluido!';
						
					}
				}
			}
		}
		return $return;
	}
}

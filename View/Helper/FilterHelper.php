<?php 
App::uses('AppHelper', 'View/Helper'); 
class FilterHelper extends AppHelper {
	public $helpers = array('Html', 'Form', 'Menu');

	public function conditions($name, $conditions = array()){
		$options = array(
            'label'=>false,
            'div'=>false,
            'class'=>'span12',
            'autocomplete'=>'off',
            'onfocus'=>'this.select();',
            'required'=>''
        );
		$options = array_merge($options, $conditions);
		echo "<td  data-th='".ucfirst(__($name))."'>";
		$this->Form->inputDefaults($options);

		$options = array(
            '=' => 'igual',
            'LIKE' => 'contenha',
            'NOT LIKE' => 'não contenha',
            'LIKE BEGIN' => 'começando com',
            'LIKE END' => 'terminando com',
            '!=' => 'diferente',
            '>'  => 'maior do que',
            '>=' => 'maior ou igual a',
            '<'  => 'menor que',
            '<=' => 'menor ou igual a'
        );

		echo $this->Form->input("conditions.$name", array(
            'options' => $options,
        ));

        echo $this->Form->input("Filter.$name", array(
        	'type'=>'text',
			'autofocus' => true,
			'placeholder' => ucfirst(__($name)).'...',
		));
		echo "</td>";
	}

	public function conditionsDate($name, $conditions = array()){

		$options = array(
            'label'=>false,
            'div'=>false,
            'class'=>'span12',
            'autocomplete'=>'off',
            'onfocus'=>'this.select();',
        );
		$options = array_merge($options, $conditions);

		echo "<td  data-th='".ucfirst(__($name))."'>";
			$this->Form->inputDefaults($options);

	        // '>=' => 'maior ou igual a'
	        // '<=' => 'menor ou igual a'

	        echo $this->Form->input("Date.0.$name", array(
	        	'type'=>'text',
				'autofocus' => true,
				'placeholder' => '01/09/2014',
				'title' => 'de...',
			));
			echo $this->Form->input("Date.1.$name", array(
	        	'type'=>'text',
				'autofocus' => true,
				'placeholder' => date("d/m/Y H:i:00"),
				'title' => 'ate...',
			));
		echo "</td>";
	}

	public function conditionsSelect($name, $list = array()){
		echo "<td  data-th='".ucfirst(__($name))."'>";
		$this->Form->inputDefaults(array(
            'label'=>false,
            'div'=>false,
            'class'=>'span12',
            'autocomplete'=>'off',
            'onfocus'=>'this.select();',
            'required'=>''
        ));

		$options = array(
            '=' => 'igual',
        );

		echo $this->Form->input("conditions.$name", array(
            'options' => $options,
        ));

        $list['null'] = "Nenhum";

        echo $this->Form->input("Filter.$name", array(
        	'type'=>'select',
        	'empty'=>'Opções',
			'options' => $list,
            'onchange'=>'this.form.submit();'
		));
		echo "</td>";
	}

	public function row($name){
		echo $this->Form->checkbox(
			"row.$name", 
			array( 
				'class'=>'rowfilter'
			)
		);
	}

	public function limit(){
		return $this->Form->input('Pagination.limit', array(
            'label'=>false,
            'div'=>false,
            'type'=>'select',
            'options'=> array(
				'20'=>'20',
				'50'=>'50',
				'100'=>'100',
				'999999999999999'=>'Todos'
			),
            'default'=>20,
            "class"=>"span12",
            'onchange'=>'this.form.submit();'
        ));
	}


	public function img(){
		echo $this->Html->image(
			'/img/icons/filters.png',
			array(
				'title'=>'Filter',
				'width'=>'20px',
				'height'=>'20px',
				'class'=>'left'
			)
		);
	}


} 

?>


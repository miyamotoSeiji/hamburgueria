<?php
abstract class AppModelTestCase extends CakeTestCase {
    
    public $fixtures = array();
    public $modelName = null;
    public $newRecord = array();
    public $record = array();

    public function startTest($method) {
        $method = $method;
        $this->{$this->modelName} = ClassRegistry::init($this->modelName);
    }

    public function setUp() {
        $this->beforeTestSave();
    }
    
    public function beforeTestSave() {
        $this->record = $this->newRecord;
    } 
    
    public function assertTrueInstance() {
        $this->assertTrue(is_a($this->{$this->modelName}, $this->modelName));
    }

    public function assertEqualsFind($expected = 1) {
        $actual = $this->{$this->modelName}->find('count');
        $this->assertEquals($expected, $actual);
    }

    public function assertEqualsFindConditions($conditions) {
        $actual = $this->{$this->modelName}->find('count', array('conditions' => $conditions));
        $expected = 1;
        $this->assertEquals($expected, $actual);
    }

    public function assertEqualsNotFindConditions($conditions) {
        $actual = $this->{$this->modelName}->find('count', array('conditions' => $conditions));
        $expected = 0;
        $this->assertEquals($expected, $actual);
    }

    public function assertTrueSave() {
        $saved = $this->{$this->modelName}->save($this->record, false);
        $this->assertTrue(!empty($saved));
        
        return $saved;
    }    

    public function assertEqualsInvalidField($field, $content) {
        $this->{$this->modelName}->validationErrors = null;        
        if (empty($this->{$this->modelName}->data)) {
            $this->{$this->modelName}->set(array($field => $content));
        } else {
            $this->{$this->modelName}->data[$this->modelName][$field] = $content;            
        }
        $valid = $this->{$this->modelName}->validates(array('fieldList' => array($field)));
        $invalidFields = $this->{$this->modelName}->validationErrors;
        if (is_array($invalidFields)) {
            $invalidFields = array_keys($invalidFields);            
            $invalidFieldName = $invalidFields[0];
        } else {
            $invalidFieldName = $invalidFields;
        }

        $this->assertFalse($valid);
        $this->assertEquals($field, $invalidFieldName);
    }
    
    public function copyFileUploaded($arquivo) {
        $source = TESTS . 'Fixture' . DS . 'files' . DS . $arquivo;        
        $destination = $this->{$this->modelName}->path() . $arquivo;
        
        return copy($source, $destination);                
    }
    
    public function deleteFileUploaded($arquivo) {
        return unlink($this->{$this->modelName}->path() . $arquivo);        
    }
    
    
}   
?>
<?php
require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'WebContent'.DIRECTORY_SEPARATOR.'EvalProfileModel.php');
class test_EvalProfileModel extends UnitTestCase {
	private $model;
	
	function setUp() {
		$con = mysqli_connect("localhost", "krobbins", "abc123", "tj_data_test");
		$sql = "DELETE FROM urlentry";
		mysqli_query($con, $sql);
		mysqli_close($con);
		$this->model = new EvalProfileModel("localhost", "krobbins", "abc123", "tj_data_test");	
	}
	
	function tearDown() {
		
	}
	
  function testMakeEvalProfileModel(){
  	$this->assertTrue(class_exists('EvalProfileModel'), 
  			'The EvalProfileModel class should be defined');
  	$this->assertTrue(is_a($this->model, 'EvalProfileModel'), 
  			'EvalProfileModel should have a constructor');
  }
  
  function testOnEmptyDatabase() {
  	$this->model->deleteALL ();
  	$this->assertEqual($this->model->getNextProfile(), 0,
  			'getNextProfile should return false when trying to get a profile from an empty database');
  	$this->assertEqual($this->model->getCount(), 0,
  			'getCount should return 0 rows when database is empty');
  }
  
  function testCreateSimpleInsertion(){
  	$this->assertEqual($this->model->getCount(), 0,
  			'getCount should return 0 rows when database is empty');
  	$newvals = array('name' => 'john smith',
  						'email' => '123@aol.com',
  						'sex' => 'male',
  						'available' => array('mon','tue','sat'),
  						'exp' => '1-3',
  						'trainer_description' => 'this is the trainer description');
  	$filevals = array('photo' => array('name' => 'icon.jpg',
  										'type' => 'image/jpeg',
  										'tmp_name' => 'C:\xampp\tmp\phpB7E7.tmp',
  										'error' => '0',
  										'size' => '31097'));
  	$result = $this->model->create($newvals, $filevals);
  	if(!is_array($result)){
  		$iserror = 1;
  	}else{
  		$iserror = 0;
  	}
  	
  	$this->assertEqual(0, $iserror, 
  			'create should not produce an error when input is correct, error is: '.$this->model->getError().' result is ');
  	$this->assertEqual(1, $this->model->getCount(),
  			'error count should not be 0 when added row, count is '.$this->model->getCount());
  }
   
  function testInsertMultipleRows(){
  	$this->model->deleteALL();  	
  	$this->assertEqual($this->model->getCount(), 0, 
  			'It should return 0 rows when database is empty');

  	for ($k = 1; $k <= 10; $k++) {
  		$newvals = array('name' => "john smith$k",
  				'email' => "123$k@aol.com",
  				'sex' => 'male',
  				'available' => array('mon','tue','sat'),
  				'exp' => '1-3',
  				'trainer_description' => 'this is the trainer description');
  		$filevals = array('photo' => array('name' => "icon$k.jpg",
  				'type' => 'image/jpeg',
  				'tmp_name' => 'C:\xampp\tmp\phpB7E7.tmp',
  				'error' => '0',
  				'size' => '31097'));
  		$this->model->create($newvals, $filevals);
  	}
  	$this->assertEqual($this->model->getCount(), 10, 
  	         'The database should have 10 rows after inserting 10 Profiles, count is '.$this->model->getCount());
  }
  
  function testGetUrl(){
  	$this->model->deleteALL();
  	$this->assertEqual($this->model->getCount(), 0,
  			'It should return 0 rows when database is empty');
    
  	for ($k = 1; $k <= 10; $k++) {
  		$newvals = array('name' => "john smith$k",
  				'email' => "123$k@aol.com",
  				'sex' => 'male',
  				'available' => array('mon','tue','sat'),
  				'exp' => '1-3',
  				'trainer_description' => 'this is the trainer description');
  		$filevals = array('photo' => array('name' => "icon$k.jpg",
  				'type' => 'image/jpeg',
  				'tmp_name' => 'C:\xampp\tmp\phpB7E7.tmp',
  				'error' => '0',
  				'size' => '31097'));
  		$this->model->create($newvals, $filevals);
  	}
  	$this->assertEqual($this->model->getCount(), 10,
  			'The database should have 10 rows after inserting 10 profiles, count is'.$this->model->getCount());
  	
  	for ($k = 1; $k <= 10; $k++) {
  		$myTrainer = "john smith$k";
  		$myResult = $this->model->getProfile($myTrainer);
  		$this->assertTrue(is_array($myResult));
  		$this->assertEqual(strcmp($myResult['name'], $myTrainer), 0, 'The returned value from getProfile should be the same');
  	}
  }
  
  function testTryConnectionWithBadCredentials () {
  	$this->expectException();
  	//$this->expectError(new PatternExpectation("/Bad connection/i"));
  	$mod = new EvalProfileModel ( "localhost", "jrobbins", "abc123", "tj_data_test" );
  	//$this->assertTrue(is_a($mod, 'EvalUrlModel'));
  	//$this->assertTrue($mod->getError());
  }
}
?>
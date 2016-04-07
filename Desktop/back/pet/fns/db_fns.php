<?php
/*
 *  @author programofreak
 *  @email programofreak@programofreaks.com
 */

    #========================================================#
    #------- SETTING UP DATABASE CONNECTION USING PDO -------#
    #========================================================#
    
# @class PDOConfig provides the PDO connection of mysql queries
# to use, instantiate an object of this class as $dbh = new PDOConfig; where the $dbh will be the database handler
	
class PDOConfig extends PDO { 
    private $engine; 
    private $host; 
    private $database; 
    private $user; 
    private $pass; 
    
    public function __construct(){ 
		$this->engine = "mysql";             	# database engine
		$this->host =  "localhost";          	# host name
		$this->database = "pet";      	# database name
		$this->user ="root";           	# database username
		$this->pass = "guru";          	# database password
		
        $dns = $this->engine.':dbname='.$this->database.";host=".$this->host; 
        try {
			parent::__construct( $dns, $this->user, $this->pass ); 
		}catch(PDOException $e){
			var_dump($e);
			var_dump($e->getMessage());
			var_dump($e->getCode());
		}
    } 
}
?>
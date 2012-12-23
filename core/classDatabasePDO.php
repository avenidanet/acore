<?php
/**
* ACore v.5.0.0
*
* Simple framework php
*
* @author Brian Salazar [Avenidanet]
* @link http://www.avenidanet.com
* @copyright Brian Salazar 2006-2013
* @license http://mit-license.org
* 
*/

class DatabasePDO extends PDO{
	
	private static $instance = null;
	private $recordSet = null;
	private $query = "";	
	protected $acore = null;

	public function __construct()
	{
		$this->acore = Settings::Init();
		try {
			parent::__construct('mysql:host=' . $this->acore->host . ';dbname=' . $this->acore->database,$this->acore->user, $this->acore->pass);
		} catch(PDOException $e) {
			echo "ACore DB_ERROR: ".$e->getMessage();
		}
	}
	
    public static function Init()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }
 		return self::$instance;
    }
        
	/*
	 * QUERY NORMAL
	 * 
	 * (SELECT :fields) | array(field => value)
	 */
    public function queryNormal($sentence,$data){
    	return $this->sendQuery($sentence, $data);
    }
    
    /*
     * SELECT
     * 
     * (SELECT * FROM table WHERE field= :field ORDER BY field ASC LIMIT 0,100) | array(field => value)
     */ 
    public function querySelect($table,$count=FALSE,$data='*',$where='',$fields=array(),$order='',$limit=''){
   		$sentence = "SELECT ";
   		$sentence .= ($count)?'COUNT(':'';
   		
   		if(is_array($data)){
   			foreach ($data as $field => $value){
   				$sentence .= $value . ',';
   			}
   			$sentence = substr($sentence, 0, -1);
   		}else{
   			$sentence .= $data;
   		}
   		
   		$sentence .= ($count)?')':'';
   		
   		$sentence .= " FROM ".$table;
   		$sentence .= ( $where == '' ) ? '' : ' WHERE ' . $where;
		$sentence .= ( $order == '' ) ? '' : ' ORDER BY ' . $order;
		$sentence .= ( $limit == '' ) ? '' : ' LIMIT ' . $limit;
		$sentence .= ";";
		
		return $this->sendQuery($sentence, $fields);	
    }
   
	/*
	 * INSERT
	 * 
	 * (INSERT INTO table (fields) as (:fields)) | array(field=> value)
	 */
    public function queryInsert($table,$data){
    	$fields = "";
    	$values = "";
    	$params = array();
    	
    	foreach ($data as $field => $value){
    		$fields .= $field.",";
    		$values .= ":".$field.",";
    	}

    	$fields = substr($fields, 0,-1);
    	$values = substr($values, 0,-1);
    	
    	$sentence = "INSERT INTO " . $table ." (".$fields.") VALUES (".$values.");";
    	
		return $this->sendQuery($sentence,$data,$table);
    }
    
    /*
     * UPDATE
     * 
     * (UPDATE table SET field = :field WHERE field = :field)
     */
    public function queryUpdate($table,$data,$where,$fields){
    	$sentence = "UPDATE " . $table . " SET ";
    	foreach ($data as $field => $value){
    		$sentence .= $field . " = :". $field . ",";
    	}
    	$sentence = substr($sentence, 0, -1);
    	$sentence .= ' WHERE ' . $where;
    	
    	$arrays = array_merge($data,$fields);

    	return $this->sendQuery($sentence,$arrays,$table);
    }
    
    /*
     * DELETE
     * 
     * (DELETE FROM table WHERE field = :field)
     */
	public function queryDelete($table,$where,$fields){
	    $sentence = "DELETE FROM " . $table . ' WHERE ' . $where;
    	return $this->sendQuery($sentence, $fields);
    }
	
    /*
     * PDO Send Query ('saneadas')
     */
    private function sendQuery($sentence,$data,$table=NULL){
    	if($this->acore->debug){
    		D::log($sentence);
    		D::log($data);
    	}
        $pdos = $this->prepare($sentence);
		if(!empty($data)){
			foreach ($data as $field => $value){
				if(is_numeric( $value )){
					$pdos->bindValue(":".$field, $value, PDO::PARAM_INT);
				}else{
					$pdos->bindValue(":".$field, $value, PDO::PARAM_STR);
				}
			}
		}
		
		if($pdos->execute()){
			if($sentence[0] == "S"){
				return $pdos->fetchALL(PDO::FETCH_ASSOC);
			}elseif ($sentence[0] == "I") {
				return PDO::lastInsertId();
			}else{
				return TRUE;
			}
		}else{
			echo "ACore DB_ERROR: Check query, enable debug mode.";
			D::log($sentence);
			D::log($data);
			return FALSE;
		}	
    }
}
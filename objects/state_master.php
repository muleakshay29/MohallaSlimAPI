<?php
class StateMaster
{
    // database connection and table name
    private $conn;
    private $table_name = "state_master";

    // object properties
    public $State_name;
    public $State_id;
    public $timestamp;

    public function __construct($db)
	{
        $this->conn = $db;
    }

    public function readAll() 
	{
		$query = "SELECT State_id as Id,State_name as Name
				  FROM ".$this->table_name."
				  ORDER BY State_id ASC";

        //prepare query statement
        $stmt = $this->conn->prepare($query);

        //execute query
        $stmt->execute();

        return $stmt;
    }
	
	public function read($Country_id)
	{
		$query = "SELECT State_id as Id,State_name as Name 
				  FROM " . $this->table_name . " 
				  WHERE Country_id=:Country_id
				  ORDER BY State_id ASC";

        //prepare query for execution
        $stmt = $this->conn->prepare($query);

        $Country_id = htmlspecialchars(strip_tags($Country_id));
        $stmt->bindParam(':Country_id', $Country_id);
        $stmt->execute();
		return $stmt;

        /* $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

		if($results != null)
		{
			return json_encode($results);
		}
		else
		{
			return 0;
		} */
    }
}
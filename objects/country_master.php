<?php
class CountryMaster
{
    // database connection and table name
    private $conn;
    private $table_name = "country_master";

    // object properties
    public $Country_name;
    public $Country_id;
    public $timestamp;

    public function __construct($db)
	{
        $this->conn = $db;
    }

    public function create()
	{
        try
		{
            // insert query
            $query = "INSERT INTO ".$this->table_name."
					  SET Country_name=:Country_name";
			
            // prepare query for execution
            $stmt = $this->conn->prepare($query);

            // sanitize
            $Country_name = htmlspecialchars(strip_tags($this->Country_name));

            // bind the parameters
            $stmt->bindParam(':Country_name', $Country_name);

            // Execute the query
            if($stmt->execute())
			{
                // return true;
				return $this->conn->lastInsertId(); 
            }
			else
			{
                // return false;
                return '0';
            }

        }
            // show error if any
        catch(PDOException $exception)
		{
            die('ERROR: ' . $exception->getMessage());
        }
    }
	
	public function read() 
	{
		$query = "SELECT Country_id as Id,Country_name as Name
				  FROM ".$this->table_name."
				  ORDER BY Country_id ASC";

        //prepare query statement
        $stmt = $this->conn->prepare($query);

        //execute query
        $stmt->execute();

        return $stmt;
    }
	
	public function rowCount() 
	{
        $query = "SELECT COUNT(*) as total_rows FROM ".$this->table_name."";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total_rows'];
    }
	
	public function delete($ins)
	{
        $ins = htmlspecialchars(strip_tags($ins));

        $query = "DELETE FROM ".$this->table_name." WHERE Country_id = '".$ins."' ";

        $stmt = $this->conn->prepare($query);

        if($stmt->execute())
		{
            return 1;
        }
		else
		{
            return 0;
        }
    }
	
	public function readOne($City_id)
	{
        // select one record
        $query = "SELECT * FROM " . $this->table_name . " WHERE Country_id=:Country_id";

        //prepare query for execution
        $stmt = $this->conn->prepare($query);

        $Country_id = htmlspecialchars(strip_tags($Country_id));
        $stmt->bindParam(':Country_id', $Country_id);
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

		if($results != null)
		{
			return json_encode($results);
		}
		else
		{
			return 0;
		}
    }
	
	public function update()
	{
        $query = "UPDATE " . $this->table_name . "
				  SET Country_name=:Country_name
                  WHERE Country_id=:Country_id";

        //prepare query for excecution
        $stmt = $this->conn->prepare($query);

        $Country_name = htmlspecialchars(strip_tags($this->Country_name));
        $Country_id = htmlspecialchars(strip_tags($this->Country_id));

        // bind the parameters
        $stmt->bindParam(':Country_name', $Country_name);
        $stmt->bindParam(':Country_id', $Country_id);
		$stmt->execute();
		
        // execute the query
        if($stmt->execute())
		{
            return 1; 
        }
		else
		{
            return 0;
        }
    }
	
	public function searchCity($City_name)
	{
		$param = "%$Country_name%";
        // select one record
        $query = "SELECT Country_id,Country_name FROM " . $this->table_name . " WHERE Country_name LIKE :Country_name";

        //prepare query for execution
        $stmt = $this->conn->prepare($query);

        $Country_name = htmlspecialchars(strip_tags($Country_name));
        $stmt->bindParam(':Country_name', $param);
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return json_encode($results);
    }
}
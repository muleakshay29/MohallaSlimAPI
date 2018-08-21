<?php
class CityMaster
{
    // database connection and table name
    private $conn;
    private $table_name = "city_master";

    // object properties
    public $City_name;
    public $Country_id;
    public $State_id;
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
            $query = "INSERT INTO city_master
					  SET Country_id=:Country_id, State_id=:State_id, City_name=:City_name, created=:created";
			// echo $query;
            // prepare query for execution
            $stmt = $this->conn->prepare($query);

            // sanitize
            $Country_id = htmlspecialchars(strip_tags($this->Country_id));
            $State_id = htmlspecialchars(strip_tags($this->State_id));
            $City_name = htmlspecialchars(strip_tags($this->City_name));

            // bind the parameters
            $stmt->bindParam(':Country_id', $Country_id);
            $stmt->bindParam(':State_id', $State_id);
            $stmt->bindParam(':City_name', $City_name);

            // we need the created variable to know when the record was created
            // also, to comply with strict standards: only variables should be passed by reference
            $created = date('Y-m-d H:i:s');
            $stmt->bindParam(':created', $created);

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
	
	public function readAll()
	{
		$query = "SELECT *
				  FROM ".$this->table_name."
				  ORDER BY City_id DESC";

        //prepare query statement
        $stmt = $this->conn->prepare($query);

        //execute query
        $stmt->execute();

        return $stmt;
    }
	
	public function read($State_id)
	{
		$query = "SELECT City_id,City_name
				  FROM ".$this->table_name."
				  WHERE State_id=:State_id
				  ORDER BY City_id DESC";

        //prepare query for execution
        $stmt = $this->conn->prepare($query);

        $State_id = htmlspecialchars(strip_tags($State_id));
        $stmt->bindParam(':State_id', $State_id);
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

        $query = "DELETE FROM ".$this->table_name." WHERE City_id = '".$ins."' ";

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
        $query = "SELECT * FROM " . $this->table_name . " WHERE City_id=:City_id";

        //prepare query for execution
        $stmt = $this->conn->prepare($query);

        $City_id = htmlspecialchars(strip_tags($City_id));
        $stmt->bindParam(':City_id', $City_id);
        $stmt->execute();

        $results = $stmt->fetch(PDO::FETCH_ASSOC);

		if($results != null)
		{
			return $results;
		}
		else
		{
			return 0;
		}
    }
	
	public function update()
	{
        $query = "UPDATE " . $this->table_name . "
				  SET Country_id=:Country_id, State_id=:State_id, City_name=:City_name, created=:created
                  WHERE City_id=:City_id";

        //prepare query for excecution
        $stmt = $this->conn->prepare($query);

        $Country_id = htmlspecialchars(strip_tags($this->Country_id));
		$State_id = htmlspecialchars(strip_tags($this->State_id));
		$City_name = htmlspecialchars(strip_tags($this->City_name));
        $City_id = htmlspecialchars(strip_tags($this->City_id));

        // bind the parameters
        $stmt->bindParam(':Country_id', $Country_id);
		$stmt->bindParam(':State_id', $State_id);
		$stmt->bindParam(':City_name', $City_name);
        $stmt->bindParam(':City_id', $City_id);
		
		$updated = date('Y-m-d H:i:s');
		$stmt->bindParam(':created', $updated);
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
		$resultArray = array();
		$param = "%$City_name%";
        // select one record
        $query = "SELECT City_id,City_name FROM " . $this->table_name . " WHERE City_name LIKE :City_name";

        //prepare query for execution
        $stmt = $this->conn->prepare($query);

        $City_name = htmlspecialchars(strip_tags($City_name));
        $stmt->bindParam(':City_name', $param);
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

		// return json_encode($results);
		
		if($results != null)
		{
			return json_encode($results);
		}
		else
		{
			return json_encode($resultArray);
		}
    }
}
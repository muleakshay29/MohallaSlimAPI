<?php
class Master
{
    // object properties
    public $City_name;
    public $Country_id;
    public $State_id;
	
	private $conn;
	private $table_name;
	public $Create_date;
	public $Update_date;

    public function __construct($db)
	{
        $this->conn = $db;
		$this->Create_date = date('Y-m-d H:i:s');
		$this->Update_date = date('Y-m-d H:i:s');
    }
	
	public function GetRecord($tablename,array $array)
	{
		$record = array();
		
		if(!isset($array['fields']) || $array['fields']=="") {$array['fields']="*";}

		$query_string = "select ".$array['fields']." from ".$tablename." "; 	

		if(@$array['where']!="")
		{
			$query_string.="where ".$array['where']." ";
		}

		//setting group by
		if(@$array['groupby']!="")
		{
			$query_string.=" group by ".$array['groupby'];
		}

		//setting order type
		if(@$array['ordertype']=="")
		{
			$array['ordertype']="desc";
		}
		
		//seeting order by
		if(@$array['orderby']!="")
		{
			$query_string.=" order by ".$array['orderby']." ".$array['ordertype'];
		}	

		//setting record start limit
		if(@$array['startfrom']=="")
		{
			$array['startfrom']=0;
		}

		//setting record limit
		if(@$array['limit']>0 && is_numeric(@$array['limit']))
		{
			$query_string.=" limit ".$array['startfrom'].", ".$array['limit'];
		}
	
		$stmt = $this->conn->prepare($query_string);
		$stmt->execute();		
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$this->conn = null;
		return $results;
	}
	
	public function GetSingleRecord($tablename,array $array)
	{
		$record = array();
		
		if(!isset($array['fields']) || $array['fields']=="") {$array['fields']="*";}

		$query_string = "select ".$array['fields']." from ".$tablename." "; 	

		if(@$array['where']!="")
		{
			$query_string.="where ".$array['where']." ";
		}

		//setting group by
		if(@$array['groupby']!="")
		{
			$query_string.=" group by ".$array['groupby'];
		}

		//setting order type
		if(@$array['ordertype']=="")
		{
			$array['ordertype']="desc";
		}
		
		//seeting order by
		if(@$array['orderby']!="")
		{
			$query_string.=" order by ".$array['orderby']." ".$array['ordertype'];
		}	

		//setting record start limit
		if(@$array['startfrom']=="")
		{
			$array['startfrom']=0;
		}

		//setting record limit
		if(@$array['limit']>0 && is_numeric(@$array['limit']))
		{
			$query_string.=" limit ".$array['startfrom'].", ".$array['limit'];
		}
	
		$stmt = $this->conn->prepare($query_string);
		$stmt->execute();		
		$results = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->conn = null;
		return $results;
	}
	
	public function InsertRecord($tablename,$fieldarray,$valuearray)
	{
		$query_string = "INSERT INTO ".$tablename." SET ";
					  
		//$query_string = "insert into ".$tablename." (";

		foreach ($fieldarray as $key => $value) 
		{
			$query_string.="$value=:$value ,";
		}		
		$query_string = trim($query_string," ,");
		
		$stmt = $this->conn->prepare($query_string);
		
		foreach ($valuearray as $key => $value)
		{
			$filter_value = htmlspecialchars(strip_tags($value));
			$stmt->bindValue(":$key", $filter_value );
		}
		
		if( $stmt->execute() )
		{
			$result = $this->conn->lastInsertId();
		}
		else
		{
			$result = 0;
		}
		
		$this->conn = null;
		return $result;	
	}
	
	public function UpdateRecord($tablename,array $values,$where="")
	{
		$result = 0;
		if(!empty($values))
		{
			$query_string = "update ".$tablename." set ";
			
			foreach ($values as $key => $value) 
			{
				$query_string.="$key=:$key ,";
			}			
			$query_string = trim($query_string," ,");
			
			if($where != "")
			{
				$query_string .=" where ".$where;
			}
			
			$stmt = $this->conn->prepare($query_string);

			foreach($values as $key => $value)
			{
				$filter_value = htmlspecialchars(strip_tags($value));
				$stmt->bindValue(":$key", $filter_value );
			}
			
			if( $stmt->execute() )
			{
				$result = $stmt->rowCount();
			}
			else
			{
				$result = 0;
			}
			
			$this->conn = null;		
		}
		return $result;
	}
	
	public function DeleteRecord($tablename, $where, $limit=0)
	{
		$query_string = "delete from ".$tablename." ";

		if($where!="")
		{
			$query_string.=" where ".$where;
		}

		if($limit>0)
		{
			$query_string.=" limit ".$limit;	
		}
		
		$stmt = $this->conn->prepare($query_string);

		if( $stmt->execute() )
		{
			$result = $stmt->rowCount();
		}
		else
		{
			$result = 0;
		}
		
		$this->conn = null;	

		return $result;
	}
}
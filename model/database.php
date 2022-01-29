<?php

/*
PROGRAM: 		Jabstar Aviation Fuel Stop Planner (AUSTRALIA).
AUTHOR: 		Don Cameron.
DATE: 			University summer break - 2021/2022.
PURPOSE: 		To practice web app development skills learnt in first yer of IT degree at Victoria University, Melbourne, Victoria, Australia (PHP, MySQL, HTML,CSS).

				See 'jabstar/readme.txt' for more details
*/

function open_database()
{
    global $db;
	
	$dsn = 'mysql:host=localhost;dbname=jabstar_db';
    	$username = 'root';
   	$password = '';

    try {
        $db = new PDO($dsn, $username, $password);
		
    } catch (PDOException $e) {
        $error_message = $e->getMessage();       
	    echo $error_message;
        exit();
    }
}	

function get_coordinates($wp_name)
{
/*
INPUT: waypoint name
OUTPUT: gps coordinates of that waypoint
*/	
	global $db;
	
	$query = 'SELECT wp_lat, wp_lon 
			  FROM jswaypoints
              WHERE wp_name = :wp_name';
	$statement = $db->prepare($query);
	$statement->bindValue(':wp_name', $wp_name);
	$statement->execute();	
	$coordinates = $statement->fetch();
	$statement->closeCursor();
	
	return $coordinates;
}

function save_route_list($route_list_to_save, $username)
{
/*
INPUTS: route list to be saved (start/end only, NOT INCLUDING FUEL STOPS -
		the algorithm regenerates the fuel stops later, 
		after these parameters are retrieved), username
		
OUTPUT: saves route list to the 'jstrips' database table

NB: Assumes route list is presented sequentially as one dimensional array 
(each input route consists of 5 sequential elements: dep, dest, bearing, distance & range
 -  these are written to the database record along with the username)*/
 
	global $db;		
	
	$i = 0;
	foreach ($route_list_to_save as $sequential_element)
	{
		if ($i == 0)
		{
			$tp_dep = $sequential_element;
		}
		
		if ($i == 1)
		{
			$tp_dest = $sequential_element;
		}
		
		if ($i == 2)
		{
			$tp_bear = $sequential_element;
		}
		
		if ($i == 3)
		{
			$tp_dist = $sequential_element;
		}
		
		if ($i == 4)
		{
			$tp_range = $sequential_element;		
		
			$query = "INSERT INTO JSTRIPS
						(tp_dep, tp_dest, tp_bear, tp_dist, tp_range, pt_name)
					VALUES
						(:tp_dep, :tp_dest, :tp_bear, :tp_dist, :tp_range, :pt_name)";
					
			$statement = $db->prepare($query);
			$statement->bindValue(':tp_dep', $tp_dep);
			$statement->bindValue(':tp_dest', $tp_dest);
			$statement->bindValue(':tp_bear', $tp_bear);
			$statement->bindValue(':tp_dist', $tp_dist);
			$statement->bindValue(':tp_range', $tp_range);
			$statement->bindValue(':pt_name', $username);
			$statement->execute();
			$statement->closeCursor();		
		}
		
		$i++;
		if ($i == 5)
		{
			$i = 0;
		}		
	}
}

function get_route_list($username)
{
/*
INPUT: username
OUTPUTS: retrieved route list (consists of start point, end point, overall bearing,
			overall distance & range paramaeter entered when route was originally generated 
			- algorithm uses these parameters to 'regenerate' the route) 
*/	
	global $db;

	$query = "SELECT * FROM JSTRIPS
				WHERE pt_name = :pt_name";
	$statement = $db->prepare($query);
	$statement->bindValue(':pt_name', $username);
	$statement->execute();
	$retrieved_route_list = $statement->fetchAll();
	$statement->closeCursor();
	
	return $retrieved_route_list;
}	

function delete_routes($username)
{
/*
INPUT: username
OUTPUT: deletes ALL routes from jstrips where username matches
*/	
	global $db;
	
	$query = "DELETE FROM JSTRIPS
				WHERE pt_name = :pt_name";
	$statement = $db->prepare($query);
	$statement->bindValue(':pt_name', $username);
	$statement->execute();
	$statement->closeCursor();	
}

function register($username, $password)
{
/*
INPUTS: username, password
OUTPUTS: writes username and password to the jspilots database table
*/
	global $db;			
		
		$query = "INSERT INTO JSPILOTS
					(pt_name, pt_pword)
				VALUES
					(:pt_name, :pt_pword)";
					
		$statement = $db->prepare($query);
		$statement->bindValue(':pt_name', $username);
		$statement->bindValue(':pt_pword', $password);
			
		$statement->execute();
		$statement->closeCursor();	
}

function login($username, $password)
{
/*
INPUTS: username & password
OUTPUTS: returns 0 if this username/password combination exists in database table
			'jspilots' - otherwise returns 1
*/
	global $db;
	
	if (empty($username) || empty($password))
	{
		return 1;
	}
			
	$query = "SELECT * FROM JSPILOTS
				WHERE pt_name = :pt_name 
					AND pt_pword = :pt_pword";
	$statement = $db->prepare($query);
	$statement->bindValue(':pt_name', $username);
	$statement->bindValue(':pt_pword', $password);
	$statement->execute();
	
	$user = $statement->fetch();
	$statement->closeCursor();

	if (($username == $user[0]) && ($password == $user[1]))
	{
		return 0;
	}
	else
	{
		return 1;
	}
}

function read_jswaypoints()
{
/*
INPUT: nil
OUTPUT: returns the array jswaypoints containing the name and gps coordinates
		of all waypoints in database table jswaypoints
*/	
	global $db;

	$query = "SELECT * FROM JSWAYPOINTS";
				
	$statement = $db->prepare($query);	
	$statement->execute();
	$jswaypoints = $statement->fetchAll();
	$statement->closeCursor();
	
	return $jswaypoints;	
}


?>

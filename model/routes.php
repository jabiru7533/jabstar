<?php

/*
PROGRAM: 		Jabstar Aviation Fuel Stop Planner (AUSTRALIA).
AUTHOR: 		Don Cameron.
DATE: 			University summer break - 2021/2022.
PURPOSE: 		To practice web app development skills learnt in first yer of IT degree at Victoria University, Melbourne, Victoria, Australia (PHP, MySQL, HTML,CSS).

				See 'jabstar/readme.txt' for more details
*/

function session_store($stored_route)
{
/*
INPUT: stored route (departure point, destination, bearing & distance)
OUTPUT: stores route in session cookie
*/

	if (empty($_SESSION['routes'][0]))
	{
		$_SESSION['routes'][0] = $stored_route;
	}
	else
	{
		$_SESSION['routes'][] = $stored_route; 
	}

}

function session_retrieve()
{
/*	
INPUT: nil
OUTPUT: stored route retrieved from session cookie (consists of departure point,
			destination, bearing & distance
*/	
	$routes = $_SESSION['routes'];
	$stored_route_display = array(array());
	
	$i = 0;
	foreach ($routes as $route)		
	{		
		$j = 0;
		foreach ($route as $route_details)
		{				
			$stored_route_display[$i][$j] = $route_details;
			$j++;	
		}

		$i++;		
	}		
	return $stored_route_display;
}

?>
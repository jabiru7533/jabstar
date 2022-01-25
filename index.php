<?php
/*
PROGRAM: 		Jabstar Aviation Fuel Stop Planner (AUSTRALIA).
AUTHOR: 		Don Cameron.
DATE: 			University summer break - 2021/2022.
PURPOSE: 		To practice web app development skills learnt in first yer of IT degree at Victoria University, Melbourne, Victoria, Australia (PHP, MySQL, HTML,CSS).

				See 'jabstar/readme.txt' for more details
*/

//------------------------------------------------------------------------------
//CONSTANTS

define('BEARING_DIFF', 30);

//INITIALISE VARIABLES

$errors = array();
$distance = 0;
$bearing = 0;
if (empty($show_route))
{
  $show_route = 0;
}
$username = " ";
$password = " ";
$login_status = 1;

//------------------------------------------------------------------------------

//SETUP SESSION COOKIE FOR TEMPORARY ROUTE LIST STORAGE

//Start session managment wth a persistent cookie

$lifetime = 60 * 60 * 24 * 365;
session_set_cookie_params($lifetime, '/');
session_start();

//Set an array in session

if (!isset($_SESSION['routes']))
{
	$_SESSION['routes'] = array(array());
}
//Load session cookie function library

require_once('model/routes.php');

//-----------------------------------------------------------------------------

//SETUP DATABASE FOR PERMANENT ROUTE STORAGE 

require_once('model/database.php');
open_database();

//-----------------------------------------------------------------------------

//LOAD NAVIGATION FUNCTIONS LIBRARY

require_once('navigate.php');

//-----------------------------------------------------------------------------

//RUN MAIN MENU 

//get action variable from POST

$action = filter_input(INPUT_POST, 'action');

//process actions

switch( $action ) {
	
    case 'Generate New Route':			
		
		$new_route = array(array());
		
		$departure = filter_input(INPUT_POST, 'departure');
		if (empty($departure)) {
			$errors[] = 'Departure datalist selection error';	//NB: full error handelling yet to be implemented
		} else {            
			$departure_coordinates = get_coordinates($departure);
		}
		
		$destination = filter_input(INPUT_POST, 'destination');
		if (empty($destination)) {
			$errors[] = 'Destination datalist selection error';
		} else {            
			$destination_coordinates = get_coordinates($destination);	//NB: full error handelling yet to be implemented
		}
		
		$aircraft_range = filter_input(INPUT_POST, 'range');	//NB: full error handelling yet to be implemented		

//Calculate Overall bearing and distance to destination
				
		$bearing = bearing($departure_coordinates[0], $departure_coordinates[1], 
			$destination_coordinates[0], $destination_coordinates[1]);
		$distance = distance($departure_coordinates[0], $departure_coordinates[1],
			$destination_coordinates[0], $destination_coordinates[1]);
			
//Generate route			
			
		list($no_fuel_stops_flag, $calculate_last_leg_flag, $new_route) = generate_route($aircraft_range, $distance, $departure_coordinates, $destination_coordinates, $departure, $destination, $bearing);		
		
		$show_route = 1;
		
		$login_status = filter_input(INPUT_POST, 'login_status');
		$username = filter_input(INPUT_POST, 'username');
		
		break;
		
	case 'Clear Session Cookie':
	
		$login_status = filter_input(INPUT_POST, 'login_status');
		$username = filter_input(INPUT_POST, 'username');
	
		unset($_SESSION['routes']);
		break;
		
	case 'Add to Route List (Session Cookie)':
	
		$show_route = 1;
		
		$login_status = filter_input(INPUT_POST, 'login_status');
		$username = filter_input(INPUT_POST, 'username');
		$no_fuel_stops_flag = filter_input(INPUT_POST, 'no_fuel_stops_flag');
		$aircraft_range = filter_input(INPUT_POST, 'aircraft_range');
		$calculate_last_leg_flag = filter_input(INPUT_POST, 'calculate_last_leg_flag');
		
		if ($no_fuel_stops_flag == 1)	//i.e. only do this if there are fuel stops
		{
			$serialized_new_route = $_POST['new_route'];
		
			$i = 0;
			$j = 0;
		
			foreach ($serialized_new_route as $sequential_element)
			{
				$new_route[$i][$j] = $sequential_element; 
		
				$j++;
				if ($j == 3)
				{
					$j = 0;
					$i++;
				}		
			}
		}
				
		$departure = filter_input(INPUT_POST, 'departure');
		if (empty($departure)) {
			$errors[] = 'Add to Route List error';		//NB: full error handelling yet to be implemented			
		} 
		
		$destination = filter_input(INPUT_POST, 'destination');		
		if (empty($destination)) {
			$errors[] = 'Add to Route List Error';		//NB: full error handelling yet to be implemented
		} 
		
		$bearing = filter_input(INPUT_POST, 'bearing');
		if (empty($bearing)) {
			$errors[] = 'Add to Route List error';		//NB: full error handelling yet to be implemented		
		} 
		
		$distance = filter_input(INPUT_POST, 'distance');		
		if (empty($distance)) {
			$errors[] = 'Add to Route List Error';		//NB: full error handelling yet to be implemented
		} 
		
		$stored_route = array($departure, $destination, $bearing, $distance, $aircraft_range);
		session_store($stored_route);
			
		break;		
		
	case 'Show Route List (Session Cookie)':
		
		$stored_routes_display = session_retrieve();
		$show_route = 2;
		
		$login_status = filter_input(INPUT_POST, 'login_status');
		$username = filter_input(INPUT_POST, 'username');
		
		break;
		
	case 'Save to Database (Requires Login/Register)':
	
		$login_status = filter_input(INPUT_POST, 'login_status');
		$username = filter_input(INPUT_POST, 'username');
		if ($login_status == 1)
		{				
			break;
		}
		
		$route_list_to_save = $_POST['stored_routes'];		
		save_route_list($route_list_to_save, $username);
	
		break;
		
	case 'Retrieve Old Routes (Requires Login/Register)':
	
		$login_status = filter_input(INPUT_POST, 'login_status');
		$username = filter_input(INPUT_POST, 'username');
		if ($login_status == 1)
		{				
			break;
		}

		$show_route = 3;	
		
		$retrieved_route_list = get_route_list($username);	
	
		break;
		
	case 'Return to Route Generator':
	
		$login_status = filter_input(INPUT_POST, 'login_status');
		$username = filter_input(INPUT_POST, 'username');
		
		break;	
		
	case 'DELETE ALL Routes from Database':
	
		$login_status = filter_input(INPUT_POST, 'login_status');
		$username = filter_input(INPUT_POST, 'username');
		if ($login_status == 1)
		{				
			break;
		}
		
		delete_routes($username);
		
		break;
		
	case 'Login':
				
		$username = filter_input(INPUT_POST, 'username');
		if (empty($username)) {
			$errors[] = 'Username cannot be empty';			//NB: full error handelling yet to be implemented	
		} 
		
		$password = filter_input(INPUT_POST, 'password');		
		if (empty($password)) {
			$errors[] = 'Password cannot be empty';			//NB: full error handelling yet to be implemented
		} 
		
		$login_status = login($username, $password);
		
		break;
		
	case 'Register':
		
		$username = filter_input(INPUT_POST, 'username');
		if (empty($username)) {
			$errors[] = 'Username cannot be empty';			//NB: full error handelling yet to be implemented	
		} 
		
		$password = filter_input(INPUT_POST, 'password');		
		if (empty($password)) {
			$errors[] = 'Password cannot be empty';			//NB: full error handelling yet to be implemented
		} 
		
		register($username, $password);
		
		break;
		
	case 'Logout':

		$login_status = 1;
		unset($_SESSION['routes']);

		break;
	
}		

//-----------------------------------------------------------------------------

//CALL OUTPUT DISPLAY PAGE

include 'view/index.php';
 
 ?>
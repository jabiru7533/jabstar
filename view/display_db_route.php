<?php

/*
PROGRAM: 		Jabstar Aviation Fuel Stop Planner (AUSTRALIA).
AUTHOR: 		Don Cameron.
DATE: 			University summer break - 2021/2022.
PURPOSE: 		To practice web app development skills learnt in first yer of IT degree at Victoria University, Melbourne, Victoria, Australia (PHP, MySQL, HTML,CSS).

				See 'jabstar/readme.txt' for more details
*/

//CONSTANTS

define('BEARING_DIFF', 30);

//INITIALISE VARIABLES

$new_route = array(array());

//LOAD NAVIGATION FUNCTIONS LIBRARY

require_once('../navigate.php');

//SETUP DATABASE FOR ROUTE REGENERATION 

require_once('../model/database.php');
open_database();

//GET ROUTE PARAMETERS

$departure = filter_input(INPUT_POST, 'tp_dep');
$destination = filter_input(INPUT_POST, 'tp_dest');
$aircraft_range = filter_input(INPUT_POST, 'tp_range');
$departure_coordinates = get_coordinates($departure);
$destination_coordinates = get_coordinates($destination);

//Calculate Overall bearing and distance to destination
				
$bearing = bearing($departure_coordinates[0], $departure_coordinates[1], 
			$destination_coordinates[0], $destination_coordinates[1]);
$distance = distance($departure_coordinates[0], $departure_coordinates[1],
			$destination_coordinates[0], $destination_coordinates[1]);
			
//Generate route

list($no_fuel_stops_flag, $calculate_last_leg_flag, $new_route) = generate_route($aircraft_range, $distance, $departure_coordinates, $destination_coordinates, $departure, $destination, $bearing);	

?>

<!doctype html>

<!-- OUTPUT DISPLAY PAGE --> 

<html lang="en">

	<head>

<!-- STYLESHEET LINK / WEBSITE TITLE / FAVICON-->

		<link rel="stylesheet" href="css/jabstar.css">		
		<style><?php include "view/css/jabstar.css" ?></style>
		
		<title>Jabstar: Route Details</title>
	
		<link rel="icon" href="images/yellow_star2.png" type="image/icon type">
		<meta charset="utf-8">
		<meta name="viewport" content="width-device-width, initial-scale=1">
	
	</head>

	<body>

<!-- LOGO -->
	
		<header>	
		
			<a href="index.php"><img src="images/jabstar_logo.png" alt="Jabstar LOGO"></a>
			
		</header>

		<main>

<!-- Display regenerated route -->		

			<br>
			<div class="head"> <h2>Route:&nbsp;<?php echo $departure;?> to&nbsp; <?php echo $destination;?></h2>
			<span>&nbsp;(Bearing:&nbsp;<?php printf("%03d", $bearing);?>&nbsp;Degrees Magnetic &nbsp;/&nbsp Distance:&nbsp;<?php echo $distance;?>&nbsp Nautical Miles)</span></div>
			<br><br>
				
			<?php if ($no_fuel_stops_flag == 1)
			{?>
								
				<div class="head"><h2>Suggested Fuel Stops</h2>
				<span>&nbsp;(Aircraft Range: &nbsp;<?php echo $aircraft_range?>&nbsp; Nautical Miles)</span></div>				
				<br>
					
				<?php if ($calculate_last_leg_flag == 1)
				{									
					?><p><span style ="color: red; font-weight: 900;">ERROR - unable to find sufficient fuel stops due to inadequate aircraft range</span></p><?php	
				}
				?>
				<br>	
				<table class="routelist">
					<tr>
						<th>Airport</th>
						<th>Bearing (Degrees Magnetic)</th>
						<th>Distance (Nautical Miles)</th>
					</tr>
					<tr>
						<td><?php echo $departure;?></td>
						<td>&nbsp;-</td>
						<td>&nbsp;-</td>
					</tr>
							
					<?php foreach ($new_route as $new_route_element)
					{				
					?>
						<tr>
							<td><?php echo $new_route_element[0];?></td>						
							<td><?php printf("%03d", $new_route_element[1]);?></td>	
							<td><?php echo $new_route_element[2];?></td>
						</tr>	
					<?php
					}
					?>										
				</table>
			<?php
			}
			else
			{
				echo "No fuel stops required";
			}?>			
				
		</main>
	
		<footer>
	
			<br><br>
			&copy; Copyright 2021. All rights reserved <br>
			<a href="mailto:donaldewancameron@gmail.com">donaldewancameron@gmail.com</a>
	
		</footer>
	
	</body>
	
</html>				
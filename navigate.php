<?php
/*
PROGRAM: 		Jabstar Aviation Fuel Stop Planner (AUSTRALIA).
AUTHOR: 		Don Cameron.
DATE: 			University summer break - 2021/2022.
PURPOSE: 		To practice web app development skills learnt in first yer of IT degree at Victoria University, Melbourne, Victoria, Australia (PHP, MySQL, HTML,CSS).

				See 'jabstar/readme.txt' for more details
*/

function distance($lat1, $lon1, $lat2, $lon2)
{
/*
INPUTS:	gps coordinates of 2 waypoints 
		(as floating point numbers to 4 decimal places -
		latitude is considered negative for Australia whilst
		longtitude is considered positive)
OUTPUT: distance in nautical miles between the 2 waypoints
*/	
	$r = 6371.0; // km
	$dlat = ($lat2 - $lat1) * M_PI / 180;	
	$dlon = ($lon2 - $lon1) * M_PI / 180;
	$lat1 = $lat1 * M_PI / 180;	
	$lat2 = $lat2 * M_PI / 180;	

	$a = sin($dlat / 2) * sin($dlat / 2) + sin($dlon / 2) * sin($dlon / 2) * cos($lat1) * cos($lat2);
	$c = 2 * atan2(sqrt($a), sqrt(1 - $a));
	$d = $r * $c;

	$distance = intval($d * .539957);

	return $distance;
	
}

function bearing($lat1, $lon1, $lat2, $lon2)
{
/*
INPUTS: gps coordinates of 2 waypoints
		(as floating point numbers to 4 decimal places -
		latitude is considered negative for Australia whilst
		longtitude is considered positive)
OUTPUT: magnetic bearing of waypoint 2 with respect to waypoint 1 
		(applies 11 degrees of variation to get magnetic bearing -
		this is the correct adjustment for the east coast of Australia)	
*/
	$londiff = $lon1 - $lon2;
	if ($londiff < 0)
	{
			$londiff = sqrt($londiff * $londiff);
	}
		
	$lat2 = $lat2 * M_PI / 180;
	$londiff = $londiff * M_PI / 180;
	$lat1 = $lat1 * M_PI / 180;
	
	$x = cos($lat2) * sin($londiff);
	$y = (cos($lat1) * sin($lat2)) - ( sin($lat1) * cos($lat2) * cos($londiff));
	$b = atan2($x, $y);
	
	$b = (180 / M_PI) * $b;
	
	if ($lon1 > $lon2)
	{
		$b = 360 - $b;
	}

	$b = $b - 11; //magnetic variation

	if ($b < 0)
	{
		$b = 360 + $b;
	}		
	$bearing = intval($b);
	
	return $bearing;	
}

function generate_route($aircraft_range, $distance, $departure_coordinates, $destination_coordinates, $departure, $destination, $bearing)
{
/*
INPUTS: departure point name & gps coordinates, destination name & gps coordinates, bearing of destination from departure point, aircraft range
OUTPUTS: no_fuel_stops flag (= 0 if journey requires NO fuel stops), calculate_last_leg_flag (= 0 if journey DOES have fuel stops),
		new_route (this is a 2 dimensional array - rows = journey legs / columns = Name, Bearing & Distance of the waypoint for a given journey leg)	
PROCESSING: If the route distance is greater than the aircraft range, attempt to find fuel stops.
				Calculate the bearing and distance from the departure point to ALL OTHER WAYPOINTS in the database.
					For each one: if the distance is less than the aircraft range AND the bearing (to it from the departurue point) is different from the overall bearing by less than the BEARING DIFFERENCE CONSTANT,
					consider this as a potential fuel stop.
				If there are no suitable fuel stops, write a suitable error message.	
				From the potential fuel stops, select the one which has the greatest distance.
				Now, treat the new fuel stop as the 'departure point' and repeat the process (i.e. look for a fuel stop with the greatest distance - but less than the aircraft range - where the bearing to it is less than
					the BEARING DIFFERENCE CONSTANT different from the bearing to the destination from the current 'departure point' i.e. the previous fuel stop).
				Keep doing this until you have a fuel stop whose distance from the overall destination is less than the aircrafts range.	
*/
			
//Find Fuel Stops where necessary

		$no_fuel_stops_flag = 1;
		$calculate_last_leg_flag = 0;
		if ($distance > $aircraft_range)			
		{
			$lat1 = $departure_coordinates[0];
			$lon1 = $departure_coordinates[1];
			$waypoint1 = $departure;
			$next_wp_name = "";
			$next_distance = 0;
			$next_bearing = $bearing;
			$bearing_diff = BEARING_DIFF;
			$current_bearing_to_destination = $bearing;
			$fuel_stop_found_flag = 1;
			
			$i = 0;
			do {							
				$jswaypoints = read_jswaypoints();
				
				foreach ($jswaypoints as $waypoint)
				{					
					$distance2 = distance($lat1, $lon1, $waypoint[1], $waypoint[2]);	
					$bearing2 = bearing($lat1, $lon1, $waypoint[1], $waypoint[2]);	
					$bearing_diff = $current_bearing_to_destination - $bearing2;			
								
					if (($distance2 <= $aircraft_range) && (abs($bearing_diff) <= BEARING_DIFF) && ($waypoint[0] != $waypoint1))						
					{						
						$fuel_stop_found_flag = 0;
												
						if ($distance2 > $next_distance)
						{							
							$next_wp_name = $waypoint[0];
							$next_bearing = $bearing2;
							$next_distance = $distance2;
							$waypoint_lat = $waypoint[1];
							$waypoint_lon = $waypoint[2];							
						}					
					}									
				}
				
				if ($fuel_stop_found_flag == 1)
				{					
					$calculate_last_leg_flag = 1;
					break;
				}
				
				$new_route[$i][0] = $next_wp_name;				
				$new_route[$i][1] = $next_bearing;
				$new_route[$i][2] = $next_distance;
				
				$remaining_distance_to_destination = 
					distance($waypoint_lat, $waypoint_lon, $destination_coordinates[0], $destination_coordinates[1]);
				$current_bearing_to_destination = 
					bearing($waypoint_lat, $waypoint_lon, $destination_coordinates[0], $destination_coordinates[1]);
								
				$lat1 = $waypoint_lat;
				$lon1 = $waypoint_lon;
				$waypoint1 = $next_wp_name;
				
				$next_wp_name = "";
				$next_distance = 0;
				$next_bearing = $bearing;
				$bearing_diff = BEARING_DIFF;	

				$fuel_stop_found_flag = 1;
								
				$i++;	
				
			} while ($remaining_distance_to_destination > $aircraft_range);  
						
			if ($calculate_last_leg_flag == 0)
			{				
				$new_route[$i][0] = $destination;
				$new_route[$i][1] = $current_bearing_to_destination;
				$new_route[$i][2] = $remaining_distance_to_destination;
			}		
		}
		else
		{
			$no_fuel_stops_flag = 0;
			$new_route = "";
		}
		
		return array($no_fuel_stops_flag, $calculate_last_leg_flag, $new_route);
}	


?>
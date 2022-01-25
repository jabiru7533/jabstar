
PROGRAM: 		Jabstar Aviation Fuel Stop Planner (AUSTRALIA).
AUTHOR: 		Don Cameron.
DATE: 			University summer break - 2021/2022.
PURPOSE: 		To practice web app development skills learnt in first yer of IT degree at Victoria University, Melbourne, Victoria, Australia (PHP, MySQL, HTML,CSS).

INPUTS: 		Departure point (use drop down menu), Destination (use drop down menu), Aircraft Range (enter integer value).

OUTPUTS: 		A list of suggested fuel stops on route (where applicable) supplying avgas for light aircraft. Bearings and distances supplied for all way points. 
			Trip details can be stored in the session cookie (mimics an e-commerce shopping cart). The session cookie details can be stored in the data base
			(mimics the checkout function on an e-commerce shopping cart). Multiple users can log in to the application to save and retrieve previously
			generated route details (again, designed to mimic e-commerce style account functionality).

PROCESSING:		The database contains the gps coordinates of the 248 airfields which supply Avgas in Australia (generated from details in the En Route Supplememnt
			Australia (ERSA) published by Airservices Australia). The program calculates distances and bearings between waypoints and writes this data to the 
			screen. If the planned trip is longer than the aircraft range entered, the program uses an algorithm to generate suggested fuel stops. An error message
			is generated if the aircraft range is insufficient to generate fuel stops spanning the entire journey.
		
INSTALLATION:		Install XAMPP to your system. Copy the Jabstar folder to the htdocs folder created by XAMPP. Open phpMyAdmin, import and run the jabstarDB.sql file
			(located in the jabstar/model folder) to set up the database.
				
TO RUN PROG:		Open the XAMPP control panel, start the Apache and MySQL services, open a browser, type "localhost/jabstar" into the address bar and press enter
			(NB: you can, if desired, monitor /manipulate the database, whilst the program is running, by opening phpMyAdmin and selecting "jabstar_db").


(SAMPLE) TEST DATA:		Input								Expected Output 
				-----								---------------
		
				PENFIELD to BENDIGO, Range 200 nm				Bearing 328 M, Distance 49 nm, no fuel stops required 

				PENFIELD to HORN ISLAND, Range 200 nm				Bearing 343 M, Distance 1621 nm, unable to find sufficient fuel stops due to inadequate aircraft range

				PENFIELD to HORN ISLAND, Range 400 nm				Bearing 343 M, Distance 1621 nm

												Suggested Fuel Stops (NB: the algorithm always finds the same outputs if inputs remain constant)
											
												Airport			Bearing	(M)	Distance (nm)					
												-------			-----------	-------------
												PENFIELD		-		-											
												BROKEN HILL		322		367
												WINDORAH		358		400
												CLONCURRY		325		308
												BURKETOWN		331		183
												LOCKHART RIVER		025		369
												HORN ISLAND		324		144											


TO DO LIST:		1) Implement input validation / error handelling.
			2) Store login status in session cookie so that the 'Home' navigation link doesn't cancel / reset login status ?
			3) Improve front end (javascript, responsive web design ?).
			4) Can a 2 dimensional array be passed back through a hidden form field (this would improve the code in the database storage functions) ?			



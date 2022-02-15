<?php
/*
PROGRAM: 		Jabstar Aviation Fuel Stop Planner (AUSTRALIA).
AUTHOR: 		Don Cameron.
DATE: 			University summer break - 2021/2022.
PURPOSE: 		To practice web app development skills learnt in first yer of IT degree at Victoria University, Melbourne, Victoria, Australia (PHP, MySQL, HTML,CSS).

				See 'jabstar/readme.txt' for more details
*/
?>

<!doctype html>

<!-- OUTPUT DISPLAY PAGE --> 

<html lang="en">

<head>

<!-- STYLESHEET LINK / WEBSITE TITLE / FAVICON-->

	<link rel="stylesheet" href="view/css/jabstar.css">		
	<style><?php include "view/css/jabstar.css" ?></style>
	
	<title>Jabstar: Fuel Stop Planner</title>
	
	<link rel="icon" href="view/images/yellow_star2.png" type="image/icon type">
	<meta charset="utf-8">
	<meta name="viewport" content="width-device-width, initial-scale=1">
	
</head>

<body>

<!-- LOGO -->
	
	<header>			
		<a href="index.php"><img src="view/images/jabstar_logo.png" alt="Jabstar LOGO"></a>
	</header>

<!-- NAVIGATION LINKS / LOGIN / REGISTER-->

	<nav>
		<ul>	
			<li><a href="index.php">Home&nbsp;</a></li>
			<li><a href="view/about.php">About&nbsp;</a></li>
			<li><a href="view/aircraft.php">Aircraft&nbsp;</a></li>
			<li><a href="view/gallery.php">Images&nbsp;</a></li>
			<li><a href="view/contact.php">Contact&nbsp;</a></li>				
		</ul>	
	</nav>
	
		<?php global $login_status; if ($login_status == 1) {?>
			
		<form class="login" action="." method="post">					
			<label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Username&nbsp;</label>
			<input type="text" size="10" name="username">
			<label>&nbsp;Password&nbsp;</label>
			<input type="password" size="10" name="password">		
			<label>&nbsp;</label>
			<input type="submit" name="action" value="Login">	
			<label>&nbsp;</label>
			<input type="submit" name="action" value="Register">	
		</form>
		
		<form class="login_mobile" action="." method="post">					
			<label>Username&nbsp;</label>
			<input type="text" name="username"><br><br>
			<label>Password&nbsp;&nbsp;</label>
			<input type="password" name="password"><br><br>		
			<label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
			<input type="submit" name="action" value="Login">	
			<label>&nbsp;</label>
			<input type="submit" name="action" value="Register">	
		</form>
				
		<?php ;} else {echo "Pilot " . $username . " is logged in ... .";         ?>    

		<form class="logout" action="." method="post">
			<input type="submit" name="action" value="Logout">            
		</form>

		<?php }?>
			
	<main>
		<br><br>		
	
		<h1>Aviation Fuel Stop Planner (AUSTRALIA) </h1>
		<h3>Contains a database of 248 airports currently supplying AVGAS (correct as of 2/12/2021)</h3> 		
	
<!-- MAIN IMAGE -->	

		<picture>
			<source 
				media="(max-width: 1279px) and (min-width: 769px)"
				srcset="view/images/tablet2.jpg">
			<source 
				media="(max-width: 768px)"
				srcset="view/images/mobile3.jpg">
			<img 
				src="view/images/header4.jpg" 
				alt="main image">
		</picture>
		
<!--SCREEN 0: ROUTE GENERATOR INPUT-->
	
		<?php if ($show_route == 0)		
		{ 
		?>		

			<form class="input_action" action="." method="post">
			
				<p>
					<label>Departure&nbsp;
						<input list="departure" size ="30" name="departure" autocomplete="off" value=" ">
					</label>		
			
					<datalist id="departure">
						<option value="ADELAIDE/PARAFIELD">
						<option value="ADELS GROVE">
						<option value="ALBANY">
						<option value="ALBURY">
						<option value="ALDINGA">
						<option value="ALICE SPRINGS">
						<option value="ARMIDALE">
						<option value="ATHERTON">
						<option value="AYERS ROCK">
						<option value="AYR">
						<option value="BACCHUS MARSH">
						<option value="BAIRNSDALE">
						<option value="BALLARAT">
						<option value="BALLINA/BYRON GATEWAY">
						<option value="BARCALDINE">
						<option value="BARWON HEADS/GEELONG">
						<option value="BATHURST">
						<option value="BENALLA">
						<option value="BENDIGO">
						<option value="BIRDSVILLE">
						<option value="BLACKALL">
						<option value="BOONAH">
						<option value="BORROLOOLA">
						<option value="BOULIA">
						<option value="BOURKE">
						<option value="BRISBANE WEST WELLCAMP">
						<option value="BRISBANE/ARCHERFIELD">
						<option value="BROKEN HILL">
						<option value="BROOME">
						<option value="BUNBURY">
						<option value="BUNDABERG">
						<option value="BURKETOWN">
						<option value="BUSSELTON">
						<option value="CABOOLTURE">
						<option value="CADNEY HOMESTEAD">
						<option value="CAIGUNA">
						<option value="CAIRNS">
						<option value="CALOUNDRA">
						<option value="CALVIN GROVE">
						<option value="CAMDEN HAVEN">
						<option value="CAMDEN">							
						<option value="CANBERRA">
						<option value="CARNARVON">
						<option value="CEDUNA">
						<option value="CERES">
						<option value="CESSNOCK">
						<option value="CHARLEVILLE">
						<option value="CHARTERS TOWERS">
						<option value="CHILLAGOE">
						<option value="CHINCHILLA">
						<option value="CLARE VALLEY">
						<option value="CLERMONT">
						<option value="CLIFTON">
						<option value="CLONCURRY">
						<option value="COBAR">
						<option value="COBDEN">
						<option value="COCKATOO ISLAND">
						<option value="COEN">
						<option value="COFFS HARBOUR">
						<option value="COLAC">
						<option value="COLDSTREAM">
						<option value="COOBER PEDY">
						<option value="COOKTOWN">
						<option value="COONAMBLE">
						<option value="COOTAMUNDRA">
						<option value="COWRA">
						<option value="CROYDON">
						<option value="CUNNAMULLA">
						<option value="DARWIN">
						<option value="DENILIQUIN">
						<option value="DERBY">
						<option value="DEVONPORT">
						<option value="DONNINGTON AIRPARK">
						<option value="DUBBO">
						<option value="DUNWICH">
						<option value="ECHUCA">
						<option value="ELCHO ISLAND">
						<option value="ELROSE">
						<option value="EMERALD">
						<option value="EMKAYTEE">
						<option value="ESPERANCE">
						<option value="EUROA">
						<option value="FLINDERS ISLAND">
						<option value="FORREST">
						<option value="GAWLER">
						<option value="GAYNDAH">
						<option value="GEORGETOWN (QLD)">
						<option value="GERALDTON">
						<option value="GLADSTONE">
						<option value="GOLD COAST">
						<option value="GOOLWA">
						<option value="GOONDIWINDI">
						<option value="GOULBURN">
						<option value="GOVE">
						<option value="GRIFFITH">
						<option value="GROOTE EYLANDT">
						<option value="GUNNEDAH">
						<option value="GYMPIE">
						<option value="HALLS CREEK">
						<option value="HAMILTON ISLAND">
						<option value="HAMILTON">
						<option value="HAWKER">
						<option value="HAY">
						<option value="HERVEY BAY">
						<option value="HOBART/CAMBRIDGE">
						<option value="HOOKER CREEK">
						<option value="HORN ISLAND">
						<option value="HORSHAM">
						<option value="HUGHENDEN">
						<option value="HUNGERFORD">
						<option value="INGHAM">
						<option value="INNAMINCKA TOWNSHIP">
						<option value="INNAMINCKA">
						<option value="INVERELL">
						<option value="JABIRU">
						<option value="JAMESTOWN">
						<option value="JINDABYNE">
						<option value="KALGOORLIE-BOULDER">
						<option value="KALUMBURU">
						<option value="KARRATHA">
						<option value="KEMPSEY">
						<option value="KERANG">
						<option value="KINGAROY">
						<option value="KUNUNURRA">
						<option value="KYNETON">
						<option value="LATROBE VALLEY">
						<option value="LAUNCESTON">
						<option value="LEIGH CREEK">
						<option value="LEONGATHA">
						<option value="LEONORA">
						<option value="LETHBRIDGE AIRPORT">
						<option value="LIGHTNING RIDGE">
						<option value="LILYDALE">
						<option value="LISMORE">
						<option value="LOCKHART RIVER">
						<option value="LONGREACH">
						<option value="LORD HOWE ISLAND">
						<option value="LYNDOCH">
						<option value="MACKAY">
						<option value="MAITLAND (NSW)">
						<option value="MAITLAND (SA)">
						<option value="MALLACOOTA">
						<option value="MANGALORE">
						<option value="MANINGRIDA">
						<option value="MANJIMUP">
						<option value="MAREEBA">
						<option value="MARREE">
						<option value="MARYBOROUGH (QLD)">
						<option value="MCARTHUR RIVER MINE">
						<option value="MEEKATHARRA">
						<option value="MELBOURNE/ESSENDON">
						<option value="MELBOURNE/MOORABBIN">
						<option value="MELTON">
						<option value="MERIMBULA">
						<option value="MERREDIN">
						<option value="MILDURA">
						<option value="MOREE">
						<option value="MORUYA">
						<option value="MOUNT GAMBIER">
						<option value="MOUNT ISA">
						<option value="MOUNT KEITH">
						<option value="MUDGEE">
						<option value="MURRAY BRIDGE">
						<option value="MURRAY FIELD">
						<option value="MURWILLUMBAH">
						<option value="NAGAMBIE-WIRRATE">
						<option value="NARACOORTE">
						<option value="NARRABRI">
						<option value="NARRANDERA">
						<option value="NARROMINE">
						<option value="NEWMAN">
						<option value="NHILL">
						<option value="NORMANTON">
						<option value="NORTHAM">
						<option value="NORTHERN PENINSULA">
						<option value="NULLARBOR MOTEL">
						<option value="OAKEY">
						<option value="ORANGE">
						<option value="PARKES">
						<option value="PENFIELD">
						<option value="PERTH/JANDAKOT">
						<option value="PETERBOROUGH/GREAT OCEAN ROAD">
						<option value="PORT AUGUSTA">
						<option value="PORT HEDLAND">
						<option value="PORT LINCOLN">
						<option value="PORT MACQUARIE">
						<option value="PORT PIRIE">
						<option value="PORTLAND">
						<option value="PROSERPINE/WHITSUNDAY COAST">
						<option value="PUNGALINA">
						<option value="QUILPIE">							
						<option value="REDCLIFFE">
						<option value="RENMARK">
						<option value="ROCKHAMPTON">
						<option value="ROMA">
						<option value="ROWSLEY/BROOKS LANDING">
						<option value="RYLSTONE AIRPARK">
						<option value="SCONE">
						<option value="SHELLHARBOUR AIRPORT">
						<option value="SHEPPARTON">
						<option value="SHUTE HARBOUR/WHITSUNDAY">
						<option value="SOMERSBY">
						<option value="STAWELL">
						<option value="SUNSHINE COAST">
						<option value="SWAN HILL">
						<option value="SYDNEY/BANKSTOWN">
						<option value="TAMBO">
						<option value="TAMWORTH">
						<option value="TAREE">
						<option value="TEMORA">
						<option value="TENNANT CREEK">
						<option value="THANGOOL">
						<option value="THARGOMINDAH">
						<option value="TIBOOBURRA">
						<option value="TINDAL">
						<option value="TOCUMWAL">
						<option value="TOORADIN">
						<option value="TOOWOOMBA">
						<option value="TOWNSVILLE/TOWNSVILLE">
						<option value="TRUSCOTT-MUNGALALU">
						<option value="TUMUT">
						<option value="TYABB">
						<option value="VAN ROOK STATION">
						<option value="VICTORIA RIVER DOWNS">
						<option value="WAGGA WAGGA">
						<option value="WALGETT">
						<option value="WANGARATTA">
						<option value="WARBURTON">
						<option value="WARRACKNABEAL">
						<option value="WARRNAMBOOL">
						<option value="WARWICK">
						<option value="WATTS BRIDGE">
						<option value="WEDDERBURN">
						<option value="WEIPA">
						<option value="WENTWORTH">
						<option value="WEST SALE">
						<option value="WHITE CLIFFS">
						<option value="WHITE GUM">
						<option value="WHYALLA">
						<option value="WILLIAM CREEK">
						<option value="WINDORAH">
						<option value="WINTON">
						<option value="WUDINNA">
						<option value="WYNYARD">
						<option value="YARRAM">
						<option value="YARRAWONGA">
						<option value="YOUNG">	
					</datalist>								
						
					<label>&nbsp;Destination&nbsp;
						<input list="destination" size="30" name="destination" autocomplete="off" value=" ">
					</label>			
	
					<datalist id="destination">
						<option value="ADELAIDE/PARAFIELD">
						<option value="ADELS GROVE">
						<option value="ALBANY">
						<option value="ALBURY">
						<option value="ALDINGA">
						<option value="ALICE SPRINGS">
						<option value="ARMIDALE">
						<option value="ATHERTON">
						<option value="AYERS ROCK">
						<option value="AYR">
						<option value="BACCHUS MARSH">
						<option value="BAIRNSDALE">
						<option value="BALLARAT">
						<option value="BALLINA/BYRON GATEWAY">
						<option value="BARCALDINE">
						<option value="BARWON HEADS/GEELONG">
						<option value="BATHURST">
						<option value="BENALLA">
						<option value="BENDIGO">
						<option value="BIRDSVILLE">
						<option value="BLACKALL">
						<option value="BOONAH">
						<option value="BORROLOOLA">
						<option value="BOULIA">
						<option value="BOURKE">
						<option value="BRISBANE WEST WELLCAMP">
						<option value="BRISBANE/ARCHERFIELD">
						<option value="BROKEN HILL">
						<option value="BROOME">
						<option value="BUNBURY">
						<option value="BUNDABERG">
						<option value="BURKETOWN">
						<option value="BUSSELTON">
						<option value="CABOOLTURE">
						<option value="CADNEY HOMESTEAD">
						<option value="CAIGUNA">
						<option value="CAIRNS">
						<option value="CALOUNDRA">
						<option value="CALVIN GROVE">
						<option value="CAMDEN HAVEN">
						<option value="CAMDEN">							
						<option value="CANBERRA">
						<option value="CARNARVON">
						<option value="CEDUNA">
						<option value="CERES">
						<option value="CESSNOCK">
						<option value="CHARLEVILLE">
						<option value="CHARTERS TOWERS">
						<option value="CHILLAGOE">
						<option value="CHINCHILLA">
						<option value="CLARE VALLEY">
						<option value="CLERMONT">
						<option value="CLIFTON">
						<option value="CLONCURRY">
						<option value="COBAR">
						<option value="COBDEN">
						<option value="COCKATOO ISLAND">
						<option value="COEN">
						<option value="COFFS HARBOUR">
						<option value="COLAC">
						<option value="COLDSTREAM">
						<option value="COOBER PEDY">
						<option value="COOKTOWN">
						<option value="COONAMBLE">
						<option value="COOTAMUNDRA">
						<option value="COWRA">
						<option value="CROYDON">
						<option value="CUNNAMULLA">
						<option value="DARWIN">
						<option value="DENILIQUIN">
						<option value="DERBY">
						<option value="DEVONPORT">
						<option value="DONNINGTON AIRPARK">
						<option value="DUBBO">
						<option value="DUNWICH">
						<option value="ECHUCA">
						<option value="ELCHO ISLAND">
						<option value="ELROSE">
						<option value="EMERALD">
						<option value="EMKAYTEE">
						<option value="ESPERANCE">
						<option value="EUROA">
						<option value="FLINDERS ISLAND">
						<option value="FORREST">
						<option value="GAWLER">
						<option value="GAYNDAH">
						<option value="GEORGETOWN (QLD)">
						<option value="GERALDTON">
						<option value="GLADSTONE">
						<option value="GOLD COAST">
						<option value="GOOLWA">
						<option value="GOONDIWINDI">
						<option value="GOULBURN">
						<option value="GOVE">
						<option value="GRIFFITH">
						<option value="GROOTE EYLANDT">
						<option value="GUNNEDAH">
						<option value="GYMPIE">
						<option value="HALLS CREEK">
						<option value="HAMILTON ISLAND">
						<option value="HAMILTON">
						<option value="HAWKER">
						<option value="HAY">
						<option value="HERVEY BAY">
						<option value="HOBART/CAMBRIDGE">
						<option value="HOOKER CREEK">
						<option value="HORN ISLAND">
						<option value="HORSHAM">
						<option value="HUGHENDEN">
						<option value="HUNGERFORD">
						<option value="INGHAM">
						<option value="INNAMINCKA TOWNSHIP">
						<option value="INNAMINCKA">
						<option value="INVERELL">
						<option value="JABIRU">
						<option value="JAMESTOWN">
						<option value="JINDABYNE">
						<option value="KALGOORLIE-BOULDER">
						<option value="KALUMBURU">
						<option value="KARRATHA">
						<option value="KEMPSEY">
						<option value="KERANG">
						<option value="KINGAROY">
						<option value="KUNUNURRA">
						<option value="KYNETON">
						<option value="LATROBE VALLEY">
						<option value="LAUNCESTON">
						<option value="LEIGH CREEK">
						<option value="LEONGATHA">
						<option value="LEONORA">
						<option value="LETHBRIDGE AIRPORT">
						<option value="LIGHTNING RIDGE">
						<option value="LILYDALE">
						<option value="LISMORE">
						<option value="LOCKHART RIVER">
						<option value="LONGREACH">
						<option value="LORD HOWE ISLAND">
						<option value="LYNDOCH">
						<option value="MACKAY">
						<option value="MAITLAND (NSW)">
						<option value="MAITLAND (SA)">
						<option value="MALLACOOTA">
						<option value="MANGALORE">
						<option value="MANINGRIDA">
						<option value="MANJIMUP">
						<option value="MAREEBA">
						<option value="MARREE">
						<option value="MARYBOROUGH (QLD)">
						<option value="MCARTHUR RIVER MINE">
						<option value="MEEKATHARRA">
						<option value="MELBOURNE/ESSENDON">
						<option value="MELBOURNE/MOORABBIN">
						<option value="MELTON">
						<option value="MERIMBULA">
						<option value="MERREDIN">
						<option value="MILDURA">
						<option value="MOREE">
						<option value="MORUYA">
						<option value="MOUNT GAMBIER">
						<option value="MOUNT ISA">
						<option value="MOUNT KEITH">
						<option value="MUDGEE">
						<option value="MURRAY BRIDGE">
						<option value="MURRAY FIELD">
						<option value="MURWILLUMBAH">
						<option value="NAGAMBIE-WIRRATE">
						<option value="NARACOORTE">
						<option value="NARRABRI">
						<option value="NARRANDERA">
						<option value="NARROMINE">
						<option value="NEWMAN">
						<option value="NHILL">
						<option value="NORMANTON">
						<option value="NORTHAM">
						<option value="NORTHERN PENINSULA">
						<option value="NULLARBOR MOTEL">
						<option value="OAKEY">
						<option value="ORANGE">
						<option value="PARKES">
						<option value="PENFIELD">
						<option value="PERTH/JANDAKOT">
						<option value="PETERBOROUGH/GREAT OCEAN ROAD">
						<option value="PORT AUGUSTA">
						<option value="PORT HEDLAND">
						<option value="PORT LINCOLN">
						<option value="PORT MACQUARIE">
						<option value="PORT PIRIE">
						<option value="PORTLAND">
						<option value="PROSERPINE/WHITSUNDAY COAST">
						<option value="PUNGALINA">
						<option value="QUILPIE">							
						<option value="REDCLIFFE">
						<option value="RENMARK">
						<option value="ROCKHAMPTON">
						<option value="ROMA">
						<option value="ROWSLEY/BROOKS LANDING">
						<option value="RYLSTONE AIRPARK">
						<option value="SCONE">
						<option value="SHELLHARBOUR AIRPORT">
						<option value="SHEPPARTON">
						<option value="SHUTE HARBOUR/WHITSUNDAY">
						<option value="SOMERSBY">
						<option value="STAWELL">
						<option value="SUNSHINE COAST">
						<option value="SWAN HILL">
						<option value="SYDNEY/BANKSTOWN">
						<option value="TAMBO">
						<option value="TAMWORTH">
						<option value="TAREE">
						<option value="TEMORA">
						<option value="TENNANT CREEK">
						<option value="THANGOOL">
						<option value="THARGOMINDAH">
						<option value="TIBOOBURRA">
						<option value="TINDAL">
						<option value="TOCUMWAL">
						<option value="TOORADIN">
						<option value="TOOWOOMBA">
						<option value="TOWNSVILLE/TOWNSVILLE">
						<option value="TRUSCOTT-MUNGALALU">
						<option value="TUMUT">
						<option value="TYABB">
						<option value="VAN ROOK STATION">
						<option value="VICTORIA RIVER DOWNS">
						<option value="WAGGA WAGGA">
						<option value="WALGETT">
						<option value="WANGARATTA">
						<option value="WARBURTON">
						<option value="WARRACKNABEAL">
						<option value="WARRNAMBOOL">
						<option value="WARWICK">
						<option value="WATTS BRIDGE">
						<option value="WEDDERBURN">
						<option value="WEIPA">
						<option value="WENTWORTH">
						<option value="WEST SALE">
						<option value="WHITE CLIFFS">
						<option value="WHITE GUM">
						<option value="WHYALLA">
						<option value="WILLIAM CREEK">
						<option value="WINDORAH">
						<option value="WINTON">
						<option value="WUDINNA">
						<option value="WYNYARD">
						<option value="YARRAM">
						<option value="YARRAWONGA">
						<option value="YOUNG">				
					</datalist>	
						
					<label>&nbsp;Aircraft Range (nm)&nbsp;</label>
					<input type="text" size="4" name="range" value="200" autocomplete="off">	
						
					<br><br>
						
					<label>&nbsp;</label>
					<input type="submit" name="action" value="Generate New Route">
						
					<input type="hidden" name="login_status" value="<?php echo $login_status?>">
					<input type="hidden" name="username" value="<?php echo $username?>">
			
					<label>&nbsp;</label>
					<input type="submit" name="action" value="Show Route List (Session Cookie)">
			
					<label>&nbsp;</label>
					<input type="submit" name="action" value="Retrieve Old Routes (Requires Login/Register)">			
				</p>
			
			</form>
			
			<form class="input_action_mobile" action="." method="post">
			
				<p>
					<label>Departure&nbsp;&nbsp;&nbsp;
						<input list="departure" size ="30" name="departure" autocomplete="off" value=" ">
					</label>		
			
					<datalist id="departure">
						<option value="ADELAIDE/PARAFIELD">
						<option value="ADELS GROVE">
						<option value="ALBANY">
						<option value="ALBURY">
						<option value="ALDINGA">
						<option value="ALICE SPRINGS">
						<option value="ARMIDALE">
						<option value="ATHERTON">
						<option value="AYERS ROCK">
						<option value="AYR">
						<option value="BACCHUS MARSH">
						<option value="BAIRNSDALE">
						<option value="BALLARAT">
						<option value="BALLINA/BYRON GATEWAY">
						<option value="BARCALDINE">
						<option value="BARWON HEADS/GEELONG">
						<option value="BATHURST">
						<option value="BENALLA">
						<option value="BENDIGO">
						<option value="BIRDSVILLE">
						<option value="BLACKALL">
						<option value="BOONAH">
						<option value="BORROLOOLA">
						<option value="BOULIA">
						<option value="BOURKE">
						<option value="BRISBANE WEST WELLCAMP">
						<option value="BRISBANE/ARCHERFIELD">
						<option value="BROKEN HILL">
						<option value="BROOME">
						<option value="BUNBURY">
						<option value="BUNDABERG">
						<option value="BURKETOWN">
						<option value="BUSSELTON">
						<option value="CABOOLTURE">
						<option value="CADNEY HOMESTEAD">
						<option value="CAIGUNA">
						<option value="CAIRNS">
						<option value="CALOUNDRA">
						<option value="CALVIN GROVE">
						<option value="CAMDEN HAVEN">
						<option value="CAMDEN">							
						<option value="CANBERRA">
						<option value="CARNARVON">
						<option value="CEDUNA">
						<option value="CERES">
						<option value="CESSNOCK">
						<option value="CHARLEVILLE">
						<option value="CHARTERS TOWERS">
						<option value="CHILLAGOE">
						<option value="CHINCHILLA">
						<option value="CLARE VALLEY">
						<option value="CLERMONT">
						<option value="CLIFTON">
						<option value="CLONCURRY">
						<option value="COBAR">
						<option value="COBDEN">
						<option value="COCKATOO ISLAND">
						<option value="COEN">
						<option value="COFFS HARBOUR">
						<option value="COLAC">
						<option value="COLDSTREAM">
						<option value="COOBER PEDY">
						<option value="COOKTOWN">
						<option value="COONAMBLE">
						<option value="COOTAMUNDRA">
						<option value="COWRA">
						<option value="CROYDON">
						<option value="CUNNAMULLA">
						<option value="DARWIN">
						<option value="DENILIQUIN">
						<option value="DERBY">
						<option value="DEVONPORT">
						<option value="DONNINGTON AIRPARK">
						<option value="DUBBO">
						<option value="DUNWICH">
						<option value="ECHUCA">
						<option value="ELCHO ISLAND">
						<option value="ELROSE">
						<option value="EMERALD">
						<option value="EMKAYTEE">
						<option value="ESPERANCE">
						<option value="EUROA">
						<option value="FLINDERS ISLAND">
						<option value="FORREST">
						<option value="GAWLER">
						<option value="GAYNDAH">
						<option value="GEORGETOWN (QLD)">
						<option value="GERALDTON">
						<option value="GLADSTONE">
						<option value="GOLD COAST">
						<option value="GOOLWA">
						<option value="GOONDIWINDI">
						<option value="GOULBURN">
						<option value="GOVE">
						<option value="GRIFFITH">
						<option value="GROOTE EYLANDT">
						<option value="GUNNEDAH">
						<option value="GYMPIE">
						<option value="HALLS CREEK">
						<option value="HAMILTON ISLAND">
						<option value="HAMILTON">
						<option value="HAWKER">
						<option value="HAY">
						<option value="HERVEY BAY">
						<option value="HOBART/CAMBRIDGE">
						<option value="HOOKER CREEK">
						<option value="HORN ISLAND">
						<option value="HORSHAM">
						<option value="HUGHENDEN">
						<option value="HUNGERFORD">
						<option value="INGHAM">
						<option value="INNAMINCKA TOWNSHIP">
						<option value="INNAMINCKA">
						<option value="INVERELL">
						<option value="JABIRU">
						<option value="JAMESTOWN">
						<option value="JINDABYNE">
						<option value="KALGOORLIE-BOULDER">
						<option value="KALUMBURU">
						<option value="KARRATHA">
						<option value="KEMPSEY">
						<option value="KERANG">
						<option value="KINGAROY">
						<option value="KUNUNURRA">
						<option value="KYNETON">
						<option value="LATROBE VALLEY">
						<option value="LAUNCESTON">
						<option value="LEIGH CREEK">
						<option value="LEONGATHA">
						<option value="LEONORA">
						<option value="LETHBRIDGE AIRPORT">
						<option value="LIGHTNING RIDGE">
						<option value="LILYDALE">
						<option value="LISMORE">
						<option value="LOCKHART RIVER">
						<option value="LONGREACH">
						<option value="LORD HOWE ISLAND">
						<option value="LYNDOCH">
						<option value="MACKAY">
						<option value="MAITLAND (NSW)">
						<option value="MAITLAND (SA)">
						<option value="MALLACOOTA">
						<option value="MANGALORE">
						<option value="MANINGRIDA">
						<option value="MANJIMUP">
						<option value="MAREEBA">
						<option value="MARREE">
						<option value="MARYBOROUGH (QLD)">
						<option value="MCARTHUR RIVER MINE">
						<option value="MEEKATHARRA">
						<option value="MELBOURNE/ESSENDON">
						<option value="MELBOURNE/MOORABBIN">
						<option value="MELTON">
						<option value="MERIMBULA">
						<option value="MERREDIN">
						<option value="MILDURA">
						<option value="MOREE">
						<option value="MORUYA">
						<option value="MOUNT GAMBIER">
						<option value="MOUNT ISA">
						<option value="MOUNT KEITH">
						<option value="MUDGEE">
						<option value="MURRAY BRIDGE">
						<option value="MURRAY FIELD">
						<option value="MURWILLUMBAH">
						<option value="NAGAMBIE-WIRRATE">
						<option value="NARACOORTE">
						<option value="NARRABRI">
						<option value="NARRANDERA">
						<option value="NARROMINE">
						<option value="NEWMAN">
						<option value="NHILL">
						<option value="NORMANTON">
						<option value="NORTHAM">
						<option value="NORTHERN PENINSULA">
						<option value="NULLARBOR MOTEL">
						<option value="OAKEY">
						<option value="ORANGE">
						<option value="PARKES">
						<option value="PENFIELD">
						<option value="PERTH/JANDAKOT">
						<option value="PETERBOROUGH/GREAT OCEAN ROAD">
						<option value="PORT AUGUSTA">
						<option value="PORT HEDLAND">
						<option value="PORT LINCOLN">
						<option value="PORT MACQUARIE">
						<option value="PORT PIRIE">
						<option value="PORTLAND">
						<option value="PROSERPINE/WHITSUNDAY COAST">
						<option value="PUNGALINA">
						<option value="QUILPIE">							
						<option value="REDCLIFFE">
						<option value="RENMARK">
						<option value="ROCKHAMPTON">
						<option value="ROMA">
						<option value="ROWSLEY/BROOKS LANDING">
						<option value="RYLSTONE AIRPARK">
						<option value="SCONE">
						<option value="SHELLHARBOUR AIRPORT">
						<option value="SHEPPARTON">
						<option value="SHUTE HARBOUR/WHITSUNDAY">
						<option value="SOMERSBY">
						<option value="STAWELL">
						<option value="SUNSHINE COAST">
						<option value="SWAN HILL">
						<option value="SYDNEY/BANKSTOWN">
						<option value="TAMBO">
						<option value="TAMWORTH">
						<option value="TAREE">
						<option value="TEMORA">
						<option value="TENNANT CREEK">
						<option value="THANGOOL">
						<option value="THARGOMINDAH">
						<option value="TIBOOBURRA">
						<option value="TINDAL">
						<option value="TOCUMWAL">
						<option value="TOORADIN">
						<option value="TOOWOOMBA">
						<option value="TOWNSVILLE/TOWNSVILLE">
						<option value="TRUSCOTT-MUNGALALU">
						<option value="TUMUT">
						<option value="TYABB">
						<option value="VAN ROOK STATION">
						<option value="VICTORIA RIVER DOWNS">
						<option value="WAGGA WAGGA">
						<option value="WALGETT">
						<option value="WANGARATTA">
						<option value="WARBURTON">
						<option value="WARRACKNABEAL">
						<option value="WARRNAMBOOL">
						<option value="WARWICK">
						<option value="WATTS BRIDGE">
						<option value="WEDDERBURN">
						<option value="WEIPA">
						<option value="WENTWORTH">
						<option value="WEST SALE">
						<option value="WHITE CLIFFS">
						<option value="WHITE GUM">
						<option value="WHYALLA">
						<option value="WILLIAM CREEK">
						<option value="WINDORAH">
						<option value="WINTON">
						<option value="WUDINNA">
						<option value="WYNYARD">
						<option value="YARRAM">
						<option value="YARRAWONGA">
						<option value="YOUNG">	
					</datalist>		

					<br><br>	
											
					<label>&nbsp;Destination&nbsp;
						<input list="destination" size="30" name="destination" autocomplete="off" value=" ">
					</label>			
	
					<datalist id="destination">
						<option value="ADELAIDE/PARAFIELD">
						<option value="ADELS GROVE">
						<option value="ALBANY">
						<option value="ALBURY">
						<option value="ALDINGA">
						<option value="ALICE SPRINGS">
						<option value="ARMIDALE">
						<option value="ATHERTON">
						<option value="AYERS ROCK">
						<option value="AYR">
						<option value="BACCHUS MARSH">
						<option value="BAIRNSDALE">
						<option value="BALLARAT">
						<option value="BALLINA/BYRON GATEWAY">
						<option value="BARCALDINE">
						<option value="BARWON HEADS/GEELONG">
						<option value="BATHURST">
						<option value="BENALLA">
						<option value="BENDIGO">
						<option value="BIRDSVILLE">
						<option value="BLACKALL">
						<option value="BOONAH">
						<option value="BORROLOOLA">
						<option value="BOULIA">
						<option value="BOURKE">
						<option value="BRISBANE WEST WELLCAMP">
						<option value="BRISBANE/ARCHERFIELD">
						<option value="BROKEN HILL">
						<option value="BROOME">
						<option value="BUNBURY">
						<option value="BUNDABERG">
						<option value="BURKETOWN">
						<option value="BUSSELTON">
						<option value="CABOOLTURE">
						<option value="CADNEY HOMESTEAD">
						<option value="CAIGUNA">
						<option value="CAIRNS">
						<option value="CALOUNDRA">
						<option value="CALVIN GROVE">
						<option value="CAMDEN HAVEN">
						<option value="CAMDEN">							
						<option value="CANBERRA">
						<option value="CARNARVON">
						<option value="CEDUNA">
						<option value="CERES">
						<option value="CESSNOCK">
						<option value="CHARLEVILLE">
						<option value="CHARTERS TOWERS">
						<option value="CHILLAGOE">
						<option value="CHINCHILLA">
						<option value="CLARE VALLEY">
						<option value="CLERMONT">
						<option value="CLIFTON">
						<option value="CLONCURRY">
						<option value="COBAR">
						<option value="COBDEN">
						<option value="COCKATOO ISLAND">
						<option value="COEN">
						<option value="COFFS HARBOUR">
						<option value="COLAC">
						<option value="COLDSTREAM">
						<option value="COOBER PEDY">
						<option value="COOKTOWN">
						<option value="COONAMBLE">
						<option value="COOTAMUNDRA">
						<option value="COWRA">
						<option value="CROYDON">
						<option value="CUNNAMULLA">
						<option value="DARWIN">
						<option value="DENILIQUIN">
						<option value="DERBY">
						<option value="DEVONPORT">
						<option value="DONNINGTON AIRPARK">
						<option value="DUBBO">
						<option value="DUNWICH">
						<option value="ECHUCA">
						<option value="ELCHO ISLAND">
						<option value="ELROSE">
						<option value="EMERALD">
						<option value="EMKAYTEE">
						<option value="ESPERANCE">
						<option value="EUROA">
						<option value="FLINDERS ISLAND">
						<option value="FORREST">
						<option value="GAWLER">
						<option value="GAYNDAH">
						<option value="GEORGETOWN (QLD)">
						<option value="GERALDTON">
						<option value="GLADSTONE">
						<option value="GOLD COAST">
						<option value="GOOLWA">
						<option value="GOONDIWINDI">
						<option value="GOULBURN">
						<option value="GOVE">
						<option value="GRIFFITH">
						<option value="GROOTE EYLANDT">
						<option value="GUNNEDAH">
						<option value="GYMPIE">
						<option value="HALLS CREEK">
						<option value="HAMILTON ISLAND">
						<option value="HAMILTON">
						<option value="HAWKER">
						<option value="HAY">
						<option value="HERVEY BAY">
						<option value="HOBART/CAMBRIDGE">
						<option value="HOOKER CREEK">
						<option value="HORN ISLAND">
						<option value="HORSHAM">
						<option value="HUGHENDEN">
						<option value="HUNGERFORD">
						<option value="INGHAM">
						<option value="INNAMINCKA TOWNSHIP">
						<option value="INNAMINCKA">
						<option value="INVERELL">
						<option value="JABIRU">
						<option value="JAMESTOWN">
						<option value="JINDABYNE">
						<option value="KALGOORLIE-BOULDER">
						<option value="KALUMBURU">
						<option value="KARRATHA">
						<option value="KEMPSEY">
						<option value="KERANG">
						<option value="KINGAROY">
						<option value="KUNUNURRA">
						<option value="KYNETON">
						<option value="LATROBE VALLEY">
						<option value="LAUNCESTON">
						<option value="LEIGH CREEK">
						<option value="LEONGATHA">
						<option value="LEONORA">
						<option value="LETHBRIDGE AIRPORT">
						<option value="LIGHTNING RIDGE">
						<option value="LILYDALE">
						<option value="LISMORE">
						<option value="LOCKHART RIVER">
						<option value="LONGREACH">
						<option value="LORD HOWE ISLAND">
						<option value="LYNDOCH">
						<option value="MACKAY">
						<option value="MAITLAND (NSW)">
						<option value="MAITLAND (SA)">
						<option value="MALLACOOTA">
						<option value="MANGALORE">
						<option value="MANINGRIDA">
						<option value="MANJIMUP">
						<option value="MAREEBA">
						<option value="MARREE">
						<option value="MARYBOROUGH (QLD)">
						<option value="MCARTHUR RIVER MINE">
						<option value="MEEKATHARRA">
						<option value="MELBOURNE/ESSENDON">
						<option value="MELBOURNE/MOORABBIN">
						<option value="MELTON">
						<option value="MERIMBULA">
						<option value="MERREDIN">
						<option value="MILDURA">
						<option value="MOREE">
						<option value="MORUYA">
						<option value="MOUNT GAMBIER">
						<option value="MOUNT ISA">
						<option value="MOUNT KEITH">
						<option value="MUDGEE">
						<option value="MURRAY BRIDGE">
						<option value="MURRAY FIELD">
						<option value="MURWILLUMBAH">
						<option value="NAGAMBIE-WIRRATE">
						<option value="NARACOORTE">
						<option value="NARRABRI">
						<option value="NARRANDERA">
						<option value="NARROMINE">
						<option value="NEWMAN">
						<option value="NHILL">
						<option value="NORMANTON">
						<option value="NORTHAM">
						<option value="NORTHERN PENINSULA">
						<option value="NULLARBOR MOTEL">
						<option value="OAKEY">
						<option value="ORANGE">
						<option value="PARKES">
						<option value="PENFIELD">
						<option value="PERTH/JANDAKOT">
						<option value="PETERBOROUGH/GREAT OCEAN ROAD">
						<option value="PORT AUGUSTA">
						<option value="PORT HEDLAND">
						<option value="PORT LINCOLN">
						<option value="PORT MACQUARIE">
						<option value="PORT PIRIE">
						<option value="PORTLAND">
						<option value="PROSERPINE/WHITSUNDAY COAST">
						<option value="PUNGALINA">
						<option value="QUILPIE">							
						<option value="REDCLIFFE">
						<option value="RENMARK">
						<option value="ROCKHAMPTON">
						<option value="ROMA">
						<option value="ROWSLEY/BROOKS LANDING">
						<option value="RYLSTONE AIRPARK">
						<option value="SCONE">
						<option value="SHELLHARBOUR AIRPORT">
						<option value="SHEPPARTON">
						<option value="SHUTE HARBOUR/WHITSUNDAY">
						<option value="SOMERSBY">
						<option value="STAWELL">
						<option value="SUNSHINE COAST">
						<option value="SWAN HILL">
						<option value="SYDNEY/BANKSTOWN">
						<option value="TAMBO">
						<option value="TAMWORTH">
						<option value="TAREE">
						<option value="TEMORA">
						<option value="TENNANT CREEK">
						<option value="THANGOOL">
						<option value="THARGOMINDAH">
						<option value="TIBOOBURRA">
						<option value="TINDAL">
						<option value="TOCUMWAL">
						<option value="TOORADIN">
						<option value="TOOWOOMBA">
						<option value="TOWNSVILLE/TOWNSVILLE">
						<option value="TRUSCOTT-MUNGALALU">
						<option value="TUMUT">
						<option value="TYABB">
						<option value="VAN ROOK STATION">
						<option value="VICTORIA RIVER DOWNS">
						<option value="WAGGA WAGGA">
						<option value="WALGETT">
						<option value="WANGARATTA">
						<option value="WARBURTON">
						<option value="WARRACKNABEAL">
						<option value="WARRNAMBOOL">
						<option value="WARWICK">
						<option value="WATTS BRIDGE">
						<option value="WEDDERBURN">
						<option value="WEIPA">
						<option value="WENTWORTH">
						<option value="WEST SALE">
						<option value="WHITE CLIFFS">
						<option value="WHITE GUM">
						<option value="WHYALLA">
						<option value="WILLIAM CREEK">
						<option value="WINDORAH">
						<option value="WINTON">
						<option value="WUDINNA">
						<option value="WYNYARD">
						<option value="YARRAM">
						<option value="YARRAWONGA">
						<option value="YOUNG">				
					</datalist>	
					
					<br><br>
						
					<label>&nbsp;Aircraft Range (nm)&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
					<input type="text" size="4" name="range" value="200" autocomplete="off">&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;	
						
					<br><br>
						
					<label>&nbsp;</label>
					<input type="submit" name="action" value="Generate New Route">
					
					<br><br>
						
					<input type="hidden" name="login_status" value="<?php echo $login_status?>">
					<input type="hidden" name="username" value="<?php echo $username?>">
			
					<label>&nbsp;</label>
					<input type="submit" name="action" value="Show Route List (Session Cookie)">
					
					<br><br>
			
					<label>&nbsp;</label>
					<input type="submit" name="action" value="Retrieve Old Routes (Requires Login/Register)">			
				</p>
			
			</form>			
			
		<?php
		}
		?>			
			
<!-- SCREEN 1: DISPLAY GENERATED ROUTE -->		

		<?php
		if ($show_route == 1)
		{ 
		?>
			<br>
			<div class="head"> <h2>Route:&nbsp;<?php echo $departure;?> to&nbsp; <?php echo $destination;?></h2>
			<span>&nbsp;(Bearing:&nbsp;<?php printf("%03d", $bearing);?>&nbsp;Degrees Magnetic &nbsp;/&nbsp Distance:&nbsp;<?php echo $distance;?>&nbsp Nautical Miles)</span></div>
				
			<br><br>
				
			<!-- ------------------------------------------------------------------------------- -->
			<?php if ($no_fuel_stops_flag == 1) // i.e. only do this if there are fuel stops
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
			<!-- ------------------------------------------------------------------------------ -->
			<?php
			}
			else
			{
				echo "No fuel stops required";
			}?>	
			<!-- ------------------------------------------------------------------------------ -->		
			
			<br>
			<form action="." method="post">
				<p>			
					<input type="hidden" name="departure" value="<?php echo $departure;?>">
					<input type="hidden" name="destination" value="<?php echo $destination;?>">
					<input type="hidden" name="bearing" value="<?php echo $bearing;?>">
					<input type="hidden" name="distance" value="<?php echo $distance;?>">
						
					<input type="hidden" name="login_status" value="<?php echo $login_status?>">
					<input type="hidden" name="username" value="<?php echo $username?>">	

					<input type="hidden" name="no_fuel_stops_flag" value="<?php echo $no_fuel_stops_flag?>">
					<input type="hidden" name="aircraft_range" value="<?php echo $aircraft_range?>">
					<input type="hidden" name="calculate_last_leg_flag" value="<?php echo $calculate_last_leg_flag?>">
						
											
					<!-- --------------------------------------------------------------------- --> 	
					<?php
					if ($no_fuel_stops_flag== 1)//i.e only do this if there are fuel stops
					{							
						foreach ($new_route as $route_segment)
						{
							foreach ($route_segment as $route_segment_element)
							{				
							?>
								<input type="hidden" name="new_route[]" value="<?php echo $route_segment_element?>">	
							<?php
							}						
						}
					}						
					?>								
					<!-- --------------------------------------------------------------------- -->
								
					<label>&nbsp;</label>
					<input type="submit" name="action" value="Add to Route List (Session Cookie)">
			
					<label>&nbsp;</label>
					<input type="submit" name="action" value="Show Route List (Session Cookie)">
			
					<label>&nbsp;</label>
					<input type="submit" name="action" value="Return to Route Generator">	
				</p>			
			</form>
		<?php
		}
		?>
			
<!--SCREEN 2: DISPLAY ROUTE LIST STORED IN SESSION COOKIE -->

		<?php
		if ($show_route == 2)
		{ 		
		?>
				
			<h2>Route List Stored in Session Cookie</h2>
			<table class="routelist">
				<tr>
					<th>Departure</th>
					<th>Destination</th>
					<th>Bearing</th>
					<th>Distance</th>
					<th>Aircraft Range</th>
				</tr>
		
			<?php 
		
				$i = 0;
				foreach ($stored_routes_display as $route)		
				{					
					?><tr><?php
					
					$j = 0;
					foreach ($route as $route_details)
					{						
						?>	<td><?php if ($j == 2)
							{
								printf("%03d", $route_details);
							}
							else
							{													
								echo $route_details;
							}
							?>	</td><?php				
										
					$j++;		
					}
					?></tr><?php	
					$i++;
				}	
			?>
	
			</table>
		
			<form action="." method="post">		

				<?php
				$i = 0;
				foreach ($stored_routes_display as $route)
				{
					foreach ($route as $route_details)
					{				
					?>
						<input type="hidden" name="stored_routes[]" value="<?php echo $route_details?>">	
					<?php
					}
				$i++;
				}
				?>
									
				<br><br>
			
				<input type="hidden" name="login_status" value="<?php echo $login_status?>">
				<input type="hidden" name="username" value="<?php echo $username?>">

				<label>&nbsp;</label>
				<input type="submit" name="action" value="Save to Database (Requires Login/Register)">			
				
				<label>&nbsp;</label>
				<input type="submit" name="action" value="Clear Session Cookie">	
			
				<label>&nbsp;</label>
				<input type="submit" name="action" value="Return to Route Generator">
			
			</form>
		
		<?php			
		}
		?>
			
<!--SCREEN 3: DISPLAY ROUTES STORED IN DATABASE -->	
		
		<?php if ($show_route == 3)
		{ 
		?>				
			<h2>Routes Stored in Database</h2>
			
			<table class="routelist">
				<tr>
					<th>Departure</th>
					<th>Destination</th>
					<th>Bearing</th>
					<th>Distance</th>
					<th>Aircraft Range</th>
					<th>&nbsp;</th>
				</tr>
		
				<?php foreach ($retrieved_route_list as $route)
				{
				?>
				<tr>
					<td><?php echo $route['TP_DEP']?></td>
					<td><?php echo $route['TP_DEST']?></td>
					<td><?php printf("%03d", $route['TP_BEAR'])?></td>
					<td><?php echo $route['TP_DIST']?></td>
					<td><?php echo $route['TP_RANGE']?></td>
						
					<td><form action="view/display_db_route.php" target="_blank" method="post">
						<input type="hidden" name="tp_dep"
							value="<?php echo $route['TP_DEP']; ?>">
						<input type="hidden" name="tp_dest"
							value="<?php echo $route['TP_DEST']; ?>">
						<input type="hidden" name="tp_bear"
							value="<?php echo $route['TP_BEAR']; ?>">
						<input type="hidden" name="tp_dist"
							value="<?php echo $route['TP_DIST']; ?>">
						<input type="hidden" name="tp_range"
							value="<?php echo $route['TP_RANGE']; ?>">
						<input type="submit" value="Dislay in New Tab">
					</form></td>		
				</tr>	

				<?php
				}
				?>
			</table>
				
			<form action="." method="post">
				<br><br>
					
				<input type="hidden" name="login_status" value="<?php echo $login_status?>">
				<input type="hidden" name="username" value="<?php echo $username?>">
					
				<label>&nbsp;</label>
				<input type="submit" name="action" value="DELETE ALL Routes from Database">			
				
				<label>&nbsp;</label>
				<input type="submit" name="action" value="Return to Route Generator">
					
			</form>
			
		<?php
		}
		?>
		
	</main>
	
	<footer>
		<br><br>
		&copy; Copyright 2021. All rights reserved <br>
		<a href="mailto:donaldewancameron@gmail.com">donaldewancameron@gmail.com</a>
	</footer>

</body>
</html>

<!DOCTYPE html>

<html>
  <head> 
   <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
   <!--<link rel="stylesheet" href="calendar.css"> -->
   <title>Book An Appontment</title>
   <style>
  	  body{
  	  	font-family: Lato;
  	  }
  	  caption{
  	  	font-size: 22pt;
  	  	margin: 10px 0 20px 0;
  	   	font-weight: 700;
  	  }
  	  table.calendar{
  	  	width:60%; 
  	  	border:1px solid #000;
  	  	margin-left: 250px;
  	  	margin-top: -35px;
  	  }
  	  td.day{
  	  	width: 10%; 
  	  	height: 100px; 
  	  	border: 1px solid #000; 
  	  	vertical-align: top;
        background-color: white;
  	  }
  	  td.day span.day-date{
  	  	width: 10%; 
  	  	height: 100px; 
  	  	font-size: 14pt; 
  	  	font-weight: 700;
  	  }
  	  th.header{
  	  	background-color: #003972; 
  	  	color: #fff; 
  	  	font-size: 14pt; 
  	  	padding: 5px;
  	  }
  	  .not-month{
  	  	background-color: lightgrey;   /*#a6c3df*/
  	  }
  	  td.today {
  	  	width: 10%; 
  	  	height: 100px; 
  	  	background-color: cyan;   /*#efefef*/
  	  }
  	  td.day span.today-date{
  	  	width: 10%; 
  	  	height: 100px; 
  	  	font-size: 16pt;
  	  }
      .titlos{
        position: relative;
        left: 110px;
        bottom: 110px;
        font-family: Helvetica;
        color: black;
      }
      .ikona{
        width: 150px;
      }
      body{
        background-image: url("back2.jpg");
        background-size: cover;
        background-attachment: fixed;
      }
   </style>
   
  </head>
  <body>
    <header>
      <span>
        <a href="#"><img class="ikona" src="logo.png"></a>
        <div class="titlos">
          <h2>Doctor Any Time</h2>
        </div>
      </span>
    </header>
    
  </body>

</html>

<script type="text/javascript">
    function send_date(value){
        window.location.replace("event.php?date="+value);
    }
</script>
<?php


  	function build_calendar($month,$year,$dateArray,$db) {
	$dates= get_dates($month,$db);
	
	
       // Create array containing abbreviations of days of week.
       $daysOfWeek = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');

       // What is the first day of the month in question?
       $firstDayOfMonth = mktime(0,0,0,$month,1,$year);

       // How many days does this month contain?
       $numberDays = date('t',$firstDayOfMonth);

       // Retrieve some information about the first day of the
       // month in question.
       $dateComponents = getdate($firstDayOfMonth);

       // What is the name of the month in question?
       $monthName = $dateComponents['month'];

       // What is the index value (0-6) of the first day of the
       // month in question.
       $dayOfWeek = $dateComponents['wday'];

       // Create the table tag opener and day headers

       $calendar = "<table class='calendar'>";
       $calendar .= "<caption>$monthName $year</caption>";
       $calendar .= "<tr>";

       // Create the calendar headers

       foreach($daysOfWeek as $day) {
            $calendar .= "<th class='header'>$day</th>";
       } 

       // Create the rest of the calendar

       // Initiate the day counter, starting with the 1st.

       $currentDay = 1;

       $calendar .= "</tr><tr>";

       // The variable $dayOfWeek is used to
       // ensure that the calendar
       // display consists of exactly 7 columns.

       if ($dayOfWeek > 0) { 
            $calendar .= "<td colspan='$dayOfWeek' class='not-month'>&nbsp;</td>"; 
       }
       
       $month = str_pad($month, 2, "0", STR_PAD_LEFT);
    
       while ($currentDay <= $numberDays) {

            // Seventh column (Saturday) reached. Start a new row.

            if ($dayOfWeek == 7) {

                 $dayOfWeek = 0;
                 $calendar .= "</tr><tr>";

            }
            
            $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
            
            $date = "$year-$month-$currentDayRel";
            
            if ($date == date("Y-m-d")){
             $calendar .= "<td class='day today' rel='$date' onclick=send_date('$date')><span class='today-date'>$currentDay</span>";
             $appointments = check_day($date,$dates);
             if ($appointments!=null){
                 foreach ($appointments as $appointment)
                 $calendar.="<p>".$appointment[0]. " ".$appointment[1]. " code:".$appointment[7]."</p>";
             }
            $calendar.="</td>";
            }
            else{
             $calendar .= "<td class='day' rel='$date'  onclick=send_date('$date')><span class='day-date'>$currentDay</span>";
             $appointments = check_day($date,$dates);
             if ($appointments!=null){
                 foreach ($appointments as $appointment)
                     $calendar.="<p>".$appointment[0]. " ".$appointment[1]. " Doctor:".$appointment[5]."</p>";
             }
            $calendar.="</td>";
            }
            
        
            

            // Increment counters
   
            $currentDay++;
            $dayOfWeek++;

       }
       
       

       // Complete the row of the last week in month, if necessary

       if ($dayOfWeek != 7) { 
       
            $remainingDays = 7 - $dayOfWeek;
            $calendar .= "<td colspan='$remainingDays' class='not-month'>&nbsp;</td>"; 

       }
       
       $calendar .= "</tr>";

       $calendar .= "</table>";

       return $calendar;

  }

  function build_previousMonth($month,$year,$monthString){
   
   $prevMonth = $month - 1;
    
    if ($prevMonth == 0) {
     $prevMonth = 12;
    }
    
   if ($prevMonth == 12){  
    $prevYear = $year - 1;
   } else {
    $prevYear = $year;
   }
   
   $dateObj = DateTime::createFromFormat('!m', $prevMonth);
   $monthName = $dateObj->format('F'); 
   
   return "<div class='prev'; style='margin-left:460px;  width: 100px;'><a style='color:black;' href='?m=" . $prevMonth . "&y=". $prevYear ."'><- " . $monthName . "</a></div>";
  }

  function build_nextMonth($month,$year,$monthString){
   
   $nextMonth = $month + 1;
    
    if ($nextMonth == 13) {
     $nextMonth = 1;
    }
   
   if ($nextMonth == 1){  
    $nextYear = $year + 1;
   } else {
    $nextYear = $year;
   }
   
   $dateObj = DateTime::createFromFormat('!m', $nextMonth);
   $monthName = $dateObj->format('F');
 
   return "<div class='next'; style='margin-left:750px; margin-top:-20px; width: 100px;'><a style='color:black;' href='?m=" . $nextMonth . "&y=". $nextYear ."'>" . $monthName . " -></a></div>";
  }


  ?> 

  <?php

     parse_str($_SERVER['QUERY_STRING']);  
   
     if ($m == ""){
      
      $dateComponents = getdate();
      $month = $dateComponents['mon'];
      $year = $dateComponents['year'];
     } else {
     
       $month = $m;
       $year = $y;
     
     }
require_once "config.php";
require_once "session.php";
function get_dates($month,$db){
	
	$query= $db->prepare("SELECT * FROM appointments WHERE month(date)=?");
		$query->bind_param('s',$month);
	        $query->execute();
	$resultSet= $query->get_result();
	$result=$resultSet->fetch_all();
	return $result;
}
function check_day($day, $dates){
      $results = array();
      foreach ($dates as $date){
          if ($date[8] == $day){
              array_push($results,$date);
          }
      }
      return $results;
  }
  echo build_previousMonth($month, $year, $monthString);
   echo build_nextMonth($month,$year,$monthString);
   echo build_calendar($month,$year,$dateArray,$db);


?>



<!-- prev month: style='width: 33%; margin-left:250px; margin-top:150px; display:inline-block;' -->
<!-- next month: style='width: 33%; margin-top: 100px; display:inline-block;'
				 style='width: 33%; display:inline-block; text-align:right;'
         <div>&nbsp;</div>
 -->


<!DOCTYPE html>
  <html>
  <head>
    <style>
      .footer-nav{
        text-align: center;
      }
    </style>
  </head>
  <body>
    <br><br><br>
    <nav class="footer-nav" role="navigation">
      <p>Copyright &copy;
         2020 Doctor Any Time. All rights deserved.</p>
    </nav>
  </body>
  </html>

<?php 
include('includes/header.php');



if(!isset($_SESSION['type'])){
    header('location:index.php');
   
	}
 if(!($_SESSION['type']=='student')){
      header('location:index.php');
    }
?>
<style>

.s_menu ul li:nth-child(4) a   {
         background-color: #BCCEF2;
}


</style>

<div class="s_container">

<div class="s_menu">


<ul>
<li><a href="student.php">Home</a></li>
<li><a href="student_profile.php">My Profile</a></li>

<li><a href="advising.php">Advising Panel</a></li>

<li><a href="course_details.php">Course Details</a></li>

</ul>

</div>

<div class="s_content">
  
  
  <div class="details_table">

<table >
<tr class="sms">
<th style="width:15%">Course</th>
<th style="width:10%">Section</th>
<th style="width:15%">Avaliable Seat </th>
<th style="width:15%">Faculty</th>
<th style="width:15%">Day</th>
<th style="width:15%">Start Time</th>
<th style="width:15%">End Time</th>
</tr>
      <?php 
	 
	  $rr=1;
	  
	     $resul=mysqli_query($con,"SELECT section.course_id ,time.lab, section.Sec_No ,section.Total_Seat - section.booked_seat , person.p_name ,time.Day ,time.start_time , time.end_time from section inner join time on section.course_id = time.course_id and section.Sec_No = time.Section_No inner join person on section.faculty_id = person.p_id") ;
		 foreach($resul as $row):
		 if($row['lab']==1)
		 $lab=" Lab";
		 else $lab="";
		 if($rr%2==0) $qq="odd"; else $qq="even";
		 $rr++;
		   echo('<tr class="'.$qq.'">');
		   echo('<td>'.$row['course_id'].' '.$lab.' </td>');
		   echo('<td>'.$row['Sec_No'].'</td>');
		   echo('<td>'.$row['section.Total_Seat - section.booked_seat'].'</td>');
		   echo('<td>'.$row['p_name'].'</td>');
		   echo('<td>'.$row['Day'].'</td>');
		   echo('<td>'.$row['start_time'].'</td>');
		   echo('<td>'.$row['end_time'].'</td>');
		  
		
		   echo('</tr>');
		 
		 endforeach;
	  
	  ?>
      
</table>


    </div>




  </div>

</div>

<?php include('includes/footer.php'); ?>
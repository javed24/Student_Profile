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

.s_menu ul li:nth-child(1) a   {
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
  <span class="tt"> GRADE SHEET </span>
       <div class="details_table">

<table >
<tr>
<th style="width:30%">Course</th>
<th style="width: 40%">Course Name</th>
<th style="width:30%">GPA </th>
</tr>
      <?php 
	 $smst="";
	  $rr=1;
	  $id=$_SESSION['id'];
	  
	     $resul=mysqli_query($con," select t1.course_id ,t1.semester,t1.gpa,t2.course_name from completed_course t1 inner join course t2 on t1.course_id = t2.course_id and t1.student_id='$id' order by time asc") ;
	
		 foreach($resul as $row):
		 if($rr==1) {
			 $smst= $row['semester'];
			 echo('<tr  class="sms">');
			 echo('<td colspan="3">'.$row['semester'].' </td>');
			 echo('</tr>');
		 }
		 if($smst != $row['semester']){
			 $rr=3;
			  $smst= $row['semester'];
			 echo('<tr  class="sms">');
			 echo('<td colspan="3">'.$row['semester'].' </td>');
			 echo('</tr>');
			 
		 }
		 if($rr%2==0) $qq="odd"; else $qq="even";
		 $rr++;
		   echo('<tr class="'.$qq.'">');
		   echo('<td>'.$row['course_id'].' </td>');
		   echo('<td>'.$row['course_name'].'</td>');
		   echo('<td>'.$row['gpa'].'</td>');
			
		   echo('</tr>');
		 
		 endforeach;
	   $resul=mysqli_query($con,"select avg(t1.gpa) from completed_course t1 where t1.student_id='$id' and not exists(select * from completed_course t2 where t1.course_id = t2.course_id and t2.gpa>t1.gpa and t2.student_id='$id')") ;
	 foreach($resul as $row):
        $cgpa=number_format($row['avg(t1.gpa)'],2);
        endforeach; 
        
        $resul=mysqli_query($con,"SELECT sum(credit) from course where course_id in (select course_id from completed_course where student_id = '$id')") ;
	 foreach($resul as $row):
        $sum=number_format($row['sum(credit)'],0);
        endforeach; 
		    echo('<tr  class="sms">');
			 echo('<td >Total Earned Credit : &nbsp;'.$sum .' </td>'); 
             echo('<td > </td>');
             echo('<td >CGPA  &nbsp;= &nbsp;'.$cgpa.' </td>');  
			 echo('</tr>');
		

	
	  ?>
      
</table>


    </div>  




  </div>

</div>

<?php include('includes/footer.php'); ?>
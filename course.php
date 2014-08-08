<!--$_GET["course"]  $_GET["sec"]; -->



<?php 

include('includes/header.php');
include('current_semester.php');



if(!isset($_SESSION['type'])){
    header('location:index.php');
   
	}
 if(!($_SESSION['type']=='faculty')){
      header('location:index.php');
    }
	
		
	$course=$_GET["course"];
	  $sec=$_GET["sec"];
	  
	if(isset($_POST['update'])){
		
		$re2= mysqli_query($con,"SELECT student_id from advising where Course_id='$course' and Sec_No='$sec' and confirmed = '1'") ;
		
		 foreach($re2 as $roww):
		     $std_id= $roww['student_id'];
			 
			 $gp= $_POST[$std_id];
			 
			 if(!empty($gp)){
				
        mysqli_query($con,"INSERT INTO `usis_project`.`completed_course` (`student_id`, `course_id`, `semester`, `gpa`, `time`)  VALUES ('$std_id', '$course', '$semester', '$gp',CURRENT_TIMESTAMP) ON DUPLICATE KEY UPDATE gpa='$gp';");
			 
			 }
		 endforeach;
		
	}

?>


<div class="s_container">

<div class="s_menu">


<ul>

<li><a href="faculty.php">Home</a></li>
<li><a href="faculty_advising.php">Advising Panel</a></li>
<li><a href="faculty_profile.php">My Profile</a></li>

</ul>

</div>

<div class="s_content">

<div class="course_table">
  <?php  echo('<form action="course.php?course='.$course.'&sec='.$sec.'" method="post">');  ?>

<table >
<tr>
<th style="width:20%">ID</th>
<th style="width:20%">Name</th>
<th style="width:20%">GPA</th>
<th style="width:40%">Update GPA</th>
</tr>
      <?php 
	 $rr=1;
	  
	  
	  echo( $course."  Sec: ".$sec);
	     $resul=mysqli_query($con,"SELECT advising.student_id, person.p_name, completed_course.gpa from advising inner join person on advising.course_id='$course' and advising.Sec_No='$sec' and advising.student_id=person.p_id and advising.confirmed='1' left join completed_course on advising.student_id=completed_course.student_id and advising.course_id= completed_course.course_id and advising.semester=completed_course.semester") ;
		 foreach($resul as $row):
		  if($rr%2==0) $qq="odd"; else $qq="even";
		 $rr++;
		   echo('<tr class="'.$qq.'">');
		   echo('<td>'.$row['student_id'].'</td>');
		   echo('<td>'.$row['p_name'].'</td>');
		   echo('<td>'.$row['gpa'].'</td>');
		   echo('<td> &nbsp;&nbsp;Enter GPA : &nbsp;&nbsp;  <input type="text" name="'.$row['student_id'].'" /></td>');
		
		   echo('<tr>');
		 
		 endforeach;
	  
	  ?>
      
</table>

    <input type="submit" style="float:right ;margin-right:15px; margin-top:15px " value="Update GPA"  name="update"/>
  </form>
    </div>

  </div>

</div>

<?php include('includes/footer.php'); ?>
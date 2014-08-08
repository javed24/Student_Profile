<?php 
include('includes/header.php');
include('current_semester.php');
//login check

if(!isset($_SESSION['type'])){
    header('location:index.php');
   
	}
 if(!($_SESSION['type']=='faculty')){
      header('location:index.php');
    }
$id=0;
//submited info for search
if(isset($_POST['search']) && isset($_POST['searchbox'])){
	
$_SESSION['s_id']=$_POST['searchbox'];	
	
	
	
	
}

if(isset($_SESSION['s_id'])){
	$id= $_SESSION['s_id'];
	
}

//submited info for add course

if(isset($_POST['add_course']) && isset($_POST['add_courses'])){
    
	$re = $_POST['add_courses'];
	$re=explode('%',$re);

  $res= mysqli_query($con,"insert into advising (student_id,Course_id,Sec_No,semester) select '$id','$re[0]','$re[1]' ,'$semester' from dual where not exists (select 1 from prereq_course left join completed_course ON completed_course.student_id='$id' and prereq_course.required_course=completed_course.course_id WHERE prereq_course.course_id ='$re[0]' AND completed_course.course_id is null) and not exists(SELECT 1 FROM time t1 where t1.course_id='$re[0]' AND t1.Section_No ='$re[1]' and t1.Day in (select t2.Day from time t2 where t2.course_id  in (select advising.Course_id  from advising where student_id='$id' and advising.Sec_No=t2.Section_No )  and t1.start_time= t2.start_time))  and exists(select 1 from section where course_id='$re[0]' and Sec_No='$re[1]' and Total_Seat > booked_seat )");	
   /* $str="INSERT INTO `usis_project`.`advising` (`student_id`, `Course_id`, `Sec_No`, `semester`) VALUES ('".$_SESSION['id']."', 'cse110', '2', NULL)";
	$result=mysqli_query($con,$str) ;*/
	
	//echo mysqli_affected_rows($con);
	if(mysqli_affected_rows($con) >0){
		
	   $res= mysqli_query($con,"UPDATE  `usis_project`.`section` SET  `booked_seat` =  booked_seat +1 WHERE  `section`.`course_id` =  '$re[0]' AND  `section`.`Sec_No` ='$re[1]'");
		
	}
	

}
	



//submited info for drop course
	
if(isset($_POST['drop_course']) && isset($_POST['drop_courses'])){	
     
	 $re1 = $_POST['drop_courses'];
	$re1=explode('%',$re1);
 mysqli_query($con,"DELETE FROM `usis_project`.`advising` WHERE `advising`.`student_id` = '$id' AND `advising`.`Course_id` = '$re1[0]' AND `advising`.`Sec_No` = '$re1[1]'  ") ;
 
   if(mysqli_affected_rows($con) >0){
		
	   $res= mysqli_query($con,"UPDATE  `usis_project`.`section` SET  `booked_seat` =  booked_seat -1 WHERE  `section`.`course_id` =  '$re1[0]' AND  `section`.`Sec_No` ='$re1[1]'");
		
	}
 
 
 }
	
	
	
?>
<style>

.s_menu ul li:nth-child(2) a   {
         background-color: #BCCEF2;
}


</style>

<div class="s_container">

<div class="s_menu">


<ul>

<li><a href="faculty.php">Home</a></li>
<li><a href="faculty_advising.php">Advising Panel</a></li>
<li><a href="faculty_profile.php">My Profile</a></li>

</ul>

</div>

<div class="s_content">

    
  <div class="av_course">
      
      <div class="searchBox">
           <form action="faculty_advising.php"  method="post">
                 <input type="text" name="searchbox"/>
               <input type="submit" value="Search"  name="search"/>
           
              </form>
              
              
          </div>
      
    <span class="av_tex" ><h6> Add Course</h6> </span>
     <form action="faculty_advising.php?" method="post">
        <select name="add_courses" size="8">
         <!--   <option value="h">1st</option>-->
            <?php 
			$$rr=1;
			$result=mysqli_query($con,"SELECT * FROM Section") ;
			
			foreach($result as $row):
			 if($rr%2==0) $qq="odd"; else $qq="even";
		 $rr++;
				/*?> <option value="{'course':'<?php echo($row['course_id'])?>','sec':'<?php echo($row['Sec_No']);?>'}"> */
				
				?><option class="<?php echo($qq);?>" value="<?php echo($row['course_id'] .'%'.$row['Sec_No']); ?>">
			<?php	echo($row['course_id'].' &nbsp;&nbsp; Sec: '.$row['Sec_No'].' &nbsp; Available :  '.($row['Total_Seat']-$row['booked_seat']).'</option> '); 
				
			endforeach;
			
			
			?>
                          
        
        </select>
          
        <input type="submit" value="Add"  name="add_course"/>
     
     </form>
  
  </div>
  
  
   <div class="ad_course">
   
  <!-- added course list-->
       
       <?php
$gpaa=0;
        $res=mysqli_query($con,"select avg(t1.gpa) from completed_course t1 where t1.student_id='$id' and not exists(select * from completed_course t2 where t1.course_id = t2.course_id and t2.gpa>t1.gpa and t2.student_id='$id')") ;
	 foreach($res as $row):
		  $gpaa= number_format($row['avg(t1.gpa)'],2);
		
		

	   endforeach; 
?>
 
        <div class="added">
             <span class="ad_tex"> Selected Courses Of :: &nbsp;<?php if(isset($_SESSION['s_id'])) echo($_SESSION['s_id'].' &nbsp;&nbsp;CGPA: &nbsp;'.$gpaa); ?>  </span>
            
            
            
                 <form action="faculty_advising.php" method="post">
          <select name="drop_courses" size="5">
         <!--   <option value="h">1st</option>-->
             <?php 
			 $$rr=1;
			$result=mysqli_query($con,"SELECT course.course_id ,advising.confirmed, section.Sec_No,course.credit, department.d_name,person.p_name  FROM Section inner join advising on   Section.course_id = advising.Course_id and Section.Sec_No=advising.Sec_No and advising.student_id='$id'  inner join course on course.course_id = section.course_id inner join department on course.Department_id = department.d_id inner join faculty on section.faculty_id =faculty.person_p_id inner join person on faculty.person_p_id= person.p_id") ;
			
			foreach($result as $row):
			if($rr%2==0) $qq="odd"; else $qq="even";
		 $rr++;
				/*?> <option class="<?php echo($qq);?>" value="{'course':'<?php echo($row['course_id'])?>','sec':'<?php echo($row['Sec_No']);?>'}"> */
				
				?><option class="<?php echo($qq);?>" value="<?php echo($row['course_id'] .'%'.$row['Sec_No']); ?>">
			<?php	echo($row['course_id'].' &nbsp;&nbsp; Sec: '.$row['Sec_No'].' &nbsp; credit: '.$row['credit'].'&nbsp; dept: '.$row['d_name'].' </option> '); 
			$a=$row['course_id'];
			$b=$row['Sec_No'];
			if($row['confirmed']==0){
				mysqli_query($con,"UPDATE `usis_project`.`advising` SET `confirmed` =  '1' WHERE `advising`.`student_id` ='$id' AND  `advising`.`Course_id` =  '$a' AND  `advising`.`Sec_No` ='$b'") ;
			}
			endforeach;
			
			
			
			?>
                          
         
        </select>
     
        <input type="submit" value="Drop"  name="drop_course"/>
     
     </form> 
 
            
        </div>
 
 
         <div class="cls_routine">
                
      <?php     
         $result=mysqli_query($con,"SELECT t1.day ,t1.start_time ,t3.Room_No, t1.course_id , t1.Section_No from time t1 inner join advising t2 on t1.course_id= t2.course_id and t1.Section_No = t2.Sec_No and t2.student_id='$id' inner join section t3 on t2.course_id = t3.course_id and t2.Sec_No = t3.Sec_No");
          
		   $array= array(array());
		    $d =0; $t=0;
		  foreach($result as $row):
		     if($row['day'] == "Sunday")
			    $d= 0;
		   else if($row['day'] == "Monday")
		        $d=1;
		   else if($row['day'] == "Tuesday")
		        $d=2;
		   else if($row['day'] == "Wednesday")
		        $d=3;
		   else if($row['day'] == "Thursday")
		        $d=4;
				
				
		  if($row['start_time'] == "08:00:00")
		        $t=0;
	      else if($row['start_time'] == "09:30:00")
		        $t=1;
		  else if($row['start_time'] == "11:00:00")
		        $t=2;
		  else if($row['start_time'] == "12:30:00")
		        $t=3;				
		  else if($row['start_time'] == "02:00:00")
		        $t=4;
		  else if($row['start_time'] == "03:30:00")
		        $t=5;				
			$array[$t] [$d]=$row['course_id'].'@'.$row['Section_No'].'@'.$row['Room_No'];		
			
		 endforeach; 
?>		   
		 <div class="r_table">

<table >
<tr>
<th class="even" style="width: 20%">Time/Day</th>
<th class="even" style="width: 16%">Sunday</th>
<th class="even" style="width: 16%">Monday</th>
<th class="even" style="width: 16%">Tuesday </th>
<th class="even" style="width: 16%">Wednesday</th>
<th class="even" style="width: 16%">Thursday</th>
</tr>
<?php	
	 
		   echo('</tr>');
		       
		   for($i=0;$i<6;$i++){
			    echo('<tr >');
			   
			           if($i==0) echo('<td class="even"> 8:00 AM- 9:20AM </td>');
			      else if($i==1) echo('<td class="even"> 9:30 AM- 10:50AM </td>');
				  else if($i==2) echo('<td class="even"> 11:00 Am- 12:20PM </td>');
				  else if($i==3) echo('<td class="even"> 12:30 PM- 01:50PM </td>');
				  else if($i==4) echo('<td class="even"> 02:00 PM- 03:20PM </td>');
				  else if($i==5) echo('<td class="even"> 03:30 PM- 4:50PM </td>');
			   for($j=0;$j<5;$j++){
			       if(isset($array[$i] [$j])){
					  $zx=explode('@',$array[$i] [$j]); 
					  echo('<td class="odd">' .$zx[0].'</br>'. $zx[1].'</br>'.$zx[2].' </td>');
					  
				   }
				   else echo('<td> </td>');
			   
		   }
			   
			 echo('</tr>');  
		   }
		 

	  ?>
      
</table>
          
       
      </div>
  
      </div>
  
  </div>
 </div> 
 
</div>

<?php include('includes/footer.php'); ?>
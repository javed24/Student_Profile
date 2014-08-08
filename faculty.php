<?php 

include('includes/header.php');



if(!isset($_SESSION['type'])){
    header('location:index.php');
   
	}
 if(!($_SESSION['type']=='faculty')){
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

<li><a href="faculty.php">Home</a></li>
<li><a href="faculty_advising.php">Advising Panel</a></li>
<li><a href="faculty_profile.php">My Profile</a></li>

</ul>

</div>

<div class="s_content">
    <div class="my_crs">
      <div class="my_rs_tx">
        My courses
      </div>
       <div class="cour">
                   <ul>
          
<!-- <li><a href="course.php?course=cse110&sec=2">Home</a></li>-->
            <?php 
			$f_id= $_SESSION['id'];
			$result=mysqli_query($con,"SELECT course_id,Sec_No FROM `section` WHERE faculty_id ='$f_id'") ;
			
			
			foreach($result as $row):
			
			echo('<h6><li><a href="course.php?course='.$row['course_id'].'&sec='.$row['Sec_No'].'">'.$row['course_id'].' Sec: '.$row['Sec_No'].'</a></li></h6>');
			
			endforeach;
			
			?>
            
            
            
            </ul>
       </div>
    
      
     </div>




  </div>

</div>

<?php include('includes/footer.php'); ?>
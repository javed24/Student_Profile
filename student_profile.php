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

.s_menu ul li:nth-child(2) a   {
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
         
          <div class="d_table">

<table >
<tr>
<th style="width: 30%"></th>
<th style="width:70%"></th>
</tr>
      <?php 

	  $rr=1;
	  $id=$_SESSION['id'];
	  
	     $resul=mysqli_query($con," select * from person where p_id= '$id'") ;
	
		 foreach($resul as $row):

		   echo('<tr class="odd">');
		   echo('<td class="l"> Name: </td>');
		   echo('<td class="r">'.$row['p_name'].'</td>');
		   echo('</tr>');
		   
		    echo('<tr class="even">');
		   echo('<td class="l"> Father&acute;s Name: </td>');
		   echo('<td class="r">'.$row['p_f_name'].'</td>');
		   echo('</tr>');
		   
		   echo('<tr class="odd" >');
		   echo('<td class="l"> Mother&acute;s Name: </td>');
		   echo('<td class="r">'.$row['p_m_name'].'</td>');
		   echo('</tr>');
		   
		   echo('<tr class="even">');
		   echo('<td class="l"> Email: </td>');
		   echo('<td class="r">'.$row['p_email'].'</td>');
		   echo('</tr>');
		   
		   echo('<tr class="odd">');
		   echo('<td class="l"> Phone: </td>');
		   echo('<td class="r">'.$row['p_phone'].'</td>');
		   echo('</tr>');
		   
		   echo('<tr class="even">');
		   echo('<td class="l"> Blood Group: </td>');
		   echo('<td class="r">'.$row['p_phone'].'</td>');
		   echo('</tr>');
		   
		   echo('<tr class="odd">');
		   echo('<td class="l"> Birth Date: </td>');
		   echo('<td class="r">'.$row['p_birth_date'].'</td>');
		   echo('</tr>');
		   
		   echo('<tr class="even">');
		   echo('<td class="l"> Address: </td>');
		   echo('<td class="r">'.$row['p_address'].'</td>');
		   echo('</tr>');
		   
		  
		 
		 endforeach;
	   
	  ?>
      
</table>


    </div>  
         
         
          




  </div>

</div>

<?php include('includes/footer.php'); ?>
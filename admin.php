<?php 
include('includes/header.php');

if(!isset($_SESSION['type'])){
    header('location:index.php');
   
	}
 if(!($_SESSION['type']=='admin')){
      header('location:index.php');
    }



//prepare db preadd
if(isset($_POST['p_preAd'])){

$res= mysqli_query($con,"DELETE FROM `usis_project`.`advising` WHERE `advising`.`confirmed` = '0'");
$res= mysqli_query($con,"UPDATE `usis_project`.`section` SET `booked_seat` = '0' WHERE 1");

}


//prepare db add
if(isset($_POST['p_Ad'])){

$res= mysqli_query($con,"DELETE FROM `usis_project`.`advising` WHERE `advising`.`confirmed` = '1'");

}


//disaqble preadd
if(isset($_POST['DpreAd'])){

$res= mysqli_query($con,"UPDATE `usis_project`.`student` SET `Can_Advise` = '0' WHERE 1");

}


//enable pre for completed credit


if(isset($_POST['p_cre']) && isset($_POST['p_creGo'])  ){


$val=$_POST['p_creGo'];


$res= mysqli_query($con," UPDATE `usis_project`.`student` SET `Can_Advise` = '1' WHERE `student`.`student_id` in ( select  distinct t1.student_id from completed_course t1 where  ( SELECT sum(t2.credit) from course t2 where t2.course_id in (select t3.course_id from completed_course t3 where t3.student_id = t1.student_id)) > '$val')");


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

<li><a href="admin.php">Home</a></li>


</ul>

</div>

<div class="s_content">
    <div class="controls" >
  
  
  
      <div class="pre_ad">
         Pre-Advising
         <form action="admin.php" method="post">
         </br>
            
              <input type="submit" value="Prepare DataBase For Pre-Advising"  name="p_preAd"/>
              </br> 
              
              <span class="www"><p> Enable Pre-advising whose completed </br>credit is greater than</p></span>
                                        <input type="text" name="p_cre" />
                     
                          <input type="submit" value="GO"  name="p_creGo"/>
         
         </br>
         
         <input type="submit" value="Disable Pre-Advising"  name="DpreAd"/>
         
         </form>
          
      </div>
   <div class="admin_adv">
      Advising 
      </br>
       </br>
        <form action="admin.php" method="post">
     <input type="submit" value="Prepare DataBase For Advising"  name="p_Ad"/>
     
     
       </form>
  </div>

</div>

<?php include('includes/footer.php'); ?>
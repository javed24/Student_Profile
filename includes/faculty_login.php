<?php
include('connection.php');

if(isset($_SESSION['logged_in'])){
	//display index
    
     if( $_SESSION['type'] == 'faculty'){
	       header('location:../faculty.php');
       }
	
	}
	else{
	
			$username= $_POST['userId'];
			$password= md5($_POST['password']);
			if(empty($username) or empty($password)){
			$error= "All fields are required !!";
                 header('location:../index.php');
            }
			else{
				$result=mysqli_query($con,"SELECT * FROM faculty WHERE person_p_id =(select p_id from person where p_id ='$username' and usis_password= '$password')" );
				$num =mysqli_num_rows($result);
				
				if($num == 1) {
					$error= "correct";
					//loged in
                     session_start();
					$_SESSION['logged_in'] = true;
                     $_SESSION['type'] = 'faculty';
					 $_SESSION['id']=$username;
					header('location:../faculty.php');
					exit();
				
				}
				else {$error="wrong id or password !!";
                      
                      header('location:../index.php');}
			}
        
	}
		

?>
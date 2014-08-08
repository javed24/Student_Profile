<?php include('includes/header.php'); ?>
   <div class="login">
        <div class="stdnt">
        
        
        <span class="text">STUDENT AREA</span>
        
           <form action="includes/stdnt_login.php" method="post">
           
           <ul class="stdnt_login">
           <li>
                  User ID :  <input type="number" name="userId" />
           </li>
           <li>
                  Password :  <input type="password" name="password"  />
           </li>
           <li>
                   <input type="submit" value=" Log in" />
            </li>
           </ul>
            </form>
        
        </div>
        
        
         
        
        <div class="faculty">
        
        <span class="text">FACULTY AREA</span>
            <form action="includes/faculty_login.php" method="post">
           
           <ul class="stdnt_login">
           <li>
                  User ID :  <input type="number" name="userId" />
           </li>
           <li>
                  Password :  <input type="password" name="password"  />
           </li>
           <li>
                   <input type="submit" value=" Log in" />
            </li>
           </ul>
            </form>
    
        </div>
        
        <div class="admin">
        
        
        <span class="text">ADMIN AREA</span>
            <form action="includes/admin_login.php" method="post">
           
           <ul class="stdnt_login">
           <li>
                  User ID :  <input type="number" name="userId" />
           </li>
           <li>
                  Password :  <input type="password" name="password"  />
           </li>
           <li>
                   <input type="submit" value=" Log in" />
            </li>
           </ul>
            </form>
        </div>
   </div>
   
   <div class="footer">
   </div>


<?php include('includes/footer.php'); ?>
       
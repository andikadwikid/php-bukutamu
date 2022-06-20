<?php  
 include 'config.php';
 if(isset($_POST["query"]))  
 {  
      $output = '';  
      $query = "SELECT * FROM department WHERE nama_d LIKE '%".$_POST["query"]."%'";  
      $result = mysqli_query($connect, $query);  
      $output = '<ul class="list-unstyled">';  
      if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '<li>'.$row["nama_d"].'</li>';  
           }  
      }  
      else  
      {  
           $output .= '<li>Department tidak ditemukan</li>';  
      }  
      $output .= '</ul>';  
      echo $output;  
 }  
 ?>  
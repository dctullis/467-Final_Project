<!--***********************
    Written by David Tullis
    Last Modified - 4/30/20
    ***********************-->

    <?php 
 //inserts the updated customer data in the finalized_quotes db and removes the quote from the customer_quotes db
 $database = new PDO('mysql:host=courses; dbname=z1860353', 'z1860353', '1999Mar23');
 $db2 = new PDO('mysql:host=courses; dbname=z1860353', 'z1860353', '1999Mar23');

 if(!empty($_POST))  
 { 
    session_start();
    $customer_id = $_SESSION['cid'];
    $quote_id = $_POST['q_id'];
    $output = '';  
    $message = '';
    if($quote_id != '')  
      {  
        $sql = "
          INSERT INTO finalized_quotes
          SELECT * FROM customer_quotes
          WHERE c_id = $customer_id 
          AND q_id = $quote_id;";
          
        $query2 = "
          DELETE FROM customer_quotes
           WHERE c_id = $customer_id 
           AND q_id = $quote_id;";
      }
     

      $sth = $database->prepare($sql);
      $sth->execute();

      $stm = $db2->prepare($query2);
      $stm->execute();
      if($sth)  
      {  
           $output .= '<label class="text-success">' . $message . '</label>';    
      }  
      echo $output;  

      
      header('Location: sap.php');
 }  
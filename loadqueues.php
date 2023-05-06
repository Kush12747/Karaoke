<?php
  include("karaokedjinterface.php");

  try {

    #$order = $_GET['order'];
    #$direction = $_GET['dir'];
    #$type = $_GET['type'];
    #$out = "";
    #if ($order != "" && $direction != "") {
      #echo print_queues($pdoobj->get_pdo(), $pdoobj->get_fcursort(), $pdoobj->get_fcurdir(), $pdoobj->get_pcursort(), $pdoobj->get_pcurdir());
      #$free = print_queue($freeq->get_pdo(), "Free");
      #$paid = print_queue($freeq->get_pdo(), "Paid");
    #}
    #echo $free;
    #echo $paid; 
    #echo print_queues($freeq->get_pdo());
    echo render_query($freeq->get_pdo(), "SELECT * FROM FreeQueue ORDER BY Location ASC", "f");
    echo render_query($freeq->get_pdo(), "SELECT * FROM PaidQueue ORDER BY Location ASC", "p");

  }
  catch(PDOexception $e) {
    echo "Connection to database failed: " . $e->getMessage();
  }   
?>
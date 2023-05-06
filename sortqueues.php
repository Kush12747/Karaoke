<?php
  include("karaokedjinterface.php");

  try {

    $id = $_GET['id'];
    $type = $_GET['type'];

    if ($id != "" && $type != "") {
      if ($type == "f") {                                # if queue is free
        if ($id == $freeq->get_srt()) {               # if clicked id is the current sort
          $freeq->flip_dir();# flip sort direction
        } else {                              # else if clicked id is not the current sort
          $freeq->set_srt($id);         # change current sort to id
          $freeq->set_dir("ASC");        # set sort direction to ASC
        }
      } else {                                # else if queue is paid
        if ($id == $paidq->get_srt()) {               # if clicked id is the current sort
          $paidq->flip_dir();# flip sort direction
        } else {                              # else if clicked id is not the current sort
          $paidq->set_srt($id);         # change current sort to id
          $paidq->set_dir("ASC");        # set sort direction to ASC
        }
      }
    }
  $html = render_query($freeq->get_pdo(), "SELECT * FROM FreeQueue ORDER BY ".$freeq->get_srt()." ".$freeq->get_dir().";", "f");
  $html .= render_query($freeq->get_pdo(), "SELECT * FROM PaidQueue ORDER BY ".$paidq->get_srt()." ".$paidq->get_dir().";", "p");





      #if ( ($type == "free") && $id == $pdoobj->get_fcursort() ) {
        #$cursrt = $pdoobj->get_fcursort();
      #  $pdoobj->set_fcurdir($pdoobj->get_opposite_dir($type));
      #else if (($type = "free") && $id != $pdoobj->get_fcursort()) {

      #}
      #} else if ( ($type == "paid") && $id == $pdoobj->get_pcursort() ) {
      #  $pdoobj->set_pcurdir($pdoobj->get_opposite_dir($type));
      #} 
      #echo print_queues($pdoobj->get_pdo(), $pdoobj->get_fcursort(), $pdoobj->get_fcurdir(), $pdoobj->get_pcursort(), $pdoobj->get_pcurdir());  
  }
  catch(PDOexception $e) {
    echo "Connection to database failed: " . $e->getMessage();
  }
?>
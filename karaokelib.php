<?php
  # draws a table with the given result set
  #
  function draw_table($rows) {
    echo "<table border=1 cellspacing=1>"
      ."<tr>";
    foreach($rows[0] as $key => $item) {
      echo "<th id=\"$key\" onclick=\"flip_sort(this.id)\">$key</th>";
    }
    echo "</tr>";
    foreach($rows as $row) {
      echo "<tr>";
      foreach($row as $key => $item) {
        echo "<td>$item</td>";
      }
      echo "</tr>";
    }
    echo "</table>";
  }

  function return_table($rows, $type) {
    $tbl = "<div class=\"column\"><div><table id=\"$type\">";
    foreach($rows[0] as $key => $item) {
      $tbl .= "<th id=\"$key\" onclick=\"flip_sort(this.id, '$type')\">$key</th>";
    }
    $tbl .= "</tr>";
    foreach($rows as $row) {
      $tbl .= "<tr>";
      foreach($row as $key => $item) {
        $tbl .= "<td>$item</td>";
      }
      $tbl .= "</tr>";
    }
    $tbl .= "</table></div></div>";
    return $tbl;
  }

  # returns a pdo statement containing everything from the given table
  # $pdo is the pdo object
  # $table is the target table to query
  # $order is the attribute to sort the result set on
  # $direction is the direction the results should be sorted in
  #   - D for DESC, anthing else for ASC
  #   - defaults to ASC
  function return_all($pdo, $table, $order, $direction = "ASC") {
    if ($direction == "D") {
      $direction = "DESC";
    }
    $query = "SELECT * FROM " . $table . " ORDER BY " . $order . " " . $direction . ";";
    $result = $pdo->query($query);
    return $result->fetchAll(PDO::FETCH_ASSOC);
  }

  # returns the value of attribute $target in  table $table based 
  # on the value of $basev in attribute $basea
  # $pdo is the pdo object
  # $target is attribute from which the value is to be returned
  # $table is the table to query from
  # $basea is the attribute to search from
  # $basev is the value to search with
  function get_value($pdo, $target, $table, $basea, $basev) {
    $query = "SELECT " . $target . " FROM " . $table . " WHERE " . $basea . " = \"" . $basev . "\";";
    $result = $pdo->query($query);
    return $result->fetchColumn();
  }

  # inserts $values into $table
  # $pdo is the pdo object
  # $$table is the destination table
  # $values is an array containing the values to be inserted
  function insert($pdo, $table, $values) {
    $last = array_key_last($values);
    $query = "INSERT INTO " . $table . " VALUES (";
    foreach($values as $key => $val) {
      if (!is_numeric($val)) {
        $query .= "'";  
      }
      $query .= $val;
      if (!is_numeric($val)) {
        $query .= "'";
      }
      if ($key != $last) {
        $query .= ", ";
      }
    }
    $query .= ");";
    echo "<br><br> QUERY TEST:<br>" . $query;
    return ($num = $pdo->exec($query)); 
  }

  # removes a tuple from $table depending on the $value of $attribute
  # $pdo is the pdo object
  # $table is the table to remove from
  # $attribute is the attribute to search in
  # $value is the value to search for
  # DELETE FROM $table 
  #   WHERE 
  #
  #
  function remove($pdo, $table, $attributes, $values) {
    $last = array_key_last($attributes);
    $query = "DELETE FROM " . $table . " WHERE ";
    foreach($attributes as $key => $attr) {
      $query .= $attr .= " = ";
      if (!is_numeric($values[$key])) {
        $query .= "'";
      } 
      $query .= $values[$key];
      if (!is_numeric($values[$key])) {
        $query .= "'";
      } 
      if ($key != $last) {
        $query .= " AND ";
      }
    }
    $query .= ";";
    return ($num = $pdo->exec($query));
  }

  function print_queue($pdo, $type, $order = "Spot", $direction = "ASC") {
    if ($type = "Free") {
      $tblstmnt = $pdo->query("SELECT * FROM FreeQueue ORDER BY ".$order." ".$direction.";");
    } else {
      $tblstmnt = $pdo->query("SELECT * FROM PaidQueue ORDER BY ".$order." ".$direction.";");
    }
    if ($tblstmnt) {
      $r = $tblstmnt->fetchAll(PDO::FETCH_ASSOC);
      $tbl = return_table($r, $type);
    } else {
      $tbl = "ERROR IN QUERY!";
    }
    return $tbl;
  }

  function render_query($pdo, $query, $type) {
    $tbl = "";
    $stmnt = $pdo->query($query);
    if ($stmnt) {
      $result = $stmnt->fetchALL(PDO::FETCH_ASSOC);
      $tbl = return_table($result, $type);
    } else {
      $tbl = "ERROR IN QUERY!";
    }
    return $tbl;
  }

  function print_queues($pdo, $order = "Spot", $direction = "ASC") {
    $freetblstmnt = $pdo->query("SELECT * FROM FreeQueue ORDER BY ".$forder." ".$fdirection.";");
    $result = $freetblstmnt->fetchAll(PDO::FETCH_ASSOC);
    $freetbl = return_table($result, "free");
    $paidtblstmnt = $pdo->query("SELECT * FROM PaidQueue ORDER BY $porder $pdirection;");
    $result = $paidtblstmnt->fetchAll(PDO::FETCH_ASSOC);
    $paidtbl = return_table($result, "paid");
    $html = "<div class=\"row\">".$paidtbl.$freetbl."</div";
    return $html;
  }





  # generates an html select form element with the given options
  # $options is an array containing the options
  # $name is the value that the element should be accessible by
  function generate_select($options, $name) {
    echo '<select name='.$name.'>';
    foreach($options as $option) {
      echo '<option>'.$option."</option>";
    }
    echo "</select>";
  }

?>
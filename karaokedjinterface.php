<!DOCTYPE html>
<html>
<head>

<style>
  * {
  box-sizing: border-box;
}

.row {
  margin-left:-5px;
  margin-right:-5px;
}
  
.column {
  float: left;
  width: 50%;
  padding: 5px;
}

.row::after {
  content: "";
  clear: both;
  display: table;
}

table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th, td {
  text-align: left;
  padding: 16px;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}
</style>


<title>DJ Interface</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<?php
  include("secrets.php");
  include("pdo.php");
  $freeq = new Karaoke("mysql:host=courses;dbname=z1944656", $username, $password);
  $paidq = new Karaoke("mysql:host=courses;dbname=z1944656", $username, $password);
?>   
</head>
<body onload="load_page()">
<div id="tblcontainer">
</div>
<script type="text/javascript">
  function flip_sort(id, type) {
    //alert(parent);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "sortqueues.php?"+"id="+id+"&type="+type, true);
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById(id).innerHTML = this.responseText;
      }
    };
    xmlhttp.send();
  }
</script>
<script type="text/javascript">
  function load_page() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("tblcontainer").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET", "loadqueues.php", true);
    xmlhttp.send();

  }
</script>
</body>

</html>


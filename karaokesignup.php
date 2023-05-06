<html>
<head>
   <title>Song Signup</title>
</head>
<body>
   <h1>Song Signup</h1>
</body>
</html>

<?php

include 'secrets.php';

//establish the connection to database
  try {
    $dsn = "mysql:host=courses;dbname=z1944656";
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
  catch(PDOexception $e) {
    echo "Connection to database failed: " . $e->getMessage();
  }
  echo "<form method = 'POST' action='KaraokeWeb.php'>";

  echo "<label for='song'>Enter Song: </label>";
  echo "<input type='text' id='title' name='title'><br><br>";

  echo "<label for='artist'>Artist: </label>";
  echo "<input type='text' id='artist' name='artist'><br><br>";

  echo "<label for='queue'>Select Queue Type: </label>";
  echo "<select id='queue' name='queue'>";
  echo "<option value='free'>Free Queue</option>";
  echo "<option value='paid'>Paid Queue</option>";
  echo "</select><br><br>";

  echo "<label for='payment'>Enter Amount: </label>";
  echo "<input type='text' id='payment' name='payment'><br><br>";

  echo "<input type='submit' value='submit'><br><br>";
  echo "</form>";

  if ($_SERVER['REQUEST_METHOD'] == 'POST')
  {
      $title = $_POST["Title"];
      $artist = $_POST["ArtistName"];
      $queue = $_POST["QueueType"];
      $amt = $_POST["AmountPaid"];
  }
 // sql2 = $pdo->prepare("INSERT INTO SignUp (UserID, QueueID, FileID, Location, AmountPaid) VALUES ('U019', '$queue',    );");
  $sql = $pdo->query("SELECT Title FROM Song;");
  $rows = $sql->fetchAll(PDO::FETCH_ASSOC);
  echo "<table border = 1 cellspacing = 1>";
  echo "<th>Song Title</th>";
  foreach($rows as $row) {
    echo "<tr>";
    echo "<td>" . $row["Title"] . "</td>";
    echo "</tr>";
  }
  echo "</table>";
?>
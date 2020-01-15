<html>
<head>
 <Title>Registration Form</Title>
 <link rel='stylesheet' href='style.css'>
 <body>
  <div id="login-box">
    <div class="left">
      <center><h1>DAFTAR DISINI</h1></center>
      <p>Fill in your name and email address, then click <strong>Submit</strong> to register.</p>
      <form method="post" action="index.php" enctype="multipart/form-data" >
        <input type="text" name="name" id="name" placeholder="Nama" />
        <input type="text" name="email" id="email" placeholder="E-mail" />
        <input type="text" name="job" id="job" placeholder="Pekerjaan" />
        <center><input type="submit" name="submit" value="Submit" /></center>
        <center><input type="submit" name="load_data" value="Load Data" /></center>
      </form>

      <div class="right">
        <center><h1>YANG TERDAFTAR</h1></center>
 <?php
 $host = "ikhsan.database.windows.net";
 $user = "ikhsan";
 $pass = "Wonosobo123";
 $db = "dicodingdb";

 try {
  $conn = new PDO("sqlsrv:server = $host; Database = $db", $user, $pass);
  $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
} catch(Exception $e) {
  echo "Failed: " . $e;
}

if (isset($_POST['submit'])) {
  try {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $job = $_POST['job'];
    $date = date("Y-m-d");
            // Insert data
    $sql_insert = "INSERT INTO Registration (name, email, job, date) 
    VALUES (?,?,?,?)";
    $stmt = $conn->prepare($sql_insert);
    $stmt->bindValue(1, $name);
    $stmt->bindValue(2, $email);
    $stmt->bindValue(3, $job);
    $stmt->bindValue(4, $date);
    $stmt->execute();
  } catch(Exception $e) {
    echo "Failed: " . $e;
  }

  echo "<h3>Your're registered!</h3>";
} else if (isset($_POST['load_data'])) {
  try {
    $sql_select = "SELECT * FROM Registration";
    $stmt = $conn->query($sql_select);
    $registrants = $stmt->fetchAll(); 
    if(count($registrants) > 0) {
      echo "<h2>People who are registered:</h2>";
      echo "<table>";
      echo "<tr><th>Name</th>";
      echo "<th>Email</th>";
      echo "<th>Job</th>";
      echo "<th>Date</th></tr>";
      foreach($registrants as $registrant) {
        echo "<tr><td>".$registrant['name']."</td>";
        echo "<td>".$registrant['email']."</td>";
        echo "<td>".$registrant['job']."</td>";
        echo "<td>".$registrant['date']."</td></tr>";
      }
      echo "</table>";
    } else {
      echo "<h3>No one is currently registered.</h3>";
    }
  } catch(Exception $e) {
    echo "Failed: " . $e;
  }
}
?>
      </div>
      <div class="or">=</div>
    </div>

  </body>
  </html>


<?php

  $chercher_lettre = $_POST["chercher"];

  $conn = mysqli_connect("localhost","root","","afci") 
  or die("Connection Failed");

  $sql = "SELECT * FROM students WHERE first_name LIKE '%{$chercher_lettre}%' OR last_name LIKE '%{$chercher_lettre}%'";
  $result = mysqli_query($conn, $sql) or die("SQL Query Failed.");
  $output = "";
  if(mysqli_num_rows($result) > 0 ){
    $output = '<table border="1" width="100%" cellspacing="0" cellpadding="10px">
                <tr>
                <th width="60px">   Id              </th>
                <th>                First Name      </th>
                <th>                Last Name       </th>
                <th>                HTML           </th>
                <th>                Angular           </th>
                <th>                Php           </th>
                <th width="90px">   Edit            </th>
                <th width="90px">   Delete          </th>
                </tr>';

                while($row = mysqli_fetch_assoc($result)){
                  $output .= 
                  "<tr>
                    <td align='center'>
                      {$row["id"]}
                    </td>
                    <td>
                      {$row["first_name"]} 
                    </td>
                    <td>
                      {$row["last_name"]}
                    </td>
                    <td>
                      {$row["html"]}
                    </td>
                    <td>
                      {$row["angular"]}
                    </td>
                    <td>
                      {$row["php"]}
                    </td>
                    <td align='center'>
                      <button class='edit-btn' data-eid='{$row["id"]}'>
                        Edit
                      </button>
                    </td>
                    <td align='center'>
                      <button Class='delete-btn' data-id='{$row["id"]}'>
                        Delete
                      </button>
                    </td>
                  </tr>";
                }
      $output .= "</table>";

      mysqli_close($conn);

      echo $output;
  }else{
      echo "<h2>No Record Found.</h2>";
  }

?>

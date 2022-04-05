<?php

    $conn = mysqli_connect("localhost","root","","afci") or die("Connection Failed");

    $sql = "Select * from students";

    $result = mysqli_query($conn, $sql) or die("SQL Query Failed");

    $output="";

    if(mysqli_num_rows($result)>0)
    {
        $output = '<table border="1" width="100%" 
        cellspacing="0" cellpadding="10px">
        <tr>
            <th width="60px">   Id              </th>
            <th>                First Name      </th>
            <th>                Last Name       </th>
            <th>                HTML           </th>
            <th>                Angular           </th>
            <th>                Php           </th>
            <th width="60px">   Edit            </th>
            <th width="60px">   Delete          </th>
            <th width="60px">   Report         </th>
        </tr>
        ';

        while($row=mysqli_fetch_assoc($result))
        {
            $output .= "
            
            <tr>
                <td align='center'>
                    {$row["id"]}
                </td>
                <td align='center' class='salim' data-id='{$row["id"]}'>
                    {$row["first_name"]}
                </td>
                <td align='center' class='salim' data-id='{$row["id"]}'>
                    {$row["last_name"]}
                </td>
                <td align='center' class='salim' data-id='{$row["id"]}'>
                    {$row["html"]}
                </td>
                <td align='center' class='salim' data-id='{$row["id"]}'>
                    {$row["angular"]}
                </td>
                <td align='center' class='salim' data-id='{$row["id"]}'>
                    {$row["php"]}
                </td>
                <td align='center'>
                    <button class='edit-btn' data-id='{$row["id"]}'>
                        Edit
                    </button>
                </td>
                <td align='center'>
                    <button class='delete-btn' data-id='{$row["id"]}'>
                        Delete
                    </button>
                </td>
                <td align='center'>
                    <button class='report-btn' data-id='{$row["id"]}'>
                        Report
                    </button>
                </td>
            </tr>";
        }
        $output .="</table>";
        mysqli_close($conn);
        echo $output;
    }
    else {
        echo "<h2>Aucun Enregistrement Trouvé.</h2>";
    }
?>
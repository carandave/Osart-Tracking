<?php 

    require_once('../../config.php');

  

    if(isset($_POST['checking_viewbtn'])){
        $s_id = $_POST['student_id'];

        // $query = "SELECT r.user_id, r.incident_id, r.location, i.id, i.name FROM report_list r INNER JOIN incident_list i ON r.incident_id = i.id WHERE r.id = '$s_id'";

        $query = "SELECT * FROM request_list WHERE id = '$s_id'";
        
        $query_run = mysqli_query($conn, $query);
    

        foreach($query_run as $row){ 
            $data_array = array(
                    // 'id' => $row['id'],
                    // 'incident_id' => $row['incident_id'],
                    // 'incident_id' => $row['incident_id'],
                    'reqId' => $row['id'],
                    'resName' => $row['res_name'],
                    'noOfResponder' => $row['no_of_responder'],
                    'incType' => $row['inc_type'],
                    'description' => $row['description'],
                    'location' => $row['location'],
                    'dateReq' => $row['date_req'],
                    'status' => $row['status']
                    
                    );
        }

        echo json_encode($data_array);
        
        }

   

?>
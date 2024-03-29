<?php 

	require_once('../config.php');

	if(isset($_POST['request_button'])){
		 $incidentId = $_POST['incident_id'];
		 $specificLoc = $_POST['specific_loc'];
		 $howResponder = $_POST['how_responder'];
		 $descTest = $_POST['desc_text'];
		 $dateCreated = date('Y-m-d h:i:s');

		$iquery = "INSERT INTO `request_list`(`no_of_responder`, `inc_type`, `description`, `location`, `date_req`) VALUES ('$howResponder','$incidentId','$descTest','$specificLoc','$dateCreated')";
		if ($conn->query($iquery) === TRUE) {
			echo '<script>alert("Requested Successfully")</script>';
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}

		
	}

?>


<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<?php $stat_arr = ["Pending Request","Approved Request", "Accepted"]; ?>
<div class="card card-outline rounded-0 card-navy">
	<div class="card-header">
		<h3 class="card-title">Tracking Responder<?= isset($_GET['status']) && isset($stat_arr[$_GET['status']]) ? "({$stat_arr[$_GET['status']]})" : "" ?></h3>

		<div class="card-tools">
			<?php if(!isset($_GET['status'])): ?>
			<?php 
			$count_pending = $conn->query("SELECT id FROM `report_list` where `status` = 0")->num_rows;
			?>
			<!-- <a href="./?page=incident_reports&status=0" class="btn btn-flat btn-gradient-light border"><span class="badge badge-danger rounded"><?= format_num($count_pending > 0 ? $count_pending : 0) ?></span>  Filter Pending Request</a> -->
			<?php else: ?>
			<a href="./?page=incident_reports" class="btn btn-flat btn-gradient-light border"><i class="fa fa-list"></i>  List All</a>
			<?php endif; ?>
			<!-- <a href="javascript:void(0)" id="create_new" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>  Create New</a> -->
			
			<!-- <button type="button" class="btn btn-flat btn-primary" data-toggle="modal" data-target="#exampleModal">
			Launch demo modal
			</button> -->

			<!-- <button type="button" class="btn btn-flat btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Request BackUp</button> -->

			
			<!-- <a href="javascript:void(0)" id="request" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>  Request BackUp</a> -->
		</div>
	</div>
	<div class="card-body">
        <div class="container-fluid">
			<table class="table table-hover table-striped table-bordered" id="list">
				<colgroup>
					<!-- <col width="5%"> -->
					<col width="20%">
					<col width="20%">
					<col width="20%">
					<col width="20%">
					<!-- <col width="10%">
					<col width="10%"> -->
				</colgroup>
				<thead>
					<tr align="center">
						<!-- <th>#</th> -->
						<th style="display: none"></th>
                        <th>First Name</th>
                        <th>Last Name</th>
						<th>Longitude</th>
						<th>Latitude</th>
                        <th>View Location</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					// $i = 1;
					// $where = "";
					// if(isset($_GET['status']))
						// $where = " where r.`status` = '{$_GET['status']}' ";
                    $uId = $_SESSION['userId'];
					$qry = $conn->query("SELECT * FROM users");

                    if($qry->num_rows > 0){
					
                        while($row = $qry->fetch_assoc()):

                        
							
						
						// $teams = "";
						// $team_query = $conn->query("SELECT concat(rt.name,' ', t.code) as `team` from team_list t inner join respondent_type_list rt on t.respondent_type = rt.id where t.id in (SELECT team_id from `report_teams` where report_id = '{$row['id']}') order by `team` asc");
						// if($team_query->num_rows > 0){
						// 	$teams = array_column($team_query->fetch_all(MYSQLI_ASSOC),'team');
						// 	$teams = implode(", ", $teams);
						// }
					?>
					
						<tr align="center">
							<!-- <td class="text-center"><?php echo $i++; ?></td> -->
							<td class="stud_id" style="display: none"><?php echo $row['id']; ?></td>
                            <td><?php echo $row['firstname'] ?></td>
							<td><?php echo $row['lastname'] ?></td>
							<td>
								<input type="text" name="longitude" id="longitude" value="<?php echo $row['longitude'] ?>" readonly>
							</td>
                            <td>
								<input type="text" name="latitude" id="latitude" value="<?php echo $row['latitude'] ?>" readonly>
							</td>
                            <td>
								<form action="<?php echo base_url ?>admin/?page=user/trackView" method="POST">
									<input type="text" class="d-none" name="latitudes" id="latitude" value="<?php echo $row['latitude'] ?>" readonly>
									<input type="text" class="d-none" name="longitudes" id="longitude" value="<?php echo $row['longitude'] ?>" readonly>
									<input type="submit" name="btnTrig" class="btn btn-primary" value="View Location">
								</form>
                                <!-- <a href="">View Location</a> -->
                                <!-- <button type="button" class="btn btn-primary locationBtn" >View Location</button> -->

                                <!-- View Location Modal -->
                                <!-- <div class="modal fade bd-example-modal-lg" id="viewLocation" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div id="map" style="height: 400px; width: 100%;">
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <script type="text/javascript">



                                    let map;

                                    function initMap() {
										var uluru = { lat: <?php echo $row['latitude']; ?>, lng: <?php echo $row['longitude']; ?> };
										console.log(uluru);
										let map = new google.maps.Map(document.getElementById("map"), {
											center: uluru,
											zoom: 10
										});

										var marker = new google.maps.Marker({
											position: uluru,
											map: map
										})
                                    }
                                </script>
                                <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCq48uXc35YvNlFRqteQywr0hKHY-GeVw4&callback=initMap">
                                </script> -->

                            </td>

                            
						</tr>
					<?php endwhile; 
                    } 
                    ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){

		// $('.locationBtn').click(function (e){

		// 	console.log("Clikced")
		// 	$('#viewLocation').modal('show');

		// 	$tr = $(this).closest('tr');

		// 	var data = $tr.children("td").map(function(){
		// 		return $(this).text();
		// 	}).get();

		// 	console.log(data);

		// })

		$('.view_btn').click(function (e){
                e.preventDefault();
                // alert("Hello World");

                var stud_id = $(this).closest('tr').find('.stud_id').text();
                // console.log(stud_id);

                $.ajax({
					type: "POST",
                    url: "incident_reports/request.php",
					dataType: "json",
                    data: {
                        'checking_viewbtn': true,
                        'student_id': stud_id,
                    },
                    success: function(response){
						// console.log("Test");
						console.log(response);

						// $('#view1').prop(“disabled”, false);
						// var text = $('#view1'). val();
						// $(text).prop(“disabled”, true)

						// let view1 = document.getElementById("view1").value = response.id;
						let view2 = document.getElementById("view1").value = response.incident_id;
						let view3 = document.getElementById("view2").value = response.location;

						

						// $('.student_viewing_data').html(response); 
						
						
						
                        $('studentVIEWModal').modal('show');
                    }
                })
		})

		$('.delete_data').click(function(){
			_conf("Are you sure to delete this incident report permanently?","delete_report",[$(this).attr('data-id')])
		})
		$('#create_new').click(function(){
			uni_modal("<i class='fa fa-plus'></i> Add New Incident Report","incident_reports/manage_report.php", "modal-lg")
		})
		$('.view_data').click(function(){
			uni_modal("<i class='fa fa-bars'></i> Incident Report Details","incident_reports/view_report.php?id="+$(this).attr('data-id'), "modal-lg")
		})
		$('.edit_data').click(function(){
			uni_modal("<i class='fa fa-edit'></i> Update Incident Report Details","incident_reports/manage_report.php?id="+$(this).attr('data-id'), "modal-lg")
		})
		$('.table').dataTable({
			columnDefs: [
					{ orderable: false, targets: [6] }
			],
			order:[0,'asc']
		});
		$('.dataTable td,.dataTable th').addClass('py-1 px-2 align-middle')
	})
	function delete_report($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_report",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.reload();
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>
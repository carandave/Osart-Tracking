<?php 

	require_once('../config.php');

	 $resId = $_settings->userdata('id');
	 $type = $_settings->userdata('type');


	
	$sqlr = "SELECT * FROM users WHERE id='$resId'";
	$resultr = $conn->query($sqlr);
	

	if(isset($_POST['request_button'])){
		 $incidentId = $_POST['incident_id'];
		 $resName = $_POST['res_name'];
		 $specificLoc = $_POST['specific_loc'];
		 $howResponder = $_POST['how_responder'];
		 $descTest = $_POST['desc_text'];
		 $dateCreated = date('Y-m-d h:i:s');
		 $status = "Pending";

		$iquery = "INSERT INTO `request_list`(`no_of_responder`, `res_name`, `inc_type`, `description`, `location`, `date_req`, `status`) VALUES ('$howResponder','$resName','$incidentId','$descTest','$specificLoc','$dateCreated','$status')";
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
		<h3 class="card-title">List of Patient Care Report <?= isset($_GET['status']) && isset($stat_arr[$_GET['status']]) ? "({$stat_arr[$_GET['status']]})" : "" ?></h3>

		<div class="card-tools">
			<!-- <a href="javascript:void(0)" id="create_new" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>  Create New </a> -->
			<?php if(!isset($_GET['status'])): ?>
			<!-- <?php 
			$count_pending = $conn->query("SELECT id FROM `request_list` where `status` = 'pending'")->num_rows;
			?>
			<a href="./?page=incident_reports&status=0" class="btn btn-flat btn-gradient-light border"><span class="badge badge-danger rounded"><?= format_num($count_pending > 0 ? $count_pending : 0) ?></span>  Filter Pending Request</a>
			<?php else: ?> -->
			<a href="./?page=incident_reports" class="btn btn-flat btn-gradient-light border"><i class="fa fa-list"></i>  List All</a>
			<?php endif; ?>
			
			
			<!-- <button type="button" class="btn btn-flat btn-primary" data-toggle="modal" data-target="#exampleModal">
			Launch demo modal
			</button> -->

			<!-- <button type="button" class="btn btn-flat btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Request BackUp</button> -->

			
			<!-- <a href="javascript:void(0)" id="request" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>  Request BackUp</a> -->
		</div>
	</div>
	<div class="card-body">
        <div class="container-fluid">
			<?php 
				$i = 1;
				$where = "";
				// if(isset($_GET['status'])){
					
					$qry = "SELECT r.id as resId, r.user_id, r.name, r.m_name, r.l_name, r.gender, r.age, r.address, r.report_datetime, r.incident_id, r.location, u.id, u.type, i.id, i.name as `incident` FROM report_list r INNER JOIN users u ON r.user_id = u.id INNER JOIN incident_list i ON r.incident_id = i.id";
					$resulti = $conn->query($qry);
				// }
				// 	$where = " where r.`status` = '{$_GET['status']}' ";
				// $qry = $conn->query("SELECT r.*, i.name as `incident` from `report_list` r inner join incident_list i on r.incident_id = i.id {$where} order by unix_timestamp(r.report_datetime) desc ");
				// while($row = $qry->fetch_assoc()):
				// 	$teams = "";
				// 	$team_query = $conn->query("SELECT concat(rt.name,' ', t.code) as `team` from team_list t inner join respondent_type_list rt on t.respondent_type = rt.id where t.id in (SELECT team_id from `report_teams` where report_id = '{$row['id']}') order by `team` asc");
				// 	if($team_query->num_rows > 0){
				// 		$teams = array_column($team_query->fetch_all(MYSQLI_ASSOC),'team');
				// 		$teams = implode(", ", $teams);
				// 	}
			?>
			<table class="table table-hover table-striped table-bordered table-responsive" id="list">
				<colgroup>
					<col width="5%">
					<col width="15%">
					<col width="20%">
					<col width="20%">
					<col width="20%">
					<col width="10%">
					<col width="10%">
				</colgroup>
				<thead>
					<tr align="center">
						<th>#</th>
						<th style="display: none;"></th>
						<th>Name</th>
						<th>Age</th>
						<th>Gender</th>
						<th>Address</th>
						<th>Date & Time</th>
						<th>Incident Report</th>
						<th>Incident Location</th>
						
								<?php if($type == 2){?>
									<th>Request BackUp</th>
								<?php }?>

						
					</tr>
				</thead>
				<tbody>
					

					<?php if($resulti->num_rows > 0) {?>
						<?php while($row = $resulti->fetch_assoc()){?>
						<tr align="center">
							<td class="text-center"><?php echo $i++; ?></td>
							<td class="stud_id" id="stud_id" name="stud_id" style="display: none"><?php echo $row['resId']; ?></td>
							<td><?php echo $row['name'] ?> <?php echo $row['m_name'] ?> <?php echo $row['l_name'] ?></td>
							<td><?php 
							    $age = $row['age'];
								$date = new DateTime($age);
								$interval = $date->diff(new DateTime);
								echo $interval->y;
								
								?>
							</td>
							<td><?php echo $row['gender'] ?></td>
							<td><?php echo $row['address'] ?></td>
							<td><?php echo date("Y-m-d H:i",strtotime($row['report_datetime'])) ?></td>
							<td><?php echo $row['incident'] ?></td>
							<td><?php echo $row['location'] ?></td>
							
							
							

									<?php if($type == 2){?>
										<!-- <td>Request BackUp</td> -->
										<td>
											<a href="#" class="btn btn-success view_btn" data-toggle="modal" data-target="#studentVIEWModal" >
												Request
											</a>
										</td>
									<?php }?>

							
							

							<!-- Modal -->
							<div class="modal fade" id="studentVIEWModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title text-center" id="exampleModalLabel">Request Back Up</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body text-center">
										<div class="student_viewing_data">
											<!-- <label for="" class="float-left">Incident Id</label>
											<input type="text" id="view1" class="view1 form-control" disabled="true"> -->
											<form action="" method="POST">
												

												<?php if($resultr->num_rows > 0){?>
													<?php while($rowr = $resultr->fetch_assoc()){?>
														<label for="" class="float-left mt-2">Responder Name</label>
														<input type="text" name="res_name" id="res_name" class="res_name form-control" value="<?php echo $rowr['firstname'].' '.$rowr['lastname'];?>" readOnly="true" required>
													<?php }?>
												<?php }?> 

												<label for="" class="float-left mt-2">Incident Type</label>
												<input type="text" name="incident_id" id="view1" class="view2 form-control" readOnly="true" required>

												<label for="" class="float-left mt-2">Location</label>
												<input type="text" name="specific_loc" id="view2" class="view2 form-control" readOnly="true" required>

												<label for="" class="float-left mt-2">How many Responder?</label>
												<input type="number" name="how_responder" id="" class="view2 form-control" required>

												<label for="" class="float-left mt-2">Description</label>
												<textarea name="desc_text" id="" class="form-control" cols="5" rows="3" required></textarea>

												<input type="submit" name="request_button" class="btn btn-success btn-block mt-3" value="Request">
											</form>
											

										</div>
											
											<!-- <input type="text" id="view3" class="view3 form-control" disabled="true"> -->
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									</div>
									</div>
								</div>
							</div>
					
						</tr>
						<?php } ?>
					<?php } ?>
					
				</tbody>
			</table>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){

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
                        'student_id': stud_id
                    },
                    success: function(response){
						// console.log("Test");
						console.log(response);

						// $('#view1').prop(“disabled”, false);
						// var text = $('#view1'). val();
						// $(text).prop(“disabled”, true)

						// let view1 = document.getElementById("view1").value = response.id;
						document.getElementById("view1").value = response.name;
						document.getElementById("view2").value = response.location;

						

						// $('.student_viewing_data').html(response); 
						
						
						
                        $('studentVIEWModal').modal('show');
                    }
                })
		})

		$('.delete_data').click(function(){
			_conf("Are you sure to delete this incident report permanently?","delete_report",[$(this).attr('data-id')])
		})
		$('#create_new').click(function(){
			uni_modal("<i class='fa fa-plus'></i> Add","incident_reports/manage_report.php", "modal-lg")
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
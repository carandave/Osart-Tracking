<?php 

require_once('../config.php');


if(isset($_POST['edit_button'])){

	// $editStatus = $_POST['edit_status'];
	$editReqId = $_POST['reqIdUp'];

	$sqlu = "UPDATE request_list SET status='Confirm' WHERE id='$editReqId'";
	

//    $iquery = "INSERT INTO `request_list`(`no_of_responder`, `res_name`, `inc_type`, `description`, `location`, `date_req`, `status`) VALUES ('$howResponder','$resName','$incidentId','$descTest','$specificLoc','$dateCreated','$status')";
   if ($conn->query($sqlu) === TRUE) {
	   echo '<script>alert("Successfully edited the request!")</script>';
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
<div class="card card-outline rounded-0 card-navy">
	<div class="card-header">

		<div class="row">
			<div class="col-md-6">
				<h3 class="card-title">List of Request Back Up</h3>
			</div>

			<div class="col-md-6 d-flex justify-content-end">
				<?php 
				$count_pending = $conn->query("SELECT id FROM `request_list` where `status` = 'pending'")->num_rows;
				?>
				<a href="" class="btn btn-flat btn-gradient-light border"><span class="badge badge-danger rounded"><?= format_num($count_pending > 0 ? $count_pending : 0) ?></span>       Pending Request</a>
			</div>
		</div>
		

		
			
		<!-- <div class="card-tools">
			<a href="javascript:void(0)" id="create_new" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>  Add New</a>
		</div> -->
	</div>
	<div class="card-body">
        <div class="container-fluid">
			<table class="table table-hover table-striped table-bordered" id="list">
				<colgroup>
					<col width="5%">
					<col width="15%">
					<col width="20%">
					<col width="30%">
					<col width="15%">
					<col width="15%">
				</colgroup>
				<thead>
					<tr align="center">
						<th>#</th>
						<th>Name of Responder</th>
						<th>Incident Type</th>
						
                        <th>Location</th>
                        <th>No. of Responder</th>
						<th>Description</th>
						<th>Status</th>
                        <th>Date Requested</th>
						
						<th>Action</th>
						<!-- <th>Status</th>
						<th>Action</th> -->
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 1;
						$qry = $conn->query("SELECT * FROM `request_list` WHERE status='Pending' order by `date_req` DESC");
						while($row = $qry->fetch_assoc()):
					?>
						<tr align="center">
							<td class="text-center"><?php echo $i++; ?></td>
							<td class="stud_id" style="display: none;"><?php echo $row['id']; ?></td>
							<td><?php echo $row['res_name'] ?></td>
							<td><p class="m-0 truncate-1"><?php echo $row['inc_type'] ?></p></td>
                            
                            <td><?php echo $row['location'] ?></td>
                            <td><?php echo $row['no_of_responder'] ?></td>
                            <td><?php echo $row['description'] ?></td>
							<td><?php echo $row['status'] ?></td>
							
                            
                            <td><?php echo date("Y-m-d H:i",strtotime($row['date_req'])) ?></td>
                            
							<td>
								<form action="" method="POST">

									<input type="text" name="reqIdUp" id="reqIdUp" value="<?php echo $row['id']; ?>" class="edit_reqId form-control d-none"  readOnly="true" required>
									
									<input type="submit" name="edit_button" class="btn btn-success btn-block mt-3" value="Confirm">
								</form>
								<!-- <a href="#" class="btn btn-success edit_btn" >
									Edit
								</a> -->
								<!-- <a href="#" class="btn btn-success edit_btn" data-toggle="modal" data-target="#requestVIEWModal" >
									Edit
								</a> -->
							</td>

							<!-- Modal -->
							<!-- <div class="modal fade" id="requestVIEWModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title text-center" id="exampleModalLabel">Request Information</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body text-center">
										<div class="student_viewing_data">

											<form action="" method="POST">

												<label for="" class="float-left mt-2 d-none">Request Id</label>
												<input type="text" name="edit_reqId" id="edit_reqId" class="edit_reqId form-control d-none" readOnly="true" required>
												
												<label for="" class="float-left mt-2">Responder Name</label>
												<input type="text" name="edit_res_name" id="edit_res_name" class="edit_res_name form-control" readOnly="true" required>

												<label for="" class="float-left mt-2">Incident Type</label>
												<input type="text" name="edit_incident_id" id="edit_incident_id" class="edit_incident_id form-control" readOnly="true" required>

												<label for="" class="float-left mt-2">Location</label>
												<input type="text" name="edit_specific_loc" id="edit_specific_loc" class="edit_specific_loc form-control" readOnly="true" required>

												<label for="" class="float-left mt-2">How many Responder?</label>
												<input type="number" name="edit_how_responder" id="edit_how_responder" class="edit_how_responder form-control" readOnly="true" required>

												<label for="" class="float-left mt-2">Description</label>
												<textarea name="edit_desc_text" id="edit_desc_text" class="edit_desc_text form-control" cols="5" rows="3" readOnly="true" required></textarea>

												<label for="" class="float-left mt-2">Status</label>
												<select name="edit_status" id="edit_status" class="edit_status form-control" required>
													<option value=""></option>
													
													<option value="Confirm">Confirm</option>
												</select>

												<input type="submit" name="edit_button" class="btn btn-success btn-block mt-3" value="Edit">
											</form>
											

										</div>
											
											
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									</div>
									</div>
								</div>
							</div> -->
							<!-- End Modal -->
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){

		$('.edit_btn').click(function (e){
                e.preventDefault();
                // alert("Hello World");

                var stud_id = $(this).closest('tr').find('.stud_id').text();
                console.log(stud_id);

                $.ajax({
					type: "POST",
                    // url: "incident_reports/request.php",
					url: "request/viewinfo_request.php",
					dataType: "json",
                    data: {
                        'checking_viewbtn': true,
                        'student_id': stud_id,
                    },
                    success: function(response){
						// console.log("Test");
						console.log(response);
					
						let view0 = document.getElementById("edit_reqId").value = response.reqId;
						let view1 = document.getElementById("edit_res_name").value = response.resName;
						let view2 = document.getElementById("edit_incident_id").value = response.inc_type;
						let view3 = document.getElementById("edit_specific_loc").value = response.location;
						let view4 = document.getElementById("edit_how_responder").value = response.noOfResponder;
						let view5 = document.getElementById("edit_desc_text").value = response.description;
						// var view6 = document.getElementById("edit_status").value = response.status;
						// var view6 = document.getElementById("edit_status").value = response.status;
						$("#edit_status option:selected").text(response.status);
						$("#edit_status option:selected").val(response.status);

						
						
						
                        $('studentVIEWModal').modal('show');
                    }
                })
		})

		$('.delete_data').click(function(){
			_conf("Are you sure to delete this incident permanently?","delete_incident",[$(this).attr('data-id')])
		})
		$('#create_new').click(function(){
			uni_modal("<i class='fa fa-plus'></i> Add New Incident","incidents/manage_incident.php")
		})
		$('.view_data').click(function(){
			uni_modal("<i class='fa fa-bars'></i> Incident Details","incidents/view_incident.php?id="+$(this).attr('data-id'))
		})
		$('.edit_data').click(function(){
			uni_modal("<i class='fa fa-edit'></i> Update Incident Details","incidents/manage_incident.php?id="+$(this).attr('data-id'))
		})
		$('.table').dataTable({
			columnDefs: [
					{ orderable: false, targets: [4] }
			],
			order:[0,'asc']
		});
		$('.dataTable td,.dataTable th').addClass('py-1 px-2 align-middle')
	})
	function delete_incident($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_incident",
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
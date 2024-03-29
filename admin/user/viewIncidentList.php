<?php if($_settings->chk_flashdata('success')): 
$lastName = $_GET['lastname'];    
?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<style>
    .user-avatar{
        width:3rem;
        height:3rem;
        object-fit:scale-down;
        object-position:center center;
    }
</style>
<div class="card card-outline rounded-0 card-navy">
	<div class="card-header">
		<h3 class="card-title">List of Incident Reports by <span class="font-weight-bold"><?php echo $lastName = $_GET['lastname']; ?></span></h3>
		<div class="card-tools">
			<!-- <a href="./?page=user/manage_user" id="create_new" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>  Add New Responder</a> -->
		</div>
	</div>
	<div class="card-body">
        <div class="container-fluid">
			<table class="table table-hover table-striped table-bordered" id="list">
				<colgroup>
					<col width="5%">
					<col width="15%">
					<col width="15%">
					<col width="25%">
					<col width="15%">
					<col width="10%">
					<col width="15%">
				</colgroup>
				<thead>
					<tr align="center">
						<!-- <th>#</th>
						<th>Id</th>
						<th>Date Updated</th>
						<th>Profile Photo</th>
						<th>Reponder Name</th>
						<th>Username</th>
						<th>User Type</th>
						<th>Action</th> -->
                        <th>#</th>
						<th style="display: none;"></th>
						<th>Name</th>
						<th>Age</th>
						<th>Address</th>
						<th>Date & Time</th>
						<th>Incident Report</th>
						<th>Map Location</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					    $i = 1;
                        $resId = $_GET['id'];
                        
						$qry = "SELECT r.id as resId, r.user_id, r.name, r.age, r.address, r.report_datetime, r.incident_id, r.location, u.id, i.id, i.name as `incident` FROM report_list r INNER JOIN users u ON r.user_id = u.id INNER JOIN incident_list i ON r.incident_id = i.id WHERE r.user_id = '$resId'";
					    $resulti = $conn->query($qry);
					?>
                    <?php if($resulti->num_rows > 0) {?>
						<?php while($row = $resulti->fetch_assoc()){?>
                            <tr align="center">
							<td class="text-center"><?php echo $i++; ?></td>
							<td class="stud_id" id="stud_id" name="stud_id" style="display: none"><?php echo $row['resId']; ?></td>
							<td><?php echo $row['name'] ?></td>
							<td><?php echo $row['age'] ?></td>
							<td><?php echo $row['address'] ?></td>
							<td><?php echo date("Y-m-d H:i",strtotime($row['report_datetime'])) ?></td>
							<td><?php echo $row['incident'] ?></td>
							<td><?php echo $row['location'] ?></td>
							
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

		// $('.viewIncident').click(function (e){
		// 	var stud_id = $(this).closest('tr').find('.stud_id').text();
		// 	console.log(stud_id);

		// 	document.getElementById("UserId").value = stud_id;
		// });

		$('.delete_data').click(function(){
			_conf("Are you sure to delete this User permanently?","delete_user",[$(this).attr('data-id')])
		})
		$('.table').dataTable({
			columnDefs: [
					{ orderable: false, targets: [6] }
			],
			order:[0,'asc']
		});
		$('.dataTable td,.dataTable th').addClass('py-1 px-2 align-middle')
	})
	function delete_user($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Users.php?f=delete",
			method:"POST",
			data:{id: $id},
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(resp == 1){
					location.reload();
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>
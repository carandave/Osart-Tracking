<?php

require_once('../../config.php');
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT  * FROM `report_list` where id = '{$_GET['id']}'");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }
}
?>
<style>
	#cimg{
		width:100%;
		max-height:20vh;
		object-fit:scale-down;
		object-position:center center;
	}
</style>
<div class="container-fluid">
	<form action="" id="report-form">
		<input type="hidden" name ="id" value="<?php echo isset($id) ? $id : '' ?>">
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<fieldset>
					<legend>Incident Information</legend>

					<div class="form-group">
						<label for="report_datetime" class="control-label">Report Date & Time <small class="text-danger">*</small></label>
						<input type="datetime-local" name="report_datetime" id="report_datetime" class="form-control form-control-sm rounded-0" value="<?php echo isset($report_datetime) ? date("Y-m-d\TH:i", strtotime($report_datetime)) : date("Y-m-d\TH:i")  ?>" max="<?= date("Y-m-d\TH:i") ?>" required/>
					</div>
					<div class="form-group">
						<label for="incident_id" class="control-label">Incident Type <small class="text-danger">*</small></label>
						<select name="incident_id" id="incident_id" class="select2 form-control form-control-sm rounded-0" required>
							<option value="" <?php echo !isset($incident_id)? 'selected' : '' ?>></option>
							<?php 
							// $incident_qry = $conn->query("SELECT * FROM `incident_list` where delete_flag = 0 and `status` = 1 ".(isset($incident_id) ? " or id = '{$incident_id}'" : "" )." order by `name` asc ");
							$incident_qry = $conn->query("SELECT * FROM `incident_list` ".(isset($incident_id) ? " or id = '{$incident_id}'" : "" )." order by `name` asc ");
							while($row = $incident_qry->fetch_assoc()):
							?>
							<option value="<?= $row['id'] ?>" <?php echo isset($incident_id) && $incident_id == $row['id'] ? 'selected' : '' ?>><?= $row['name'] ?></option>
							<?php endwhile; ?>
						</select>
					</div>
					<div class="form-group">
						<label for="location" class="control-label">Incident Location <small class="text-danger">*</small></label>
						<!-- <textarea type="text" name="location" id="location" class="form-control form-control-sm rounded-0" required><?php echo isset($location) ? $location : ''; ?></textarea> -->
						<select class="form-control form-control-sm rounded-0" name="location" id="location" required ><?php echo isset($location) ? $location : ''; ?>
								<option value=""></option>	
								<option value="Abilay Norte, Oton">Abilay Norte, Oton</option>
								<option value="Abilay Sur, Oton">Abilay Sur, Oton</option>
								<option value="Alegre, Oton">Alegre, Oton</option>
								<option value="Batuan Ilaud, Oton">Batuan Ilaud, Oton</option>
								<option value="Batuan Ilaya, Oton">Batuan Ilaya, Oton</option>
								<option value="ita Norte, Oton">Bita Norte, Oton</option>
								<option value="Bita Sur, Oton">Bita Sur, Oton</option>
								<option value="otong, Oton">Botong, Oton</option>
								<option value="Buray, Oton">Buray, Oton</option>
								<option value="Cabanbanan, Oton">Cabanbanan, Oton</option>
								<option value="Caboloan Norte, Oton">Caboloan Norte, Oton</option>
								<option value="Caboloan Sur, Oton">Caboloan Sur, Oton</option>
								<option value="Cadinglian, Oton">Cadinglian, Oton</option>
								<option value="Cagbang, Oton">Cagbang, Oton</option>
								<option value="Calam-isan, Oton">Calam-isan, Oton</option>
								<option value="Galang, Oton">Galang, Oton</option>
								<option value="Lambuyao, Oton">Lambuyao, Oton</option>
								<option value="Mambog, Oton">Mambog, Oton</option>
								<option value="Pakiad, Oton">Pakiad, Oton</option>
								<option value="Poblacion East, Oton">Poblacion East, Oton</option>
								<option value="Poblacion North, Oton">Poblacion North, Oton</option>
								<option value="Poblacion South, Oton">Poblacion South, Oton</option>
								<option value="Poblacion West, Oton">Poblacion West, Oton</option>
								<option value="Polo Maestra Bita, Oton">Polo Maestra Bita, Oton</option>
								<option value="Oton">Oton</option>
								<option value="Rizal, Oton">Rizal, Oton</option>
								<option value="Salngan, Oton">Salngan, Oton</option>
								<option value="Sambaludan, Oton">Sambaludan, Oton</option>
								<option value="San Antonio, Oton">San Antonio, Oton</option>
								<option value="San Nicolas, Oton">San Nicolas, Oton</option>
								<option value="Santa Clara, Oton">Santa Clara, Oton</option>
								<option value="Santa Monica, Oton">Santa Monica, Oton</option>
								<option value="Santa Rita, Oton">Santa Rita, Oton</option>
								<option value="Tagbac Norte, Oton">Tagbac Norte, Oton</option>
								<option value="Tagbac Sur, Oton">Tagbac Sur, Oton</option>
								<option value="Trapiche, Oton">Trapiche, Oton</option>
								<option value="Tuburan, Oton">Tuburan, Oton</option>
								<option value="Turog-Turog, Oton">Turog-Turog, Oton</option>
						</select>
					</div>
					<!-- <div class="form-group">
						<label for="remarks" class="control-label">Remarks</label>
						<textarea type="text" name="remarks" id="remarks" class="form-control form-control-sm rounded-0"><?php echo isset($remarks) ? $remarks : ''; ?></textarea>
					</div> -->
				</fieldset>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<fieldset>
					
					<div class="form-group">
						<label class="control-label">First Name <small class="text-danger">*</small></label>
						<input type="text" name="name" id="name" class="form-control form-control-sm rounded-0" required>
					</div>

					<div class="form-group">
						<label class="control-label">Middle Name <small class="text-danger">*</small></label>
						<input type="text" name="m_name" id="m_name" class="form-control form-control-sm rounded-0" required>
					</div>

					<div class="form-group">
						<label class="control-label"> Last Name <small class="text-danger">*</small></label>
						<input type="text" name="l_name" id="l_name" class="form-control form-control-sm rounded-0" required>
					</div>

					<div class="form-group">
						<label class="control-label">Gender <small class="text-danger">*</small></label>

						<select name="gender" id="gender" class="form-control form-control-sm rounded-0" required>
							<option value=""></option>
							<option value="Male">Male</option>
							<option value="Female">Female</option>
						</select>
						
					</div>

					<div class="form-group">
						<label class="control-label">Age<small class="text-danger">*</small></label>
						<input type="date" name="age" id="age" class="form-control form-control-sm rounded-0" required>
					</div>

					<div class="form-group">
						<label for="location" class="control-label">Address<small class="text-danger">*</small></label>
						<input type="text" name="address" id="address" class="form-control form-control-sm rounded-0" required>
						<!-- <?php echo isset($location) ? $location : ''; ?> -->
					</div>
					
					<!-- <div class="form-group">
						<label for="teams" class="control-label">Station <small class="text-danger">*</small></label>
						<div class="input-group input-group-sm">
							<select id="teams" class="form-control form-control-sm rounded-0" required>
								<option selected disabled>Loading Selection...</option>
							</select>
							<button class="btn btn-outline-secondary btn-sm rounded-0" type="button" id="reload_team_sel" title="Update Station Selection"><i class="fa fa-sync-alt"></i></button>
							<button class="btn btn-outline-primary btn-sm rounded-0" type="button" id="add_team" title="Add Station to List"><i class="fa fa-plus"></i></button>
						</div>
					</div> -->
					<!-- <table class="table table-stripped table-bordered" id="team-tbl">
						<colgroup>
							<col width="15%">
							<col width="85%">
						</colgroup>
						<thead>
							<tr class="bg-gradient-dark">
								<th class="text-center py-1"></th>
								<th class="text-center py-1">Station</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							if(isset($id)): 
							$qry = $conn->query("SELECT t.id, concat(rt.name, ' ', t.code) as `team` FROM `team_list` t inner join respondent_type_list rt on t.respondent_type = rt.id where t.id in (SELECT `team_id` FROM `report_teams` where report_id = '{$id}') ");
							while($row = $qry->fetch_assoc()):
							?>
							<tr>
								<td class="text-center px-2 py-1"><button class="btn btn-outline-danger rem-team btn-sm rounded-0 py-0" type="button"><i class="fa fa-times"></i></button></td>
								<td class="px-2 py-1">
									<input type="hidden" name="team_id[]" value="<?= $row['id'] ?>">
									<span class="team_name"><?= $row['team'] ?></span>
								</td>
							</tr>
							<?php endwhile; ?>
							<?php endif; ?>
						</tbody>
					</table> -->
				</fieldset>
				<!-- <div class="form-group">
					<label for="status" class="control-label">Status <small class="text-danger">*</small></label>
					<select name="status" id="status" class="form-control form-control-sm rounded-0" required>
						<option value="0" <?php echo isset($status) && $status == 0 ? 'selected' : '' ?>>Responding</option>
						<option value="1" <?php echo isset($status) && $status == 1 ? 'selected' : '' ?>>In Patrol</option>
						<option value="2" <?php echo isset($status) && $status == 2 ? 'selected' : '' ?>>Requested</option>
					</select>
				</div> -->
				
			</div>
		</div>
	</form>
</div>
<noscript id="team-clone">
<tr>
	<td class="text-center px-2 py-1"><button class="btn btn-outline-danger rem-team btn-sm rounded-0 py-0" type="button"><i class="fa fa-times"></i></button></td>
	<td class="px-2 py-1">
		<input type="hidden" name="team_id[]">
		<span class="team_name">Sample</span>
	</td>
</tr>
</noscript>
<script>
	function get_teams(){
		$('#teams').html('<option value="" selected disabled>Loading Selection...</option>')
		if($('#teams').hasClass("select2-hidden-accessible"))
			$('#teams').select2('destroy'); 
		$.ajax({
			url:_base_url_+'classes/Master.php?f=load_team',
			method:'POST',
			data:{id:'<?= isset($id) ? $id : '' ?>'},
			dataType:'json',
			error:err=>{
				console.log(err)
				alert("An error occurred while loading the team selection");
				$('#teams').html('<option value="" selected disabled>No Available Station</option>')
			},
			success:function(resp){
				$('#teams').html('')
				if(Object.keys(resp).length > 0){
					var opt = $("<option>")
					opt.val("").attr('selected',true).attr('disabled', true)
					$('#teams').append(opt)

					Object.keys(resp).map(k=>{
						var data = resp[k]
						var opt = $("<option>")
						opt.val(data.id).text(data.team)
						$('#teams').append(opt)
					})
					$('#teams').select2({
						placeholder:'Please Select Station here',
						containerCssClass:'form-control form-control-sm rounded-0',
						dropdownParent:$('#uni_modal')
					})
				}else{
					$('#teams').html('<option value="" selected disabled>No Available Station</option>')
				}
			}

		})
	}
	$(document).ready(function(){
		$('#uni_modal').on('shown.bs.modal',function(){
			$('.select2').select2({
				placeholder:'Please Select Here',
				dropdownParent:$('#uni_modal'),
				containerCssClas:'form-control form-control-sm rounded-0'
			})
			get_teams()
		})
		$('#reload_team_sel').click(function(){
			get_teams()
		})
		$('#add_team').click(function(){
			var id = $('#teams').val()
			if($('[name="team_id[]"][value="'+id+'"]').length > 0){
				alert("Station already listed.")
				return false;
			}
			var name = $('#teams option[value="'+id+'"]').text()
			var tr = $($('noscript#team-clone').html()).clone()
			tr.find('[name="team_id[]"]').val(id)
			tr.find('.team_name').text(name)
			$('#team-tbl tbody').append(tr)
			tr.find('rem-team').click(function(){
				if(confirm("Are you sure to remove this Station?") == true){
					tr.remove()
				}
			})
			$('#teams').val('').trigger('change')
		})
		$('#team-tbl tbody tr').find('.rem-team').click(function(){
			if(confirm("Are you sure to remove this Station?") == true){
				$(this).closest('tr').remove()
			}
		})
		$('#report-form').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			 $('.err-msg').remove();
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=save_report",
				data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
				error:err=>{
					console.log(err)
					alert_toast("An error occured",'error');
					end_loader();
				},
				success:function(resp){
					if(typeof resp =='object' && resp.status == 'success'){
						location.reload()
					}else if(resp.status == 'failed' && !!resp.msg){
                        var el = $('<div>')
                            el.addClass("alert alert-danger err-msg").text(resp.msg)
                            _this.prepend(el)
                            el.show('slow')
                            $("html, body,.modal").scrollTop(0);
                            end_loader()
                    }else{
						alert_toast("An error occured",'error');
						end_loader();
					}
				}
			})
		})

	})
</script>
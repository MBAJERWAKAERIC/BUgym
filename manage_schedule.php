<?php include 'db_connect.php' ?>
<?php
if(isset($_GET['id'])){
$qry = $conn->query("SELECT * FROM schedules where id= ".$_GET['id']);
foreach($qry->fetch_array() as $k => $val){
	$$k=$val;
}
$dow_arr = !empty($dow) ? explode(',',$dow) : '';
}
?>
<style>
	
	
</style>
<div class="container-fluid">
	<form action="" id="manage-schedule">
		<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
		<div class="col-lg-12">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label for="" class="control-label">Member</label>
						<select name="member_id" id="" class="custom-select select2" required>
							<option value=""></option>
						<?php 
							$members = $conn->query("SELECT *,concat(lastname,', ',firstname,' ',middlename) as name FROM members order by concat(lastname,', ',firstname,' ',middlename) asc");
							while($row= $members->fetch_array()):
						?>
							<option value="<?php echo $row['id'] ?>" <?php echo isset($member_id) && $member_id == $row['id'] ? 'selected' : '' ?>><?php echo ucwords($row['name']) ?></option>
						<?php endwhile; ?>
						</select>
					</div>
					<div class="form-group">
						<label for="" class="control-label">Days of Week</label>
						<select name="dow[]" id="" class="custom-select select2" multiple="multiple">
							<?php 
							$dow = array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
							for($i = 0; $i < 7;$i++):
							?>
							<option value="<?php echo $i ?>" <?php echo !empty($dow_arr) && in_array($i,$dow_arr) ? 'selected' : '' ?>><?php echo $dow[$i] ?></option>
						<?php endfor; ?>
						</select>
					</div>
					<div class="form-group">
						<label for="" class="control-label">Month From</label>
						<input type="month" name="date_from" id="date_from" class="form-control" value="<?php echo isset($date_from) ? date('Y-m',strtotime($date_from)):'' ?>">
					</div>
					<div class="form-group">
						<label for="" class="control-label">Month To</label>
						<input type="month" name="date_to" id="date_to" class="form-control" value="<?php echo isset($date_to) ? date('Y-m',strtotime($date_to)) :'' ?>">
					</div>
					<div class="form-group">
						<label for="" class="control-label">Time From</label>
						<input type="time" name="time_from" id="time_from" class="form-control" value="<?php echo isset($time_from) ? $time_from : '' ?>">
					</div>
					<div class="form-group">
						<label for="" class="control-label">Time To</label>
						<input type="time" name="time_to" id="time_to" class="form-control" value="<?php echo isset($time_to) ? $time_to : '' ?>">
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
<script>
	$('.select2').select2({
		placeholder:'Please Select Here',
		width:'100%'
	})
	$('#manage-schedule').submit(function(e){
		e.preventDefault()
		start_load()
		$('#msg').html('')
		$.ajax({
			url:'ajax.php?action=save_schedule',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully saved",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
				
			}
		})
	})
	
</script>
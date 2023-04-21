<?php include 'db_connect.php' ?>
<?php
if(isset($_GET['id'])){
	$qry = $conn->query("SELECT * FROM members where id=".$_GET['id'])->fetch_array();
	foreach($qry as $k =>$v){
		$$k = $v;
	}
}

?>
<div class="container-fluid">
	<form action="" id="manage-member">
		<div id="msg"></div>
			<div class="form-group">
				<label class="control-label">Member</label>
				<select name="member_id" required="required" class="custom-select select2" id="">
					<option value=""></option>
					<?php
						$qry = $conn->query("SELECT *,concat(lastname,', ',firstname,' ',middlename) as name FROM members where id not in (SELECT member_id from registration_info where status = 1) order by concat(lastname,', ',firstname,' ',middlename) asc");
						while($row= $qry->fetch_assoc()):
					?>
					<option value="<?php echo $row['id'] ?>" <?php echo isset($member_id) && $member_id == $row['id'] ? 'selected' : '' ?>><?php echo ucwords($row['name']) ?></option>
					<?php endwhile; ?>
				</select>
			</div>
			<div class="form-group">
				<label class="control-label">Plan</label>
				<select name="plan_id" required="required" class="custom-select select2" id="">
					<option value=""></option>
					<?php
						$qry = $conn->query("SELECT * FROM plans order by plan asc");
						while($row= $qry->fetch_assoc()):
					?>
					<option value="<?php echo $row['id'] ?>" <?php echo isset($plan_id) && $plan_id == $row['id'] ? 'selected' : '' ?>><?php echo ucwords($row['plan']) ?></option>
					<?php endwhile; ?>
				</select>
			</div>
			<div class="form-group">
				<label class="control-label">Package</label>
				<select name="package_id" required="required" class="custom-select select2" id="">
					<option value=""></option>
					<?php
						$qry = $conn->query("SELECT * FROM packages order by package asc");
						while($row= $qry->fetch_assoc()):
					?>
					<option value="<?php echo $row['id'] ?>" <?php echo isset($package_id) && $package_id == $row['id'] ? 'selected' : '' ?>><?php echo ucwords($row['package']) ?></option>
					<?php endwhile; ?>
				</select>
			</div>
			<div class="form-group">
				<label class="control-label">Trainer</label>
				<select name="trainer_id" class="custom-select select2" id="">
					<option value=""></option>
					<?php
						$qry = $conn->query("SELECT * FROM trainers order by name asc");
						while($row= $qry->fetch_assoc()):
					?>
					<option value="<?php echo $row['id'] ?>" <?php echo isset($trainer_id) && $trainer_id == $row['id'] ? 'selected' : '' ?>><?php echo ucwords($row['name']) ?></option>
					<?php endwhile; ?>
				</select>
			</div>
	</form>
</div>

<script>
	$('.select2').select2({
		placeholder:'Select Here',
		width:'100%'
	})
	$('#manage-member').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_membership',
			method:'POST',
			data:$(this).serialize(),
			success:function(resp){
				if(resp ==1){
					alert_toast("Data successfully saved.",'success')
					setTimeout(function(){
						location.reload()
					},1000)
				}
			}
		})
	})
</script>
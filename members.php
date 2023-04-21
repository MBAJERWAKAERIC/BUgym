<?php include('db_connect.php');?>

<div class="container-fluid">
<style>
	input[type=checkbox]
{
  /* Double-sized Checkboxes */
  -ms-transform: scale(1.5); /* IE */
  -moz-transform: scale(1.5); /* FF */
  -webkit-transform: scale(1.5); /* Safari and Chrome */
  -o-transform: scale(1.5); /* Opera */
  transform: scale(1.5);
  padding: 10px;
}
</style>
	<div class="col-lg-12">
		<div class="row mb-4 mt-4">
			<div class="col-md-12">
				
			</div>
		</div>
		<div class="row">
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<b>Member List</b>
						<span class="">

							<button class="btn btn-primary btn-block btn-sm col-sm-2 float-right" type="button" id="new_member">
					<i class="fa fa-plus"></i> New</button>
				</span>
					</div>
					<div class="card-body">
						
						<table class="table table-bordered table-condensed table-hover">
							<colgroup>
								<col width="5%">
								<col width="15%">
								<col width="20%">
								<col width="20%">
								<col width="20%">
								<col width="20%">
							</colgroup>
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="">Member ID</th>
									<th class="">Name</th>
									<th class="">Email</th>
									<th class="">Contact</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$i = 1;
								$member =  $conn->query("SELECT *,concat(lastname,', ',firstname,' ',middlename) as name from members order by concat(lastname,', ',firstname,' ',middlename) asc");
								while($row=$member->fetch_assoc()):
								?>
								<tr>
									
									<td class="text-center"><?php echo $i++ ?></td>
									<td class="">
										 <p><b><?php echo $row['member_id'] ?></b></p>
										 
									</td>
									<td class="">
										 <p><b><?php echo ucwords($row['name']) ?></b></p>
										 
									</td>
									<td class="">
										 <p><b><?php echo $row['email'] ?></b></p>
									</td>
									<td class="">
										 <p><b><?php echo $row['contact'] ?></b></p>
										 
									</td>
									<td class="text-center">
										<button class="btn btn-sm btn-outline-primary view_member" type="button" data-id="<?php echo $row['id'] ?>" >View</button>
										<button class="btn btn-sm btn-outline-primary edit_member" type="button" data-id="<?php echo $row['id'] ?>" >Edit</button>
										<button class="btn btn-sm btn-outline-danger delete_member" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
									</td>
								</tr>
								<?php endwhile; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- Table Panel -->
		</div>
	</div>	

</div>
<style>
	
	td{
		vertical-align: middle !important;
	}
	td p{
		margin: unset
	}
	img{
		max-width:100px;
		max-height: :150px;
	}
</style>
<script>
	$(document).ready(function(){
		$('table').dataTable()
	})
	$('#new_member').click(function(){
		uni_modal("<i class='fa fa-plus'></i> New Member","manage_member.php",'mid-large')
	})
	$('.view_member').click(function(){
		uni_modal("<i class='fa fa-id-card'></i> Member Details","view_member.php?id="+$(this).attr('data-id'),'large')
		
	})
	$('.edit_member').click(function(){
		uni_modal("<i class='fa fa-edit'></i> Manage Member Details","manage_member.php?id="+$(this).attr('data-id'),'mid-large')
		
	})
	$('.delete_member').click(function(){
		_conf("Are you sure to delete this topic?","delete_member",[$(this).attr('data-id')],'mid-large')
	})

	function delete_member($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_member',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script>
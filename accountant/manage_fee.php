<?php include '../config.php' ?>
<?php
if(isset($_GET['id'])){
	$qry = $conn->query("SELECT * FROM student_ef_list where id = {$_GET['id']} ");
	foreach($qry->fetch_array() as $k => $v){
		$$k = $v;
	}
}
?>
<div class="container-fluid">
	<form id="manage-fees">
		<div id="msg"></div>
		<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
		<div class="form-group">
		<label for="" class="control-label">month and year</label>
        <input type="month" id="month" name="month" class="form-control">
        </div>
		 <div class="form-group">
            <label for="" class="control-label">Enrollment No./ E.F. No.</label>
            <input type="text" class="form-control" name="ef_no"  value="<?php echo isset($ef_no) ? $ef_no :'' ?>" required>
        </div>
		<div class="form-group">
			<label for="" class="control-label">Student</label>
			<select name="student_id" id="student_id" class="custom-select input-sm select2">
				<option value=""></option>
				<?php
					$student = $conn->query("SELECT * FROM students order by name asc ");
					while($row= $student->fetch_assoc()):
				?>
				<option value="<?php echo $row['student_id'] ?>" <?php echo isset($student_id) && $student_id == $row['student_id'] ? 'selected' : '' ?>><?php echo ucwords($row['name']).' | '. $row['student_id'] ?></option>
				<?php endwhile; ?>
			</select>
		</div>
		<div class="form-group">
			<label for="" class="control-label">Standard</label>
			<select name="course_id" id="course_id" class="custom-select input-sm select2">
				<option value=""></option>
				<?php
					$student = $conn->query("SELECT *,standard as class FROM classes order by standard asc ");
					while($row= $student->fetch_assoc()):
				?>
				<option value="<?php echo $row['class_id'] ?>" data-amount = "<?php echo $row['total_amount'] ?>" <?php echo isset($course_id) && $course_id == $row['class_id'] ? 'selected' : '' ?>><?php echo $row['class'] ?></option>
				<?php endwhile; ?>
			</select>
		</div>
		 <div class="form-group">
            <label for="" class="control-label">Fee</label>
            <input type="text" class="form-control text-right" name="total_fee"  option value="<?php echo isset($total_fee) ? number_format($total) :'' ?>" required readonly>
        </div>
	</form>
</div>
<script>
	$('.select2').select2({
		placeholder:'Please select here',
		width:'100%'
	})
	$('#course_id').change(function(){
		var amount= $('#course_id option[value="'+$(this).val()+'"]').attr('data-amount')
		$('[name="total_fee"]').val(parseFloat(amount).toLocaleString('en-US',{style:'decimal',maximumFractionDigits:2,minimumFractionDigits:2}))
	})
	$('#manage-fees').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_fees',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)
				end_load()
			},
			success:function(resp){
					location.reload();
					alert_toast("Data successfully saved.",'success')
						setTimeout(function(){
							location.reload()
						},1000)
			}
		})
	})
</script>

<div class="box">
	<?php if(isset($csv)): ?>
		<div class="box-header with-border">
			<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
					title="Collapse">
				<i class="fa fa-minus"></i></button>
			<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
				<i class="fa fa-times"></i></button>
			</div>
		</div>
		<div class="box-body">

			<table class="table table-hover">
				<thead>
					<th>Name</th>
					<th>Email</th>
					<th>Subject</th>
					<th>Body</th>
					<th>Sending Status</th>
					<th>Sending Schedule</th>
				</thead>
				<tbody>
				<?php if(count($csv)>0): foreach($csv as $row):?>
					<?php
						if(date('Y-m-d H:i:s', strtotime($row['send_on'])) > date('Y-m-d H:i:s', strtotime('+5 minutes'))) $file_status	=	'<span><a class="badge bg-blue" href="'.HTTP_PATH.'Home/send/'.$row['id'].'/?redirect=1">Pending Schedule</a></span>';
						elseif(date('Y-m-d H:i:s', strtotime($row['send_on'])) < date('Y-m-d H:i:s', strtotime('+5 minutes')) && date('Y-m-d H:i:s', strtotime($row['send_on'])) > date('Y-m-d H:i:s', strtotime('-5 minutes'))) $file_status	=	'<span class="badge bg-gray">Sending...</span>';
						else $file_status	=	'<a class="badge bg-red" href="'.HTTP_PATH.'Home/send/'.$row['id'].'/?redirect=1">Sending Failed</a>';
						if($row['is_sent']==1) {
							$file_status	=	'<span class="badge bg-green">Sending complete</span>';
						}
					?>
					<tr>
						<td><?php echo $row['full_name']; ?></td>
						<td><?php echo $row['recipient']; ?></td>
						<td><?php echo $row['subject']; ?></td>
						<td><?php echo $row['body']; ?></td>
						<td><?php echo $file_status; ?></td>
						<td><?php echo date('h:i a j F Y', strtotime($row['send_on'])); ?></td>
					</tr>
				<?php endforeach; endif; ?>
				</tbody>
			</table>
		</div>
		<div class="box-footer">
			<p>References uploaded: <?php echo $uploaded; ?></p>
		</div>
	<?php endif; ?>
</div>

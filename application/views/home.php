<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//print_r($data);exit;
?>
<div class="">
	<h1 style="font-size:20pt">Family Tree Home</h1>
	<?php if($this->session->flashdata('message')): ?>
	<div class="alert alert-info">
		<?php echo $this->session->flashdata('message');?>
	</div>
	<?php endif;?>
	<div class="clearfix well">
		<a class="btn btn-info pull-right" href="<?php echo site_url('home/create'); ?>">Add New Record</a>
	</div>
    <?php if(is_array($data) && count($data) > 0){ ?>
	<table class="table table-bordered table-hover" cellspacing="0" width="100%" id="employee">
		<thead>
			<tr>
				<th>Name</th>
				<th>Place Of Stay</th>
				<th>Contact No</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		<?php $i=1; foreach($data as $rec): ?>
        <tr>
            <td><?php echo $rec->name; ?></td>
            <td><?php echo $rec->place_of_stay; ?></td>
			<td><?php echo $rec->contact_no; ?></td>
			<td>
				<div class="hidden-sm hidden-xs btn-group">
					<a class="btn btn-xs btn-success" href="<?php echo site_url('home/profile/'.$rec->id); ?>">
						<i class="ace-icon fa fa-eye bigger-120"></i>
					</a>

					<a class="btn btn-xs btn-info" href="<?php echo site_url('home/edit/'.$rec->id); ?>">
						<i class="ace-icon fa fa-pencil bigger-120"></i>
					</a>

					<a class="btn btn-xs btn-danger" href="<?php echo site_url('home/delete/'.$rec->id); ?>">
						<i class="ace-icon fa fa-trash-o bigger-120"></i>
					</a>
				</div>
            </td>
        </tr>
		<?php endforeach; ?>
		</tbody>
	</table>
    <?php } ?>
	<div><?php echo $links; ?></div>
</div>

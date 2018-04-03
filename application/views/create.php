<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php echo validation_errors(); ?>
 
<?php echo form_open_multipart('home/create/', "class='form-horizontal'"); ?>
	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right" for="form-field-1">  Name </label>

		<div class="col-sm-9">
<input type="text" id="form-field-1" placeholder="Name" name="name" class="col-xs-10 col-sm-5" value="<?php echo set_value('name'); ?>">
		</div>
	</div>

    <div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">  Parent Name </label>

    <div class="col-sm-9">
        <select name="parent_id" value="<?php echo set_value('parent_id'); ?>">
            <option value="">Select Parent</option>
            <?php
            foreach($sele_val as $row)
            {
                echo '<option value="'.$row->id.'">'.$row->name.'</option>';
            }
            ?>
        </select>
    </div>
    </div>

	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Place Of Stay </label>

		<div class="col-sm-9">
			<input type="text" id="form-field-2" placeholder="Place Of Stay" class="col-xs-10 col-sm-5" name="place_of_stay" value="<?php echo set_value('place_of_stay'); ?>">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right" for="form-field-3"> Contact No </label>

		<div class="col-sm-9">
			<input type="number" id="form-field-3" placeholder="Contact No" class="col-xs-10 col-sm-5" max-length="10" name="contact_no" value="<?php echo set_value('contact_no'); ?>">
		</div>
	</div>
    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="form-field-3"> DOB </label>

        <div class="col-sm-9">
            <input type="date" id="form-field-4" placeholder="DOB" class="col-xs-10 col-sm-5 form_datetime" name="date_of_birth" value="<?php echo set_value('dob'); ?>">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Email </label>

        <div class="col-sm-9">
            <input type="text" id="form-field-5" placeholder="Email" class="col-xs-10 col-sm-5" name="email" value="<?php echo set_value('email'); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Alternate Mobile Number </label>

        <div class="col-sm-9">
            <input type="number" id="form-field-6" placeholder="Alternate mobile No" class="col-xs-10 col-sm-5" max-length="10" name="alt_contact_no" value="<?php echo set_value('alt_contact_no'); ?>">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Spouse Detail </label>

        <div class="col-sm-9">
            <textarea name='spouse_details' id="form-field-6" class="col-xs-10 col-sm-5"><?php echo set_value('spouse_details'); ?></textarea>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Gender </label>
        <div class="col-sm-9">
            <input type="radio" name="gender" value="male" <?php
            echo set_value('gender') == "male" ? "checked" : "";
            ?> /> Male
            <input type="radio" name="gender" value="female" <?php
            echo set_value('gender') == "female" ? "checked" : "";
            ?>/> Female
            <input type="radio" name="gender" value="other" <?php
            echo set_value('gender') == "other" ? "checked" : "";
            ?>/> Other
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Alive Status </label>

        <div class="col-sm-9">
            <input type="radio" name="alive_status" value=1 <?php
            echo set_value('alive_status') == 1 ? "checked" : "";
            ?>/> Alive
            <input type="radio" name="alive_status" value=0  <?php
            echo set_value('alive_status') == 0 ? "checked" : "";
            ?>/> Died
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="form-field-3">Profile Image </label>

        <div class="col-sm-9">
            <input type = "file" name = "profile_image_localtion" size = "20" />
        </div>

    </div>
	<div class="space-4"></div>
	<div class="clearfix form-actions">
		<div class="col-md-offset-3 col-md-9">
			<button class="btn btn-info" type="submit">
				<i class="ace-icon fa fa-check bigger-110"></i>
				Submit
			</button>

			&nbsp; &nbsp; &nbsp;
			<button class="btn" type="reset">
				<i class="ace-icon fa fa-undo bigger-110"></i>
				Reset
			</button>
		</div>
	</div>
</form>

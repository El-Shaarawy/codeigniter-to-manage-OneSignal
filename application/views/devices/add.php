<h1><?php echo "Create Doctor";?></h1>
<p><?php if($isEnglish=="1"){echo "Please enter the Doctor information below in English.";}else{echo "Please enter the Doctor information below in Arabic.";}?></p>
<div id="infoMessage"><?php echo $message;?></div>

<?php if($isEnglish=="1"){echo form_open("Doctors/add");}else{echo form_open("Doctors/add/0");}?>

<p>
  <?php echo lang('create_user_fname_label', 'first_name');?> <br />
  <?php echo form_input($first_name);?>
</p>

<p>
  <?php echo lang('create_user_lname_label', 'last_name');?> <br />
  <?php echo form_input($last_name);?>
</p>
<p>
  Speciality: <br>
  <select class="ui-select span4" id="spec_id" name="spec_id">

    <?php
    foreach ($specs as $spec) { ?>
      <option value="<?=$spec->id;?>"><?=$spec->specialization;?></option>

    <?php } ?>
  </select>
</p>

<p>
  Clinic: <br>
  <select class="ui-select span4" id="clinic_id" name="clinic_id">
    <option value="null"> No Clinic</option>
    <?php
    foreach ($clinics as $clinic) { ?>
      <option value="<?=$clinic->id;?>"><?=$clinic->name;?></option>

    <?php } ?>
  </select>
</p>
<p>
Hospital: <br>
  <select class="ui-select span4" id="hosp_id" name="hosp_id">
    <option value="null">No Hospital</option>
    <?php
    foreach ($hosps as $hosp) { ?>
      <option value="<?=$hosp->id;?>"><?=$hosp->name;?></option>

    <?php } ?>
  </select>
</p>

<p>
  <?php echo lang('create_user_country_label', 'country');?> <br />
  <?php echo form_input($country);?>
</p>
<p>
City: <br>
  <select class="ui-select span4" id="city" name="city">
    <?php
    foreach ($cities as $city) { ?>
      <option value="<?=$city->name;?>"><?=$city->name;?></option>

    <?php } ?>
  </select>
</p>
<p>
  <?php echo lang('create_user_address_label', 'address');?> <br />
  <?php echo form_input($address);?>
</p>

<p>
  <?php echo lang('create_user_clinic_hours_label', 'clinic hours');?> <br />
  <?php echo form_input($clinic_hours);?>
</p>

<p>
  <?php echo lang('create_user_clinic_number_label', 'clinic number');?> <br />
  <?php echo form_input($clinic_number);?>
</p>

<p>
  <?php echo lang('create_user_phone_label', 'personal number');?> <br />
  <?php echo form_input($personal_number);?>
</p>

<p>
  <?php echo lang('create_user_latitude_label', 'Latitude');?> <br />
  <?php echo form_input($latitude);?>
</p>

<p>
  <?php echo lang('create_user_longitude_label', 'Longitude');?> <br />
  <?php echo form_input($longitude);?>
</p>


<p><?php echo form_submit('submit', lang('create_doctor_submit_btn'));?></p>

<?php echo form_close();?>

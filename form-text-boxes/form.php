<?php
	//Defaults for the arm when the page first loads
	$default_x = 0; //offset of 512 will be added
	$default_y = 100;
	$default_z = 150;
	$default_wrist_angle = 0; //offset of 90 will be added
	$default_gripper = 512;
	$default_delta = 125;
?>
<!doctype html>
<html xml:lang="en-gb" lang="en-gb" >
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css" integrity="sha384-aUGj/X2zp5rLCbBxumKTCw2Z50WgIr1vs/PFN4praOTvYXWlVyh2UtNUU0KAUhAX" crossorigin="anonymous">

		<!-- Additional Styles -->
		<link rel="stylesheet" href="assets/main.css">

		<!-- Ajax to Control the Arm and JavaScript to Update Current Values -->
		<script src="assets/main.js"></script>

	</head>
	<body onload="ajaxMoveArm();">
		<div class="container-fluid">
			<h1>Use AJAX to Control Robot Arm</h1>

			<p>Enter parameter values in the boxes below.  You must update at least one value to make the arm move.  When you update a value in a text box and then click or tab outside the box, the arm will move.  If you enter the same value that was already there, or an invalid value for that parameter, the arm will not move.  If you enter a value outside of the upper or lower limits, the closest limit will be used for the value by default.</p>

			<p>The arm requires a few seconds in between changes.  Check the response box below for notification that the arm is ready to receive your next command, and wait a second before tabbing to the next field.</p>

			<p>Note: All fields use interpreted values below (certain parameters must be offset to a positive range before transmission), so negative values are accepted.  Please refer to <a href="http://learn.robotgeek.com/2-uncategorised/153-arm-control.html#limits" target="_blank">RobotGeek's documentation</a> for more information about offsets.</p>

			<form name="controlArm">
				<div class="form-group padding-bottom">
					<label for="x_axis">X-Axis:</label>
					<input class="form-control" type="text" onChange="ajaxMoveArm('X-Axis', this.value);" name="x_axis" id="x_axis" value="<?php echo $default_x; ?>" />
					<div class="pull-left small-text">Lower Limit: -150</div>
					<div class="pull-right small-text">Upper Limit: 150</div>
				</div>
				<div class="form-group padding-bottom">
					<label for="y_axis">Y-Axis:</label>
					<input class="form-control" type="text" onChange="ajaxMoveArm('Y-Axis', this.value);" name="y_axis" id="y_axis" value="<?php echo $default_y; ?>" />
					<div class="pull-left small-text">Lower Limit: 50</div>
					<div class="pull-right small-text">Upper Limit: 150</div>
				</div>
				<div class="form-group padding-bottom">
					<label for="z_axis">Z-Axis:</label>
					<input class="form-control" type="text" onChange="ajaxMoveArm('Z-Axis', this.value);" name="z_axis" id="z_axis" value="<?php echo $default_z; ?>" />
					<div class="pull-left small-text">Lower Limit: 20</div>
					<div class="pull-right small-text">Upper Limit: 250</div>
				</div>
				<div class="form-group padding-bottom">
					<label for="wrist_angle">Wrist Angle:</label>
					<input class="form-control" type="text" onChange="ajaxMoveArm('Wrist_Angle', this.value);" name="wrist_angle" id="wrist_angle" value="<?php echo $default_wrist_angle; ?>" />
					<div class="pull-left small-text">Lower Limit: -45</div>
					<div class="pull-right small-text">Upper Limit: 45</div>
				</div>
				<div class="form-group padding-bottom">
					<label for="gripper">Gripper:</label>
					<input class="form-control" type="text" onChange="ajaxMoveArm('Gripper', this.value);" name="gripper" id="gripper" value="<?php echo $default_gripper; ?>" />
					<div class="pull-left small-text">Lower Limit: 0</div>
					<div class="pull-right small-text">Upper Limit: 512</div>
				</div>
				<div class="form-group padding-bottom">
					<label for="delta">Delta:</label>
					<input class="form-control" type="text" onChange="ajaxMoveArm('Delta', this.value);" name="delta" id="delta" value="<?php echo $default_delta; ?>" />
					<div class="pull-left small-text">Lower Limit: 0</div>
					<div class="pull-right small-text">Upper Limit: 255</div>
				</div>
				<div class="form-group padding-bottom">
					<label for="armResponse">Arm Response:</label>
					<br />
					<textarea class="form-control" rows="4" name="armResponse" readonly>Page is loading, please wait for this message to update before altering values...</textarea>
				</div>
			</form>
		</div>
	</body>
</html>


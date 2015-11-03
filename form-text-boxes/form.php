<!doctype html>
<html xml:lang="en-gb" lang="en-gb" >
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css" integrity="sha384-aUGj/X2zp5rLCbBxumKTCw2Z50WgIr1vs/PFN4praOTvYXWlVyh2UtNUU0KAUhAX" crossorigin="anonymous">

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
		<script>
		function ajaxMoveArm(field_changed, new_value){
			var ajaxRequest;
			
			try{
				// Opera 8.0+, Firefox, Safari
				ajaxRequest = new XMLHttpRequest();
			} catch (e){
				// Internet Explorer Browsers
				try{
					ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try{
						ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e){
						// Something went wrong
						alert("Could not set AJAX variable.");
						return false;
					}
				}
			}

			//Other vars
			var x_axis = document.getElementById('x_axis').value;
			var y_axis = document.getElementById('y_axis').value;
			var z_axis = document.getElementById('z_axis').value;
			var wrist_angle = document.getElementById('wrist_angle').value;
			var gripper = document.getElementById('gripper').value;
			var delta = document.getElementById('delta').value;

			//get the value that was just updated
			var changed = field_changed;
			var changed_value = new_value;

			// Create a function that will receive data sent from the server
			ajaxRequest.onreadystatechange = function(){
				if(ajaxRequest.readyState == 4){
					document.controlArm.armResponse.value = ajaxRequest.responseText;
				}
			}
			ajaxRequest.open("GET", "form_results.php?x_axis=" + x_axis + "&y_axis=" + y_axis + "&z_axis=" + z_axis + "&wrist_angle=" + wrist_angle + "&gripper=" + gripper + "&delta=" + delta + "&changed=" + changed + "&changed_value=" + changed_value, true);
			ajaxRequest.send(null); 
		}
		</script>
	</head>
	<body>
		<div class="container-fluid">
			<h1>Use AJAX to Control Robot Arm</h1>

			<p>Enter parameter values in the boxes below.  You must update at least one value to make the arm move.  When you update a value in a text box and then click or tab outside the box, the arm will move.  If you enter the same value that was already there, or an invalid value for that parameter, the arm will not move.</p>

			<p>The arm requires a few seconds in between changes.  Check the response box below for notification that the arm is ready to receive your next command, and wait a second before tabbing to the next field.</p>

			<p>Note: These fields do not currently have limits defined.  Please refer to <a href="http://learn.robotgeek.com/2-uncategorised/153-arm-control.html#limits" target="_blank">RobotGeek's documentation</a> for more information about what values are supported by each parameter.</p>

			<form name="controlArm">
				<div class="form-group">
					<label for="x_axis">X-Axis:</label>
					<input class="form-control" type="text" onChange="ajaxMoveArm('X-Axis', this.value);" name="x_axis" id="x_axis" value="512" />
				</div>
				<div class="form-group">
					<label for="y_axis">Y-Axis:</label>
					<input class="form-control" type="text" onChange="ajaxMoveArm('Y-Axis', this.value);" name="y_axis" id="y_axis" value="100" />
				</div>
				<div class="form-group">
					<label for="z_axis">Z-Axis:</label>
					<input class="form-control" type="text" onChange="ajaxMoveArm('Z-Axis', this.value);" name="z_axis" id="z_axis" value="150" />
				</div>
				<div class="form-group">
					<label for="wrist_angle">Wrist Angle:</label>
					<input class="form-control" type="text" onChange="ajaxMoveArm('Wrist_Angle', this.value);" name="wrist_angle" id="wrist_angle" value="45" />
				</div>
				<div class="form-group">
					<label for="gripper">Gripper:</label>
					<input class="form-control" type="text" onChange="ajaxMoveArm('Gripper', this.value);" name="gripper" id="gripper" value="0" />
				</div>
				<div class="form-group">
					<label for="delta">Delta:</label>
					<input class="form-control" type="text" onChange="ajaxMoveArm('Delta', this.value);" name="delta" id="delta" value="16" />
				</div>
				<div class="form-group">
					<label for="armResponse">Arm Response:</label>
					<br />
					<textarea class="form-control" rows="4" name="armResponse" readonly>Ready to receive next command.</textarea>
				</div>
			</form>
		</div>
	</body>
</html>


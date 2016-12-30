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

  //Verify that the value is within its limits
  var upperLimit = '';
  var lowerLimit = '';
  var extraResponseText = '';
  var field_name = '';

  switch(changed) {
    case "X-Axis":
      upperLimit = 150;
      lowerLimit = -150;
      field_name = 'x_axis';
      break;
    case "Y-Axis":
      upperLimit = 150;
      lowerLimit = 50;
      field_name = 'y_axis';
      break;
    case "Z-Axis":
      upperLimit = 250;
      lowerLimit = 20;
      field_name = 'z_axis';
      break;
    case "Wrist_Angle":
      upperLimit = 45;
      lowerLimit = -45;
      field_name = 'wrist_angle';
      break;
    case "Gripper":
      upperLimit = 512;
      lowerLimit = 0;
      field_name = 'gripper';
      break;
    case "Delta":
      upperLimit = 255;
      lowerLimit = 0;
      field_name = 'delta';
      break;
  }

  if(changed_value > upperLimit) {
    changed_value = upperLimit;
    extraResponseText = "Warning: The value entered was greater than the upper limit.  The upper limit of " + upperLimit + " has been used by default."; 
    document.getElementById(field_name).value = changed_value;
  } else if(changed_value < lowerLimit) {
    changed_value = lowerLimit;
    extraResponseText = "Warning: The value entered was lower than the lower limit.  The lower limit of " + lowerLimit + " has been used by default."; 
    document.getElementById(field_name).value = changed_value;
  }

  // Create a function that will receive data sent from the server
  ajaxRequest.onreadystatechange = function(){
    if(ajaxRequest.readyState == 4){
      document.controlArm.armResponse.value = extraResponseText + " " + ajaxRequest.responseText;
    }
  }
  ajaxRequest.open("GET", "form_results.php?x_axis=" + x_axis + "&y_axis=" + y_axis + "&z_axis=" + z_axis + "&wrist_angle=" + wrist_angle + "&gripper=" + gripper + "&delta=" + delta + "&changed=" + changed + "&changed_value=" + changed_value, true);
  ajaxRequest.send(null);

}

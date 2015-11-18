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

  //Update current values for range sliders
  document.getElementById("x_axis_current").innerHTML = (x_axis - 512);
  document.getElementById("y_axis_current").innerHTML = y_axis;
  document.getElementById("z_axis_current").innerHTML = z_axis;
  document.getElementById("wrist_angle_current").innerHTML = (wrist_angle - 45);
  document.getElementById("gripper_current").innerHTML = gripper;
  document.getElementById("delta_current").innerHTML = delta;

}

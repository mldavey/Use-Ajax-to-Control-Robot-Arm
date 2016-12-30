Use AJAX to Control Robot Arm
=============

This is an example sweep in controlling robot arms with an AJAX form.

The serial class is a modified version of the PHP Serial class by Xowap (https://github.com/Xowap/PHP-Serial).

Kyle Granat from Trossen Robotics (https://github.com/kgranat) wrote the original arm.php code.  The form.php code in each folder and AJAX to handle results were written by Maureen Davey (http://www.maureenldavey.com).

Please refer to RobotGeek's documentation (http://learn.robotgeek.com/2-uncategorised/153-arm-control.html#limits) for more info on valid parameters for the snapper arm and offsets.


File Structure
====
* form-sliders/form.php - Control the arm by dragging HTML5 sliders.  The file form.php calls to form_results.php via AJAX to move the arm.  You only need to load form.php in your web browser.  
  * Utilizes Bootstrap for layout
  * Mobile-friendly (except Opera Mini, which may not support HTML5 range inputs)
* form-text-boxes/form.php - Control the arm by updating the default values in an AJAX form.  The file form.php calls to form_results.php via AJAX to move the arm.  You only need to load form.php in your web browser.
  * Utilizes Bootstrap for layout
  * Mobile-friendly
* arm.php - Control the arm by hardcoding values in PHP and loading this file in a web browser.  You must update the file and reload in your web browser to move the arm.

To Dos
====
* Adjust both form-text-boxes version and sliders version to read default parameters from a separate XML file instead of hardcoding via PHP.
* Look at simplifying the code for handling the limits in form-text-boxes, potentially options where the limits and field names don't have to be hardcoded into the results file.
* Explore other possibilities for transmitting the values to the arm beyond AJAX.
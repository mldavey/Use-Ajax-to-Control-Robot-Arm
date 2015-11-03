Use AJAX to Control Robot Arm
=============

This will be an example sweep in controlling robot arms with an AJAX form.

The serial class is a modified version of the PHP Serial class by Xowap (https://github.com/Xowap/PHP-Serial).

Kyle Granat from Trossen Robotics (https://github.com/kgranat) wrote the original arm.php code.  All other files besides arm.php and php_serial.class.php were written by Maureen Davey (http://www.maureenldavey.com).


File Structure
====
* arm.php - Control the arm by hardcoding values in PHP and loading this file in a web browser.  You must update the file and reload in your web browser to move the arm.
* form-text-boxes/form.php - Control the arm by updating the default values in an AJAX form.  The file form.php calls to form_results.php via AJAX to move the arm.  You only need to load form.php in your web browser.


To Dos
====
* Add limits to the text boxes in the form-text-boxes version.
* Add a new version where the text boxes are updated to become sliders with the appropriate limit for each field defined.  The user will be able to change the values by dragging the sliders, and the form will use AJAX and PHP to send the command to the arm itself.  It may be helpful to keep the ability to enter values into the text boxes in case it's hard to be precise with the sliders, but sliders will help visualize the limits and parameters used by the arm.
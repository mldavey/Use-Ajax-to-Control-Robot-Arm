<?php
// 	 /$$                                 /$$                    
// 	| $$                                | $$                    
// 	| $$$$$$$   /$$$$$$   /$$$$$$   /$$$$$$$  /$$$$$$   /$$$$$$ 
// 	| $$__  $$ /$$__  $$ |____  $$ /$$__  $$ /$$__  $$ /$$__  $$
// 	| $$  \ $$| $$$$$$$$  /$$$$$$$| $$  | $$| $$$$$$$$| $$  \__/
// 	| $$  | $$| $$_____/ /$$__  $$| $$  | $$| $$_____/| $$      
// 	| $$  | $$|  $$$$$$$|  $$$$$$$|  $$$$$$$|  $$$$$$$| $$      
// 	|__/  |__/ \_______/ \_______/ \_______/ \_______/|__/      
// 	                                                            
// 	                                                            
// 	                                                            
error_reporting(E_ALL);
ini_set('display_errors', '1');


// 	 /$$                     /$$                 /$$                    
// 	|__/                    | $$                | $$                    
// 	 /$$ /$$$$$$$   /$$$$$$$| $$ /$$   /$$  /$$$$$$$  /$$$$$$   /$$$$$$$
// 	| $$| $$__  $$ /$$_____/| $$| $$  | $$ /$$__  $$ /$$__  $$ /$$_____/
// 	| $$| $$  \ $$| $$      | $$| $$  | $$| $$  | $$| $$$$$$$$|  $$$$$$ 
// 	| $$| $$  | $$| $$      | $$| $$  | $$| $$  | $$| $$_____/ \____  $$
// 	| $$| $$  | $$|  $$$$$$$| $$|  $$$$$$/|  $$$$$$$|  $$$$$$$ /$$$$$$$/
// 	|__/|__/  |__/ \_______/|__/ \______/  \_______/ \_______/|_______/ 
// 	                                                                    
// 	                                                                    
// 	                                                                    
include "../php_serial.class.php";



// 	  /$$$$$$                      /$$           /$$        /$$$$$$              /$$                        
// 	 /$$__  $$                    |__/          | $$       /$$__  $$            | $$                        
// 	| $$  \__/  /$$$$$$   /$$$$$$  /$$  /$$$$$$ | $$      | $$  \__/  /$$$$$$  /$$$$$$   /$$   /$$  /$$$$$$ 
// 	|  $$$$$$  /$$__  $$ /$$__  $$| $$ |____  $$| $$      |  $$$$$$  /$$__  $$|_  $$_/  | $$  | $$ /$$__  $$
// 	 \____  $$| $$$$$$$$| $$  \__/| $$  /$$$$$$$| $$       \____  $$| $$$$$$$$  | $$    | $$  | $$| $$  \ $$
// 	 /$$  \ $$| $$_____/| $$      | $$ /$$__  $$| $$       /$$  \ $$| $$_____/  | $$ /$$| $$  | $$| $$  | $$
// 	|  $$$$$$/|  $$$$$$$| $$      | $$|  $$$$$$$| $$      |  $$$$$$/|  $$$$$$$  |  $$$$/|  $$$$$$/| $$$$$$$/
// 	 \______/  \_______/|__/      |__/ \_______/|__/       \______/  \_______/   \___/   \______/ | $$____/ 
// 	                                                                                              | $$      
// 	                                                                                              | $$      
// 	                                                                                              |__/      
$serial = new phpSerial;				//create a serial object
$serial->deviceSet("/dev/ttyUSB0");		//On linux, serial ports are in /dev . The first virtual serial port from FTDI automatically is ttyUSB0 TODO: autp search / check that arm is present using return packet
$serial->confBaudRate(38400);			//set the baud rate in bits per second to communicate to the arm at
$serial->confParity("none");			//no parity
$serial->confCharacterLength(8);		//defualt byte length
$serial->confStopBits(1);				//no stop bits
$serial->deviceOpen();					//open port.


//$serial->sendMessage("Hello from my PHP script, say hi back!");



// 	 /$$    /$$                    /$$           /$$       /$$                    
// 	| $$   | $$                   |__/          | $$      | $$                    
// 	| $$   | $$ /$$$$$$   /$$$$$$  /$$  /$$$$$$ | $$$$$$$ | $$  /$$$$$$   /$$$$$$$
// 	|  $$ / $$/|____  $$ /$$__  $$| $$ |____  $$| $$__  $$| $$ /$$__  $$ /$$_____/
// 	 \  $$ $$/  /$$$$$$$| $$  \__/| $$  /$$$$$$$| $$  \ $$| $$| $$$$$$$$|  $$$$$$ 
// 	  \  $$$/  /$$__  $$| $$      | $$ /$$__  $$| $$  | $$| $$| $$_____/ \____  $$
// 	   \  $/  |  $$$$$$$| $$      | $$|  $$$$$$$| $$$$$$$/| $$|  $$$$$$$ /$$$$$$$/
// 	    \_/    \_______/|__/      |__/ \_______/|_______/ |__/ \_______/|_______/ 
// 	                                                                              
// 	                                                                              
// 	   

// setup variables for sending arm coordinates. see arm link reference pages for more info as well as limits
// snapper
// http://learn.robotgeek.com/2-uncategorised/153-arm-control.html
// Interbotix
// http://learn.trossenrobotics.com/arbotix/arbotix-communication-controllers/31-arm-link-reference.html

$x = $_GET['x_axis'];			//arm x coordinate, offset value, so 512 is '0'
$y = $_GET['y_axis'];			//arm y coordinate, native value
$z = $_GET['z_axis'];			//arm z coordinate, native value
$wristAngle = $_GET['wrist_angle'];	//arm wrist angle . offset value so 90 is '0' or straight wrist
$gripper = $_GET['gripper'];		//gripper control, 0 = close, 512 = open
$delta = $_GET['delta'];		//speed control, smaller value = faster speed
$button = 0;		//button byte for sending data
$extended = 0;		//extended instruction for special mode
$wristRotate = 0;	//wrist rotation value, NA for snapper

$changed = $_GET['changed'];
$changed = str_replace('_', ' ', $changed);
$changed_value = $_GET['changed_value'];

sendSnapperArmLinkPacket($serial, $x, $y, $z, $wristAngle, $gripper, $delta);
sleep(2);

$serial->deviceClose(); //close the serial port for the next page

echo "The $changed value was updated to $changed_value, and the arm should have finished moving.  Ready to receive next command.";


//This function accepts the high level coordinates and then turns them into the appropriate high/low byte values.
//Then it calulates the checksum for the entire packet
//finally, it forms the packet into a variable and sends the packet over the serial connection.
function sendArmLinkPacket($serial, $x, $y, $z, $wristAngle, $wristRotate, $gripper, $delta, $button, $extended)
{

	$header = 0xff; //header is 0xff or 255 in decimal

	//get high byte and low byte out of integer
	$xLow = $x % 256;//low byte, mod 256 isolates the lowest byte
	$xHigh = ($x / 256) % 256;//high byte, dividde 256 moves high byte to the lower byte place. mod 256 isolates lowest byte
	$yLow = $y % 256;
	$yHigh = ($y / 256) % 256;
	$zLow = $z % 256;
	$zHigh = ($z / 256) % 256;
	$wristAngleLow = $wristAngle % 256;
	$wristAngleHigh = ($wristAngle / 256) % 256;
	$wristRotateLow = $wristRotate % 256;
	$wristRotateHigh = ($wristRotate / 256) % 256;
	$gripperLow = $gripper % 256;
	$gripperHigh = ($gripper / 256) % 256;

	//last 3 vars are single byte
	$deltaLow = $delta % 256;
	$buttonLow = $button % 256;
	$extendedLow = $extended % 256;

	$sum = ($xHigh + $xLow + $yHigh + $yLow + $zHigh + $zLow + $wristAngleHigh + $wristAngleLow + $wristRotateHigh + $wristRotateLow + $gripperHigh  + $gripperLow + $deltaLow + $buttonLow + $extendedLow);

	$invertedChecksum = $sum % 256; //isolate low byte

	$checksum = 255 - $invertedChecksum;

	//create packet with all of the byte data
	$packetData = pack("CCCCCCCCCCCCCCCCC", $header, $xHigh, $xLow, $yHigh, $yLow, $zHigh, $zLow, $wristAngleHigh, $wristAngleLow, $wristRotateHigh, $wristRotateLow, $gripperHigh , $gripperLow, $deltaLow, $buttonLow, $extendedLow, $checksum);
	
	$serial->sendMessage($packetData);
}


//overloaded function with reduced parameters to make it easier for the snapper to work
function sendSnapperArmLinkPacket($serial, $x, $y, $z, $wristAngle, $gripper, $delta)
{
	$wristRotate = 0;
	$button = 0;
	$extended = 0;
	sendArmLinkPacket($serial, $x, $y, $z, $wristAngle, $wristRotate, $gripper, $delta, $button, $extended);

}

//examples of the first 3 packet examples
//http://learn.robotgeek.com/2-uncategorised/163-arm-link-packet-examples.html
function lowLevelMoves($serial)
{
	$packetData = pack("CCCCCCCCCCCCCCCCC", 0xff, 0x2, 0x0, 0x0, 0x96, 0x0, 0x96, 0x0, 0x5a, 0x00, 0x00, 0x0, 0x0, 0x80, 0x00, 0x00, 0xf7);
	$serial->sendMessage($packetData);
	sleep(5);

	$packetData = pack("CCCCCCCCCCCCCCCCC", 0xff, 0x1, 0x38, 0x0, 0x96, 0x0, 0x96, 0x0, 0x5a, 0x00, 0x00, 0x0, 0x0, 0x80, 0x00, 0x00, 0xc0);
	$serial->sendMessage($packetData);

	sleep(5);

	$packetData = pack("CCCCCCCCCCCCCCCCC", 0xff, 0x2, 0x0, 0x0, 0x32, 0x0, 0x96, 0x0, 0x5a, 0x00, 0x00, 0x0, 0x0, 0x80, 0x00, 0x00, 0x5b);
	$serial->sendMessage($packetData);

}

?>

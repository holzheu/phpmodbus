<?php
require_once 'PHPModbus/ModbusMasterTcp.php';

// Create Modbus object
$modbus = new ModbusMasterTcp("192.168.2.78", "1502");

try {
    // FC 3
    $recData = $modbus->readMultipleRegisters(71, 1026, 18);
}
catch (Exception $e) {
    // Print error information if any
    echo $modbus;
    echo $e;
    exit;
}

// Print status information
#echo "Status:" . $modbus . "\n";

// Print read data
#echo "Data: ";
#print_r($recData); 
#echo "\n";

$values = array_chunk($recData, 4);

// Get float from REAL interpretation
echo "REAL to Float\n";
foreach($values as $bytes)
    echo PhpType::bytes2float($bytes) . "\n";


$recData = $modbus->readMultipleRegisters(71, 525, 6);

$values = array_chunk($recData, 4);

echo "DINT to integer\n";
foreach($values as $bytes)
    echo PhpType::bytes2unsignedInt($bytes) . "\n";


$recData = $modbus->readMultipleRegisters(71, 582, 2);

$values = array_chunk($recData, 2);

// Get signed integer from INT interpretation
echo "INT to integer\n";
foreach($values as $bytes)
    echo PhpType::bytes2signedInt($bytes) . "\n";


$recData = $modbus->readMultipleRegisters(71, 768, 32);
echo "STRING to string\n";
echo PhpType::bytes2string($recData,1) . "\n";





?>

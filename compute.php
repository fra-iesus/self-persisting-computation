<?php
$knownResults = [
  0 => 1,
  1 => 1,
  2 => 2,
];

function getFactorial($n) {
    global $knownResults;

    $start = microtime(true);

    if (isset($knownResults[$n])) {
        $result = $knownResults[$n];
        $source = 'cache';
    } else {
        $result = gmp_intval(gmp_fact($n));
        $knownResults[$n] = $result;
        $source = 'calculation';

        $code = file_get_contents(__FILE__);

        if ($code === false) {
            echo "Failed to read the file!\n";
            return;
        }
        
        $updatedKnownResults = var_export($knownResults, true);
        $updatedKnownResults = preg_replace('/^array\s*\(/', '', $updatedKnownResults);
        $updatedKnownResults = preg_replace('/\);$/', '', $updatedKnownResults);

        if (substr($updatedKnownResults, -1) === ')') {
            $updatedKnownResults = substr($updatedKnownResults, 0, -1);
        }

        $updatedCode = preg_replace(
            '/\$knownResults\s*=\s*\[.*?\];/s',
            '$knownResults = [' . $updatedKnownResults . '];',
            $code,
            1
        );

        if ($updatedCode === $code) {
            echo "No change in code, \$knownResults not updated.\n";
        } else {
            echo "Code was updated.\n";
            file_put_contents(__FILE__, $updatedCode);
        }
    }

    $end = microtime(true);
    $duration = round(($end - $start) * 1000, 3);

    echo "Result: $result (from $source) in $duration ms\n";

    return $result;
}

# Tests
getFactorial(5);
getFactorial(5);
getFactorial(10);
getFactorial(10);
getFactorial(20);
getFactorial(20);
?>

<?php
$knownResults = [
    0 => 1,
    1 => 1,
    2 => 2
];

function getFactorial($n) {
    global $knownResults;

    if (isset($knownResults[$n])) {
        return $knownResults[$n];
    }

    $result = gmp_intval(gmp_fact($n));
    $knownResults[$n] = $result;

    $code = file_get_contents(__FILE__);
    $updatedCode = preg_replace(
        '/\$knownResults = .*?;\n/s',
        '$knownResults = ' . var_export($knownResults, true) . ";\n",
        $code
    );

    file_put_contents(__FILE__, $updatedCode);

    return $result;
}

# Test
echo getFactorial(5) . PHP_EOL;
echo getFactorial(5) . PHP_EOL;
?>

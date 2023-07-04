<?php

/**
 * Recursively prints the formatted nested key-value pairs in an array.
 *
 * @param array $array The array containing the nested key-value pairs.
 * @param bool $isMainObject Flag indicating if it's the main object being printed.
 * @param string $indentation The current indentation level.
 */
function printFormattedData($array, $isMainObject = true, $indentation = '')
{
    foreach ($array as $key => $value) {
        if ($isMainObject) {
            echo "============== " . ($key + 1) . " ==============\n";
        }
        if (is_array($value)) {
            if (!is_numeric($key)) {
                echo "{$indentation}\e[1m{$key}:\e[0m\n";
            }
            $indentation .= '  ';
            printFormattedData($value, false, $indentation);
            $indentation = substr($indentation, 0, -2);
        } else {
            echo "{$indentation}\e[32m{$key}:\e[0m {$value}\n";
        }
    }
}

// Call the function to print the nested key-value pairs
try {
    $filename = 'data_structure.php';
    $data = include $filename;
    printFormattedData($data, " ");
} catch (InvalidArgumentException $e) {
    echo 'Error: ' . $e->getMessage();
}

<?php
require "ConsoleFormat.php";

/**
 * Sorts an array of data by the specified keys.
 *
 * @param array  $data     The data to be sorted.
 * @param string $sortKey  The key to sort the data by.
 *
 * @return array|string    The sorted data array or an error message if the key is not found.
 */
function sortDataByKeys(array &$data, $sortKey)
{
    $isKeyFound = false;

    // Recursive function to check if the key exists
    $checkKeyExists = function (array $array, $key) use (&$checkKeyExists, &$isKeyFound) {
        foreach ($array as $k => $value) {
            if ($k === $key) {
                $isKeyFound = true;
                break;
            }
            if (is_array($value)) {
                $checkKeyExists($value, $key);
            }
        }
    };

    // Check if the sort key exists in the data
    $checkKeyExists($data, $sortKey);

    if (!$isKeyFound) {
        return null;
    }

    // Sort the data array based on the specified key
    usort($data, function ($a, $b) use ($sortKey) {
        $getNestedValue = function ($array, $key) use (&$getNestedValue) {
            $iterator = new RecursiveIteratorIterator(new RecursiveArrayIterator($array));
            foreach ($iterator as $value) {
                $keys = [];
                foreach (range(0, $iterator->getDepth()) as $depth) {
                    $keys[] = $iterator->getSubIterator($depth)->key();
                }
                if ($keys[count($keys) - 1] === $key) {
                    return $value;
                }
            }
            return null;
        };

        $value1 = $getNestedValue($a, $sortKey);
        $value2 = $getNestedValue($b, $sortKey);

        if ($value1 === $value2) {
            return 0;
        }

        return ($value1 === null) ? -1 : (($value2 === null) ? 1 : strnatcmp($value1, $value2));
    });

    return $data;
}

// Usage example

try {
    //Access to the Data structure
    $filename = 'data/data_structure.php';
    $data = include $filename;

    $sortKeys = ['last_name', 'booking_sasnumber', 'account_id'];

    foreach ($sortKeys as $sortKey) {
        $separator = str_repeat("=", strlen($sortKey) + 19);
        echo "\n+{$separator}+\n  Sorted by $sortKey \n+{$separator}+\n";

        // Sort the data by the current sort key

        $sorted_data = sortDataByKeys($data, $sortKey);

        // If the key is not found, display an error message
        if ($sorted_data === null) {
            $sorted_data = "\n+{$separator}+\n ERROR: $sortKey not found \n+{$separator}+\n";
        }

        // Print the sorted data using the console_format.php library
        ConsoleFormat::printNestedKeyValuePairs($sorted_data, [$sortKey]);
    }
} catch (Exception $e) {
    echo "An error occurred: " . $e->getMessage();
} catch (Error $e) {
    echo "An error occurred: " . $e->getMessage();
}

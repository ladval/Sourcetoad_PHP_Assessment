<?php
require "ConsoleFormat.php";

/**
 * Sorts a multidimensional array recursively based on the provided sort keys.
 *
 * @param array $data The array to be sorted.
 * @param array $sortKeys The keys used for sorting the array.
 */
function sortRecursiveByKeys(&$data, $keys)
{
    usort($data, function ($a, $b) use ($keys) {
        foreach ($keys as $key) {
            try {
                $valueA = getValueByNestedKeys($a, $key);
                $valueB = getValueByNestedKeys($b, $key);
                if ($valueA != $valueB) {
                    return $valueA <=> $valueB;
                }
            } catch (Exception $e) {
                throw new Exception("An error occurred: " . $e->getMessage());
            }
        }
        return 0;
    });

    foreach ($data as &$item) {
        foreach ($item as $key => &$value) {
            if (is_array($value)) {
                try {
                    sortRecursiveByKeys($value, $keys);
                } catch (Exception $e) {
                    // Handle the exception here
                    throw new Exception("An error occurred: " . $e->getMessage());
                }
            }
        }
    }
}

function getValueByNestedKeys($data, $keys)
{
    if (is_array($keys)) {
        $currentValue = $data;
        foreach ($keys as $key) {
            try {
                if (isset($currentValue[$key])) {
                    $currentValue = $currentValue[$key];
                } else {
                    return null;
                }
            } catch (Exception $e) {
                // Handle the exception here
                throw new Exception("An error occurred: " . $e->getMessage());
            }
        }
        return $currentValue;
    } else {
        return $data;
    }
}


// Usage data structure:
$filename = 'data/data_structure_lists.php';

// Include the data file
$data = include $filename;

// Validate if the data is an array
if (!is_array($data)) {
    throw new RuntimeException("Unable to load data from file: $filename");
}

$sortKeys = ['last_name', 'account_id', 'booking_number'];

// Sort the data recursively
sortRecursiveByKeys($data, $sortKeys);

// Print the sorted data
ConsoleFormat::printNestedKeyValuePairs($data, $sortKeys);

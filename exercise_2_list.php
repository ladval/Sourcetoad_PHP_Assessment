<?php
require "ConsoleFormat.php";

/**
 * Sorts a multidimensional array recursively based on the provided sort keys.
 *
 * @param array $data The array to be sorted.
 * @param array $sortKeys The keys used for sorting the array.
 */
function sort_recursive(&$data, $sortKeys)
{
    // Validate input parameters
    if (!is_array($data)) {
        throw new InvalidArgumentException('$data must be an array.');
    }

    if (!is_array($sortKeys) || empty($sortKeys)) {
        throw new InvalidArgumentException('$sortKeys must be a non-empty array.');
    }

    if (count($sortKeys) === 0) {
        return;
    }

    $currentKey = array_shift($sortKeys);

    usort($data, function ($a, $b) use ($currentKey, $sortKeys) {
        if (!array_key_exists($currentKey, $a) || !array_key_exists($currentKey, $b)) {
            throw new InvalidArgumentException("Invalid sort key: $currentKey");
        }

        if ($a[$currentKey] === $b[$currentKey]) {
            sort_recursive($a, $sortKeys);
            sort_recursive($b, $sortKeys);
        }
        return $a[$currentKey] <=> $b[$currentKey];
    });
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
sort_recursive($data, $sortKeys);

// Print the sorted data
ConsoleFormat::printNestedKeyValuePairs($data, $sortKeys);

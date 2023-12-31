<?php

/**
 * Class ConsoleFormat
 *
 * The ConsoleFormat class provides utility methods for formatting and printing nested key-value pairs.
 * It includes a static method to print nested key-value pairs in a more readable format.
 */
class ConsoleFormat
{
    /**
     * Prints nested key-value pairs in a formatted manner.
     *
     * @param mixed   $array           The array containing the key-value pairs.
     * @param array   $sortKey         The key used for sorting (optional).
     * @param bool    $isMainObject    Flag indicating if the current array is the main object.
     * @param string  $indentation     The indentation string for nested levels.
     *
     * @return bool    Returns true if the operation is successful, false otherwise.
     */
    public static function printNestedKeyValuePairs($array, $sortKey = [], $isMainObject = true, $indentation = '')
    {
        if (!is_array($array)) {
            echo "{$indentation}\e[31m{$array}\e[0m\n";
            return false;
        }

        foreach ($array as $key => $value) {
            if ($isMainObject) {
                echo "\n============== #" . ($key + 1) . " ==============\n\n";
            }

            if (is_array($value)) {
                if (!is_numeric($key)) {
                    echo "{$indentation}\e[1m{$key}:\e[0m\n";
                }

                $indentation .= '  ';
                self::printNestedKeyValuePairs($value, $sortKey, false, $indentation);
                $indentation = substr($indentation, 0, -2);
            } else {
                if (in_array($key, $sortKey)) {
                    echo "{$indentation}\e[33m{$key}:\e[0m {$value}\n";
                } else {
                    echo "{$indentation}\e[32m{$key}:\e[0m {$value}\n";
                }
            }
        }

        return true;
    }
}

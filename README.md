# Sourcetoad assesment

Development of the exercises for the Sourcetoad assessment. The exercises focus on handling and sorting data structures, as well as creating classes to manage commercial customer information.

## Table of Contents

- [Introduction](#introduction)
- [Features](#features)
- [Installation](#installation)
- [Usage](#usage)

## Introduction

Exercise 1: Data Structure Handling
An exercise was implemented to handle and print formatted nested key-value pairs in an array. The printFormattedData function was created to recursively iterate through the array, printing the keys and values in a structured format.

Exercise 2: Data Structure Sorting
Another exercise involved sorting a data structure. The code includes sorting functionality for a specific data structure using a chosen sorting algorithm. The implementation ensures that the data structure is sorted correctly based on specific criteria.

Exercise 3: Commercial Customer Information Management
The final exercise involved creating classes to manage commercial customer information. Two classes were developed: Item and Customer. The Item class represents an item in an inventory, with properties such as ID, name, quantity, and price. The Customer class represents a customer and their cart, with methods for managing addresses, adding/removing items from the cart, and calculating costs.

## Features

The project includes a PHP class named ConsoleFormat that facilitates sorting and displaying information in a console application. The class encapsulates the relevant data and provides methods for sorting and formatting the output.The project includes a PHP class that facilitates sorting and displaying information in a console application. The class encapsulates the relevant data and provides methods for sorting and formatting the output.

## Installation

To install and set up a PHP project with a console-based PHP command, you can follow these step-by-step instructions:

1. Install PHP: Ensure that PHP is installed on your system. You can download PHP from the official PHP website (https://www.php.net/downloads.php) or use a package manager like Homebrew (for macOS) or apt-get (for Ubuntu). The version 8.2.4 (cli) was used in this project.

2. Set up a project directory: Create a new directory for your PHP project. You can choose any name for the directory.

   ```
   mkdir my-php-project
   cd my-php-project
   ```

3. Create a new PHP file: Inside your project directory, create a new PHP file. This file will contain the code for your console-based command.

   ```
   touch my-command.php
   ```

4. Edit the PHP file: Open the `my-command.php` file in a text editor and add your PHP code. This code should implement your desired functionality for the console command.

   ```php
   <?php

   // Your code here
   // Implement your console command functionality
   // e.g., parsing arguments, executing actions, etc.

   echo "Hello, world!\n";
   ```

5. Make the PHP file executable: In order to run the PHP file as a console command, you need to make it executable. This can be done using the `chmod` command.

   ```
   chmod +x my-command.php
   ```

6. Test the command: Run your PHP command to ensure that it works as expected.

   ```
   ./my-command.php
   ```

   You should see the output "Hello, world!" printed in the console.

7. Optional: Add shebang line: You can add a shebang line at the beginning of your PHP file to specify the PHP interpreter to use when running the command. This is not necessary on all systems, but it can be helpful in some cases.

   ```php
   #!/usr/bin/env php
   <?php

   // Rest of your code
   ```

# Usage

## Exercise 1

The provided code is a PHP function `printFormattedData()` that recursively prints the formatted nested key-value pairs in an array. Here's an explanation of how to use the project and how the code works:

1. Include the data structure: The code assumes that the nested key-value pairs are stored in a separate PHP file. In this example, the filename is 'data_structure.php'. Make sure you have a valid PHP file containing the data structure.

2. Call the `printFormattedData()` function: To print the nested key-value pairs, you need to call the `printFormattedData()` function and pass the data array as the first argument. Optionally, you can pass additional arguments: `$isMainObject` and `$indentation`.

   ```php
   // Call the function to print the nested key-value pairs
   try {
       $filename = 'data_structure.php';
       $data = include $filename;
       printFormattedData($data, true, "");
   } catch (InvalidArgumentException $e) {
       echo 'Error: ' . $e->getMessage();
   }
   ```

   In this example, the function is called with the `$data` array, `$isMainObject` set to `true`, and `$indentation` set to an empty string.

3. Recursive printing: The `printFormattedData()` function iterates through each key-value pair in the array. If the value is an array, it recursively calls itself with the nested array and updates the indentation level.

   - If it's the main object being printed (`$isMainObject` is `true`), it prints a separator line.
   - If the value is an array, it prints the key (if not numeric) and adds two spaces to the indentation level.
   - If the value is not an array, it prints the key-value pair.

   The output is formatted with indentation and uses color codes for better readability. `\e[1m` and `\e[0m` are ANSI escape sequences for bold text and reset formatting, respectively. `\e[32m` is for green color.

   Here's an example of the expected output:

   ```
   ============== 1 ==============
     key1:
       key2: value2
       key3:
         key4: value4
         key5: value5
   ============== 2 ==============
     key6: value6
   ```

   This output represents a nested array structure with multiple levels of keys and values.

Important considerations for using the code:

- Make sure the 'data_structure.php' file contains a valid PHP array. The code assumes that the array is correctly formatted and contains the nested key-value pairs.
- If the 'data_structure.php' file is not in the same directory as the PHP file running the code, provide the correct path to the file.
- If any exceptions occur during the execution, an error message will be displayed. Ensure that appropriate exception handling is implemented if needed.

You can modify the code according to your specific requirements, such as changing the output format, customizing the colors, or handling exceptions differently.

## Exercise 2


## exercise_2_list.php: PHP Recursive Multidimensional Array Sorting


![alt text](https://github.com/ladval/Sourcetoad_PHP_Assessment/blob/main/img/Multisorting.jpg?raw=true)


This PHP script provides a recursive function called `sort_recursive()` that allows you to sort a multidimensional array based on one or more keys, regardless of their level within the data structure. The function utilizes recursion to handle nested arrays and ensures that the sorting is applied at all levels.

### Usage

To use the `sort_recursive()` function, follow these steps:

1. Include the required `ConsoleFormat.php` file in your project. Make sure the file is in the same directory as the script or update the `require` statement with the correct path.

2. Define the data structure you want to sort in a PHP file. The structure should be in the form of an array with nested arrays containing the data. An example data structure is provided in the documentation.

3. Include the data structure file using the `$filename` variable and assign it to the `$data` variable:
   ```php
   $filename = 'data/data_structure_lists.php';
   $data = include $filename;
   ```

4. Validate if the loaded data is an array:
   ```php
   if (!is_array($data)) {
       throw new RuntimeException("Unable to load data from file: $filename");
   }
   ```

5. Define the sort keys array based on which you want to sort the multidimensional array. Update the `$sortKeys` variable with the desired keys. You can include multiple keys to sort by:
   ```php
   $sortKeys = ['last_name', 'account_id'];
   ```

6. Sort the data recursively using the `sort_recursive()` function:
   ```php
   sort_recursive($data, $sortKeys);
   ```

7. Print the sorted data using the `ConsoleFormat::printNestedKeyValuePairs()` method or use it in your desired application logic:
   ```php
   ConsoleFormat::printNestedKeyValuePairs($data, $sortKeys);
   ```

Ensure that you have included the `ConsoleFormat.php` file and have the necessary permissions to read the data file.

### Recursive Sorting

The `sort_recursive()` function takes two parameters: `$data` (the array to be sorted) and `$sortKeys` (the keys used for sorting the array). It recursively sorts the array based on the provided keys, regardless of their level within the data structure.

During the sorting process, the function validates the input parameters, checks for the existence of the current key in the array, and throws an `InvalidArgumentException` if an invalid key is encountered.

If two elements have equal values for the current key, the function applies recursive sorting to the nested arrays by calling itself on the sub-arrays. This ensures that the sorting is performed at all levels within the multidimensional array.

### Example Data Structure

The provided example data structure demonstrates a nested array containing guest information, bookings, and accounts. The script can handle sorting based on any key within this structure.

Please make sure to update the file paths and sort keys as per your requirements.

Feel free to reach out if you have any questions or face any issues with the usage of this script.

## exercise_2_unique.php: PHP Recursive Array Sorting by Keys

![alt text](https://github.com/ladval/Sourcetoad_PHP_Assessment/blob/main/img/UniqueSorting.jpg?raw=true)

This PHP script demonstrates a method called `sortDataByKeys()` that allows you to sort an array of data based on a specified key. The script utilizes recursion to handle nested arrays and provides an error message if the key is not found within the data structure.

### Usage

To use the `sortDataByKeys()` method, follow these steps:

1. Include the required `ConsoleFormat.php` file in your project. Make sure the file is in the same directory as the script or update the `require` statement with the correct path.

2. Define the data structure you want to sort in a PHP file. The structure should be in the form of an array with nested arrays containing the data. An example data structure is provided in the documentation.

3. Include the data structure file using the `$filename` variable and assign it to the `$data` variable:
   ```php
   $filename = 'data/data_structure.php';
   $data = include $filename;
   ```

4. Define an array of sort keys, `$sortKeys`, based on which you want to sort the multidimensional array. Update the array with the desired keys. You can include multiple keys to sort by:
   ```php
   $sortKeys = ['last_name', 'booking_sasnumber', 'account_id'];
   ```

5. Iterate through the sort keys and sort the data array by each key using the `sortDataByKeys()` method:
   ```php
   foreach ($sortKeys as $sortKey) {
       // Sort the data by the current sort key
       $sorted_data = sortDataByKeys($data, $sortKey);

       // If the key is not found, display an error message
       if ($sorted_data === null) {
           $separator = str_repeat("=", strlen($sortKey) + 19);
           $sorted_data = "\n+{$separator}+\n ERROR: $sortKey not found \n+{$separator}+\n";
       }

       // Print the sorted data using the ConsoleFormat::printNestedKeyValuePairs() method
       ConsoleFormat::printNestedKeyValuePairs($sorted_data, [$sortKey]);
   }
   ```

Ensure that you have included the `ConsoleFormat.php` file and have the necessary permissions to read the data file.

### Recursive Sorting by Keys

The `sortDataByKeys()` method takes two parameters: `$data` (the array to be sorted) and `$sortKey` (the key to sort the data by). It recursively searches for the specified key within the nested arrays and sorts the array based on that key.

The method uses a recursive function, `$checkKeyExists`, to check if the key exists within the data structure. If the key is not found, the method returns `null`, and an error message is displayed.

For sorting, the method utilizes the `usort()` function and a nested function, `$getNestedValue()`, to retrieve the values of the specified key at different levels within the array. It compares the values and sorts the data accordingly.

### Example Data Structure

The provided example data structure demonstrates a nested array containing guest information, bookings, and accounts. The script can handle sorting based on any key within this structure.

Please make sure to update the file paths and sort keys as per your requirements.

Feel free to reach out if you have any questions or encounter any issues with the usage of this script.


## Exercise 3

To use the provided code and display the order information, follow these steps:

1. Include the 'exercise_3.php' file by adding the line `require_once 'exercise_3.php';` at the beginning of your PHP script. This file contains the necessary class definitions.

2. Create item instances: Use the `Item` class to create item instances with the desired details. For example:

   ```php
   $item1 = new Item(1, 'Item 1', 2, 10.99);
   $item2 = new Item(2, 'Item 2', 1, 9.99);
   ```

   Adjust the item details according to your requirements.

3. Create a customer instance: Use the `Customer` class to create a customer instance with the desired details. For example:

   ```php
   $customer = new Customer('John', 'Doe');
   ```

   Adjust the customer's first name and last name as needed.

4. Add addresses to the customer: Use the `addAddress()` method of the `Customer` class to add shipping addresses. For example:

   ```php
   $customer->addAddress('123 Main St', '', 'City', 'State', '12345');
   ```

   Modify the address details according to your needs.

5. Add items to the customer's cart: Use the `addItemToCart()` method of the `Customer` class to add items to the customer's cart. For example:

   ```php
   $customer->addItemToCart($item1);
   $customer->addItemToCart($item2);
   ```

   Add as many items as needed.

6. Update customer information: Use the setter methods of the `Customer` class to update the customer's first name or any other details. For example:

   ```php
   $customer->setFirstName('Jane');
   ```

   Adjust the customer's first name as necessary.

7. Remove items from the cart: Use the `removeItemFromCart()` method of the `Customer` class to remove items from the cart. For example:

   ```php
   $customer->removeItemFromCart($item1);
   ```

   Remove any items you want from the cart.

8. Calculate order subtotal and total cost: Use the `getSubtotal()` and `calculateCost()` methods of the `Customer` class to calculate the order subtotal and total cost. For example:

   ```php
   $subtotal = $customer->getSubtotal();
   $totalCost = $customer->calculateCost();
   ```

   These variables will store the calculated values.

9. Display order information: Use the provided echo statements to display the order information. Adjust the output formatting as needed.

   These echo statements will print the order information, including customer details, shipping address, items in the cart, and order summary.

Make sure to adjust the paths and filenames if necessary, and ensure that the required files are available.

After following these steps, you should be able to run the script and see the order information displayed in the console or browser output. The information will include the customer's name, shipping address, items in the cart, and order summary with the subtotal, shipping cost, tax, and total cost.



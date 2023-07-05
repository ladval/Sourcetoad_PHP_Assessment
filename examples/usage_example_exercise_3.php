<?php
require_once '..\exercise_3.php';

// Create item instances
$item1 = new Item(1, 'Item 1', 2, 10.99);
$item2 = new Item(2, 'Item 2', 1, 9.99);

// Create a customer instance
$customer = new Customer('John', 'Doe');
$customer->addAddress('123 Main St', '', 'City', 'State', '12345');

// Add items to the customer's cart
$customer->addItemToCart($item1);
$customer->addItemToCart($item2);

// Update customer's first name and remove an item from the cart
$customer->setFirstName('Jane');
$customer->removeItemFromCart($item1);

// Calculate order subtotal and total cost
$subtotal = $customer->getSubtotal();
$totalCost = $customer->calculateCost();

// Display order information
echo "---------------------------------\n";
echo "        ORDER INFORMATION        \n";
echo "---------------------------------\n";
echo " Customer Name: {$customer->getFirstName()} {$customer->getLastName()}\n";
echo " Shipping Address:\n";
foreach ($customer->getAddresses() as $address) {
    echo "  - {$address['line_1']}\n";
    if (!empty($address['line_2'])) {
        echo "    {$address['line_2']}\n";
    }
    echo "    {$address['city']}, {$address['state']} {$address['zip']}\n";
}
echo "---------------------------------\n";
echo "    ITEMS IN CART   \n";
echo "---------------------------------\n";
foreach ($customer->getCart() as $item) {
    echo " {$item->getName()} (Quantity: {$item->getQuantity()}, Price: $" . number_format($item->getPrice(), 2) . ")\n";
}
echo "---------------------------------\n";
echo "     ORDER SUMMARY   \n";
echo "---------------------------------\n";
echo " Subtotal: $" . number_format($subtotal, 2) . "\n";
echo " Shipping Cost: $" . number_format($customer->getShippingCost(), 2) . "\n";
echo " Tax (7%): $" . number_format($subtotal * 0.07, 2) . "\n";
echo " Total: $" . number_format($totalCost, 2) . "\n";
echo "---------------------------------\n";

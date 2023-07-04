<?php

/**
 * Class Item
 * Represents an item in the inventory.
 */
class Item
{
    private $id;
    private $name;
    private $quantity;
    private $price;

    /**
     * Item constructor.
     *
     * @param int $id
     * @param string $name
     * @param int $quantity
     * @param float $price
     */
    public function __construct($id, $name, $quantity, $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->setQuantity($quantity);
        $this->setPrice($price);
    }

    /**
     * Get the item ID.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the item name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the item quantity.
     *
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set the item quantity.
     *
     * @param int $quantity
     *
     * @throws InvalidArgumentException
     */
    public function setQuantity($quantity)
    {
        if (!is_int($quantity) || $quantity < 0) {
            throw new InvalidArgumentException("Invalid quantity value");
        }
        $this->quantity = $quantity;
    }

    /**
     * Get the item price.
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the item price.
     *
     * @param float $price
     *
     * @throws InvalidArgumentException
     */
    public function setPrice($price)
    {
        if (!is_numeric($price) || $price < 0) {
            throw new InvalidArgumentException("Invalid price value");
        }
        $this->price = $price;
    }
}

/**
 * Class Customer
 * Represents a customer and their cart.
 */
class Customer
{
    private $firstName;
    private $lastName;
    private $addresses;
    private $cart;

    /**
     * Customer constructor.
     *
     * @param string $firstName
     * @param string $lastName
     */
    public function __construct($firstName, $lastName)
    {
        $this->setFirstName($firstName);
        $this->setLastName($lastName);
        $this->addresses = [];
        $this->cart = [];
    }

    /**
     * Get the customer's first name.
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set the customer's first name.
     *
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * Get the customer's last name.
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set the customer's last name.
     *
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * Add an address to the customer's address list.
     *
     * @param string $line1
     * @param string $line2
     * @param string $city
     * @param string $state
     * @param string $zip
     */
    public function addAddress($line1, $line2, $city, $state, $zip)
    {
        $address = [
            'line_1' => $line1,
            'line_2' => $line2,
            'city' => $city,
            'state' => $state,
            'zip' => $zip,
        ];
        $this->addresses[] = $address;
    }

    /**
     * Get the customer's addresses.
     *
     * @return array
     */
    public function getAddresses()
    {
        return $this->addresses;
    }

    /**
     * Add an item to the customer's cart.
     *
     * @param Item $item
     */
    public function addItemToCart(Item $item)
    {
        $this->cart[] = $item;
    }

    /**
     * Remove an item from the customer's cart.
     *
     * @param Item $item
     */
    public function removeItemFromCart(Item $item)
    {
        $index = array_search($item, $this->cart);
        if ($index !== false) {
            unset($this->cart[$index]);
        }
    }

    /**
     * Get the customer's cart.
     *
     * @return array
     */
    public function getCart()
    {
        return $this->cart;
    }

    /**
     * Calculate the total cost for the items in the cart.
     *
     * @return float
     */
    public function calculateCost()
    {
        $shippingCost = $this->getShippingCost();
        $tax = $this->getSubtotal() * 0.07;
        return $this->getSubtotal() + $shippingCost + $tax;
    }

    /**
     * Get the subtotal cost of the items in the cart.
     *
     * @return float
     */
    public function getSubtotal()
    {
        $subtotal = 0;
        foreach ($this->cart as $item) {
            $subtotal += $item->getPrice() * $item->getQuantity();
        }
        return $subtotal;
    }

    /**
     * Get the shipping cost for the customer's address.
     *
     * @return float
     */
    public function getShippingCost()
    {
        // Access the shipping rate API or calculate shipping cost here
        // Return the cost based on the customer's address

        // Placeholder implementation
        // Assume the shipping rate API returns a fixed shipping cost
        return 5.99;
    }
}

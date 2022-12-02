<?php

class Artwork
{
    public int $id;
    public string $name;
    public Customer $customer;
    public int $customerId;
    public string $attachment;
    public string $status;
    public DateTime $deadline;
    public DateTime $created;
    public DateTime $updated;
}


?>
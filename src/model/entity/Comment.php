<?php

use Artwork as GlobalArtwork;

class Artwork
{
    public int $id;
    public Customer $customer;
    public int $customerId;
    public Artwork $artwork;
    public int $artworkId;
    public string $content;
    public DateTime $created;
    public DateTime $updated;
}


?>
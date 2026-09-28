<?php
namespace Example10;

$object = new User();
print_r($object);

class User
{
    public ?string $name = null;
    public ?string $password = null;

    public function save_user()
    {
        echo "Save User code goes here";
    }
}

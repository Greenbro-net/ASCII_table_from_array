#!/usr/bin/php
<?php
// simple implementation for model layer
class Model {
    
    public $new_array;
    public $grabing_method;
    public $file_array;

    public function __construct($grabing_method, $new_array) 
    {   
        // the code below sets property grabing_method
        $this->grabing_method = $grabing_method;

        $this->new_array = $new_array;
        // the code below will write new array in array.json if new_array is array
        true == is_array($new_array) ? $this->write_array_to_file($new_array) : false;
        
        $this->file_array = $this->grabing_method == "file" ? $this->grab_array_from_file() : $this->grab_array_from_storage();
        
    }

    // the method below sets array for writing to json file
    public function set_array_for_writing($new_array)
    {
        $this->new_array = $new_array;
    }

    // the method below is storage for array
    public function storage_for_array()
    {
        return $array = array(
            array(
                'House' => 'Baratheon',
                'Sigil' => 'A crowned stag',
                'Motto' => 'Ours is the Fury',
                ),
            array(
                'Leader' => 'Eddard Stark',
                'House' => 'Stark',
                'Motto' => 'Winter is Coming',
                'Sigil' => 'A grey direwolf'
                ),
            array(
                array('Bro' => 'You are cool'),
                'House' => 'Lannister',
                'Leader' => 'Tywin Lannister',
                'Sigil' => 'A golden lion'
                ),
            array(
                  'Q' => 'Z'
            )
        );

    }
    // the method below grabs array from file
    public function grab_array_from_file()
    {
        $array = json_decode(file_get_contents("array.json"), true);
        return $array;
    }
    // the method below grabs array from storage
    public function grab_array_from_storage()
    {
        $array = $this->storage_for_array();
        return $array;
    }

    // the method below stores array to json file
    public function write_array_to_file($array_for_writing)
    {   // the code below can handling only one level array because of console input limitations
        $json_array = json_encode(array($array_for_writing));
        file_put_contents("array.json", $json_array);
    }


}



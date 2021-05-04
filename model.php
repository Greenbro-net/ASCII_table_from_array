#!/usr/bin/php
<?php
// simple implementation for model layer
class Model {
    
    public $file_array ;

    public function __construct() 
    {
        $this->file_array = $this->grab_array_from_file();
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

    // the method below stores array to json file
    public function write_array_to_file()
    {
        $array = $this->storage_for_array();
        $json_array = json_encode($array);
        file_put_contents("array.json", $json_array);
    }


}



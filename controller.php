#!/usr/bin/php
<?php
// include Model class
require_once 'model.php';

class Controller
{
   public $input_array;

   public function __construct()
   {
    
   }

    // the method below checks if an array has array inside
    public function next_element($array) 
    {
        foreach ($array as $some_type) {
            if (is_array($some_type)) {
                return true;
            } else {
                return false;
                   }
        }
    }

    // the method below create one array that contains all arrays inside, in one line
    public function one_line_array_maker() 
    {
        $inputs = $this->get_array(new Model);
        foreach ($inputs as $position => $input) {
        
            if (is_array($input) && $this->next_element($input)) { // case with multydimentional array
                // the code below checks if ab actual array has array inside
                foreach($input as $sub_position => $sub_input) {
                    if (!is_array($sub_input)) {
                        $compiled_array[$sub_position] = $sub_input;
                        continue;
                        
                    } else {
                        $one_line_array[] = &$compiled_array;
                           }
                    // the code below sets specific key name 
                    $one_line_array[$position."sub"] = $sub_input;
                }
            } else { // case with one simple array
                $one_line_array[$position] = $input;
                   }
        }
        return $one_line_array;

    }

    // the code below creates array with unique values for row_pattern
    public function flatten() 
    {
        $arrays = $this->get_array(new Model);
        $return = array();
        array_walk_recursive($arrays, function($value, $key) use (&$return) { $return[] = $key; });
        // the code below creates array with unique values
        $row_pattern = array_unique($return);
        // the code below sorst array keys in alphabetical order
        sort($row_pattern);
        return $row_pattern;
    }

    // as argument it grabs arrays in one_level_array 
    // the method below to bypass all arrays
    public function bypass_array( $one_array) {
        $row_pattern = $this->flatten();
        foreach($row_pattern as $value) {
            if(array_key_exists($value, $one_array)) {
            $ordered_array[$value] = $one_array[$value];
            } else { // set just blank space if array doesn't have value
            $ordered_array[$value] = $one_array[$value] = "  ";
                   }
                
        } 
        return $ordered_array; // return composed array
    }

    // method  below organizes handling of one_line_array
    public function crawl_main_array() 
    {   $one_line_array = $this->one_line_array_maker();
        foreach ($one_line_array as $one_array) {
            $pre_configured_arrays[] = $this->bypass_array( $one_array);
            
        }
        return $pre_configured_arrays;
    }

    // method below gets array from object
    public function get_array(Model $input_object)
    {   // the function below gets an array from object
        $actual_array = get_object_vars($input_object);
        $actual_array = $actual_array['file_array'];
        return $actual_array;
    }

}






  

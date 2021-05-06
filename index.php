#!/usr/bin/php
<?php  
require_once 'controller.php'; 


function display_table($array) {
  $controller = new Controller();
  if (1 == $array) { // use array from storage
    $pre_configured_arrays = $controller->crawl_main_array(new Model("storage", 1)); 
  }

  elseif (is_array($array)) { // user enters own example of array 
    $model = new Model("file", $array);
    $model->set_array_for_writing($array);
    $pre_configured_arrays = $controller->crawl_main_array($model);
  } 

    // Get column names
    $keys = array_keys($pre_configured_arrays[0]);

    // Iterate over column names, get starting widths
    $maxLength = [];
    foreach ($keys as $column) {
      $maxLength[$column] = mb_strlen($column);
    }

    // Iterate over result-set, get maximum string length for each column
    foreach ($pre_configured_arrays as $row) {
      foreach ($keys as $column) {

        // If current cell length is greater than column width, increase column width
        if (mb_strlen($row[$column]) > $maxLength[$column]) {
          $maxLength[$column] = mb_strlen($row[$column]);
        }

      }
    }

    // Output top border
    echo '+';
    foreach ($keys as $column) {
      echo str_repeat('-', $maxLength[$column]+2);
      echo '+';
    }
    echo "\n";

    // Output header
    echo '| ';
    foreach ($keys as $column) {
        // str_repeat adds space for row 
      echo str_repeat(' ', $maxLength[$column] - mb_strlen($column)).$column;
      echo ' | ';
    }
    echo "\n";

    // Output bottom border
    echo '+';
    foreach ($keys as $column) {
      echo str_repeat('-', $maxLength[$column]+2);
      echo '+';
    }
    echo "\n";

    // Output all rows
    foreach ($pre_configured_arrays as $row) {
      echo '| ';
      foreach ($keys as $column) {
        echo str_repeat(' ', $maxLength[$column] - mb_strlen($row[$column])).$row[$column];
        echo ' | ';
      }
    echo "\n";
    }

}



echo "\n";

$user = readline("Use existing array as an example, enter: [a] | Use your own array as an example, enter [i] | exit [q]: ");

if ($user === "a"){ echo display_table(1); }

// the code below puts user input data in a string
if ($user === "i") { 
   $input = readline(); 
   $results = explode(" ", $input);
   echo display_table($results);

}

if ($user === "q"){ exit; }

echo "\nThanks!";
echo "\n";
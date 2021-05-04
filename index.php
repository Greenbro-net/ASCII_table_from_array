#!/usr/bin/php
<?php  
require_once 'controller.php'; 

  $controller = new Controller();
  
  $pre_configured_arrays = $controller->crawl_main_array();
  

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



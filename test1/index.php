<?php

/**
 * TO DO: In PHP, write some code that returns the string reversed, with all
 * occurrences of the most frequent character removed.
 */

declare(strict_types=1);

/** Function to process the string
  * @param  string $string
  * @return string
*/
function processString(string $string): string
{
    $cleanString = cleanString($string);
    return reverseString($cleanString);
}

/**
  * Reverse a string
  *
  * @param  string $string
  * @return string
*/
function reverseString(string $string): string
{
    // initialise the result to be retuned
    $result = '';
    
    // get the length of the string
    $size_of_string = strlen($string);

    // walk through the string and form the new reversed string
    while ($size_of_string > 0) {
        $size_of_string--;
        $result .= substr($string, $size_of_string, 1);
    }

    return $result;
}

/**
  * Remove the character with most occurences in the string
  *
  * @param  string $string
  * @return string
*/
function cleanString(string $string): string
{
    $result = '';

    // count the occurences for every single character
    $count_all_chars = array_count_values(str_split($string));

    // sort the array descending
    arsort($count_all_chars);

    // get the first element of the array
    $char_to_be_removed = array_key_first($count_all_chars);

    // remove all the occurences 
    $result = str_replace($char_to_be_removed, '', $string);

    return $result;
}

// testing with aabcccdeccff should return ffedbaa
$test = 'aabcccdeccff';
echo processString($test);

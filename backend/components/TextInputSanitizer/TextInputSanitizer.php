<?php
/**
* Copyright (c) 2013 Gabriel Ferreira <gabrielinuz@gmail.com>. All rights reserved. 
* This file is part of COMPSET.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

include_once 'components/TextInputSanitizer/interface/SanitizerInterface.php';

class TextInputSanitizer implements SanitizerInterface
{

/*FOR CLEAN INPUTS AND PREVENT SOME INJECTION*/
    private function cleanInput($input) 
    {
     
      $search = array(
        '@<script [^>]*?>.*?@si',            // Strip out javascript
        '@< [/!]*?[^<>]*?>@si',            // Strip out HTML tags
        '@<style [^>]*?>.*?</style>@siU',    // Strip style tags properly
        '@< ![sS]*?--[ tnr]*>@'         // Strip multi-line comments
      );
     
        return preg_replace($search, '', $input);
    }

    private function escapeSingleQuotes($input)
    {
        $pattern = array(); 
        $pattern[0] = "/'/";

        $replacement = array();
        $replacement[0] = "''";

        return preg_replace($pattern, $replacement, $input);
    } 

    public function sanitize($input) 
    {
        $output = '';
        if (is_array($input)) 
        {
            foreach($input as $var=>$val) 
            {
                $output[$var] = $this->sanitize($val);
            }
        }
        else 
        {
            if (get_magic_quotes_gpc()) 
            {
                $input = stripslashes($input);
            }
            $input  = $this->cleanInput($input);
            $output = $this->escapeSingleQuotes($input);
        }
        return $output;
    }
/*FOR CLEAN INPUTS AND PREVENT SOME INJECTION*/
}
?>
<?php
/**
* Copyright (c) 2013 Gabriel Ferreira <gabrielinuz@gmail.com>. All rights reserved. 
* This file is part of COMPSET.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/
interface SessionHandlerInterface
{
    public function start();
    public function set($key, $value);
    public function get($key);
    public function delete($key);
    public function destroy();
}
?>

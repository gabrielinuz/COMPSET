<?php
/**
* Copyright (c) 2013 Gabriel Ferreira <gabrielinuz@gmail.com>. All rights reserved. 
* This file is part of COMPSET.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

if ( !defined('CT_LANGUAGE') ) define('CT_LANGUAGE', 'en');

switch (CT_LANGUAGE) 
{
    /*SPANISH*/
    case 'es':
        /*VALIDATIONS MESSAGES*/
        define('CT_EXCEEDED_CHARS', 'El siguiente dato ha superado el número de caracteres permitidos: ');
        define('CT_REQUIRED_FIELD', 'Este dato es requerido');
        define('CT_VALID_EMAIL', 'El formato de mail debe ser: xxxx@xxxx.xxx');
        define('CT_REQUIRED_VALID_DATE', 'El formato de fecha requerido debe ser: xx/xx/xxxx');
        define('CT_CONFIRM_DELETE', '¿Está seguro de borrar a...? ');
    break;

    /*ENGLISH*/
    case 'en':
        /*VALIDATIONS MESSAGES*/
        define('CT_EXCEEDED_CHARS', 'The following datum has exceeded the number of characters allowed: ');
        define('CT_REQUIRED_FIELD', 'This datum is required.');
        define('CT_VALID_EMAIL', 'The valid email format must be: xxxx@xxxx.xxx');
        define('CT_REQUIRED_VALID_DATE', 'The valid date format must be: xx/xx/xxxx');
        define('CT_CONFIRM_DELETE', 'Are you sure to delete ...?');
    break;
}
?>
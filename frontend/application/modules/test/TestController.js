/**
* Copyright (c) 2016 Gabriel Ferreira <gabrielinuz@gmail.com>. All rights reserved. 
* This file is part of COMPSET.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

define(['libraries/Request/Request', 'modules/test/TestView'], 
    function (Request, TestView) 
    {
        function run() 
        {
            Request.path = 'backend/main.php';
            Request.callback = TestView;
            Request.appendParameter('action', 'test/TestAction');
            Request.appendParameter('user', 'admin');
            Request.appendParameter('password', '12345');
            Request.send();
        }

        return { run:run };
    }
);
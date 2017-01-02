/**
* Copyright (c) 2016 Gabriel Ferreira <gabrielinuz@gmail.com>. All rights reserved. 
* This file is part of COMPSET.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

define(['libraries/Request/Request', 'modules/test/TestDatabaseView'], 
    function (Request, TestDatabaseView) 
    {
        function run() 
        {
            // Request.user = 'guest';
            // Request.password = '12345';
            Request.path = 'backend/main.php';
            Request.callback = TestDatabaseView;
            Request.appendParameter('action', 'test/TestDatabase');
            Request.appendParameter('user', 'admin');
            Request.appendParameter('password', '12345');
            Request.send();
        }

        return { run:run };
    }
);
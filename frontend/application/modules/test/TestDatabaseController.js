/**
* Copyright (c) 2016 Gabriel Ferreira <gabrielinuz@gmail.com>. All rights reserved. 
* This file is part of COMPSET.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

define(['libraries/RequestWrapper/RequestWrapper', 'modules/test/TestDatabaseView'], 
    function (RequestWrapper, TestDatabaseView) 
    {
        function run() 
        {
            var request = new RequestWrapper();
            request.path = 'backend/main.php';
            request.callback = TestDatabaseView;
            request.responseType = 'json';
            request.appendParameter('action', 'test/TestDatabase');
            request.send();
        }

        return { run:run };
    }
);
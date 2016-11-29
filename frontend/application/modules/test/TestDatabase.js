/**
* Copyright (c) 2016 Gabriel Ferreira <gabrielinuz@gmail.com>. All rights reserved. 
* This file is part of COMPSET.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

define(['libraries/RequestWrapper/RequestWrapper'], function (RequestWrapper) 
{
    // document.addEventListener('DOMContentLoaded', function () 
    // {
    function run() 
    {
        function render(response)
        {
            var table = document.createElement('table');
            var th = document.createElement('th');
            for( i = 0; i < response.length; i++)
            {
                var tr = document.createElement('tr');
                var td = document.createElement('td');
                var text = document.createTextNode(response[i].username);
                td.appendChild(text);
                tr.appendChild(td);
                table.appendChild(tr);
            }

            document.getElementById('container').innerHTML = '';//clear
            document.getElementById('container').appendChild(table);
        }

        var request = new RequestWrapper();
        request.path = 'backend/main.php';
        request.callback = render;
        request.responseType = 'json';
        request.appendParameter('action', 'test/TestDatabase');
        request.send();
    // });  
    }

    return { run:run };
});
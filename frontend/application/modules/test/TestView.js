/**
* Copyright (c) 2016 Gabriel Ferreira <gabrielinuz@gmail.com>. All rights reserved. 
* This file is part of COMPSET.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

define(function () 
{
    return function render(response)
    {
        var table = document.createElement('table');
        table.className = 'table table-bordered table-hover';
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

        var button = document.createElement('button');
        button.id = 'testButton';
        button.className = 'btn btn-primary';
        var buttonName = document.createTextNode('testButton');
        button.appendChild(buttonName);
        document.getElementById('container').appendChild(button);

        button.addEventListener('click', function()
        {        
            require(['modules/test/HelloController'], function(HelloController) 
            {
                HelloController.run();
            });
        });
    };
});
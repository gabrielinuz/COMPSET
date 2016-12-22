/**
* Copyright (c) 2016 Gabriel Ferreira <gabrielinuz@gmail.com>. All rights reserved. 
* This file is part of COMPSET.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

define(function () 
{
    var Request = 
    {
        requestObject: new XMLHttpRequest(), 
        method: 'GET',
        path: '',
        callback: '',
        asynchronous: true,
        responseType: 'json',
        user: null,
        password: null,
        _url: '',
        _parameters: '',

        appendParameter(key, value)
        {
            key = (key) ? key : console.error('The key parameter can not be null!');
            value = (value) ? value : console.error('The value parameter can not be null!');
            this._parameters += key + '=' + value + '&'; 
        },

        _generateUrl()
        {
            this._parameters = this._parameters.slice(0, -1);
            this._url = this.path + '?' + this._parameters;
        },

        send()
        {
            this._generateUrl();   
            this.requestObject.open(this.method, this._url, this.asynchronous, this.user, this.password);
            this.requestObject.send();
            this.requestObject.responseType = this.responseType;

            var self = this;
            this.requestObject.onreadystatechange = function() 
            {
                if (self.requestObject.readyState === 4) 
                {
                    if (self.requestObject.status === 200) 
                    {
                        self.callback(self.requestObject.response);
                    } 
                    else 
                    {
                        console.error(self.requestObject.statusText);
                    }
                }
            };

            this.requestObject.onerror = function() 
            {
                console.error(self.requestObject.statusText);
            };
        }
    };

    return Request;
});
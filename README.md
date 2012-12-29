[![PigRegistry](http://www.koweb.ch/projects/pigregistry/logo.png)](https://github.com/KevinSupertramp/PigRegistry)

PigRegistry, a PHP storage registry who can remember a lot of data... like a pig !


<h2>Basic usage</h2>

1. Include the PigRegistry singleton
```php
	require_once 'PigRegistry.php';
```

2. Get the instance and play !
```php
    $key = 'Hello';
    $value = 'World';
    
    // Store value
    PigRegistry::get_instance()->set($key, $value);
    
    // Get value
    echo PigRegistry::get_instance()->get($key); // World
```


<h2>Advanced usage</h2>
You can use method chaining
```php
    $pig = PigRegistry::get_instance();
    
    $pig->set('key', 'value')
        ->set('key2', 'value2');
        
    echo $pig->get('key2'); // value2
```
Let's create a tree !
```php
    $pig = PigRegistry::get_instance();
    
    $pig->set('MyRouter', 'controller', 'page');
    $pig->set('MyRouter', 'view', 'index');
    
    echo $pig->get('MyRouter', 'controller'); // page
    echo $pig->get('MyRouter', 'view'); // index
```
You can use parameters as many you want
```php
    $pig = PigRegistry::get_instance();
    
    $pig->set('MyStorage', 'MyFramework', 'MyRouter', 'MyController', 'page');

    echo $pig->get('MyStorage', 'MyFramework', 'MyRouter', 'MyController', 'page'); // page
```
Get all values from a key
```php
    $pig = PigRegistry::get_instance();
    
    $pig->set('MyRouter', 'controller', 'page');
    $pig->set('MyRouter', 'view', 'index');

    print_r($pig->get('MyRouter')); // Array ( [controller] => page [view] => index )
```
Get all the storage
```php
    $pig = PigRegistry::get_instance();
    
    $pig->set('MyStorage', 'MyFramework', 'MyRouter', 'MyController', 'page');

    print_r($pig->get()); // Array ( [MyStorage] => Array ( [MyFramework] => Array ( [MyRouter] => Array ( [MyController] => page ) ) ) )
```


<h2>Optionnal parameters</h2>
Disable exception when trying to get a value from inexistant key
```php
    $pig = PigRegistry::get_instance();
    
    $pig->get('key'); // Throw exception : "PigRegistry::get() : I have no value for key "key" sorry."
    
    // Disable exception
    $pig->get('key', false); // Return null
    
    // You can use it to "know" if the storage contains data for a key
    if($pig->get('key', false))
    	echo 'found';
    else
    	echo 'not found'; // not found
```
Get a value by its array position (if the key contans an array as value)
```php
    $pig = PigRegistry::get_instance();
    
	$foo = array('Hello', 'World');
    $pig->set('key', $foo);
    
    echo $pig->get('key', 0); // Hello
    echo $pig->get('key', 1); // World
```


<h2>Author</h2>
Kevin Ryser (29.12.2012). Initially developed for a PHP framework.

Feel free to : contribute, report me any bug and suggestions or whatever :-)


<h2>Copyright and license</h2>
<pre>
New BSD License
---------------

Copyright (C) 2012 Kevin Ryser (http://www.koweb.ch) All rights reserved.

Redistribution and use in source and binary forms, with or without modification,
are permitted provided that the following conditions are met:
* Redistributions of source code must retain the above copyright notice, this
  list of conditions and the following disclaimer.
* Redistributions in binary form must reproduce the above copyright notice, this
  list of conditions and the following disclaimer in the documentation and/or
  other materials provided with the distribution.
* Neither the name of “Koweb” nor the names of its contributors may be used to
  endorse or promote products derived from this software without specific prior
  written permission.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS “AS IS” AND
ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR
ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
(INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON
ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
(INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
</pre>
<?php

/**
 * New BSD License
 * ---------------
 *
 * Copyright (C) 2012 Kevin Ryser (http://www.koweb.ch) All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without modification,
 * are permitted provided that the following conditions are met:
 * * Redistributions of source code must retain the above copyright notice, this
 *   list of conditions and the following disclaimer.
 * * Redistributions in binary form must reproduce the above copyright notice, this
 *   list of conditions and the following disclaimer in the documentation and/or
 *   other materials provided with the distribution.
 * * Neither the name of “Koweb” nor the names of its contributors may be used to
 *   endorse or promote products derived from this software without specific prior
 *   written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS “AS IS” AND
 * ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR
 * ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON
 * ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */

class PigRegistry
{
	private static $_instance = null;
	private $_data = array();

	public static function &get_instance()
	{
		if(is_null(self::$_instance))
			self::$_instance = new PigRegistry;

		return self::$_instance;
	}

	public function set()
	{
	    $num_args = func_num_args();
	    if($num_args < 2)
	    	throw new Exception('PigRegistry::set() : I need at least one key and one value to remember it.');

	    $args = func_get_args();
	    $ar = &$this->_data;

	    for($i = 0; $i < $num_args - 1; ++$i)
	    {
	        $key = $args[$i];
	        if(!isset($ar[$key]))
	        	$ar[$key] = array();

			$ar = &$ar[$key];
	    }

	    if(empty($ar))
	    	$value = $args[$num_args - 1];
	    else
	    {
	    	if(!is_array($ar))
	    		$tmp_array = array($ar);
	    	else
	    		$tmp_array = $ar;

	   		array_push($tmp_array, $args[$num_args - 1]);
	   		$value = $tmp_array;
	   	}

  		$ar = $value;
  		return $this;
	}

	public function get()
	{
	    $num_args = func_num_args();
	    if($num_args < 1)
	    	return $this->_data;

	    $args = func_get_args();
	    $ar = $this->_data;
	    $show_error = true;

	    if(is_bool($args[$num_args - 1]) === true)
	    {
	    	$show_error = $args[$num_args - 1];
	    	array_pop($args);
	    	--$num_args;
	    }
	    else if(is_int($args[$num_args - 1]) === true)
	    {
	    	$element = $args[$num_args - 1];
	    	array_pop($args);
	    	--$num_args;	    	
	    }

	    for($i = 0; $i < $num_args; ++$i)
	    {
	        $key = $args[$i];

	        if(!isset($ar[$key]) or !is_array($ar))
	        	if($show_error)
	        		throw new Exception('PigRegistry::get() : I have no value for key "' . $key . '" sorry.');
	        	else
	        		return null;

	        $ar = &$ar[$key];
	    }

	    if(isset($element))
	    	return $ar[$element];
	    else
	    	return $ar;
	}
}
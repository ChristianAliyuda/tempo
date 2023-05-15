<?php

namespace app\Helpers;
use app\Helpers\Request;
use app\Helpers\View;


/**
 * Class Router
 *
 * @author  Talha tahir <talhabhatti0257@gmail.com>
 * @package app
 */
class Router
{
    public  $getRoutes = [];
    public  $postRoutes = [];
	public  $putRoutes = [];
	public  $deleteRoutes = [];
	public  $matchedRoute = null;
	public $matchedMethod=null;
	public $request;
	
    public function __construct(){
		$this->request=new Request();
    }
	
	public function auth($type,$routes,$redirectPage='/login') {
		$routes($this);
	}
	
	public function getID(){
		$indexes=explode('/', ROUTE);
		if(sizeof($indexes)<2)
			return null;
		return $indexes[sizeof($indexes)-1];
	}
	
	public function variableRoute($url){
		$var=null;
		if(strpos($url,'/{')!==false) {
			if(!$value=$this->getID())
					return $url;
					
			if(strpos($url,'{num}')!==false && is_numeric($value) )
				$var='num';
				
			elseif(strpos($url,'{str}')!==false && is_string($value) )
				$var='str';
				
			elseif(strpos($url,'{any}')!==false )
				$var='any';

			if($var)
				$url=str_replace('/{'.$var.'}',"",$url)."/$value";
		}
		return $url;
	}
	
	public function defineMatchedRoute($route,$method){
		$this->matchedRoute=$route;
		$this->matchedMethod=$method;
		if(!defined('MATCHED_ROUTE')){
			define('MATCHED_ROUTE',$route);
			$backtrace = debug_backtrace();
			if (isset($backtrace[4]['function']) && $backtrace[4]['function'] == 'auth'){
				
				if(strtolower($backtrace[4]['args'][0])=='jwt' || $backtrace[4]['args'][0]=='api'){
					validateJWTAuth();
				}else
					validateSessionAuth($backtrace[4]['args'][0],$backtrace[4]['args'][2] ?? '/login');
			}
			$this->resolve();
		}
	}
	
	public  function listRoute($url, $fn,$type='get'){
		$route=$url;
		$url=$this->variableRoute($url);
        $this->{$type.'Routes'}[$url] = $fn;
		if($url==ROUTE && strtolower($_SERVER['REQUEST_METHOD'])==$type){
			if($route!=$url)
				$this->{$type.'Routes'}[$url]['id'] = $this->getID();
			$this->defineMatchedRoute($route,$type);
		}		
	}
	
	public function get($url, $fn){
		$this->listRoute($url,$fn,'get');
    }
	
	public function post($url, $fn){
		$this->listRoute($url,$fn,'post');
    }
	
	public function put($url, $fn){
		$this->listRoute($url,$fn,'put');
    }
	
	public function delete($url, $fn){
		$this->listRoute($url,$fn,'delete');
    }
	
	public  function view($url,$view,$layout='web',$data=[]){
		if($url==ROUTE){
			if(is_array($layout) && !is_array($data)){
				$temp=$data;
				$data=$layout;
				$layout=$temp;
			}
			if(!$layout)
				View::load($view,$data);
			else
				View::render($view,$data,$layout);
		}
	}

    public function resolve($ROUTE=ROUTE)
    {
        $method = strtolower($_SERVER['REQUEST_METHOD']);
        $url = $ROUTE ?? '/';
		
        if ($method === 'get') {
            $fn = $this->getRoutes[$url] ?? null;
        } else if( strtolower($method)=== 'post' ) {
            $fn = $this->postRoutes[$url] ?? null;
		}
		else if( strtolower($method)=== 'put' ) {
            $fn = $this->putRoutes[$url] ?? null;
		}
		else if( strtolower($method)=== 'delete' ) {
            $fn = $this->deleteRoutes[$url] ?? null;
		}
		
        if (!$fn) {
            echo 'Page not found';
            exit;
		}
	
		if(isset($fn['id']))
		{
			$id=$fn['id'];
			unset($fn['id']);
			if($method === 'get'){
				$obj=new $fn[0];
				$obj->{$fn[1]}($id);
				//print_r(call_user_func($fn, $id));
			}
			else {
				$obj=new $fn[0];	
				$obj->{$fn[1]}($id,$this->request); die;
				//print_r(call_user_func($fn,$this,$id));
			}
		}
		else{
			$obj=new $fn[0];	
			$obj->{$fn[1]}($this->request); die;
			//print_r(call_user_func($fn, $this));
		}
		die;
    }
}
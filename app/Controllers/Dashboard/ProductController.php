<?php namespace app\Controllers\Dashboard;

use app\Controllers\Dashboard\Controller;
use app\Helpers\Request;

class ProductController extends Controller
{
	
	
	public function index(){

		$data=$this->db->where('deleted_at',NULL)->table('products')->get();
		$this->view->render('admin/products', [
			'products'=>$data
        ]);
	}


	public function editproducts()
	{
		$product_id=$_GET['id'];
		$data=$this->db->where('id',$product_id)->first('products');
		$this->view->render('admin/editproduct', [
			'product'=>$data
        ]);
	}

	public function storeproduct(Request $request)
	{
		$request->validate([
			
			'link'=>['req'],
			'thumnail'=>['req'],

		]);
		$payload=$request->validated();
		unset($payload['thumnail']);
		if(isset($_FILES['thumnail']['name']) && $_FILES['thumnail']['name'])
		{
			
		$payload['logo']=$this->helper->uploadFile($_FILES['thumnail'],'uploads/products','image');
		}

		$product=$this->db->table('products')->insert($payload);
		if($product)
		{
			redirectWithMessage('/dashboard/products','Product Added Succeesfuly');
		}
		
	}



	public function updateproduct(Request $request)
	{
		$request->validate([
			
			'link' => ['req','str'],
			

		]);
		$payload=$request->validated();

		unset($payload['thumnail']);
		if(isset($_FILES['thumnail']['name']) && $_FILES['thumnail']['name'])
		{
			
		$payload['logo']=$this->helper->uploadFile($_FILES['thumnail'],'uploads/products','image');
		}
		$product=$this->db->table('products')->where('id',$request->product_id)->update($payload);
		if($product)
		{
			redirectWithMessage('/dashboard/products','Product Updated Succeesfuly');
		}
		
	}


	public function deleteProduct()
	{
		$user_id=$_GET['product_id'];
		$payload['deleted_at']=date('Y-m-d');
		$user=$this->db->table('products')->where('id',$user_id)->update($payload);
		print_r(json_encode("Product Deleted Successfuly"));
		
	}



	public function addproduct()
	{
		
		$this->view->render('admin/addproduct');
	}
	
}

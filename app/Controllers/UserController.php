<?php

namespace app\Controllers;

use app\Controllers\Controller;
use app\Helpers\Request;
use app\Helpers\Response;

class UserController extends Controller
{
	public function index()
	{

		$user_id = $_SESSION['amadox_user_id'];
		$settings = $this->db->first('settings');
		$data = $this->db->where('invitee_id', $user_id)->where('paid', 1)->get('users');
		$user = $this->db->where('id', $user_id)->first('users');
		$this->view->render('team', [
			'users' => $data,
			'leader' => $user,
			'settings' => $settings,
		]);
	}


	public function showUserdetails()
	{

		$user_id = $_GET['id'];
		$data = $this->db->where('id', $user_id)->where('paid', 1)->get('users');
		print_r(json_encode($data));
	}

	public function notification()
	{

		$user_id = $_SESSION['amadox_user_id'];
		$notification = $this->db->where('user_id', $user_id)->orderBy('id', 'desc')->get('notifications');
		$settings = $this->db->first('settings');

		$this->view->render('notification', [
			'notifications' => $notification,
			'settings' => $settings
		]);
	}


	public function updatepassword(Request $request)
	{

		$user_id = $_SESSION['amadox_user_id'];
		$user = $this->db->where('id', $user_id)->first('users');


		$request->validate([
			'old_password' => ['str', 'min:8', 'max:18', 'req'],
			'password' => ['str', 'min:8', 'req'],
			'confirm_password' => ['str', 'min:8', 'req']
		]);

		if ($request->password != $request->confirm_password) {

			redirectWithMessage('/setting', 'Password and Confirm Password is Mismitch!');
		}

		if ($user->password != sha1($request->old_password)) {
			redirectWithMessage('/setting', 'Old Password Is Invalid!');
		}



		$payload['password'] = sha1($request->password);
		$this->db->table('users')->where('id', $user_id)->update($payload);
		redirectWithMessage('/setting', 'Password is Update Successfuly!');
	}


	public function updateAccount(Request $request)
	{
		$request->validate([
			'account_name' => ['str', 'req'],
			'account_title' => ['str', 'req'],
			'account_no' => ['str', 'req']
		]);

		$user_id = $_SESSION['amadox_user_id'];

		$check = $this->db->where('user_id', $user_id)->where('payment_approved', 1)->first('payments_request');
		if ($check) {

			redirectWithMessage('/setting', 'After Take First WithDraw You Can  Not Change Your Account Deatils!');
		}


		$payload['account_no'] = $request->account_no;
		$payload['account_title'] = $request->account_title;
		$payload['account_name'] = $request->account_name;
		$this->db->table('users')->where('id', $user_id)->update($payload);
		redirectWithMessage('/setting', 'Account Number Deatils  is Updated Successfuly!');
	}


	public function updateEmail(Request $request)
	{

		$user_id = $_SESSION['amadox_user_id'];
		$user = $this->db->where('id', $user_id)->first('users');

		// $this->helper->validateCSRF();
		$request->validate([
			'oldemail' => ['str', 'req'],
			'newemail' => ['str', 'req']
		]);


		if ($user->email == $request->oldemail) {
			redirectWithMessage('/setting', 'Old Email  Is Invalid!');
		}


		$payload['email'] = $request->newemail;
		$this->db->table('users')->where('id', $user_id)->update($payload);
		redirectWithMessage('/setting', 'Email is Update Successfuly!');
	}


	public function addlink(Request $request)
	{

		$this->helper->validateCSRF();
		$request->validate([
			'link' => ['req', 'min:3'],
			'description' => ['req', 'min:3'],
		]);

		$user_id = $_SESSION['amadox_user_id'];
		$payload['link'] = $request->link;
		$payload['description'] = $request->description;
		$payload['user_id'] = $_SESSION['amadox_user_id'];

		$already = $this->db->where('user_id', $user_id)->where('mark', 0)->first('link');
		if ($already) {
			redirectWithMessage('/permote', 'Your Link Is Alreay Pending!');
		}
		$user = $this->db->table('link')->insert($payload);
		redirectWithMessage('/permote', 'Your Link Is Send Sucessfuly!');
	}


	public function message()
	{

		$message = $this->db->first('settings');
		$this->view->render('message', [
			'message' => $message
		]);
	}


	public function permote()
	{


		$this->view->render('permote', []);
	}


	public function setting()
	{

		$user_id = $_SESSION['amadox_user_id'];
		$data = $this->db->where('id', $user_id)->first('users');
		$settings = $this->db->first('settings');
		$this->view->render('setting', [
			'setting' => $data,
			'settings' => $settings,

		]);
	}


	public function invite()
	{

		$user_id = $_SESSION['amadox_user_id'];
		$settings = $this->db->first('settings');
		if (isset($_SESSION['amadox_user_id'])) {
			$data = $this->helper->encrypt_decrypt('encrypt', $_SESSION['amadox_user_id']);
			$id = 'https://amadox.co.uk/invite?id=' . $data;
		}
		$user = $this->db->where('id', $user_id)->first('users');
		$this->view->render('invite', [
			'data' => $id,
			'settings' => $settings,
			'leader' => $user
		]);
	}


	public function ads()
	{

		date_default_timezone_set("Asia/Karachi");
		$settings = $this->db->first('settings');
		$tdate = date("Y-m-d");
		$user_id = $_SESSION['amadox_user_id'];
		$user = $this->db->where('id', $user_id)->first('users');
		$levels = $this->db->where('id', $user->level_id)->first('levels');
		$date = date('Y-d-m');
		if ($date != $user->today_date) {

			$user->backend_wallet = $user->backend_wallet + $user->today_reward;
			$percent = ($user->backend_wallet * $levels->first) / 100;
			$usereward['backend_wallet'] = $user->backend_wallet - round($percent, 4);
			$usereward['today_reward'] = round($percent, 4);
			//$usereward['total_credit'] = round($percent, 4);
			$usereward['last_balance'] = round($percent, 4);
			$usereward['today_date'] = $date;
			$this->db->where('id', $user_id)->table('users')->update($usereward);
		}

		$today = $this->db->where('udate', $tdate)->where('user_id', $user_id)->orderBy('id', 'desc')->first('dailytask');
		if (empty($today))
			$task_id = 0;
		else
			$task_id = $today->task_id;

		$data = $this->db->where('id', '>', $task_id)->first('products');
		if (!$data) {
			$sid = 10000000;
		} else
			$sid = '';
		$this->view->render('daily-work', [
			'data' => $data,
			'sid' => $sid,
			'settings' => $settings,
			'user' => $user
		]);
	}



	public function dailybonus()
	{
		date_default_timezone_set("Asia/Karachi");
		$today = date("Y-m-d");

		$id = $_SESSION['amadox_user_id'];
		$data1 = $this->db->where('date', $today)->where('user_id', $id)->first('bonus');

		$data = $this->db->where('user_id', $id)->get('bonus');
		$this->view->render('bonus', [
			'bonus1' => $data1,
			'bonus' => $data
		]);
	}


	public function collectBonus()
	{
		date_default_timezone_set("Asia/Karachi");
		$id = $_SESSION['amadox_user_id'];
		$date = date('Y-m-d');
		$isalready = $this->db->where('user_id', $id)->where('date', $date)->first('bonus');
		$userlevel = $this->db->where('id', $id)->first('users');


		if ($userlevel->level_id < 2) {
			Response::json(['message' => 'level2']);
			die;
		} else if ($isalready) {
			Response::json(['message' => 'Already']);
			die;
		} else if ($isalready) {
			Response::json(['message' => 'withdrawLevel15']);
			die;
		}


		$user = $this->db->where('id', $id)->first('users');
		$level = $this->db->where('id', $user->level_id)->first('levels');
		$userbalace['user_bonus'] = $user->user_bonus + $level->bonus;
		$this->db->table('users')->where('id', $id)->update($userbalace);
		$bonus['user_id'] = $id;
		$bonus['amount'] = $level->bonus;
		$bonus['date'] = date('Y-m-d');
		$this->db->table('bonus')->insert($bonus);
		if ($bonus) {
			print_r(json_encode("Collect"));
		}
	}


	public function sendRequest(Request $request)
	{

		$lowbalance = $this->db->where('id', $_SESSION['amadox_user_id'])->first('users');
		$amount = $lowbalance->amount_pkr;
		date_default_timezone_set("Asia/Karachi");
		$already = $this->db->where('user_id', $_SESSION['amadox_user_id'])->where('payment_approved', 0)->first('payments_request');

		if (empty($lowbalance->account_name) or empty($lowbalance->account_no) or empty($lowbalance->account_title)) {
			Response::json(['message' => 'account2']);
		}

		if ($already) {
			Response::json(['message' => 'Already']);
		}





		$firsttime = $this->db->where('user_id', $_SESSION['amadox_user_id'])->where('payment_approved', 1)->first('payments_request');

		$levels = $this->db->get('levels');

		if ($firsttime) {

			foreach ($levels as $level) {
				if ($level->id == $lowbalance->level_id and $amount < $level->withdraw_limit) {
					$limit = $level->withdraw_limit;
					print_r(json_encode("Payment Request Send Successfully" . "" . $limit));
					die;
				}
			}
		}

		if ($amount < 50 and empty($firsttime)) {
			print_r(json_encode("First Payment Request Limit is 50"));
			die;
		}



		$payload['user_id'] = $_SESSION['amadox_user_id'];
		$payload['amount'] = $amount;
		$payload['updated_at'] = date("Y-m-d H:i:s");
		$user = $this->db->table('payments_request')->insert($payload);

		print_r(json_encode("Payment Request Send Successfully"));
	}


	public function bonussendRequest(Request $request)
	{

		$lowbalance = $this->db->where('id', $_SESSION['amadox_user_id'])->first('users');
		$amount = $lowbalance->user_bonus;
		date_default_timezone_set("Asia/Karachi");
		$already = $this->db->where('user_id', $_SESSION['amadox_user_id'])->first('bonuspayments_request');

		if (empty($lowbalance->account_name) or empty($lowbalance->account_no) or empty($lowbalance->account_title)) {
			Response::json(['message' => 'account2']);
		}


		if ($already and $lowbalance->level_id < 12) {
			Response::json(['message' => 'level15']);
			die;
		}

		$alreadypending = $this->db->where('user_id', $_SESSION['amadox_user_id'])->where('payment_approved', 0)->first('bonuspayments_request');


		if ($alreadypending) {
			Response::json(['message' => 'already']);
			die;
		} else if ($lowbalance->level_id < 7) {
			Response::json(['message' => 'limit']);
			die;
		}


		$alreadybalance = $this->db->where('user_id', $_SESSION['amadox_user_id'])->where('today_date', date("Y-m-d"))->first('bonuspayments_request');

		if ($alreadybalance and $lowbalance->level_id > 11) {
			Response::json(['message' => 'todaylevel12']);
		}
		$payload['user_id'] = $_SESSION['amadox_user_id'];
		$payload['amount'] = $this->convertToPkr();
		$payload['today_date'] = date("Y-m-d");
		$payload['updated_at'] = date("Y-m-d H:i:s");
		$user = $this->db->table('bonuspayments_request')->insert($payload);
		if ($user) {
			Response::json(['message' => 'successfuly']);
		}
	}


	public function convertToPkr()
	{

		$user_id = $_SESSION['amadox_user_id'];
		$user = $this->db->where('id', $user_id)->first('users');
		// $req_url = 'https://v6.exchangerate-api.com/v6/410ffc8130048e33812c5e75/latest/USD';
		// $response_json = file_get_contents($req_url);
		// //print_r($response_json);die;
		// // Continuing if we got a result
		// if (false !== $response_json) {

		// 	// Try/catch for json_decode operation


		// 	// Decoding
		// 	$response = json_decode($response_json);

		// 	// Check for success
		// 	if ('success' === $response->result) {

		// 		// YOUR APPLICATION CODE HERE, e.g.
		// 		$EUR_price = round(($user->user_bonus * $response->conversion_rates->PKR), 2);
		// 	}




		$setting = $this->db->first('settings');
		if ($user->level_id > 11 and  $user->user_bonus > 49) {
			$payload['user_bonus'] = $user->user_bonus - 50;
			$amount = 50;
			$this->db->table('users')->where('id', $user_id)->update($payload);
		} else if ($user->level_id > 11 and  $user->user_bonus < 50) {

			$payload['user_bonus'] = 0;
			$amount = $user->user_bonus;
			$this->db->table('users')->where('id', $user_id)->update($payload);
		} else {
			$payload['user_bonus'] = 0;
			$amount = $user->user_bonus;
			$this->db->table('users')->where('id', $user_id)->update($payload);
		}

		$dollar = round(($amount * $setting->dollar_rate), 2);

		return $dollar;
	}

	public function collectReward()
	{
		date_default_timezone_set("Asia/Karachi");
		$id = $_GET['id'];
		$date = date('Y-m-d');
		$user_id = $_SESSION['amadox_user_id'];
		$alreadycollect = $this->db->where('user_id', $user_id)->where('udate', $date)->where('task_id', $id)->first('dailytask');
		if ($alreadycollect) {
			print_r(json_encode("Already Collect"));
		} else {
			$count = $this->db->where('user_id', $user_id)->where('udate', $date)->first('dailytask');
			$flag = false;
			if ($count == null) {
				$flag = true;
			}
			$this->addbalance($user_id, $flag);
			$payload['user_id'] = $user_id;
			$payload['task_id'] = $id;
			$payload['udate'] = date('Y-m-d');
			$this->db->table('dailytask')->insert($payload);
			$data = $this->db->where('id', '>', $id)->where('deleted_at', NULL)->first('products');
			print_r(json_encode(['message' => 'collect', 'data' => $data]));
		}
	}



	public function addbalance($id, $flag)
	{
		$user_id = $_SESSION['amadox_user_id'];
		$user = $this->db->where('id', $user_id)->first('users');
		$data = $user->last_balance / 15;
		$invteedUser = $this->db->where('id', $id)->first('users');
		$addbalance['today_reward'] = $invteedUser->today_reward - $data;
		if ($flag == true) {
			$addbalance['total_credit'] = $invteedUser->total_credit + ($data*2.25+0.15* $invteedUser->backend_wallet);
		}
		$addbalance['current_amount'] = $invteedUser->current_amount + $data;
		$addbalance['work_earning'] = $invteedUser->work_earning + $data;
		$this->db->table('users')->where('id', $id)->update($addbalance);
	}

	public function profile()
	{

		$user_id = $_SESSION['amadox_user_id'];
		$data = $this->db->join('levels', 'levels.id', 'users.level_id')->where('users.id', $user_id)->first('users');
		$setting = $this->db->first('settings');
		$this->view->render('profile', [
			'user' => $data,
			'settings' => $setting
		]);
	}

	public function wallet()
	{

		$user_id = $_SESSION['amadox_user_id'];
		$settings = $this->db->first('settings');
		$balance = $this->db->where('id', $user_id)->first('users');
		$data = $this->db->where('user_id', $user_id)->orderBy('id', 'desc')->get('payments_request');
		$this->view->render('wallet', [
			'payments' => $data,
			'balance' => $balance,
			'settings' => $settings
		]);
	}
}

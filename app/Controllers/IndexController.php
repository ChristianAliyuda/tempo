<?php

namespace app\Controllers;

use app\Controllers\Controller;
use app\Helpers\Request;
use app\Helpers\Response;

class IndexController extends Controller
{
	public function index()
	{

		$user_id = $_SESSION['amadox_user_id'];
		$settings = $this->db->first('settings');
		$user = $this->db->where('id', $user_id)->first('users');
		$this->view->render('index', [
			'settings' => $settings,
			'user' => $user
		]);
	}



	public function oldwaiting()
	{
		$user_id = $_SESSION['amadox_user_id'];
		$settings = $this->db->first('settings');
		$user = $this->db->where('id', $user_id)->first('users');
		if ($user->paid == 1 and $user->old == 0) {
			redirect('/');
		}
		$this->view->render('waiting', [
			'settings' => $settings,
			'user' => $user
		]);
	}



	public function waiting()
	{
		$user_id = $_SESSION['amadox_user_id'];
		$settings = $this->db->first('settings');
		$user = $this->db->where('id', $user_id)->first('users');
		if ($user->paid == 1) {
			redirect('/');
		}
		if ($user->txtid_rejected == 1) {
			redirect('/verify');
		}
		$this->view->render('waiting', [
			'settings' => $settings,
			'user' => $user
		]);
	}

	public function blocked()
	{
		$user_id = $_SESSION['amadox_user_id'];
		$user = $this->db->where('id', $user_id)->first('users');
		if ($user->blocked == 0) {
			redirect('/');
		}
		$this->view->render('blocked', [
			'user' => $user
		]);
	}

	public function agrement()
	{
		$user_id = $_SESSION['amadox_user_id'];
		$settings = $this->db->first('settings');
		$user = $this->db->where('id', $user_id)->first('users');
		$this->view->render('agreement', [
			'settings' => $settings,
			'user' => $user
		]);
	}


	public function updateAgrement()
	{
		$payload['agrement'] = 1;
		$user_id = $_SESSION['amadox_user_id'];
		$this->db->table('users')->where('id', $user_id)->update($payload);
		redirect('/verify');
	}


	public function history()
	{

		$user_id = $_SESSION['amadox_user_id'];
		$settings = $this->db->first('settings');
		$payment = $this->db->where('user_id', $user_id)->get('bonuspayments_request');
		$this->view->render('bonushistory', [
			'settings' => $settings,
			'payments' => $payment
		]);
	}

	public function amazon()
	{

		$user_id = $_SESSION['amadox_user_id'];
		$settings = $this->db->first('settings');

		$this->view->render('CTA', [
			'settings' => $settings,

		]);
	}


	public function convertToPkr()
	{

		$user_id = $_SESSION['amadox_user_id'];
		$user = $this->db->where('id', $user_id)->first('users');
		// $req_url = 'https://v6.exchangerate-api.com/v6/410ffc8130048e33812c5e75/latest/USD';
		// $response_json = file_get_contents($req_url);
		$userlimt = $this->db->table('payments_request')->where('user_id', $user_id)->where('payment_approved', 1)->count();
		$already = $this->db->where('user_id', $_SESSION['amadox_user_id'])->where('payment_approved', 0)->first('payments_request');
		if ($already) {
			Response::json(['message' => 'Already']);
			die;
		}
		if ($userlimt == 0 and $user->current_amount < 0.50) {
			$notifications['description'] = "You Can Not Withdraw Less Than 0.50£";
			$notifications['user_id'] = $user_id;
			$this->db->table('notifications')->insert($notifications);
			Response::json(['message' => 'limit1']);
			die;
		} else if ($userlimt == 1 and $user->current_amount < 1) {
			$notifications['description'] = "You Can Not Withdraw Less Than 1£";
			$notifications['user_id'] = $user_id;
			$this->db->table('notifications')->insert($notifications);
			Response::json(['message' => 'limit2']);
			die;
		} else if ($userlimt == 2 and $user->current_amount < 2) {
			$notifications['description'] = "You Can Not Withdraw Less Than 2£";
			$notifications['user_id'] = $user_id;
			$this->db->table('notifications')->insert($notifications);
			Response::json(['message' => 'limit3']);
			die;
		} else if ($userlimt > 2 and $user->current_amount < 3) {
			$notifications['description'] = "You Can Not Withdraw Less Than 3£";
			$notifications['user_id'] = $user_id;
			$this->db->table('notifications')->insert($notifications);
			Response::json(['message' => 'limit4']);
			die;
		}
		//print_r($response_json);die;
		// Continuing if we got a result
		// if (false !== $response_json) {

		// 	// Try/catch for json_decode operation


		// 	// Decoding
		// 	$response = json_decode($response_json);

		// 	// Check for success
		// 	if ('success' === $response->result) {

		// 		// YOUR APPLICATION CODE HERE, e.g.
		// 		$EUR_price = round(($user->current_amount * $response->conversion_rates->PKR), 2);
		// 	}

		$setting = $this->db->first('settings');

		$EUR_price = round(($user->current_amount * $setting->dollar_rate), 2);

		$payload['amount_pkr'] = $user->amount_pkr + $EUR_price;
		$this->db->table('users')->where('id', $user_id)->update($payload);
		$this->sendRequest();
		print_r(json_encode($EUR_price));
	}

	public function sendRequest()
	{

		$lowbalance = $this->db->where('id', $_SESSION['amadox_user_id'])->first('users');
		$amount = $lowbalance->current_amount;
		date_default_timezone_set("Asia/Karachi");


		if (empty($lowbalance->account_name) or empty($lowbalance->account_no) or empty($lowbalance->account_title)) {
			Response::json(['message' => 'account2']);
			die;
		}



		$firsttime = $this->db->where('user_id', $_SESSION['amadox_user_id'])->where('payment_approved', 1)->first('payments_request');

		$levels = $this->db->get('levels');




		$payload['user_id'] = $_SESSION['amadox_user_id'];
		$payload['amount'] = $amount;
		$payload['updated_at'] = date("Y-m-d H:i:s");
		$user = $this->db->table('payments_request')->insert($payload);
	}

	public function updateverify(Request $request)
	{


		$payload['txt_id'] = $request->txt_id;
		$payload['sender_no'] = $request->sender_no;
		$payload['txtid_rejected'] = 0;
		$user_id = $_SESSION['amadox_user_id'];
		$payload['txt_id'] = $request->txt_id;

		$userdetail = $this->db->where('id', $user_id)->first('users');

		if ($userdetail->old == 1) {
			$payload['old'] = 2;
		}

		if (strlen($request->txt_id) < 11 or strlen($request->txt_id) > 12) {

			redirectWithMessage('/verify', 'Please Enter Valid Trx Id!');
		}

		$alreadysender = $this->db->where('sender_no', $payload['sender_no'])->where('paid', 1)->first('users');

		if ($alreadysender) {

			redirectWithMessage('/verify', 'This Sender No Already Register!');
		}

		$already = $this->db->where('txt_id', $payload['txt_id'])->where('txtid_rejected', 0)->first('users');

		if ($already) {
			redirectWithMessage('/verify', 'Trx Id Is  Already Used!');
		}
		$this->db->table('users')->where('id', $user_id)->update($payload);
		redirectWithMessage('/verify', 'Trx Id Update Successfuly!');
	}

	public function digitSwitch($no)
	{
		switch ($no) {
			case 1:
				$value = 'one';
				break;

			case 2:
				$value = 'two';
				break;
			case 3:
				$value = 'three';
				break;
			case 4:
				$value = 'four';
				break;

			case 5:
				$value = 'five';
				break;

			case 6:
				$value = 'six';
				break;
			case 7:
				$value = 'seven';
				break;

			case 8:
				$value = 'eight';
				break;

			case 9:
				$value = 'nine';
				break;

			case 10:
				$value = 'ten';
				break;
		}
		return $value;
	}



	public function about()
	{

		// $settings = $this->db->first('settings');
		// $data = [];
		// $no = $settings->last_account_no;
		// if (date("H:i:s") < date("H:i:s", strtotime($settings->last_account_time) + 60 * (60 * $settings->change_hour))) {

		// 	switch ($no) {
		// 		case 1:
		// 			$data['account_no'] = $accounts->account_no_one;
		// 			$data['account_name'] = $accounts->account_name_one;
		// 			break;

		// 		case 2:
		// 			$data['account_no'] = $accounts->account_no_two;
		// 			$data['account_name'] = $accounts->account_name_two;
		// 			break;
		// 		case 3:
		// 			$data['account_no'] = $accounts->account_no_three;
		// 			$data['account_name'] = $accounts->account_name_three;
		// 			break;
		// 		case 4:
		// 			$data['account_no'] = $accounts->account_no_four;
		// 			$data['account_name'] = $accounts->account_name_four;
		// 			break;

		// 		case 5:
		// 			$data['account_no'] = $accounts->account_no_five;
		// 			$data['account_name'] = $accounts->account_name_five;
		// 			break;

		// 		case 6:
		// 			$data['account_no'] = $accounts->account_no_six;
		// 			$data['account_name'] = $accounts->account_name_six;
		// 			break;

		// 		case 7:
		// 			$data['account_no'] = $accounts->account_no_seven;
		// 			$data['account_name'] = $accounts->account_name_seven;
		// 			break;

		// 		case 8:
		// 			$data['account_no'] = $accounts->account_no_eight;
		// 			$data['account_name'] = $accounts->account_name_eight;
		// 			break;

		// 		case 9:
		// 			$data['account_no'] = $accounts->account_no_nine;
		// 			$data['account_name'] = $accounts->account_name_nine;
		// 			break;

		// 		case 10:
		// 			$data['account_no'] = $accounts->account_no_ten;
		// 			$data['account_name'] = $accounts->account_name_ten;
		// 			break;
		// 	}
		// } else {
		// 	$updateSetting['last_account_time'] = date('H:i:s');
		// 	$no = $no + 1;
		// 	$digit = $this->digitSwitch($no);
		// 	while ($accounts->{'account_status_' . $digit} == 0) {
		// 		$no = $no + 1;
		// 		if ($no == 11) {
		// 			$no = 1;
		// 		}
		// 		$digit = $this->digitSwitch($no);
		// 	}
		// 	$updateSetting['last_account_no'] = $no;
		// 	$data['account_no'] = $accounts->{'account_no_' . $digit};
		// 	$data['account_name'] = $accounts->{'account_name_' . $digit};
		// 	$this->db->table('settings')->where('id', 1)->update($updateSetting);
		// }
		// $accounts = $this->db->first('accounts');

		$this->view->render('about');
	}

	public function contacts()
	{
		$user_id = $_SESSION['amadox_user_id'];
		$user = $this->db->where('id', $user_id)->first('users');
		$data = $this->db->first('settings');

		$this->view->render('contacts', [
			'settings' => $data,
			'user' => $user
		]);
	}

	public function verify()
	{

		$user_id = $_SESSION['amadox_user_id'];

		$user = $this->db->where('id', $user_id)->first('users');
		$settings = $this->db->first('settings');
		$accounts = $this->db->first('accounts');


		$data = [];
		$no = $settings->last_account_no;
		$digit = $this->digitSwitch($no);
		if (date("H:i:s") < date("H:i:s", strtotime($settings->last_account_time) + 60 * ($settings->change_hour)) && $accounts->{'account_status_' . $digit} == 1) {

			switch ($no) {
				case 1:
					$data['account_no'] = $accounts->account_no_one;
					$data['account_name'] = $accounts->account_name_one;
					break;

				case 2:
					$data['account_no'] = $accounts->account_no_two;
					$data['account_name'] = $accounts->account_name_two;
					break;
				case 3:
					$data['account_no'] = $accounts->account_no_three;
					$data['account_name'] = $accounts->account_name_three;
					break;
				case 4:
					$data['account_no'] = $accounts->account_no_four;
					$data['account_name'] = $accounts->account_name_four;
					break;

				case 5:
					$data['account_no'] = $accounts->account_no_five;
					$data['account_name'] = $accounts->account_name_five;
					break;

				case 6:
					$data['account_no'] = $accounts->account_no_six;
					$data['account_name'] = $accounts->account_name_six;
					break;
				case 7:
					$data['account_no'] = $accounts->account_no_seven;
					$data['account_name'] = $accounts->account_name_seven;
					break;

				case 8:
					$data['account_no'] = $accounts->account_no_eight;
					$data['account_name'] = $accounts->account_name_eight;
					break;

				case 9:
					$data['account_no'] = $accounts->account_no_nine;
					$data['account_name'] = $accounts->account_name_nine;
					break;

				case 10:
					$data['account_no'] = $accounts->account_no_ten;
					$data['account_name'] = $accounts->account_name_ten;
					break;
			}
		} else {
			$updateSetting['last_account_time'] = date('H:i:s');
			$no = $no + 1;
			if ($no > 10) {
				$no = 1;
			}
			$digit = $this->digitSwitch($no);
			while ($accounts->{'account_status_' . $digit} == 0) {
				$no = $no + 1;
				if ($no > 10) {
					$no = 1;
				}
				$digit = $this->digitSwitch($no);
			}
			$updateSetting['last_account_no'] = $no;
			$data['account_no'] = $accounts->{'account_no_' . $digit};
			$data['account_name'] = $accounts->{'account_name_' . $digit};
			$this->db->table('settings')->where('id', 1)->update($updateSetting);
		}


        if ($user->blocked == 1) {
			redirect('/blocked');
		}
		else if ($user->paid == 0 and $user->txt_id != NULL and $user->txtid_rejected == 0) {
			redirect('/waiting');
		} else if ($user->paid == 1 and $user->fees_pay == 3) {
			redirect('/oldverify');
		} else if ($user->paid == 1 and $user->fees_pay == 5) {
			redirect('/oldverify');
		}

		$this->view->render('verify', [
			'data' => $settings,
			'user' => $user,
			'dollar' => $settings->dollar_rate,
			'account' => $data
		]);
	}


	public function oldverify()
	{

		$data = $this->db->first('settings');

		$user_id = $_SESSION['amadox_user_id'];

		$user = $this->db->where('id', $user_id)->first('users');
		$setting = $this->db->first('settings');



		if ($user->paid == 1 and $user->old == 2 and $user->txtid_rejected == 0 and $user->fees_pay == 3) {
			redirect('/oldwaiting');
		} else if ($user->paid == 1 and $user->fees_pay == 5) {
			redirect('/');
		}
		$this->view->render('oldverify', [
			'data' => $data,
			'user' => $user,
			'dollar' => $setting->dollar_rate
		]);
	}

	public function convertToPkRs()
	{

		$user_id = $_SESSION['amadox_user_id'];
		$req_url = 'https://v6.exchangerate-api.com/v6/410ffc8130048e33812c5e75/latest/USD';
		$response_json = file_get_contents($req_url);
		//print_r($response_json);die;
		// Continuing if we got a result
		if (false !== $response_json) {

			// Try/catch for json_decode operation


			// Decoding
			$response = json_decode($response_json);

			// Check for success
			if ('success' === $response->result) {

				// YOUR APPLICATION CODE HERE, e.g.
				$EUR_price = round((1 * $response->conversion_rates->PKR), 2);
			}

			return $EUR_price;
		}
	}
}

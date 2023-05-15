<?php

namespace app\Controllers\Dashboard;

use app\Controllers\Dashboard\Controller;
use app\Helpers\Request;

class UserController extends Controller
{



    public function changepassword()
    {


        $this->view->render('admin/changepassword');
    }




    public function updatepassword(Request $request)
    {

        $user_id = $_SESSION['amadox_admin_id'];
        $user = $this->db->where('id', $user_id)->first('admins');

        $this->helper->validateCSRF();
        $request->validate([
            'old_password' => ['str', 'min:8', 'max:18', 'req'],
            'password' => ['str', 'min:8', 'req'],
            'confirm_password' => ['str', 'min:8', 'req']
        ]);

        if ($request->password != $request->confirm_password) {

            redirectWithMessage('changepassword', 'Password and Confirm Password is Mismitch!');
        }

        if ($user->password != sha1($request->old_password)) {
            redirectWithMessage('changepassword', 'Old Password Is Invalid!');
        }

        $payload['password'] = sha1($request->password);
        $this->db->table('admins')->where('id', $user_id)->update($payload);

        redirectWithMessage('changepassword', 'Password is Update Successfuly!');
    }

    public function index()
    {
        $query = "SELECT users.*,invitee.name as invitee_name FROM users
     LEFT JOIN users as invitee ON invitee.id=users.invitee_id
     WHERE users.paid=1  GROUP BY users.id ORDER BY users.txt_id DESC";
        $users = $this->db->getDataWithQuery($query);

        $this->view->render('admin/users', [
            'users' => $users
        ]);
    }

    public function userbonus()
    {
        $query = "SELECT users.invitee_id,users2.name,users2.phone,users2.level_id ,users2.email,users2.current_amount,users2.id,users2.total_credit, COUNT(users.invitee_id) as totateam
FROM users
INNER JOIN users as users2 ON users.invitee_id=users2.id where users.paid=1
GROUP BY users.invitee_id HAVING totateam > 0 ORDER BY totateam DESC limit 300";
        $totalteams = $this->db->getDatawithQuery($query);
        $settings = $this->db->first('settings');
        $this->view->render('admin/userbonus', [
            'totalteams' => $totalteams,
        ]);
    }


    public function todayuser()
    {
        date_default_timezone_set("Asia/Karachi");
        $approved_date = date('Y-m-d');

        $query = "SELECT users.*,invitee.name as invitee_name FROM users
     LEFT JOIN users as invitee ON invitee.id=users.invitee_id
     WHERE users.paid=1 AND users.txtid_rejected=0 AND users.approved_date='$approved_date'
     GROUP BY users.id
     ORDER BY users.txt_id DESC";
        $users = $this->db->getDataWithQuery($query);
        //print_r($users);die;
        $this->view->render('admin/todayuser', [
            'users' => $users
        ]);
    }



    public function easypaisauser()
    {

        $query = "SELECT users.*,invitee.name as invitee_name FROM users
     LEFT JOIN users as invitee ON invitee.id=users.invitee_id
     WHERE users.paid=0 AND users.txtid_rejected=0 AND users.deleted=0 AND users.txt_id IS NOT  NULL
     GROUP BY users.id
     ORDER BY users.txt_id DESC";
        $users = $this->db->getDataWithQuery($query);
        $this->view->render('admin/easypaisausers', [
            'users' => $users
        ]);
    }

    public function rejectedPayment()
    {
        $payment_id = $_GET['payment_id'];
        $payment = $this->db->where('id', $payment_id)->first('payments_request');
        $this->convertToPkr($payment->amount, $payment->user_id);
        $payload['payment_approved'] = 2;
        $notifications['description'] = "Your Payment Requested Rejected With Amount " . $payment->amount;
        $notifications['user_id'] = $payment->user_id;
        $this->db->table('notifications')->insert($notifications);
        $user = $this->db->table('payments_request')->where('id', $payment_id)->update($payload);
        print_r(json_encode("Payment Rejected Successfuly"));
    }

    public function convertToPkr($amount, $user_id)
    {

        $user = $this->db->where('id', $user_id)->first('users');
        // $req_url = 'https://v6.exchangerate-api.com/v6/410ffc8130048e33812c5e75/latest/USD';
        // $response_json = file_get_contents($req_url);
        $userlimt = $this->db->table('payments_request')->where('user_id', $user_id)->where('payment_approved', 1)->count();

        //print_r($response_json);die;
        // Continuing if we got a result
        // if (false !== $response_json) {

        //  // Try/catch for json_decode operation


        //  // Decoding
        //  $response = json_decode($response_json);

        //  // Check for success
        //  if ('success' === $response->result) {

        //      // YOUR APPLICATION CODE HERE, e.g.
        //      $EUR_price = round(($user->amount_pkr / $response->conversion_rates->PKR), 2);
        //  }

        $setting = $this->db->first('settings');

        $EUR_price = round(($amount / $setting->dollar_rate), 2);
        $payload['current_amount'] = $user->current_amount + $EUR_price;
        $payload['total_credit'] = $user->total_credit + $EUR_price;
        $payload['amount_pkr'] = 0;
        $this->db->table('users')->where('id', $user_id)->update($payload);
    }

    public function rejectedBonusPayment()
    {
        $payment_id = $_GET['payment_id'];
        $payment = $this->db->where('id', $payment_id)->first('bonuspayments_request');
        $this->BonusconvertToPkr($payment->amount, $payment->user_id);
        $payload['payment_approved'] = 2;
        $notifications['description'] = "Your Payment Requested Rejected With Amount " . $payment->amount;
        $notifications['user_id'] = $payment->user_id;
        $this->db->table('notifications')->insert($notifications);
        $user = $this->db->table('bonuspayments_request')->where('id', $payment_id)->update($payload);
        print_r(json_encode("Payment Rejected Successfuly"));
    }

    public function BonusconvertToPkr($amount, $user_id)
    {

        $user = $this->db->where('id', $user_id)->first('users');
        // $req_url = 'https://v6.exchangerate-api.com/v6/410ffc8130048e33812c5e75/latest/USD';
        // $response_json = file_get_contents($req_url);
        $userlimt = $this->db->table('payments_request')->where('user_id', $user_id)->where('payment_approved', 1)->count();

        //print_r($response_json);die;
        // Continuing if we got a result
        // if (false !== $response_json) {

        //  // Try/catch for json_decode operation


        //  // Decoding
        //  $response = json_decode($response_json);

        //  // Check for success
        //  if ('success' === $response->result) {

        //      // YOUR APPLICATION CODE HERE, e.g.
        //      $EUR_price = round(($amounts / $response->conversion_rates->PKR), 2);
        //  }

        $setting = $this->db->first('settings');

        $EUR_price = round(($amount / $setting->dollar_rate), 2);

        $payload['user_bonus'] = $user->user_bonus + $EUR_price;
        $payload['user_bonus'] = $user->user_bonus + $EUR_price;

        $this->db->table('users')->where('id', $user_id)->update($payload);
    }


    public function pendingUser()
    {

        $query = "SELECT users.*,invitee.name as invitee_name FROM users
     LEFT JOIN users as invitee ON invitee.id=users.invitee_id
     WHERE users.paid=0 AND users.txtid_rejected=0 AND users.deleted=0 AND users.txt_id IS  NULL
     GROUP BY users.id
     ORDER BY users.txt_id DESC";
        $users = $this->db->getDataWithQuery($query);
        $this->view->render('admin/pendingusers', [
            'users' => $users
        ]);
    }


    public function rejectedUser()
    {

        $query = "SELECT users.*,invitee.name as invitee_name FROM users
     LEFT JOIN users as invitee ON invitee.id=users.invitee_id
     WHERE users.paid=0 AND users.deleted=0 AND users.txtid_rejected=1
     GROUP BY users.id
     ORDER BY users.txt_id DESC";
        $users = $this->db->getDataWithQuery($query);
        $this->view->render('admin/rejectedusers', [
            'users' => $users
        ]);
    }


    public function link()
    {

        $data = $this->db->where('mark', 0)->table('link')->get();
        $this->view->render('admin/link', [
            'links' => $data
        ]);
    }


    public function updatesetting(Request $request)
    {

        $request->validate([
            'register_fees' => ['req', 'string'],
            'easypiasa_no' => ['req', 'str'],
            'about' => ['req'],
            'message2' => ['req'],
            'easypiasa_title' => ['req', 'str'],
            'email' => ['req'],
            'dollar_rate' => ['req'],
            'whatsapp_link' => ['req'],
            'change_hour' => ['req'],
        ]);
        $payload = $request->validated();
        $setting = $this->db->table('settings')->where('id', $request->id)->update($payload);
        if ($setting) {
            redirectWithMessage('/dashboard/setting', 'Setting Update Succeesfuly');
        }
    }

    public function storeuser(Request $request)
    {
        $request->validate([
            'name' => ['req'],
            'gender' => ['req', 'str'],
            'balance' => ['req', 'str']

        ]);
        $payload = $request->validated();

        $user = $this->db->table('withdrawuser')->insert($payload);
        if ($user) {
            redirectWithMessage('/dashboard/withdrawuser', 'User Register Succeesfuly');
        }
    }



    public function updateuser(Request $request)
    {
        $request->validate([
            'email' => ['req', 'email'],
            'name' => ['req', 'str', 'min:3'],
            'phone' => ['req', 'str', 'min:11'],
            'password' => ['str', 'min:6', 'confirmed']

        ]);

        $payload = $request->validated();
        unset($payload['password']);
        if (!empty($request->password)) {
            $payload['password'] = sha1($request->password);
        }



        $user = $this->db->table('users')->where('id', $request->user_id)->update($payload);
        if ($user) {
            redirectWithMessage('/dashboard/users', 'User Update Succeesfuly');
        }
    }

    public function updatewithdrwauser(Request $request)
    {
        $request->validate([
            'name' => ['req'],
            'gender' => ['req'],
            'balance' => ['req'],

        ]);

        $payload = $request->validated();

        $user = $this->db->table('withdrawuser')->where('id', $request->user_id)->update($payload);
        if ($user) {
            redirectWithMessage('/dashboard/withdrawuser', 'User Update Succeesfuly');
        }
    }

    public function editwithdrawuser()
    {
        $user_id = $_GET['id'];
        $data = $this->db->where('id', $user_id)->first('withdrawuser');
        $this->view->render('admin/editwithdrawusery', [
            'user' => $data
        ]);
    }


    public function edituser()
    {
        $user_id = $_GET['id'];
        $data = $this->db->where('id', $user_id)->first('users');
        $this->view->render('admin/edituser', [
            'user' => $data
        ]);
    }

    public function RejectedUsers()

    {
        $user_id = $_GET['user_id'];
        $user_ids = explode(',', $user_id);
        foreach ($user_ids as $user_id) {
            $user = $this->db->where('id', $user_id)->first('users');
            $payload['txtid_rejected'] = 1;
            $user = $this->db->table('users')->where('id', $user_id)->update($payload);
        }
        print_r(json_encode("User Rejected Successfuly"));
    }

    public function approvedUser()
    {
        date_default_timezone_set("Asia/Karachi");
        $user_ids = $_GET['user_id'];
        $user_ids = explode(',', $user_ids);
        $setting = $this->db->first('settings');

        foreach ($user_ids as $user_id) {
            $user = $this->db->where('id', $user_id)->first('users');
            $levels = $this->db->get('levels');
            if (!empty($user->invitee_id)) {
                $payloads['level_id'] = $user->level_id;
                $this->firstbalance($user->invitee_id, $user->id);
                $total = $this->total_team($user->invitee_id);
                $payloads['total_team'] = $total;
                foreach ($levels as $level) {
                    if ($total >= $level->total_team and $total <= $level->total_team2) {
                        $payloads['level_id'] = $level->id;
                    }
                }


                $user = $this->db->table('users')->where('id', $user->invitee_id)->update($payloads);
            }
            $userinvitted = $this->db->where('id', $user_id)->first('users');
            $payload['approved_date'] = date('Y-m-d');
            $payload['paid'] = 1;
            $payload['backend_wallet'] = $userinvitted->backend_wallet + ($setting->register_fees * 15) / 100;
            $user = $this->db->table('users')->where('id', $user_id)->update($payload);
        }
        print_r(json_encode("User Approved Successfuly"));
    }




    public function PaymentsRequest()
    {
        $data = $this->db->select('users.id as user_id,users.name as user_name,users.*,payments_request.*')->join('payments_request', 'users.id', 'payments_request.user_id')->where('payment_approved', 0)->table('users')->get();
        $setting = $this->db->first('settings');
        $this->view->render('admin/payments', [
            'paymnets' => $data,
            'setting' => $setting
        ]);
    }


    public function bonusPaymentsRequest()
    {
        $query = "SELECT users.id as user_id,users.name as user_name,users.*,bonuspayments_request.* FROM users
    Inner JOIN bonuspayments_request  ON bonuspayments_request.user_id=users.id
     WHERE payment_approved=0";
        $data = $this->db->getDataWithQuery($query);
        //$data = $this->db->select('users.id as user_id,users.name as user_name,users.*,bonuspayments_request.*')->count('invitee_id')->join('bonuspayments_request', 'users.id', 'bonuspayments_request.user_id')->where('payment_approved', 0)->table('users')->get();
        //print_r($data);die;
        $this->view->render('admin/bonuspayments', [
            'paymnets' => $data
        ]);
    }




    public function marklink()
    {

        $link_id = $_GET['link_id'];
        $payload['mark'] = 1;
        $user = $this->db->table('link')->where('id', $link_id)->update($payload);
        print_r(json_encode("Link Mark Successfuly"));
    }



    public function approvedPayments()
    {
        $data = $this->db->select('users.id as user_id,users.name as user_name,users.*,payments_request.*')->join('payments_request', 'users.id', 'payments_request.user_id')->where('payment_approved', 1)->table('users')->get();
        //print_r($data);die;
        $this->view->render('admin/approvedpayments', [
            'paymnets' => $data
        ]);
    }

    public function approvedPayment()
    {
        $payment_id = $_GET['payment_id'];
        $payment = $this->db->where('id', $payment_id)->first('payments_request');
        $this->updatebalance($payment->amount, $payment->user_id);
        $payload['payment_approved'] = 1;
        $notifications['description'] = "Your Payment Requested Approved With Amount " . $payment->amount;
        $notifications['user_id'] = $payment->user_id;
        $this->db->table('notifications')->insert($notifications);
        $user = $this->db->table('payments_request')->where('id', $payment_id)->update($payload);
        print_r(json_encode("Payment Approved Successfuly"));
    }

    public function approvedBonusPayment()
    {
        $payment_id = $_GET['payment_id'];

        $payment = $this->db->where('id', $payment_id)->first('bonuspayments_request');
        $payload['payment_approved'] = 1;
        $notifications['description'] = "Your Payment Requested Approved With Amount " . $payment->amount;
        $notifications['user_id'] = $payment->user_id;
        $User = $this->db->where('id', $payment->user_id)->first('users');
        $balance['total_bonus_withdraw'] = $User->total_bonus_withdraw + $payment->amount;
        $this->db->table('users')->where('id', $payment->user_id)->update($balance);
        $this->db->table('notifications')->insert($notifications);
        $user = $this->db->table('bonuspayments_request')->where('id', $payment_id)->update($payload);
        print_r(json_encode("Payment Approved Successfuly"));
    }





    public function updatebalance($amount, $id)
    {

        $User = $this->db->where('id', $id)->first('users');
        if ($User->current_amount < $amount) {
            print_r(json_encode("Payment is Low"));
            die;
        }
        $balance['current_amount'] = $User->current_amount - $amount;
       
        $balance['total_credit'] = $User->total_credit - $amount;
         if($balance['total_credit']<0)
         {
             $balance['total_credit']=0;
         }
        $balance['totalwithdraw'] = $User->totalwithdraw + $amount;
        $this->db->table('users')->where('id', $id)->update($balance);
    }





    public function total_team($id)
    {

        $total = $this->db->table('users')->where('invitee_id', $id)->where('paid', 1)->count();
        return $total + 1;
    }






    public function firstbalance($id, $user_id)
    {


        $setting = $this->db->first('settings');
        $invteedUser = $this->db->where('id', $id)->first('users');
        $teamuser = $this->db->where('id', $user_id)->first('users');
        // $bonuspay = $this->db->where('user_id', $id)->first('bonuspayments_request');
        $levels = $this->db->where('id', $invteedUser->level_id)->first('levels');

        $todayDate = date('Y-m-d');
        if ($invteedUser->team_date != $todayDate) {
            $userTeam['team_date'] = $todayDate;
            $userTeam['today_team'] = 1;
        } else {
            $userTeam['today_team'] = $invteedUser->today_team + 1;
        }
        $this->db->table('users')->where('id', $id)->update($userTeam);
        $addbalance['current_amount'] = $invteedUser->current_amount + ($setting->register_fees * 15) / 100;
        $addbalance['total_credit'] = $invteedUser->total_credit + ($setting->register_fees * 15) / 100;
        $addbalance['refral_earning'] = $invteedUser->refral_earning + ($setting->register_fees * 15) / 100;
        $addbalance['backend_wallet'] = $invteedUser->backend_wallet + ($setting->register_fees * 10) / 100;
        if (empty($bonuspay) and $invteedUser->level_id == 2) {
            $addbalance['user_bonus'] = $invteedUser->user_bonus;
        } else {
            $addbalance['user_bonus'] = $invteedUser->user_bonus + $levels->bonus;
        }
        $notifications['description'] = "New Member " . $teamuser->name . " Added In Your Team";
        $notifications['user_id'] = $invteedUser->id;
        $this->db->table('notifications')->insert($notifications);
        $this->db->table('users')->where('id', $id)->update($addbalance);
        if (!empty($invteedUser->invitee_id)) {
            $secondUser = $this->db->where('invitee_id', $invteedUser->invitee_id)->first('users');
            $this->secondbalance($invteedUser->invitee_id);
        }
    }

    public function AddBalance(Request $request)
    {

        $amount = $request->amount;
        $id = $request->user_id;
        $User = $this->db->where('id', $id)->first('users');
        $balance['current_amount'] = $User->current_amount + $amount;
        $balance['total_credit'] = $User->total_credit + $amount;
        $this->db->table('users')->where('id', $id)->update($balance);
        print_r(json_encode("Add Successfully"));
    }


    public function secondbalance($id)
    {

        $setting = $this->db->first('settings');
        $invteedUser = $this->db->where('id', $id)->first('users');
        $addbalance['backend_wallet'] = $invteedUser->backend_wallet + ($setting->register_fees * 10) / 100;
        $this->db->table('users')->where('id', $id)->update($addbalance);
        if (!empty($invteedUser->invitee_id)) {
            $secondUser = $this->db->where('invitee_id', $invteedUser->invitee_id)->first('users');
            $this->threebalance($invteedUser->invitee_id);
        }
    }


    public function threebalance($id)
    {

        $setting = $this->db->first('settings');
        $invteedUser = $this->db->where('id', $id)->first('users');
        $addbalance['backend_wallet'] = $invteedUser->backend_wallet + ($setting->register_fees * 5) / 100;
        $this->db->table('users')->where('id', $id)->update($addbalance);
        if (!empty($invteedUser->invitee_id)) {
            $secondUser = $this->db->where('invitee_id', $invteedUser->invitee_id)->first('users');
            $this->fourbalance($invteedUser->invitee_id);
        }
    }


    public function fourbalance($id)
    {

        $setting = $this->db->first('settings');
        $invteedUser = $this->db->where('id', $id)->first('users');
        $addbalance['backend_wallet'] = $invteedUser->backend_wallet + ($setting->register_fees * 3) / 100;
        $this->db->table('users')->where('id', $id)->update($addbalance);
        if (!empty($invteedUser->invitee_id)) {
            $secondUser = $this->db->where('invitee_id', $invteedUser->invitee_id)->first('users');
            $this->fivebalance($invteedUser->invitee_id);
        }
    }

    public function fivebalance($id)
    {

        $setting = $this->db->first('settings');
        $invteedUser = $this->db->where('id', $id)->first('users');
        $addbalance['backend_wallet'] = $invteedUser->backend_wallet + ($setting->register_fees * 2) / 100;
        $this->db->table('users')->where('id', $id)->update($addbalance);
        if (!empty($invteedUser->invitee_id)) {
            $secondUser = $this->db->where('invitee_id', $invteedUser->invitee_id)->first('users');
            $this->sixbalance($invteedUser->invitee_id);
        }
    }



    public function sixbalance($id)
    {

        $setting = $this->db->first('settings');
        $invteedUser = $this->db->where('id', $id)->first('users');
        $addbalance['backend_wallet'] = $invteedUser->backend_wallet + ($setting->register_fees * 1) / 100;
        $this->db->table('users')->where('id', $id)->update($addbalance);
    }

    public function deleteUser()
    {
        $user_id = $_GET['user_id'];
        $payload['deleted_at'] = date('Y-m-d');
        $user = $this->db->table('users')->where('id', $user_id)->update($payload);
        print_r(json_encode("User Deleted Successfuly"));
    }

    public function blockUser()
    {
        $user_id = $_GET['user_id'];
        $user = $this->db->where('id', $user_id)->first('users');
        $payload['blocked'] = $user->blocked ? 0 : 1;
        $payload['account_no'] = '00000000000';
        $user = $this->db->table('users')->where('id', $user_id)->update($payload);
        // print_r('yes');
        // die;
        print_r(json_encode("User Blocked Successfuly"));
    }


    public function setting()
    {

        $data = $this->db->table('settings')->first();
        //print_r($data);die;
        $this->view->render('admin/setting', [
            'setting' => $data
        ]);
    }



    public function adduser()
    {

        $this->view->render('admin/adduser');
    }

    public function teambonus()
    {
        date_default_timezone_set("Asia/Karachi");
        $approved_date = date('Y-m-d');
        $users = $this->db->where('paid', 1)->where('approved_date', $approved_date)->get('users');


        foreach ($users as $user) {
            $settings = $this->db->first('bonus_settings');
            $todayDate = date('Y-m-d');
            $updateTotal = [];
            $updateUser = [];
            if ($user->today_team >= $settings->first_team && $user->today_team < $settings->second_team && $user->team_date == $todayDate) {
                $updateUser['current_amount'] = $user->current_amount + $settings->first_bonus;
                $updateUser['total_credit'] = $user->total_credit + $settings->first_bonus;
                $updateTotal['total_bonus'] = $settings->total_bonus + $settings->first_bonus;
            } elseif ($user->today_team >= $settings->second_team && $user->today_team < $settings->third_team && $user->team_date == $todayDate) {
                $updateUser['current_amount'] = $user->current_amount + $settings->second_bonus;
                $updateUser['total_credit'] = $user->total_credit + $settings->second_bonus;
                $updateTotal['total_bonus'] = $settings->total_bonus + $settings->second_bonus;
            } elseif ($user->today_team >= $settings->third_team  && $user->team_date == $todayDate) {
                $updateUser['current_amount'] = $user->current_amount + $settings->third_bonus;
                $updateUser['total_credit'] = $user->total_credit + $settings->third_bonus;
                $updateTotal['total_bonus'] = $settings->total_bonus + $settings->third_bonus;
            }
            if (!empty($updateTotal)) {
                $setting = $this->db->table('bonus_settings')->where('id', 1, '=')->update($updateTotal);
                $this->db->table('users')->where('id', $user->id)->update($updateUser);
            }
            // redirectWithMessage('/dashboard/bonus', 'Team Reward Added Successfully');
        }

        print_r(json_encode("Add Successfully"));
    }

    public function bonus()
    {
        $settings = $this->db->table('bonus_settings')->first();
        $this->view->render('admin/teambonus', [
            'settings' => $settings
        ]);
    }

    public function updateteambonus(Request $request)
    {
        $request->validate([
            'first_team' => ['req'],
            'first_bonus' => ['req'],
            'second_team' => ['req'],
            'second_bonus' => ['req'],
            'third_team' => ['req'],
            'third_bonus' => ['req'],
        ]);
        $payload = $request->validated();
        $accounts = $this->db->table('bonus_settings')->where('id', $request->id)->update($payload);
        if ($accounts) {
            redirectWithMessage('/dashboard/bonus', 'Bonus Settings Update Succeesfuly');
        }
    }

    public function accounts()
    {
        $accounts = $this->db->table('accounts')->first();
        $settings = $this->db->table('settings')->first();
        // print_r($settings);
        // die;
        $this->view->render('admin/accounts', [
            'accounts' => $accounts,
            'settings' => $settings
        ]);
    }

    public function updateAccounts(Request $request)
    {
        $request->validate([
            'account_name_one' => ['req', 'string'],
            'account_no_one' => ['req'],
            'account_status_one' => ['req'],
            'account_name_two' => ['req', 'string'],
            'account_no_two' => ['req'],
            'account_status_two' => ['req'],
            'account_name_three' => ['req', 'string'],
            'account_no_three' => ['req'],
            'account_status_three' => ['req'],
            'account_name_four' => ['req', 'string'],
            'account_no_four' => ['req'],
            'account_status_four' => ['req'],
            'account_name_five' => ['req', 'string'],
            'account_no_five' => ['req'],
            'account_status_five' => ['req'],
            'account_name_six' => ['req', 'string'],
            'account_no_six' => ['req'],
            'account_status_six' => ['req'],
            'account_name_seven' => ['req', 'string'],
            'account_no_seven' => ['req'],
            'account_status_seven' => ['req'],
            'account_name_eight' => ['req', 'string'],
            'account_no_eight' => ['req'],
            'account_status_eight' => ['req'],
            'account_name_nine' => ['req', 'string'],
            'account_no_nine' => ['req'],
            'account_status_nine' => ['req'],
            'account_name_ten' => ['req', 'string'],
            'account_no_ten' => ['req'],
            'account_status_ten' => ['req'],
        ]);
        $payload = $request->validated();
        $accounts = $this->db->table('accounts')->where('id', $request->id)->update($payload);
        if ($accounts) {
            redirectWithMessage('/dashboard/accounts', 'Accounts Update Succeesfuly');
        }
    }
}

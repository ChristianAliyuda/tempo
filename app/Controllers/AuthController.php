<?php

namespace app\Controllers;

use app\Controllers\Controller;
use app\Helpers\Auth;
use app\Helpers\Request;
use app\Helpers\Email;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $this->helper->validateCSRF();
        $request->validate([
            'email' => ['req', 'email'],
            'password' => ['str', 'min:6', 'max:18']
        ]);

        $creds = $request->only(['email', 'password']);
        $user = Auth::attempt($creds);
        if (!$user) {
            redirectBackWithError('Email Or Password Is Incorrect');
        }

        $this->updateteam();

        redirect('/');
    }


    public function updateteam()
{
        $user_id = $_SESSION['amadox_user_id'];
        $payload['total_team']=$this->db->table('users')->where('invitee_id',$user_id)->where('paid',1)->count();
        $this->db->table('users')->where('id', $user_id)->update($payload);
    }


    public function loginpage()
    {
        $this->view->render('login');
    }

    public function signup()
    {
        $data = '';
        if (isset($_GET['id'])) {
            $id = $this->helper->encrypt_decrypt('decrypt', $_GET['id']);
            $data = $this->db->where('id', $id)->first('users');
        }

        $this->view->render('register', ['invitee_id' => $data]);
    }


    public function register(Request $request)
    {
        $this->helper->validateCSRF();

        $request->validate([
            'email' => ['req', 'email'],
            'name' => ['req', 'min:3', 'max:48'],
            'password' => ['str', 'min:8', 'max:18'],
            'address' => ['str', 'req'],
            'account_name' => ['str', 'req'],
            'account_no' => ['str', 'req'],
            'country' => ['str', 'req'],
        ]);

        

        if ($request->password != $request->confirm_password) {
            redirectBackWithError('Password and Confirm Password Is Not Same');
        }

        unset($request->confirm_password);

        if (strlen($request->account_no) != 11) {
            redirectBackWithError('Enter 11 Digit In account_No');
        }

        if ($request->country != "Pakistan") {
            redirectBackWithError('Not Avalibale In Your Country');
        }

        $aleardy = $this->db->where('email', $request->email)->first('users');
        if ($aleardy) {
            redirectBackWithError('Email Is Already Taken');
        }
        $aleardyphone = $this->db->where('phone', $request->account_no)->first('users');
        if ($aleardyphone) {
            redirectBackWithError('Account No Is Already Taken');
        }
        unset($request->password_confirmation);
        $user = $this->db->table('users')->insert(
            $request->except(['password', 'balance'])
                + [
                    'password' => sha1($request->password)
                ]

        );
        Auth::storeSession($user);
        redirect('/');
    }


    public function forgot_password()
    {
        $this->view->render('forgot_password');
    }
    
     public function forgot_email()
    {
        $this->view->render('forget-email');
    }
    
    
     public function forgetEmail(Request $request)
    {
        
        $request->validate([
            'trx_id' => ['req'],
        ]);
        $users = $this->db->where('txt_id', $request->trx_id)->get('users');
        if (!$users) {
            redirectBackWithError('Please Put Correct Txt ID Is Not Found');
        }
        
        $this->view->render('forget-email', ['user' =>$users]);
        
    }


    public function SendForgotEmail(Request $request)
    {
        $email = new Email;
        $this->helper->validateCSRF();
        $request->validate([
            'email' => ['req', 'email'],
        ]);
        $users = $this->db->where('email', $request->email)->get('users');
        if (!$users) {
            redirectBackWithError('Email Is Not Found');
        }
        $_SESSION['email'] = $request->email;
        $email->sendForgetPasswordEmail($request->email);
        redirectWithMessage('/reset_password', 'OTP  Code Send On Your Email');
    }

    public function updatereset_password(Request $request)
    {

        $this->helper->validateCSRF();
        $request->validate([

            'password' => ['str', 'min:6', 'max:18'],
            'otp' => ['req'],
            'email' => ['req'],
        ]);

        if ($request->password != $request->password_confirmation) {
            redirectBackWithError('Password And Confirm Password Is Not Same');
        }

        $expiry = time();
        $otp = $this->db->where('expiry', '<', $expiry)->where('token', $request->otp)->get('reset_tokens');
        if ($otp) {
            redirectBackWithError('Your OTP is Expired');
        }

        $checkotp = $this->db->where('token', $request->otp)->where('email', $request->email)->get('reset_tokens');
        if (!$checkotp) {
            redirectBackWithError('Your OTP is Invlaid');
        }

        $updatepassword['password'] = sha1($request->password);
        $this->db->table('reset_tokens')->where('email', $request->email)->delete();
        $this->db->table('users')->where('email', $request->email)->update($updatepassword);
        redirectWithMessage('/login', 'Your Password Changes Successfully!');
    }

    public function reset_password()
    {
        $this->view->render('reset_password');
    }

    public function logout()
    {
        session_destroy();
        unset($_SESSION);
        redirect('/login');
    }
}
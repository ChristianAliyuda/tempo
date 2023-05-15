<?php

namespace app\Controllers\Dashboard;

use app\Controllers\Dashboard\Controller;

class IndexController extends Controller
{


    public function index()
    {
        date_default_timezone_set("Asia/Karachi");
        $date = date('Y-m-d');
        $startdate = date('Y-m-d') . " 00:00:00";
        $lastdate = date('Y-m-d') . " 23:59:59";
        $setting = $this->db->first('settings');

        $data["users"] = $this->db->table('users')->count();
        $data["approved_users"] = $this->db->table('users')->where('paid', 1)->count();
        $data["pending_users"] = $this->db->table('users')->where('paid', 0)->count();
        $data["total_withdraw"] = $this->db->table('users')->where('paid', 1)->sum('totalwithdraw');
        $data["videos"] = $this->db->table('products')->where('deleted_at', NULL)->count();

        $data["dollar"] = $setting->dollar_rate;
        $data["today_approved"] = $this->db->table('users')->where('approved_date', $date)->count();;


        // $data["today_withdraw"]=$this->db->table('payments_request')->where('created_at',"<",".$lastdate")->where('created_at',">",".$startdate")->sum('amount');
        // echo $data["today_withdraw"];die;



        $query = "SELECT users.invitee_id,users2.name,users2.phone,users2.level_id ,users2.email,users2.current_amount,users2.id,users2.total_credit, COUNT(users.invitee_id) as totateam
FROM users
INNER JOIN users as users2 ON users.invitee_id=users2.id where users.paid=1
GROUP BY users.invitee_id HAVING totateam > 0 ORDER BY totateam DESC limit 300";
        $totalteams = $this->db->getDatawithQuery($query);
        $settings = $this->db->first('settings');
        // print_r($totalteams);
        // die;
        $this->view->render('admin/index', [
            'data' => $data,
            'totalteams' => $totalteams,
            'setting' => $settings
        ]);
    }


    public function cleardata()
    {

        $oneWeeklyAgo = new \DateTime('1 week ago');
        $weeklydate = $oneWeeklyAgo->format('Y-m-d H:i:s');


        $query = "DELETE FROM users where   txt_id IS NULL";
        $users = $this->db->deleteDataWIthQuery($query);
        $data = $this->db->table('settings')->first();
        $this->view->render('admin/setting', [
            'setting' => $data
        ]);
    }

    public function convertToPkRs()
    {


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

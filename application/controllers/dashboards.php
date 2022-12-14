<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboards extends CI_Controller {
    public function index() 
    {   
        $current_user_id = $this->session->userdata('user_id');
        if(!$current_user_id) { 
            redirect("users");
        } 
        else {
            $total = $this->dashboard->total();
            $pending = $this->dashboard->pending();
            $approved = $this->dashboard->approved();
            $cancelled = $this->dashboard->cancelled();
            $po_total = $this->dashboard->po_total();
            $po_pending = $this->dashboard->po_pending();
            $po_approved = $this->dashboard->po_approved();
            $po_cancelled = $this->dashboard->po_cancelled();
            $data = array('total'=>$total, 'pending'=>$pending, 'approved'=>$approved, 'cancel'=>$cancelled, 'po_total'=>$po_total, 'po_pending'=>$po_pending, 'po_approved'=>$po_approved, 'po_cancel'=>$po_cancelled);
            $this->load->view('templates/includes/header');
            $this->load->view('templates/includes/sidebar');
            $this->load->view('admin/dist/index', $data);
            $this->load->view('templates/includes/footer');
        }
    }

    public function users() 
    {
        $result = $this->user->get_all_user();
        $list = array('list' => $result);
        $this->load->view('templates/includes/header');
        $this->load->view('templates/includes/sidebar');
        $this->load->view('admin/dist/list_users',$list);
        $this->load->view('templates/includes/footer');
    }

    public function addusers() 
    {
        $department = $this->dashboard->get_department();
        $data = array('department'=>$department);
        $this->load->view('templates/includes/header');
        $this->load->view('templates/includes/sidebar');
        $this->load->view('admin/dist/add_users', $data);
        $this->load->view('templates/includes/footer');
    }

    public function vendor() 
    {
        $res = $this->vendor->get_allvendor();
        $list = array('list'=> $res);
        $this->load->view('templates/includes/header');
        $this->load->view('templates/includes/sidebar');
        $this->load->view('admin/dist/add_vendor', $list);
        $this->load->view('templates/includes/footer');
    }

    public function item() 
    {
        $res = $this->item->get_allitem();
        $list = array('list'=> $res);
        $this->load->view('templates/includes/header');
        $this->load->view('templates/includes/sidebar');
        $this->load->view('admin/dist/add_item', $list);
        $this->load->view('templates/includes/footer');
    }
    
    public function request() 
    {
        redirect('requests');
    }

    public function pr_details() 
    {
        $date = date("Y-m-d, H:i:s");
        $department = $this->dashboard->get_department();
        $pr_no = $this->request->get_last_pr();
        $create = $this->request->save_pr($pr_no);
        $details = $this->request->get_save_pr($create);
        $this->session->set_userdata('last_save_pr', ''.$create.'');
        $this->session->set_userdata('activity', 'Attepmt to create PR '.$pr_no.'');
        $this->activity->log($this->session->userdata('user_id'));
        $list = array('pr_no' => $create, 'date' => $date, 'details'=>$details, 'department'=>$department);
        $this->load->view('templates/includes/header');
        $this->load->view('templates/includes/sidebar');
        $this->load->view('admin/dist/add_pr', $list);
        $this->load->view('templates/includes/footer');
    }
    
    public function order() 
    {
        $this->load->view('templates/includes/header');
        $this->load->view('templates/includes/sidebar');
        $this->load->view('admin/dist/add_order');
        $this->load->view('templates/includes/footer');
    }

    public function list_request() 
    {
        $result = $this->request->fetch_all_generated_request();
        $list = array('list' => $result);
        $this->load->view('templates/includes/header');
        $this->load->view('templates/includes/sidebar');
        $this->load->view('admin/dist/list_request',$list);
        $this->load->view('templates/includes/footer');
    }
    
    public function list_order() 
    {
        $result = $this->request->fetch_all_generated_order();
        $list = array('list' => $result);
        $this->load->view('templates/includes/header');
        $this->load->view('templates/includes/sidebar');
        $this->load->view('admin/dist/list_order',$list);
        $this->load->view('templates/includes/footer');
    }

    public function list_logs() 
    {
        $result = $this->activity->fetch_all_logs();
        $list = array('list' => $result);
        $this->load->view('templates/includes/header');
        $this->load->view('templates/includes/sidebar');
        $this->load->view('admin/dist/list_logs',$list);
        $this->load->view('templates/includes/footer');
    }

    public function approval_request() 
    {   
        $approver = $this->session->userdata('approver');
        $result = $this->request->fetch_all_request_approval($approver);
        $list = array('list' => $result);
        $this->load->view('templates/includes/header');
        $this->load->view('templates/includes/sidebar');
        $this->load->view('admin/dist/approval_request',$list);
        $this->load->view('templates/includes/footer');
    }
    
    public function approval_order() 
    {   
        $approver = $this->session->userdata('approver');
        $result = $this->request->fetch_all_order_approval($approver);
        $list = array('list' => $result);
        $this->load->view('templates/includes/header');
        $this->load->view('templates/includes/sidebar');
        $this->load->view('admin/dist/approval_order',$list);
        $this->load->view('templates/includes/footer');
    }

    
    public function report() 
    {   
        $dtable = $this->report->daily_table();
        $po_dtable = $this->report->po_daily_table();
        $wtable = $this->report->weekly_table();
        $po_wtable = $this->report->po_weekly_table();
        $mtable = $this->report->monthly_table();
        $po_mtable = $this->report->po_monthly_table();
        $yytable = $this->report->yearly_table();
        $po_yytable = $this->report->po_yearly_table();
        $data = array('dtable'=>$dtable, 'po_dtable'=>$po_dtable, 'wtable'=>$wtable, 'po_wtable'=>$po_wtable, 'mtable'=>$mtable, 'po_mtable'=>$po_mtable, 'yytable'=>$yytable, 'po_yytable'=>$po_yytable);

        $dchart = $this->report->daily_chart();
        $ychart = $this->report->ydaily_chart();
        $wchart = $this->report->weekly_chart();
        $wmax = $this->report->weekly_max();
        $mchart = $this->report->monthly_chart();
        $mmax = $this->report->monthly_max();
        $yychart = $this->report->yearly_chart();
        $yymax = $this->report->yearly_max();
        $ynow = $this->report->yearnow();
        $pynow = $this->report->pyearnow();
        $ynow2 = $this->report->yearnow2();
        $pynow2 = $this->report->pyearnow2();
        $ynow3 = $this->report->yearnow3();
        $pynow3 = $this->report->pyearnow3();
        $ynow4 = $this->report->yearnow4();
        $pynow4 = $this->report->pyearnow4();
        $ynow5 = $this->report->yearnow5();
        $pynow5 = $this->report->pyearnow5();
        $ynow6 = $this->report->yearnow6();
        $pynow6 = $this->report->pyearnow6();
        $ynow7 = $this->report->yearnow7();
        $pynow7 = $this->report->pyearnow7();
        $ynow8 = $this->report->yearnow8();
        $pynow8 = $this->report->pyearnow8();
        $ynow9 = $this->report->yearnow9();
        $pynow9 = $this->report->pyearnow9();
        $ynow10 = $this->report->yearnow10();
        $pynow10 = $this->report->pyearnow10();
        $ynow11 = $this->report->yearnow11();
        $pynow11 = $this->report->pyearnow11();
        $ynow12 = $this->report->yearnow12();
        $pynow12 = $this->report->pyearnow12();
        $ynow13 = $this->report->yearnow13();
        $pynow13 = $this->report->pyearnow13();
        $ynow14 = $this->report->yearnow14();
        $pynow14 = $this->report->pyearnow14();
        $ynow15 = $this->report->yearnow15();
        $pynow15 = $this->report->pyearnow15();
        $chart = array('wchart'=>$wchart, 'wmax'=>$wmax, 'dchart'=>$dchart, 'ychart'=>$ychart, 'mchart'=>$mchart, 'mmax'=>$mmax, 'yychart'=>$yychart, 'yymax'=>$yymax, 'ynow'=>$ynow, 'pynow'=>$pynow, 'ynow2'=>$ynow2, 'pynow2'=>$pynow2, 'ynow3'=>$ynow3, 'pynow3'=>$pynow3, 'ynow4'=>$ynow4, 'pynow4'=>$pynow4, 'ynow5'=>$ynow5, 'pynow5'=>$pynow5, 'ynow6'=>$ynow6, 'pynow7'=>$pynow7, 'ynow8'=>$ynow8, 'pynow8'=>$pynow8, 'ynow10'=>$ynow10, 'pynow10'=>$pynow10, 'ynow11'=>$ynow11, 'pynow11'=>$pynow11, 'ynow12'=>$ynow12, 'pynow12'=>$pynow12, 'ynow13'=>$ynow13, 'pynow13'=>$pynow13, 'ynow14'=>$ynow14, 'pynow14'=>$pynow14, 'ynow15'=>$ynow15, 'pynow15'=>$pynow15, 'ynow9'=>$ynow9, 'pynow9'=>$pynow9, 'ynow7'=>$ynow7, 'pynow6'=>$pynow6);

        $this->load->view('templates/includes/header');
        $this->load->view('templates/includes/sidebar');
        $this->load->view('admin/dist/view_report',$data);
        $this->load->view('templates/includes/footer',$chart);
    }

    public function logoff() 
    {
        $this->session->sess_destroy();
        $this->session->set_userdata('activity', ''.$this->session->userdata('firstname').' successfully logged out');
        $this->activity->log($this->session->userdata('user_id'));
        redirect("users");   
    }

    
}

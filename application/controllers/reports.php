<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Reports extends CI_Controller {

    public function export_csv_drequests(){ 
		$fileName = 'daily_requests.xlsx';  
		$employeeData = $this->report->daily_table();
		$spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
       	$sheet->setCellValue('A1', 'PR No.');
        $sheet->setCellValue('B1', 'Department');
        $sheet->setCellValue('C1', 'Description');
        $sheet->setCellValue('D1', 'Total Price');
	    $sheet->setCellValue('E1', 'Created At');      
        $rows = 2;
        foreach ($employeeData as $val){
            $sheet->setCellValue('A' . $rows, $val['pr_no']);
            $sheet->setCellValue('B' . $rows, $val['department']);
            $sheet->setCellValue('C' . $rows, $val['description']);
            $sheet->setCellValue('D' . $rows, $val['total_price']);
	        $sheet->setCellValue('E' . $rows, date('M-d-Y', strtotime($val['created_at'])));
            $rows++;
        } 
        $writer = new Xlsx($spreadsheet);
		$writer->save("assets/files/".$fileName);
		header("Content-Type: application/vnd.ms-excel");
        $this->session->set_userdata('activity', 'export daily requests');
        $this->activity->log($this->session->userdata('user_id'));
        redirect("/assets/files/".$fileName);        
	}

    public function export_csv_dorders(){ 
		$fileName = 'daily_orders.xlsx';  
		$employeeData = $this->report->po_daily_table();
		$spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'PO No.');
        $sheet->setCellValue('B1', 'PR No.');
        $sheet->setCellValue('C1', 'Department');
        $sheet->setCellValue('D1', 'Description');
        $sheet->setCellValue('E1', 'Total Price');
	    $sheet->setCellValue('F1', 'Created At');      
        $rows = 2;
        foreach ($employeeData as $val){
            $sheet->setCellValue('A' . $rows, $val['order_no']);
            $sheet->setCellValue('B' . $rows, $val['pr_no']);
            $sheet->setCellValue('C' . $rows, $val['department']);
            $sheet->setCellValue('D' . $rows, $val['description']);
            $sheet->setCellValue('E' . $rows, $val['total_price']);
	        $sheet->setCellValue('F' . $rows, date('M-d-Y', strtotime($val['created_at'])));
            $rows++;
        } 
        $writer = new Xlsx($spreadsheet);
		$writer->save("assets/files/".$fileName);
		header("Content-Type: application/vnd.ms-excel");
        $this->session->set_userdata('activity', 'export daily orders');
        $this->activity->log($this->session->userdata('user_id'));
        redirect("/assets/files/".$fileName);        
	}

    public function export_csv_wrequests(){ 
		$fileName = 'weekly_requests.xlsx';  
		$employeeData = $this->report->weekly_table();
		$spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
       	$sheet->setCellValue('A1', 'PR No.');
        $sheet->setCellValue('B1', 'Department');
        $sheet->setCellValue('C1', 'Description');
        $sheet->setCellValue('D1', 'Total Price');
	    $sheet->setCellValue('E1', 'Created At');      
        $rows = 2;
        foreach ($employeeData as $val){
            $sheet->setCellValue('A' . $rows, $val['pr_no']);
            $sheet->setCellValue('B' . $rows, $val['department']);
            $sheet->setCellValue('C' . $rows, $val['description']);
            $sheet->setCellValue('D' . $rows, $val['total_price']);
	        $sheet->setCellValue('E' . $rows, date('M-d-Y', strtotime($val['created_at'])));
            $rows++;
        } 
        $writer = new Xlsx($spreadsheet);
		$writer->save("assets/files/".$fileName);
		header("Content-Type: application/vnd.ms-excel");
        $this->session->set_userdata('activity', 'export weekly requests');
        $this->activity->log($this->session->userdata('user_id'));
        redirect("/assets/files/".$fileName);        
	}
    
    public function export_csv_worders(){ 
		$fileName = 'weekly_orders.xlsx';  
		$employeeData = $this->report->po_weekly_table();
		$spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'PO No.');
        $sheet->setCellValue('B1', 'PR No.');
        $sheet->setCellValue('C1', 'Department');
        $sheet->setCellValue('D1', 'Description');
        $sheet->setCellValue('E1', 'Total Price');
	    $sheet->setCellValue('F1', 'Created At');      
        $rows = 2;
        foreach ($employeeData as $val){
            $sheet->setCellValue('A' . $rows, $val['order_no']);
            $sheet->setCellValue('B' . $rows, $val['pr_no']);
            $sheet->setCellValue('C' . $rows, $val['department']);
            $sheet->setCellValue('D' . $rows, $val['description']);
            $sheet->setCellValue('E' . $rows, $val['total_price']);
	        $sheet->setCellValue('F' . $rows, date('M-d-Y', strtotime($val['created_at'])));
            $rows++;
        } 
        $writer = new Xlsx($spreadsheet);
		$writer->save("assets/files/".$fileName);
		header("Content-Type: application/vnd.ms-excel");
        $this->session->set_userdata('activity', 'export weekly orders');
        $this->activity->log($this->session->userdata('user_id'));
        redirect("/assets/files/".$fileName);        
	}

    public function export_csv_mrequests(){ 
		$fileName = 'monthly_requests.xlsx';  
		$employeeData = $this->report->monthly_table();
		$spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
       	$sheet->setCellValue('A1', 'PR No.');
        $sheet->setCellValue('B1', 'Department');
        $sheet->setCellValue('C1', 'Description');
        $sheet->setCellValue('D1', 'Total Price');
	    $sheet->setCellValue('E1', 'Created At');      
        $rows = 2;
        foreach ($employeeData as $val){
            $sheet->setCellValue('A' . $rows, $val['pr_no']);
            $sheet->setCellValue('B' . $rows, $val['department']);
            $sheet->setCellValue('C' . $rows, $val['description']);
            $sheet->setCellValue('D' . $rows, $val['total_price']);
	        $sheet->setCellValue('E' . $rows, date('M-d-Y', strtotime($val['created_at'])));
            $rows++;
        } 
        $writer = new Xlsx($spreadsheet);
		$writer->save("assets/files/".$fileName);
		header("Content-Type: application/vnd.ms-excel");
        $this->session->set_userdata('activity', 'export monthly requests');
        $this->activity->log($this->session->userdata('user_id'));
        redirect("/assets/files/".$fileName);        
	}
    
    public function export_csv_morders(){ 
		$fileName = 'monthly_orders.xlsx';  
		$employeeData = $this->report->po_monthly_table();
		$spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'PO No.');
        $sheet->setCellValue('B1', 'PR No.');
        $sheet->setCellValue('C1', 'Department');
        $sheet->setCellValue('D1', 'Description');
        $sheet->setCellValue('E1', 'Total Price');
	    $sheet->setCellValue('F1', 'Created At');      
        $rows = 2;
        foreach ($employeeData as $val){
            $sheet->setCellValue('A' . $rows, $val['order_no']);
            $sheet->setCellValue('B' . $rows, $val['pr_no']);
            $sheet->setCellValue('C' . $rows, $val['department']);
            $sheet->setCellValue('D' . $rows, $val['description']);
            $sheet->setCellValue('E' . $rows, $val['total_price']);
	        $sheet->setCellValue('F' . $rows, date('M-d-Y', strtotime($val['created_at'])));
            $rows++;
        } 
        $writer = new Xlsx($spreadsheet);
		$writer->save("assets/files/".$fileName);
		header("Content-Type: application/vnd.ms-excel");
        $this->session->set_userdata('activity', 'export monthly orders');
        $this->activity->log($this->session->userdata('user_id'));
        redirect("/assets/files/".$fileName);        
	}

    public function export_backup(){
       // Load the DB utility class
		$this->load->dbutil();
		
		// Backup your entire database and assign it to a variable
		$backup = $this->dbutil->backup();
		
		// Load the file helper and write the file to your server
		$this->load->helper('file');
		write_file(VIEWPATH.'/assets/files/db_backup/qrdtms_'.date('dmY').'_backup.gz', $backup);
		
        $this->session->set_userdata('activity', 'export database backup');
        $this->activity->log($this->session->userdata('user_id'));
		// Load the download helper and send the file to your desktop
		$this->load->helper('download');
		force_download('qrdtms_'.date('dmY').'_backup.gz', $backup);
    }


}
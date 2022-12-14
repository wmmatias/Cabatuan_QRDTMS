<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Model {

    public function daily_table(){ 
        $status = '1';
        return $this->db->query("SELECT requests.pr_no, requests.department, requests.description, sum(items.qty * items.unit_cost) AS total_price, requests.created_at
        FROM cabatuan_qrdtms.requests 
        LEFT JOIN cabatuan_qrdtms.items
        ON items.pr_no = requests.pr_no
        WHERE YEAR(requests.created_at) = YEAR(NOW()) AND MONTH(requests.created_at) = MONTH(NOW()) AND DAY(requests.created_at) = DAY(NOW())  AND requests.status = ?
        GROUP BY requests.pr_no
        ORDER BY requests.created_at DESC", array(
            $this->security->xss_clean($status)
        ))->result_array();
    }

    public function po_daily_table(){ 
        $status = '1';
        return $this->db->query("SELECT orders.order_no, requests.pr_no, requests.department, requests.description, sum(items.qty * items.unit_cost) as total_price, orders.created_at
        FROM cabatuan_qrdtms.orders 
        LEFT JOIN cabatuan_qrdtms.requests
        ON orders.pr_no = requests.pr_no
        LEFT JOIN cabatuan_qrdtms.items
        ON items.pr_no = requests.pr_no
        WHERE YEAR(orders.created_at) = YEAR(NOW()) AND MONTH(orders.created_at) = MONTH(NOW()) AND DAY(orders.created_at) = DAY(NOW()) AND orders.approver_1 = ?
        GROUP BY orders.order_no
        ORDER BY orders.created_at DESC", array(
            $this->security->xss_clean($status)
        ))->result_array();
    }
    
    public function weekly_table(){ 
        $status = '1';
        return $this->db->query("SELECT requests.pr_no, requests.department, requests.description, sum(items.qty * items.unit_cost) AS total_price, requests.created_at
        FROM cabatuan_qrdtms.requests 
        LEFT JOIN cabatuan_qrdtms.items
        ON items.pr_no = requests.pr_no
        WHERE YEARWEEK(requests.created_at) = YEARWEEK(NOW())  AND requests.status = ?
        GROUP BY requests.pr_no
        ORDER BY requests.created_at DESC", array(
            $this->security->xss_clean($status)
        ))->result_array();
    }
    
    public function po_weekly_table(){ 
        $status = '1';
        return $this->db->query("SELECT orders.order_no, requests.pr_no, requests.department, requests.description, sum(items.qty * items.unit_cost) as total_price, orders.created_at
        FROM cabatuan_qrdtms.orders 
        LEFT JOIN cabatuan_qrdtms.requests
        ON orders.pr_no = requests.pr_no
        LEFT JOIN cabatuan_qrdtms.items
        ON items.pr_no = requests.pr_no
        WHERE YEARWEEK(orders.created_at) = YEARWEEK(NOW()) AND orders.approver_1 = ?
        GROUP BY orders.order_no
        ORDER BY orders.created_at DESC", array(
            $this->security->xss_clean($status)
        ))->result_array();
    }
    
    public function monthly_table(){ 
        $status = '1';
        return $this->db->query("SELECT requests.pr_no, requests.department, requests.description, sum(items.qty * items.unit_cost) AS total_price, requests.created_at
        FROM cabatuan_qrdtms.requests 
        LEFT JOIN cabatuan_qrdtms.items
        ON items.pr_no = requests.pr_no
        WHERE YEAR(requests.created_at) = YEAR(NOW()) AND MONTH(requests.created_at)=MONTH(NOW()) AND requests.status = ?
        GROUP BY requests.pr_no
        ORDER BY requests.created_at DESC", array(
            $this->security->xss_clean($status)
        ))->result_array();
    }
    
    public function po_monthly_table(){ 
        $status = '1';
        return $this->db->query("SELECT orders.order_no, requests.pr_no, requests.department, requests.description, sum(items.qty * items.unit_cost) as total_price, orders.created_at
        FROM cabatuan_qrdtms.orders 
        LEFT JOIN cabatuan_qrdtms.requests
        ON orders.pr_no = requests.pr_no
        LEFT JOIN cabatuan_qrdtms.items
        ON items.pr_no = requests.pr_no
        WHERE YEAR(orders.created_at) = YEAR(NOW()) AND MONTH(orders.created_at)=MONTH(NOW()) AND orders.approver_1 = ?
        GROUP BY orders.order_no
        ORDER BY orders.created_at DESC", array(
            $this->security->xss_clean($status)
        ))->result_array();
    }

    public function daily_chart(){ 
        $status = '1';
        return $this->db->query("SELECT requests.pr_no, requests.department, requests.description,  sum(items.qty * items.unit_cost) as total_price, requests.created_at
        FROM cabatuan_qrdtms.requests 
        LEFT JOIN cabatuan_qrdtms.items
        ON items.pr_no = requests.pr_no
        WHERE YEAR(requests.created_at) = YEAR(NOW())
        AND MONTH(requests.created_at) = MONTH(NOW()) 
        AND DAY(requests.created_at) = DAY(NOW()) AND requests.status = ?
        GROUP BY CAST(requests.created_at AS DATE)
        ORDER BY requests.created_at ASC", array(
            $this->security->xss_clean($status)
        ))->result_array();
    }

    public function ydaily_chart(){ 
        $status = '1';
        return $this->db->query("SELECT requests.pr_no, requests.department, requests.description,  sum(items.qty * items.unit_cost) as total_price, requests.created_at
        FROM cabatuan_qrdtms.requests 
        LEFT JOIN cabatuan_qrdtms.items
        ON items.pr_no = requests.pr_no
        WHERE YEAR(requests.created_at) = YEAR(NOW())
        AND MONTH(requests.created_at) = MONTH(NOW()) 
        AND DAY(requests.created_at) = DAY(NOW() - INTERVAL 1 DAY) AND requests.status = ?
        GROUP BY CAST(requests.created_at AS DATE)
        ORDER BY requests.created_at ASC", array(
            $this->security->xss_clean($status)
        ))->result_array();
    }

    public function weekly_chart(){ 
        $status = '1';
        return $this->db->query("SELECT requests.pr_no, requests.department, requests.description,  sum(items.qty * items.unit_cost) as total_price, requests.created_at
        FROM cabatuan_qrdtms.requests 
        LEFT JOIN cabatuan_qrdtms.items
        ON items.pr_no = requests.pr_no
        WHERE YEARWEEK(requests.created_at) = YEARWEEK(NOW())  AND requests.status = ?
        GROUP BY CAST(requests.created_at AS DATE)
        ORDER BY requests.created_at ASC", array(
            $this->security->xss_clean($status)
        ))->result_array();
    }

    public function weekly_max(){
        $status = '1';
        return $this->db->query("SELECT sum(items.qty * items.unit_cost) as total_price
        FROM cabatuan_qrdtms.requests 
        LEFT JOIN cabatuan_qrdtms.items
        ON items.pr_no = requests.pr_no
        WHERE YEARWEEK(requests.created_at) = YEARWEEK(NOW())  AND requests.status = ?
        GROUP BY CAST(requests.created_at AS DATE)
        ORDER BY total_price DESC LIMIT 1",array(
            $this->security->xss_clean($status)
        ))->result_array();
    }
    
    public function monthly_chart(){ 
        $status = '1';
        return $this->db->query("SELECT requests.pr_no, requests.department, requests.description, sum(items.qty * items.unit_cost) as total_price, requests.created_at
        FROM cabatuan_qrdtms.requests 
        LEFT JOIN cabatuan_qrdtms.items
        ON items.pr_no = requests.pr_no
        WHERE YEAR(requests.created_at) = YEAR(NOW()) AND MONTH(requests.created_at)=MONTH(NOW()) AND requests.status = ?
        GROUP BY CAST(requests.created_at AS DATE)
        ORDER BY requests.created_at ASC", array(
            $this->security->xss_clean($status)
        ))->result_array();
    }

    public function monthly_max(){
        $status = '1';
        return $this->db->query("SELECT sum(items.qty * items.unit_cost) as total_price
        FROM cabatuan_qrdtms.requests 
        LEFT JOIN cabatuan_qrdtms.items
        ON items.pr_no = requests.pr_no
        WHERE YEAR(requests.created_at) = YEAR(NOW()) AND MONTH(requests.created_at)=MONTH(NOW()) AND requests.status = ?
        GROUP BY CAST(requests.created_at AS DATE)
        ORDER BY total_price DESC LIMIT 1",array(
            $this->security->xss_clean($status)
        ))->result_array();
    }

    public function yearly_chart(){ 
        $status = '1';
        return $this->db->query("SELECT requests.pr_no, requests.department, requests.description, sum(items.qty * items.unit_cost) AS total_price, requests.created_at, year(requests.created_at) as year_chart
        FROM cabatuan_qrdtms.requests 
        LEFT JOIN cabatuan_qrdtms.items
        ON items.pr_no = requests.pr_no
        WHERE requests.status = 1
        GROUP BY YEAR(created_at)
        ORDER BY YEAR(created_at) ASC", array(
            $this->security->xss_clean($status)
        ))->result_array();
    }

    public function yearly_max(){
        $status = '1';
        return $this->db->query("SELECT requests.pr_no, requests.department, requests.description, sum(items.qty * items.unit_cost) AS total_price, requests.created_at, year(requests.created_at)
        FROM cabatuan_qrdtms.requests 
        LEFT JOIN cabatuan_qrdtms.items
        ON items.pr_no = requests.pr_no
        WHERE requests.status = 1
        GROUP BY YEAR(created_at)
        ORDER BY YEAR(created_at) DESC LIMIT 1",array(
            $this->security->xss_clean($status)
        ))->result_array();
    }

    public function yearly_table(){ 
        $status = '1';
        return $this->db->query("SELECT requests.pr_no, requests.department, requests.description, sum(items.qty * items.unit_cost) AS total_price, requests.created_at
        FROM cabatuan_qrdtms.requests 
        LEFT JOIN cabatuan_qrdtms.items
        ON items.pr_no = requests.pr_no
        WHERE YEAR(requests.created_at) = YEAR(NOW()) AND requests.status = ?
        GROUP BY requests.pr_no
        ORDER BY requests.created_at DESC", array(
            $this->security->xss_clean($status)
        ))->result_array();
    }
    
    public function po_yearly_table(){ 
        $status = '1';
        return $this->db->query("SELECT orders.order_no, requests.pr_no, requests.department, requests.description, sum(items.qty * items.unit_cost) as total_price, orders.created_at
        FROM cabatuan_qrdtms.orders 
        LEFT JOIN cabatuan_qrdtms.requests
        ON orders.pr_no = requests.pr_no
        LEFT JOIN cabatuan_qrdtms.items
        ON items.pr_no = requests.pr_no
        WHERE YEAR(orders.created_at) = YEAR(NOW()) AND orders.approver_1 = ?
        GROUP BY orders.order_no
        ORDER BY orders.created_at DESC", array(
            $this->security->xss_clean($status)
        ))->result_array();
    }

    public function yearnow(){
        $status = '1';
        $dept = '1';
        return $this->db->query(" SELECT departments.name as department, sum(items.qty * items.unit_cost) AS total_price, 
        year(requests.created_at) as year_chart
        FROM cabatuan_qrdtms.requests 
        LEFT JOIN cabatuan_qrdtms.items
        ON items.pr_no = requests.pr_no
        LEFT JOIN cabatuan_qrdtms.departments
        ON departments.id = requests.department
        WHERE YEAR(requests.created_at) = YEAR(NOW()) AND requests.status = ? AND requests.department = ?
        GROUP BY requests.department
        ORDER BY requests.department ASC;", array(
            $this->security->xss_clean($status),
            $this->security->xss_clean($dept)
        ))->result_array();
    }


    public function yearnow2(){
        $status = '1';
        $dept = '2';
        return $this->db->query(" SELECT departments.name as department, sum(items.qty * items.unit_cost) AS total_price, 
        year(requests.created_at) as year_chart
        FROM cabatuan_qrdtms.requests 
        LEFT JOIN cabatuan_qrdtms.items
        ON items.pr_no = requests.pr_no
        LEFT JOIN cabatuan_qrdtms.departments
        ON departments.id = requests.department
        WHERE YEAR(requests.created_at) = YEAR(NOW()) AND requests.status = ? AND requests.department = ?
        GROUP BY requests.department
        ORDER BY requests.department ASC;", array(
            $this->security->xss_clean($status),
            $this->security->xss_clean($dept)
        ))->result_array();
    }
    
    public function yearnow3(){
        $status = '1';
        $dept = '3';
        return $this->db->query(" SELECT departments.name as department, sum(items.qty * items.unit_cost) AS total_price, 
        year(requests.created_at) as year_chart
        FROM cabatuan_qrdtms.requests 
        LEFT JOIN cabatuan_qrdtms.items
        ON items.pr_no = requests.pr_no
        LEFT JOIN cabatuan_qrdtms.departments
        ON departments.id = requests.department
        WHERE YEAR(requests.created_at) = YEAR(NOW()) AND requests.status = ? AND requests.department = ?
        GROUP BY requests.department
        ORDER BY requests.department ASC;", array(
            $this->security->xss_clean($status),
            $this->security->xss_clean($dept)
        ))->result_array();
    }
    
    public function yearnow4(){
        $status = '1';
        $dept = '4';
        return $this->db->query(" SELECT departments.name as department, sum(items.qty * items.unit_cost) AS total_price, 
        year(requests.created_at) as year_chart
        FROM cabatuan_qrdtms.requests 
        LEFT JOIN cabatuan_qrdtms.items
        ON items.pr_no = requests.pr_no
        LEFT JOIN cabatuan_qrdtms.departments
        ON departments.id = requests.department
        WHERE YEAR(requests.created_at) = YEAR(NOW()) AND requests.status = ? AND requests.department = ?
        GROUP BY requests.department
        ORDER BY requests.department ASC;", array(
            $this->security->xss_clean($status),
            $this->security->xss_clean($dept)
        ))->result_array();
    }
    
    public function yearnow5(){
        $status = '1';
        $dept = '5';
        return $this->db->query(" SELECT departments.name as department, sum(items.qty * items.unit_cost) AS total_price, 
        year(requests.created_at) as year_chart
        FROM cabatuan_qrdtms.requests 
        LEFT JOIN cabatuan_qrdtms.items
        ON items.pr_no = requests.pr_no
        LEFT JOIN cabatuan_qrdtms.departments
        ON departments.id = requests.department
        WHERE YEAR(requests.created_at) = YEAR(NOW()) AND requests.status = ? AND requests.department = ?
        GROUP BY requests.department
        ORDER BY requests.department ASC;", array(
            $this->security->xss_clean($status),
            $this->security->xss_clean($dept)
        ))->result_array();
    }
    
    public function yearnow6(){
        $status = '1';
        $dept = '6';
        return $this->db->query(" SELECT departments.name as department, sum(items.qty * items.unit_cost) AS total_price, 
        year(requests.created_at) as year_chart
        FROM cabatuan_qrdtms.requests 
        LEFT JOIN cabatuan_qrdtms.items
        ON items.pr_no = requests.pr_no
        LEFT JOIN cabatuan_qrdtms.departments
        ON departments.id = requests.department
        WHERE YEAR(requests.created_at) = YEAR(NOW()) AND requests.status = ? AND requests.department = ?
        GROUP BY requests.department
        ORDER BY requests.department ASC;", array(
            $this->security->xss_clean($status),
            $this->security->xss_clean($dept)
        ))->result_array();
    }
    
    public function yearnow7(){
        $status = '1';
        $dept = '7';
        return $this->db->query(" SELECT departments.name as department, sum(items.qty * items.unit_cost) AS total_price, 
        year(requests.created_at) as year_chart
        FROM cabatuan_qrdtms.requests 
        LEFT JOIN cabatuan_qrdtms.items
        ON items.pr_no = requests.pr_no
        LEFT JOIN cabatuan_qrdtms.departments
        ON departments.id = requests.department
        WHERE YEAR(requests.created_at) = YEAR(NOW()) AND requests.status = ? AND requests.department = ?
        GROUP BY requests.department
        ORDER BY requests.department ASC;", array(
            $this->security->xss_clean($status),
            $this->security->xss_clean($dept)
        ))->result_array();
    }
    
    public function yearnow8(){
        $status = '1';
        $dept = '8';
        return $this->db->query(" SELECT departments.name as department, sum(items.qty * items.unit_cost) AS total_price, 
        year(requests.created_at) as year_chart
        FROM cabatuan_qrdtms.requests 
        LEFT JOIN cabatuan_qrdtms.items
        ON items.pr_no = requests.pr_no
        LEFT JOIN cabatuan_qrdtms.departments
        ON departments.id = requests.department
        WHERE YEAR(requests.created_at) = YEAR(NOW()) AND requests.status = ? AND requests.department = ?
        GROUP BY requests.department
        ORDER BY requests.department ASC;", array(
            $this->security->xss_clean($status),
            $this->security->xss_clean($dept)
        ))->result_array();
    }
    
    public function yearnow9(){
        $status = '1';
        $dept = '9';
        return $this->db->query(" SELECT departments.name as department, sum(items.qty * items.unit_cost) AS total_price, 
        year(requests.created_at) as year_chart
        FROM cabatuan_qrdtms.requests 
        LEFT JOIN cabatuan_qrdtms.items
        ON items.pr_no = requests.pr_no
        LEFT JOIN cabatuan_qrdtms.departments
        ON departments.id = requests.department
        WHERE YEAR(requests.created_at) = YEAR(NOW()) AND requests.status = ? AND requests.department = ?
        GROUP BY requests.department
        ORDER BY requests.department ASC;", array(
            $this->security->xss_clean($status),
            $this->security->xss_clean($dept)
        ))->result_array();
    }
    
    public function yearnow10(){
        $status = '1';
        $dept = '10';
        return $this->db->query(" SELECT departments.name as department, sum(items.qty * items.unit_cost) AS total_price, 
        year(requests.created_at) as year_chart
        FROM cabatuan_qrdtms.requests 
        LEFT JOIN cabatuan_qrdtms.items
        ON items.pr_no = requests.pr_no
        LEFT JOIN cabatuan_qrdtms.departments
        ON departments.id = requests.department
        WHERE YEAR(requests.created_at) = YEAR(NOW()) AND requests.status = ? AND requests.department = ?
        GROUP BY requests.department
        ORDER BY requests.department ASC;", array(
            $this->security->xss_clean($status),
            $this->security->xss_clean($dept)
        ))->result_array();
    }
    
    public function yearnow11(){
        $status = '1';
        $dept = '11';
        return $this->db->query(" SELECT departments.name as department, sum(items.qty * items.unit_cost) AS total_price, 
        year(requests.created_at) as year_chart
        FROM cabatuan_qrdtms.requests 
        LEFT JOIN cabatuan_qrdtms.items
        ON items.pr_no = requests.pr_no
        LEFT JOIN cabatuan_qrdtms.departments
        ON departments.id = requests.department
        WHERE YEAR(requests.created_at) = YEAR(NOW()) AND requests.status = ? AND requests.department = ?
        GROUP BY requests.department
        ORDER BY requests.department ASC;", array(
            $this->security->xss_clean($status),
            $this->security->xss_clean($dept)
        ))->result_array();
    }
    
    public function yearnow12(){
        $status = '1';
        $dept = '12';
        return $this->db->query(" SELECT departments.name as department, sum(items.qty * items.unit_cost) AS total_price, 
        year(requests.created_at) as year_chart
        FROM cabatuan_qrdtms.requests 
        LEFT JOIN cabatuan_qrdtms.items
        ON items.pr_no = requests.pr_no
        LEFT JOIN cabatuan_qrdtms.departments
        ON departments.id = requests.department
        WHERE YEAR(requests.created_at) = YEAR(NOW()) AND requests.status = ? AND requests.department = ?
        GROUP BY requests.department
        ORDER BY requests.department ASC;", array(
            $this->security->xss_clean($status),
            $this->security->xss_clean($dept)
        ))->result_array();
    }
    
    public function yearnow13(){
        $status = '1';
        $dept = '13';
        return $this->db->query(" SELECT departments.name as department, sum(items.qty * items.unit_cost) AS total_price, 
        year(requests.created_at) as year_chart
        FROM cabatuan_qrdtms.requests 
        LEFT JOIN cabatuan_qrdtms.items
        ON items.pr_no = requests.pr_no
        LEFT JOIN cabatuan_qrdtms.departments
        ON departments.id = requests.department
        WHERE YEAR(requests.created_at) = YEAR(NOW()) AND requests.status = ? AND requests.department = ?
        GROUP BY requests.department
        ORDER BY requests.department ASC;", array(
            $this->security->xss_clean($status),
            $this->security->xss_clean($dept)
        ))->result_array();
    }
    
    public function yearnow14(){
        $status = '1';
        $dept = '14';
        return $this->db->query(" SELECT departments.name as department, sum(items.qty * items.unit_cost) AS total_price, 
        year(requests.created_at) as year_chart
        FROM cabatuan_qrdtms.requests 
        LEFT JOIN cabatuan_qrdtms.items
        ON items.pr_no = requests.pr_no
        LEFT JOIN cabatuan_qrdtms.departments
        ON departments.id = requests.department
        WHERE YEAR(requests.created_at) = YEAR(NOW()) AND requests.status = ? AND requests.department = ?
        GROUP BY requests.department
        ORDER BY requests.department ASC;", array(
            $this->security->xss_clean($status),
            $this->security->xss_clean($dept)
        ))->result_array();
    }
    
    public function yearnow15(){
        $status = '1';
        $dept = '15';
        return $this->db->query(" SELECT departments.name as department, sum(items.qty * items.unit_cost) AS total_price, 
        year(requests.created_at) as year_chart
        FROM cabatuan_qrdtms.requests 
        LEFT JOIN cabatuan_qrdtms.items
        ON items.pr_no = requests.pr_no
        LEFT JOIN cabatuan_qrdtms.departments
        ON departments.id = requests.department
        WHERE YEAR(requests.created_at) = YEAR(NOW()) AND requests.status = ? AND requests.department = ?
        GROUP BY requests.department
        ORDER BY requests.department ASC;", array(
            $this->security->xss_clean($status),
            $this->security->xss_clean($dept)
        ))->result_array();
    }

    public function pyearnow(){
        $status = '1';
        $dept = '1';
        $year = date('Y');
        $past = $year - '1';
        return $this->db->query("SELECT departments.name as department, sum(items.qty * items.unit_cost) AS total_price, 
        year(requests.created_at) as year_chart
        FROM cabatuan_qrdtms.requests 
        LEFT JOIN cabatuan_qrdtms.items
        ON items.pr_no = requests.pr_no
        LEFT JOIN cabatuan_qrdtms.departments
        ON departments.id = requests.department
        WHERE requests.status = ? AND  year(requests.created_at) = ? 
        AND departments.id = ?
        GROUP BY requests.department
        ORDER BY requests.department ASC",array(
             $this->security->xss_clean($status),
             $this->security->xss_clean($past),
             $this->security->xss_clean($dept),
        ))->result_array();
    }

    public function pyearnow2(){
        $status = '1';
        $dept = '2';
        $year = date('Y');
        $past = $year - '1';
        return $this->db->query("SELECT departments.name as department, sum(items.qty * items.unit_cost) AS total_price, 
        year(requests.created_at) as year_chart
        FROM cabatuan_qrdtms.requests 
        LEFT JOIN cabatuan_qrdtms.items
        ON items.pr_no = requests.pr_no
        LEFT JOIN cabatuan_qrdtms.departments
        ON departments.id = requests.department
        WHERE requests.status = ? AND  year(requests.created_at) = ? 
        AND departments.id = ?
        GROUP BY requests.department
        ORDER BY requests.department ASC",array(
             $this->security->xss_clean($status),
             $this->security->xss_clean($past),
             $this->security->xss_clean($dept),
        ))->result_array();
    }

    public function pyearnow3(){
        $status = '1';
        $dept = '3';
        $year = date('Y');
        $past = $year - '1';
        return $this->db->query("SELECT departments.name as department, sum(items.qty * items.unit_cost) AS total_price, 
        year(requests.created_at) as year_chart
        FROM cabatuan_qrdtms.requests 
        LEFT JOIN cabatuan_qrdtms.items
        ON items.pr_no = requests.pr_no
        LEFT JOIN cabatuan_qrdtms.departments
        ON departments.id = requests.department
        WHERE requests.status = ? AND  year(requests.created_at) = ? 
        AND departments.id = ?
        GROUP BY requests.department
        ORDER BY requests.department ASC",array(
             $this->security->xss_clean($status),
             $this->security->xss_clean($past),
             $this->security->xss_clean($dept),
        ))->result_array();
    }

    public function pyearnow4(){
        $status = '1';
        $dept = '4';
        $year = date('Y');
        $past = $year - '1';
        return $this->db->query("SELECT departments.name as department, sum(items.qty * items.unit_cost) AS total_price, 
        year(requests.created_at) as year_chart
        FROM cabatuan_qrdtms.requests 
        LEFT JOIN cabatuan_qrdtms.items
        ON items.pr_no = requests.pr_no
        LEFT JOIN cabatuan_qrdtms.departments
        ON departments.id = requests.department
        WHERE requests.status = ? AND  year(requests.created_at) = ? 
        AND departments.id = ?
        GROUP BY requests.department
        ORDER BY requests.department ASC",array(
             $this->security->xss_clean($status),
             $this->security->xss_clean($past),
             $this->security->xss_clean($dept),
        ))->result_array();
    }

    public function pyearnow5(){
        $status = '1';
        $dept = '5';
        $year = date('Y');
        $past = $year - '1';
        return $this->db->query("SELECT departments.name as department, sum(items.qty * items.unit_cost) AS total_price, 
        year(requests.created_at) as year_chart
        FROM cabatuan_qrdtms.requests 
        LEFT JOIN cabatuan_qrdtms.items
        ON items.pr_no = requests.pr_no
        LEFT JOIN cabatuan_qrdtms.departments
        ON departments.id = requests.department
        WHERE requests.status = ? AND  year(requests.created_at) = ? 
        AND departments.id = ?
        GROUP BY requests.department
        ORDER BY requests.department ASC",array(
             $this->security->xss_clean($status),
             $this->security->xss_clean($past),
             $this->security->xss_clean($dept),
        ))->result_array();
    }

    public function pyearnow6(){
        $status = '1';
        $dept = '6';
        $year = date('Y');
        $past = $year - '1';
        return $this->db->query("SELECT departments.name as department, sum(items.qty * items.unit_cost) AS total_price, 
        year(requests.created_at) as year_chart
        FROM cabatuan_qrdtms.requests 
        LEFT JOIN cabatuan_qrdtms.items
        ON items.pr_no = requests.pr_no
        LEFT JOIN cabatuan_qrdtms.departments
        ON departments.id = requests.department
        WHERE requests.status = ? AND  year(requests.created_at) = ? 
        AND departments.id = ?
        GROUP BY requests.department
        ORDER BY requests.department ASC",array(
             $this->security->xss_clean($status),
             $this->security->xss_clean($past),
             $this->security->xss_clean($dept),
        ))->result_array();
    }

    public function pyearnow7(){
        $status = '1';
        $dept = '7';
        $year = date('Y');
        $past = $year - '1';
        return $this->db->query("SELECT departments.name as department, sum(items.qty * items.unit_cost) AS total_price, 
        year(requests.created_at) as year_chart
        FROM cabatuan_qrdtms.requests 
        LEFT JOIN cabatuan_qrdtms.items
        ON items.pr_no = requests.pr_no
        LEFT JOIN cabatuan_qrdtms.departments
        ON departments.id = requests.department
        WHERE requests.status = ? AND  year(requests.created_at) = ? 
        AND departments.id = ?
        GROUP BY requests.department
        ORDER BY requests.department ASC",array(
             $this->security->xss_clean($status),
             $this->security->xss_clean($past),
             $this->security->xss_clean($dept),
        ))->result_array();
    }

    public function pyearnow8(){
        $status = '1';
        $dept = '8';
        $year = date('Y');
        $past = $year - '1';
        return $this->db->query("SELECT departments.name as department, sum(items.qty * items.unit_cost) AS total_price, 
        year(requests.created_at) as year_chart
        FROM cabatuan_qrdtms.requests 
        LEFT JOIN cabatuan_qrdtms.items
        ON items.pr_no = requests.pr_no
        LEFT JOIN cabatuan_qrdtms.departments
        ON departments.id = requests.department
        WHERE requests.status = ? AND  year(requests.created_at) = ? 
        AND departments.id = ?
        GROUP BY requests.department
        ORDER BY requests.department ASC",array(
             $this->security->xss_clean($status),
             $this->security->xss_clean($past),
             $this->security->xss_clean($dept),
        ))->result_array();
    }

    public function pyearnow9(){
        $status = '1';
        $dept = '9';
        $year = date('Y');
        $past = $year - '1';
        return $this->db->query("SELECT departments.name as department, sum(items.qty * items.unit_cost) AS total_price, 
        year(requests.created_at) as year_chart
        FROM cabatuan_qrdtms.requests 
        LEFT JOIN cabatuan_qrdtms.items
        ON items.pr_no = requests.pr_no
        LEFT JOIN cabatuan_qrdtms.departments
        ON departments.id = requests.department
        WHERE requests.status = ? AND  year(requests.created_at) = ? AND departments.id = ?
        GROUP BY requests.department
        ORDER BY requests.department ASC",array(
             $this->security->xss_clean($status),
             $this->security->xss_clean($past),
             $this->security->xss_clean($dept),
        ))->result_array();
    }

    public function pyearnow10(){
        $status = '1';
        $dept = '10';
        $year = date('Y');
        $past = $year - '1';
        return $this->db->query("SELECT departments.name as department, sum(items.qty * items.unit_cost) AS total_price, 
        year(requests.created_at) as year_chart
        FROM cabatuan_qrdtms.requests 
        LEFT JOIN cabatuan_qrdtms.items
        ON items.pr_no = requests.pr_no
        LEFT JOIN cabatuan_qrdtms.departments
        ON departments.id = requests.department
        WHERE requests.status = ? AND  year(requests.created_at) = ? 
        AND departments.id = ?
        GROUP BY requests.department
        ORDER BY requests.department ASC",array(
             $this->security->xss_clean($status),
             $this->security->xss_clean($past),
             $this->security->xss_clean($dept),
        ))->result_array();
    }

    public function pyearnow11(){
        $status = '1';
        $dept = '11';
        $year = date('Y');
        $past = $year - '1';
        return $this->db->query("SELECT departments.name as department, sum(items.qty * items.unit_cost) AS total_price, 
        year(requests.created_at) as year_chart
        FROM cabatuan_qrdtms.requests 
        LEFT JOIN cabatuan_qrdtms.items
        ON items.pr_no = requests.pr_no
        LEFT JOIN cabatuan_qrdtms.departments
        ON departments.id = requests.department
        WHERE requests.status = ? AND  year(requests.created_at) = ? 
        AND departments.id = ?
        GROUP BY requests.department
        ORDER BY requests.department ASC",array(
             $this->security->xss_clean($status),
             $this->security->xss_clean($past),
             $this->security->xss_clean($dept),
        ))->result_array();
    }

    public function pyearnow12(){
        $status = '1';
        $dept = '12';
        $year = date('Y');
        $past = $year - '1';
        return $this->db->query("SELECT departments.name as department, sum(items.qty * items.unit_cost) AS total_price, 
        year(requests.created_at) as year_chart
        FROM cabatuan_qrdtms.requests 
        LEFT JOIN cabatuan_qrdtms.items
        ON items.pr_no = requests.pr_no
        LEFT JOIN cabatuan_qrdtms.departments
        ON departments.id = requests.department
        WHERE requests.status = ? AND  year(requests.created_at) = ? 
        AND departments.id = ?
        GROUP BY requests.department
        ORDER BY requests.department ASC",array(
             $this->security->xss_clean($status),
             $this->security->xss_clean($past),
             $this->security->xss_clean($dept),
        ))->result_array();
    }

    public function pyearnow13(){
        $status = '1';
        $dept = '13';
        $year = date('Y');
        $past = $year - '1';
        return $this->db->query("SELECT departments.name as department, sum(items.qty * items.unit_cost) AS total_price, 
        year(requests.created_at) as year_chart
        FROM cabatuan_qrdtms.requests 
        LEFT JOIN cabatuan_qrdtms.items
        ON items.pr_no = requests.pr_no
        LEFT JOIN cabatuan_qrdtms.departments
        ON departments.id = requests.department
        WHERE requests.status = ? AND  year(requests.created_at) = ? 
        AND departments.id = ?
        GROUP BY requests.department
        ORDER BY requests.department ASC",array(
             $this->security->xss_clean($status),
             $this->security->xss_clean($past),
             $this->security->xss_clean($dept),
        ))->result_array();
    }

    public function pyearnow14(){
        $status = '1';
        $dept = '14';
        $year = date('Y');
        $past = $year - '1';
        return $this->db->query("SELECT departments.name as department, sum(items.qty * items.unit_cost) AS total_price, 
        year(requests.created_at) as year_chart
        FROM cabatuan_qrdtms.requests 
        LEFT JOIN cabatuan_qrdtms.items
        ON items.pr_no = requests.pr_no
        LEFT JOIN cabatuan_qrdtms.departments
        ON departments.id = requests.department
        WHERE requests.status = ? AND  year(requests.created_at) = ? 
        AND departments.id = ?
        GROUP BY requests.department
        ORDER BY requests.department ASC",array(
             $this->security->xss_clean($status),
             $this->security->xss_clean($past),
             $this->security->xss_clean($dept),
        ))->result_array();
    }

    public function pyearnow15(){
        $status = '1';
        $dept = '15';
        $year = date('Y');
        $past = $year - '1';
        return $this->db->query("SELECT departments.name as department, sum(items.qty * items.unit_cost) AS total_price, 
        year(requests.created_at) as year_chart
        FROM cabatuan_qrdtms.requests 
        LEFT JOIN cabatuan_qrdtms.items
        ON items.pr_no = requests.pr_no
        LEFT JOIN cabatuan_qrdtms.departments
        ON departments.id = requests.department
        WHERE requests.status = ? AND  year(requests.created_at) = ? 
        AND departments.id = ?
        GROUP BY requests.department
        ORDER BY requests.department ASC",array(
             $this->security->xss_clean($status),
             $this->security->xss_clean($past),
             $this->security->xss_clean($dept),
        ))->result_array();
    }

}
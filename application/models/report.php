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
        ))->result_array()[0];
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
        ))->result_array()[0];
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
        ))->result_array()[0];
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
        ))->result_array()[0];
    }

}
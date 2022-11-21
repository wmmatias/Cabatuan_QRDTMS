<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
class Email extends CI_Model {

    public function get_mbo_approver(){
        $level = '1';
        return $this->db->query("SELECT email, first_name, last_name FROM users WHERE app_level = ?",
        array(
            $this->security->xss_clean($level)
        ))->result_array()[0];
    }

    
    public function get_mt_approver(){
        $level = '2';
        return $this->db->query("SELECT email, first_name, last_name FROM users WHERE app_level = ?",
        array(
            $this->security->xss_clean($level)
        ))->result_array()[0];
    }

    
    public function get_ma_approver(){
        $level = '3';
        return $this->db->query("SELECT email, first_name, last_name FROM users WHERE app_level = ?",
        array(
            $this->security->xss_clean($level)
        ))->result_array()[0];
    }

    
    public function get_mm_approver(){
        $level = '4';
        return $this->db->query("SELECT email, first_name, last_name FROM users WHERE app_level = ?",
        array(
            $this->security->xss_clean($level)
        ))->result_array()[0];
    }

    public function get_creator($id){
        return $this->db->query("SELECT email, first_name, last_name FROM users WHERE id = ?",
        array(
            $this->security->xss_clean($id)
        ))->result_array()[0];
    }

    public function get_pr($id){
        return $this->db->query("SELECT pr_no, department, description, created_by FROM requests WHERE pr_no = ?",
        array(
            $this->security->xss_clean($id)
        ))->result_array()[0];
    }


    public function create_pr($form_data, $id){
        $creator = $this->get_creator($id);
        $pr_no = $this->security->xss_clean($form_data['pr_no']);
        $department = $this->security->xss_clean($form_data['department']);
        $description = $this->security->xss_clean($form_data['description']);
        $fullname = $this->security->xss_clean($creator['first_name'].' '.$creator['last_name']);
        $to = $this->security->xss_clean($creator['email']);
        $subject = $this->security->xss_clean($pr_no.' '.$description);
        $from = $this->security->xss_clean('qrdtms@gmail.com');
        $body = '
        <p>Good day! '.$fullname.',</p>
        </br>
        </br>
        <p>You have successfully create PR document, please check the details below</p>
        <p>PR No.: '. $pr_no .'</p>
        <p>From: '. $department .'</p>
        <p>Description: '. $description .'</p>
        </br>
        </br>
        <p>keep this as your transaction receipt</p>
        </br>
        </br>
        <p>Regards,</p>
        <p><b>Cabatuan QRDTMS</b></p>
        </br>
        </br>
        <small><i>This email message (including attachments, if any) is intended for the use of the individual or the entity to whom it is addressed and may contain information that is privileged, proprietary, confidential and exempt from disclosure. If you are not an intended recipient of this e-mail, you are not authorized to duplicate, copy, retransmit, or redistribute it by any means. Please delete it and any attachments immediately and notify the sender that you have received it in error.</i></small>
        ';

        //server setup for mailing
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'ssl://smtp.googlemail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $from;
        $mail->Password = 'nwswbygtrdfczojw';
        $mail->Port = 465;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

        //compose email
        $mail->setFrom($from);
        $mail->addAddress($to);
        $mail->Subject = $subject;
        $mail->isHtml(true);
        $mail->Body = $body;

        //condition checking if email sent
        return ($mail->send() ? 'Message sent' : 'Message not sent');

    }
    

    public function to_mbo($form_data){
        $pr_no = $this->security->xss_clean($form_data['pr_no']);
        $department = $this->security->xss_clean($form_data['department']);
        $description = $this->security->xss_clean($form_data['description']);
        $mbo = $this->get_mbo_approver();
        $fullname = $this->security->xss_clean($mbo['first_name'].' '.$mbo['last_name']);
        $to = $this->security->xss_clean($mbo['email']);
        $subject = $this->security->xss_clean($pr_no.' '.$description);
        $from = $this->security->xss_clean('qrdtms@gmail.com');
        $body = '
        <p>Good day! '.$fullname.',</p>
        </br>
        </br>
        <p>You have a pending PR for approval please check the details below</p>
        <p>PR No.: '. $pr_no .'</p>
        <p>From: '. $department .'</p>
        <p>Description: '. $description .'</p>
        </br>
        <p>keep this email for document tracking</p>
        </br>
        </br>
        <p>Regards,</p>
        <p><b>Cabatuan QRDTMS</b></p>
        </br>
        </br>
        <small><i>This email message (including attachments, if any) is intended for the use of the individual or the entity to whom it is addressed and may contain information that is privileged, proprietary, confidential and exempt from disclosure. If you are not an intended recipient of this e-mail, you are not authorized to duplicate, copy, retransmit, or redistribute it by any means. Please delete it and any attachments immediately and notify the sender that you have received it in error.</i></small>
        ';

        //server setup for mailing
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'ssl://smtp.googlemail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $from;
        $mail->Password = 'nwswbygtrdfczojw';
        $mail->Port = 465;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

        //compose email
        $mail->setFrom($from);
        $mail->addAddress($to);
        $mail->Subject = $subject;
        $mail->isHtml(true);
        $mail->Body = $body;

        //condition checking if email sent
        return ($mail->send() ? 'Message sent' : 'Message not sent');

    }
   
    public function to_mt($pr_no){
        $pr_details = $this->get_pr($pr_no);
        $department = $this->security->xss_clean($pr_details['department']);
        $description = $this->security->xss_clean($pr_details['description']);
        $mt = $this->get_mt_approver();
        $fullname = $this->security->xss_clean($mt['first_name'].' '.$mt['last_name']);
        $to = $this->security->xss_clean($mt['email']);
        $subject = $this->security->xss_clean($pr_no.' '.$description);
        $from = $this->security->xss_clean('qrdtms@gmail.com');
        $body = '
        <p>Good day! '.$fullname.',</p>
        </br>
        </br>
        <p>You have a pending PR for approval please check the details below</p>
        <p>PR No.: '. $pr_no .'</p>
        <p>From: '. $department .'</p>
        <p>Description: '. $description .'</p>
        </br>
        <p>keep this email for document tracking</p>
        </br>
        </br>
        <p>Regards,</p>
        <p><b>Cabatuan QRDTMS</b></p>
        </br>
        </br>
        <small><i>This email message (including attachments, if any) is intended for the use of the individual or the entity to whom it is addressed and may contain information that is privileged, proprietary, confidential and exempt from disclosure. If you are not an intended recipient of this e-mail, you are not authorized to duplicate, copy, retransmit, or redistribute it by any means. Please delete it and any attachments immediately and notify the sender that you have received it in error.</i></small>
        ';

        //server setup for mailing
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'ssl://smtp.googlemail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $from;
        $mail->Password = 'nwswbygtrdfczojw';
        $mail->Port = 465;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

        //compose email
        $mail->setFrom($from);
        $mail->addAddress($to);
        $mail->Subject = $subject;
        $mail->isHtml(true);
        $mail->Body = $body;

        //condition checking if email sent
        return ($mail->send() ? 'Message sent' : 'Message not sent');

    }
   
    public function mbo_to_creator($pr_no){
        $pr_details = $this->get_pr($pr_no);
        $id = $pr_details['created_by'];
        $creator = $this->get_creator($id);
        $department = $this->security->xss_clean($pr_details['department']);
        $description = $this->security->xss_clean($pr_details['description']);
        $fullname = $this->security->xss_clean($creator['first_name'].' '.$creator['last_name']);
        $to = $this->security->xss_clean($creator['email']);
        $subject = $this->security->xss_clean($pr_no.' '.$description);
        $from = $this->security->xss_clean('qrdtms@gmail.com');
        $body = '
        <p>Good day! '.$fullname.',</p>
        </br>
        </br>
        <p>Your PR has been approved by Municipal Budget Officcer</p>
        <p>PR No.: '. $pr_no .'</p>
        <p>From: '. $department .'</p>
        <p>Description: '. $description .'</p>
        </br>
        <p>keep this email for document tracking</p>
        </br>
        </br>
        <p>Regards,</p>
        <p><b>Cabatuan QRDTMS</b></p>
        </br>
        </br>
        <small><i>This email message (including attachments, if any) is intended for the use of the individual or the entity to whom it is addressed and may contain information that is privileged, proprietary, confidential and exempt from disclosure. If you are not an intended recipient of this e-mail, you are not authorized to duplicate, copy, retransmit, or redistribute it by any means. Please delete it and any attachments immediately and notify the sender that you have received it in error.</i></small>
        ';

        //server setup for mailing
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'ssl://smtp.googlemail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $from;
        $mail->Password = 'nwswbygtrdfczojw';
        $mail->Port = 465;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

        //compose email
        $mail->setFrom($from);
        $mail->addAddress($to);
        $mail->Subject = $subject;
        $mail->isHtml(true);
        $mail->Body = $body;

        //condition checking if email sent
        return ($mail->send() ? 'Message sent' : 'Message not sent');

    }

    public function to_ma($pr_no){
        $pr_details = $this->get_pr($pr_no);
        $department = $this->security->xss_clean($pr_details['department']);
        $description = $this->security->xss_clean($pr_details['description']);
        $ma = $this->get_ma_approver();
        $fullname = $this->security->xss_clean($ma['first_name'].' '.$ma['last_name']);
        $to = $this->security->xss_clean($ma['email']);
        $subject = $this->security->xss_clean($pr_no.' '.$description);
        $from = $this->security->xss_clean('qrdtms@gmail.com');
        $body = '
        <p>Good day! '.$fullname.',</p>
        </br>
        </br>
        <p>You have a pending PR for approval please check the details below</p>
        <p>PR No.: '. $pr_no .'</p>
        <p>From: '. $department .'</p>
        <p>Description: '. $description .'</p>
        </br>
        <p>keep this email for document tracking</p>
        </br>
        </br>
        <p>Regards,</p>
        <p><b>Cabatuan QRDTMS</b></p>
        </br>
        </br>
        <small><i>This email message (including attachments, if any) is intended for the use of the individual or the entity to whom it is addressed and may contain information that is privileged, proprietary, confidential and exempt from disclosure. If you are not an intended recipient of this e-mail, you are not authorized to duplicate, copy, retransmit, or redistribute it by any means. Please delete it and any attachments immediately and notify the sender that you have received it in error.</i></small>
        ';

        //server setup for mailing
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'ssl://smtp.googlemail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $from;
        $mail->Password = 'nwswbygtrdfczojw';
        $mail->Port = 465;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

        //compose email
        $mail->setFrom($from);
        $mail->addAddress($to);
        $mail->Subject = $subject;
        $mail->isHtml(true);
        $mail->Body = $body;

        //condition checking if email sent
        return ($mail->send() ? 'Message sent' : 'Message not sent');

    }
   
    public function mt_to_creator($pr_no){
        $pr_details = $this->get_pr($pr_no);
        $id = $pr_details['created_by'];
        $creator = $this->get_creator($id);
        $department = $this->security->xss_clean($pr_details['department']);
        $description = $this->security->xss_clean($pr_details['description']);
        $fullname = $this->security->xss_clean($creator['first_name'].' '.$creator['last_name']);
        $to = $this->security->xss_clean($creator['email']);
        $subject = $this->security->xss_clean($pr_no.' '.$description);
        $from = $this->security->xss_clean('qrdtms@gmail.com');
        $body = '
        <p>Good day! '.$fullname.',</p>
        </br>
        </br>
        <p>Your PR has been approved by Municipal Treasury</p>
        <p>PR No.: '. $pr_no .'</p>
        <p>From: '. $department .'</p>
        <p>Description: '. $description .'</p>
        </br>
        <p>keep this email for document tracking</p>
        </br>
        </br>
        <p>Regards,</p>
        <p><b>Cabatuan QRDTMS</b></p>
        </br>
        </br>
        <small><i>This email message (including attachments, if any) is intended for the use of the individual or the entity to whom it is addressed and may contain information that is privileged, proprietary, confidential and exempt from disclosure. If you are not an intended recipient of this e-mail, you are not authorized to duplicate, copy, retransmit, or redistribute it by any means. Please delete it and any attachments immediately and notify the sender that you have received it in error.</i></small>
        ';

        //server setup for mailing
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'ssl://smtp.googlemail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $from;
        $mail->Password = 'nwswbygtrdfczojw';
        $mail->Port = 465;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

        //compose email
        $mail->setFrom($from);
        $mail->addAddress($to);
        $mail->Subject = $subject;
        $mail->isHtml(true);
        $mail->Body = $body;

        //condition checking if email sent
        return ($mail->send() ? 'Message sent' : 'Message not sent');

    }

    public function to_mm($pr_no){
        $pr_details = $this->get_pr($pr_no);
        $department = $this->security->xss_clean($pr_details['department']);
        $description = $this->security->xss_clean($pr_details['description']);
        $mm = $this->get_mm_approver();
        $fullname = $this->security->xss_clean($mm['first_name'].' '.$mm['last_name']);
        $to = $this->security->xss_clean($mm['email']);
        $subject = $this->security->xss_clean($pr_no.' '.$description);
        $from = $this->security->xss_clean('qrdtms@gmail.com');
        $body = '
        <p>Good day! '.$fullname.',</p>
        </br>
        </br>
        <p>You have a pending PR for approval please check the details below</p>
        <p>PR No.: '. $pr_no .'</p>
        <p>From: '. $department .'</p>
        <p>Description: '. $description .'</p>
        </br>
        <p>keep this email for document tracking</p>
        </br>
        </br>
        <p>Regards,</p>
        <p><b>Cabatuan QRDTMS</b></p>
        </br>
        </br>
        <small><i>This email message (including attachments, if any) is intended for the use of the individual or the entity to whom it is addressed and may contain information that is privileged, proprietary, confidential and exempt from disclosure. If you are not an intended recipient of this e-mail, you are not authorized to duplicate, copy, retransmit, or redistribute it by any means. Please delete it and any attachments immediately and notify the sender that you have received it in error.</i></small>
        ';

        //server setup for mailing
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'ssl://smtp.googlemail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $from;
        $mail->Password = 'nwswbygtrdfczojw';
        $mail->Port = 465;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

        //compose email
        $mail->setFrom($from);
        $mail->addAddress($to);
        $mail->Subject = $subject;
        $mail->isHtml(true);
        $mail->Body = $body;

        //condition checking if email sent
        return ($mail->send() ? 'Message sent' : 'Message not sent');

    }
   
    public function ma_to_creator($pr_no){
        $pr_details = $this->get_pr($pr_no);
        $id = $pr_details['created_by'];
        $creator = $this->get_creator($id);
        $department = $this->security->xss_clean($pr_details['department']);
        $description = $this->security->xss_clean($pr_details['description']);
        $fullname = $this->security->xss_clean($creator['first_name'].' '.$creator['last_name']);
        $to = $this->security->xss_clean($creator['email']);
        $subject = $this->security->xss_clean($pr_no.' '.$description);
        $from = $this->security->xss_clean('qrdtms@gmail.com');
        $body = '
        <p>Good day! '.$fullname.',</p>
        </br>
        </br>
        <p>Your PR has been approved by Municipal Accountant</p>
        <p>PR No.: '. $pr_no .'</p>
        <p>From: '. $department .'</p>
        <p>Description: '. $description .'</p>
        </br>
        <p>keep this email for document tracking</p>
        </br>
        </br>
        <p>Regards,</p>
        <p><b>Cabatuan QRDTMS</b></p>
        </br>
        </br>
        <small><i>This email message (including attachments, if any) is intended for the use of the individual or the entity to whom it is addressed and may contain information that is privileged, proprietary, confidential and exempt from disclosure. If you are not an intended recipient of this e-mail, you are not authorized to duplicate, copy, retransmit, or redistribute it by any means. Please delete it and any attachments immediately and notify the sender that you have received it in error.</i></small>
        ';

        //server setup for mailing
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'ssl://smtp.googlemail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $from;
        $mail->Password = 'nwswbygtrdfczojw';
        $mail->Port = 465;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

        //compose email
        $mail->setFrom($from);
        $mail->addAddress($to);
        $mail->Subject = $subject;
        $mail->isHtml(true);
        $mail->Body = $body;

        //condition checking if email sent
        return ($mail->send() ? 'Message sent' : 'Message not sent');

    }
    

    public function mm($pr_no){
        $pr_details = $this->get_pr($pr_no);
        $department = $this->security->xss_clean($pr_details['department']);
        $description = $this->security->xss_clean($pr_details['description']);
        $mm = $this->get_mm_approver();
        $fullname = $this->security->xss_clean($mm['first_name'].' '.$mm['last_name']);
        $to = $this->security->xss_clean($mm['email']);
        $subject = $this->security->xss_clean($pr_no.' '.$description);
        $from = $this->security->xss_clean('qrdtms@gmail.com');
        $body = '
        <p>Good day! '.$fullname.',</p>
        </br>
        </br>
        <p>You have successfully approved PR please check the details below</p>
        <p>PR No.: '. $pr_no .'</p>
        <p>From: '. $department .'</p>
        <p>Description: '. $description .'</p>
        </br>
        <p>keep this email for document tracking</p>
        </br>
        </br>
        <p>Regards,</p>
        <p><b>Cabatuan QRDTMS</b></p>
        </br>
        </br>
        <small><i>This email message (including attachments, if any) is intended for the use of the individual or the entity to whom it is addressed and may contain information that is privileged, proprietary, confidential and exempt from disclosure. If you are not an intended recipient of this e-mail, you are not authorized to duplicate, copy, retransmit, or redistribute it by any means. Please delete it and any attachments immediately and notify the sender that you have received it in error.</i></small>
        ';

        //server setup for mailing
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'ssl://smtp.googlemail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $from;
        $mail->Password = 'nwswbygtrdfczojw';
        $mail->Port = 465;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

        //compose email
        $mail->setFrom($from);
        $mail->addAddress($to);
        $mail->Subject = $subject;
        $mail->isHtml(true);
        $mail->Body = $body;

        //condition checking if email sent
        return ($mail->send() ? 'Message sent' : 'Message not sent');

    }
   
    public function mm_to_creator($pr_no){
        $pr_details = $this->get_pr($pr_no);
        $id = $pr_details['created_by'];
        $creator = $this->get_creator($id);
        $department = $this->security->xss_clean($pr_details['department']);
        $description = $this->security->xss_clean($pr_details['description']);
        $fullname = $this->security->xss_clean($creator['first_name'].' '.$creator['last_name']);
        $to = $this->security->xss_clean($creator['email']);
        $subject = $this->security->xss_clean($pr_no.' '.$description);
        $from = $this->security->xss_clean('qrdtms@gmail.com');
        $body = '
        <p>Good day! '.$fullname.',</p>
        </br>
        </br>
        <p>Your PR has been approved by Municipal Mayor you may proceed to PO creation</p>
        <p>PR No.: '. $pr_no .'</p>
        <p>From: '. $department .'</p>
        <p>Description: '. $description .'</p>
        </br>
        <p>keep this email for document tracking</p>
        </br>
        </br>
        <p>Regards,</p>
        <p><b>Cabatuan QRDTMS</b></p>
        </br>
        </br>
        <small><i>This email message (including attachments, if any) is intended for the use of the individual or the entity to whom it is addressed and may contain information that is privileged, proprietary, confidential and exempt from disclosure. If you are not an intended recipient of this e-mail, you are not authorized to duplicate, copy, retransmit, or redistribute it by any means. Please delete it and any attachments immediately and notify the sender that you have received it in error.</i></small>
        ';

        //server setup for mailing
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'ssl://smtp.googlemail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $from;
        $mail->Password = 'nwswbygtrdfczojw';
        $mail->Port = 465;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

        //compose email
        $mail->setFrom($from);
        $mail->addAddress($to);
        $mail->Subject = $subject;
        $mail->isHtml(true);
        $mail->Body = $body;

        //condition checking if email sent
        return ($mail->send() ? 'Message sent' : 'Message not sent');

    }
    
   
    public function admin_to_creator($pr_no){
        $pr_details = $this->get_pr($pr_no);
        $id = $pr_details['created_by'];
        $creator = $this->get_creator($id);
        $department = $this->security->xss_clean($pr_details['department']);
        $description = $this->security->xss_clean($pr_details['description']);
        $fullname = $this->security->xss_clean($creator['first_name'].' '.$creator['last_name']);
        $to = $this->security->xss_clean($creator['email']);
        $subject = $this->security->xss_clean($pr_no.' '.$description);
        $from = $this->security->xss_clean('qrdtms@gmail.com');
        $body = '
        <p>Good day! '.$fullname.',</p>
        </br>
        </br>
        <p>Your PR has been approved by the admin you may proceed to create PO</p>
        <p>PR No.: '. $pr_no .'</p>
        <p>From: '. $department .'</p>
        <p>Description: '. $description .'</p>
        </br>
        <p>keep this email for document tracking</p>
        </br>
        </br>
        <p>Regards,</p>
        <p><b>Cabatuan QRDTMS</b></p>
        </br>
        </br>
        <small><i>This email message (including attachments, if any) is intended for the use of the individual or the entity to whom it is addressed and may contain information that is privileged, proprietary, confidential and exempt from disclosure. If you are not an intended recipient of this e-mail, you are not authorized to duplicate, copy, retransmit, or redistribute it by any means. Please delete it and any attachments immediately and notify the sender that you have received it in error.</i></small>
        ';

        //server setup for mailing
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'ssl://smtp.googlemail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $from;
        $mail->Password = 'nwswbygtrdfczojw';
        $mail->Port = 465;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

        //compose email
        $mail->setFrom($from);
        $mail->addAddress($to);
        $mail->Subject = $subject;
        $mail->isHtml(true);
        $mail->Body = $body;

        //condition checking if email sent
        return ($mail->send() ? 'Message sent' : 'Message not sent');

    }

    
    public function get_po($id){
        return $this->db->query("SELECT * FROM orders WHERE order_no = ?",
        array(
            $this->security->xss_clean($id)
        ))->result_array()[0];
    }
    
    public function create_po($form_data){
        $po = $this->security->xss_clean($form_data['po_no']);
        $po_details = $this->get_po($po);;
        $creator = $this->get_creator($po_details['created_by']);
        $department = $this->security->xss_clean($form_data['department']);
        $description = $this->security->xss_clean($form_data['description']);
        $fullname = $this->security->xss_clean($creator['first_name'].' '.$creator['last_name']);
        $to = $this->security->xss_clean($creator['email']);
        $subject = $this->security->xss_clean($form_data['pr_no'].' '.$description);
        $from = $this->security->xss_clean('qrdtms@gmail.com');
        $body = '
        <p>Good day! '.$fullname.',</p>
        </br>
        </br>
        <p>You have successfully create PO document, please check the details below</p>
        <p>PO No.: '.$po.'</p>
        <p>From: '. $department .'</p>
        <p>Description: '. $description .'</p>
        </br>
        </br>
        <p>keep this as your transaction receipt</p>
        </br>
        </br>
        <p>Regards,</p>
        <p><b>Cabatuan QRDTMS</b></p>
        </br>
        </br>
        <small><i>This email message (including attachments, if any) is intended for the use of the individual or the entity to whom it is addressed and may contain information that is privileged, proprietary, confidential and exempt from disclosure. If you are not an intended recipient of this e-mail, you are not authorized to duplicate, copy, retransmit, or redistribute it by any means. Please delete it and any attachments immediately and notify the sender that you have received it in error.</i></small>
        ';

        //server setup for mailing
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'ssl://smtp.googlemail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $from;
        $mail->Password = 'nwswbygtrdfczojw';
        $mail->Port = 465;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

        //compose email
        $mail->setFrom($from);
        $mail->addAddress($to);
        $mail->Subject = $subject;
        $mail->isHtml(true);
        $mail->Body = $body;

        //condition checking if email sent
        return ($mail->send() ? 'Message sent' : 'Message not sent');

    }

    public function po_to_mm($form_data){
        $po = $this->security->xss_clean($form_data['po_no']);
        $po_details = $this->get_po($po);;
        // $creator = $this->get_creator($po_details['created_by']);
        $department = $this->security->xss_clean($form_data['department']);
        $description = $this->security->xss_clean($form_data['description']);
        $mm = $this->get_mm_approver();
        $fullname = $this->security->xss_clean($mm['first_name'].' '.$mm['last_name']);
        $to = $this->security->xss_clean($mm['email']);
        $subject = $this->security->xss_clean($po_details['pr_no'].' '.$description);
        $from = $this->security->xss_clean('qrdtms@gmail.com');
        $body = '
        <p>Good day! '.$fullname.',</p>
        </br>
        </br>
        <p>You have a pending PO for approval please check the details below</p>
        <p>PR No.: '. $po .'</p>
        <p>From: '. $department .'</p>
        <p>Description: '. $description .'</p>
        </br>
        <p>keep this email for document tracking</p>
        </br>
        </br>
        <p>Regards,</p>
        <p><b>Cabatuan QRDTMS</b></p>
        </br>
        </br>
        <small><i>This email message (including attachments, if any) is intended for the use of the individual or the entity to whom it is addressed and may contain information that is privileged, proprietary, confidential and exempt from disclosure. If you are not an intended recipient of this e-mail, you are not authorized to duplicate, copy, retransmit, or redistribute it by any means. Please delete it and any attachments immediately and notify the sender that you have received it in error.</i></small>
        ';

        //server setup for mailing
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'ssl://smtp.googlemail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $from;
        $mail->Password = 'nwswbygtrdfczojw';
        $mail->Port = 465;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

        //compose email
        $mail->setFrom($from);
        $mail->addAddress($to);
        $mail->Subject = $subject;
        $mail->isHtml(true);
        $mail->Body = $body;

        //condition checking if email sent
        return ($mail->send() ? 'Message sent' : 'Message not sent');

    }
   
    
    public function get_po_to_po($id){
        return $this->db->query("SELECT * FROM orders WHERE order_no = ?",
        array(
            $this->security->xss_clean($id)
        ))->result_array()[0];
    }
   
    
    public function approved($po){
        $po_details = $this->get_po_to_po($po);
        $id = $po_details['created_by'];
        $creator = $this->get_creator($id);
        $fullname = $this->security->xss_clean($creator['first_name'].' '.$creator['last_name']);
        $to = $this->security->xss_clean($creator['email']);
        $subject = $this->security->xss_clean($po.' '.'Successfully approved');
        $from = $this->security->xss_clean('qrdtms@gmail.com');
        $body = '
        <p>Good day! '.$fullname.',</p>
        </br>
        </br>
        <p>Your PO has been approved by Municipal Mayor you may proceed disbursement voucher</p>
        <p>PO No.: '. $po .'</p>
        </br>
        </br>
        <p>keep this email for document tracking</p>
        </br>
        </br>
        <p>Regards,</p>
        <p><b>Cabatuan QRDTMS</b></p>
        </br>
        </br>
        <small><i>This email message (including attachments, if any) is intended for the use of the individual or the entity to whom it is addressed and may contain information that is privileged, proprietary, confidential and exempt from disclosure. If you are not an intended recipient of this e-mail, you are not authorized to duplicate, copy, retransmit, or redistribute it by any means. Please delete it and any attachments immediately and notify the sender that you have received it in error.</i></small>
        ';

        //server setup for mailing
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'ssl://smtp.googlemail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $from;
        $mail->Password = 'nwswbygtrdfczojw';
        $mail->Port = 465;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

        //compose email
        $mail->setFrom($from);
        $mail->addAddress($to);
        $mail->Subject = $subject;
        $mail->isHtml(true);
        $mail->Body = $body;

        //condition checking if email sent
        return ($mail->send() ? 'Message sent' : 'Message not sent');

    }

}
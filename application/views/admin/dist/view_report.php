<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Reports</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"> <a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item active">Reports</li>
                        </ol>
<?php                   if($this->session->flashdata('success')){
?>                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <?=$this->session->flashdata('success');?> 
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
<?php                   }
?>                        <div class="card mb-4">
                            <div class="card-body">
                                
                            </div>
                        </div>
                    </div>
                
                
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <p>Purchase Request</p>
                        <hr>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-1">
                                    <div class="card-body">
                                        Total Documents 
                                        <h1><?=$total['total_request']?></h1>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-1">
                                    <div class="card-body">
                                        Pending Documents
                                        <h1><?=$pending['total_pending']?></h1>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-1">
                                    <div class="card-body">
                                        Approved Documents
                                        <h1><?=$approved['total_approve']?></h1>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">
                                        Canceled Documents
                                        <h1><?=$cancel['total_cancel']?></h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p>Purchase Order</p>
                        <hr>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-1">
                                    <div class="card-body">
                                        Total Documents 
                                        <h1><?=$po_total['total_request']?></h1>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-1">
                                    <div class="card-body">
                                        Pending Documents
                                        <h1><?=$po_pending['total_pending']?></h1>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-1">
                                    <div class="card-body">
                                        Approved Documents
                                        <h1><?=$po_approved['total_approve']?></h1>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">
                                        Canceled Documents
                                        <h1><?=$po_cancel['total_cancel']?></h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
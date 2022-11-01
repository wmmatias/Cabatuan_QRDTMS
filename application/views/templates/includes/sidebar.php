<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$userlevel = $this->session->userdata('userlevel');
?>        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="/">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link" href="/dashboard/users">
                                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                                Users
                            </a>
                            <div class="sb-sidenav-menu-heading">Transaction</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#create" aria-expanded="false" aria-controls="create">
                                <div class="sb-nav-link-icon"><i class="fas fa-plus"></i></div>
                                Create
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="create" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="/dashboard/vendor">Vendor</a>
                                    <a class="nav-link" href="/dashboard/item">Item</a>
                                    <a class="nav-link" href="/dashboard/pr_details">Purchase Request</a>
                                    <a class="nav-link" href="/dashboard/order">Purchase Order</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#purchase" aria-expanded="false" aria-controls="purchase">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Document Logs
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="purchase" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="/dashboard/list_request">Purchase Request</a>
                                    <a class="nav-link" href="/dashboard/list_order">Purchase Order</a>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?=($userlevel === '0' ? 'Admin' : 'User')?>
                    </div>
                </nav>
            </div>
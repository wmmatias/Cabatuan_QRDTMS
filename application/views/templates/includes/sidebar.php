<?php
defined('BASEPATH') OR exit('No direct script access allowed');
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
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-file"></i></div>
                                Forms
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="/">Sample forms</a>
                                    <a class="nav-link" href="/">...</a>
                                </nav>
                            </div>
                            <a class="nav-link" href="/">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Document Logs
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Admin / User
                    </div>
                </nav>
            </div>
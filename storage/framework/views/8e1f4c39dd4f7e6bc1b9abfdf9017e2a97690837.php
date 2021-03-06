<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="site_title">
                <span><?php echo e(config('app.name')); ?></span>
            </a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                
                <img src="http://203.157.229.35/sis/img/user_icon.png" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <h2><?php echo e(auth()->user()->name); ?></h2>
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br/>

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                
                <ul class="nav side-menu">
                    <li>
                        
                        <a href="<?php echo e(route('admin.dashboard')); ?>">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            Home
                        </a>
                    </li>
                </ul>
            </div>
            <div class="menu_section">
                <h3>Management</h3>

                
                <?php ($emp = ''); ?>
                <?php ($app = ''); ?>
                <?php ($stor = ''); ?> 
                <?php ($qf = ''); ?> 
                
                <?php if(!empty($employee)): ?>
                    <?php if(isset($employee[0])): ?>
                        <?php ($emp = $employee[0]->id); ?>
                    <?php elseif(isset($employee)): ?>
                        <?php ($emp = $employee->id); ?>
                    <?php endif; ?>
                <?php endif; ?>
                <?php if(!empty($appointment)): ?>
                    <?php ($app = $appointment->id); ?>
                <?php endif; ?>
                <?php if(!empty($stores)): ?>
                    <?php ($stor = $stores->id); ?>
                <?php endif; ?>
                <?php if(!empty($questionsforum)): ?>
                    <?php if(!empty($questionsforum->id)): ?>
                        <?php ($qf =  $questionsforum->id); ?>
                    <?php endif; ?>
                <?php endif; ?> 

                <ul class="nav side-menu">
                    <li class="<?php if(Request::is('admin/employees/add') || Request::is('admin/employees/'.$emp.'/edit') || Request::is('admin/employees/'.$emp)): ?> active <?php endif; ?>">
                        <a href="<?php echo e(route('admin.employees')); ?>">
                            <i class="fa fa-id-badge" aria-hidden="true"></i>
                            <?php echo e("Employees"); ?>

                        </a>
                    </li>
                    <li class="<?php if(Request::is('admin/diagnosis') || Request::is('admin/diagnosis/add')): ?> active <?php endif; ?>">
                        <a href="<?php echo e(route('admin.patients')); ?>">
                            <i class="fa fa-users" aria-hidden="true"></i>
                            <?php echo e("Patients"); ?>

                        </a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('admin.doctors')); ?>">
                            <i class="fa fa-users" aria-hidden="true"></i>
                            <?php echo e("Doctors"); ?>

                        </a>
                    </li>
                    <li class="<?php if(Request::is('admin/appointments/add') || Request::is('admin/appointments/'.$app.'/edit') || Request::is('admin/appointments/'.$app)): ?> active <?php endif; ?>">
                        <a href="<?php echo e(route('admin.appointments')); ?>">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            <?php echo e("Appointments"); ?>

                        </a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('admin.services')); ?>">
                            <i class="fa fa-list" aria-hidden="true"></i>
                            <?php echo e("Services"); ?>

                        </a>
                    </li>
                    <li class="<?php if(Request::is('admin/financial')): ?> active <?php endif; ?>">
                        <a href="<?php echo e(route('admin.financial')); ?>">
                            <i class="fa fa-money" aria-hidden="true"></i>
                            <?php echo e("Financial"); ?>

                        </a>
                    </li>
                    <li class="<?php if(Request::is('admin/store/add') || Request::is('admin/store/edit/'.$stor) || Request::is('admin/store/'.$stor)): ?> active <?php endif; ?>">
                        <a href="<?php echo e(route('admin.store')); ?>">
                            <i class="fa fa-sitemap" aria-hidden="true"></i>
                            <?php echo e("Store"); ?>

                        </a>
                    </li>
                    <li class="<?php if(Request::is('admin/question_forum/add') || Request::is('admin/question_forum/edit/'.$qf) || Request::is('admin/question_forum/'.$qf)): ?> active <?php endif; ?>">
                        <a href="<?php echo e(route('admin.question_forum')); ?>">
                            <i class="fa fa-question-circle" aria-hidden="true"></i>
                            <?php echo e("Question Forum"); ?>

                        </a>
                    </li>
                    <li class="<?php if(Request::is('admin/quotation/add') || Request::is('admin/quotation/edit/'.$qf) || Request::is('admin/quotation/'.$qf)): ?> active <?php endif; ?>">
                        <a href="<?php echo e(route('admin.quotation')); ?>">
                            <i class="fa fa-file" aria-hidden="true"></i>
                            <?php echo e("Quotation"); ?>

                        </a>
                    </li>
                    
                </ul>
            </div>
            
        </div>
        <!-- /sidebar menu -->
    </div>
</div>

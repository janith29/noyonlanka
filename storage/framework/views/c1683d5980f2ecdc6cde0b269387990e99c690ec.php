<?php $__env->startSection('title', "Financial  Management"); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
        <table class="table table-striped table-hover">
            <tbody>
                <tr>
                    
                    <td><center><img src="\image\finacial\bill.png"  alt="Pic" height="90" width="90" class="user-profile-image"></center></td>
        
                </tr>
                <?php
                
                use Illuminate\Support\Facades\DB;
                
                $services=DB::select("select * from service WHERE id = ".$Invoice->service.";");
                foreach ($services as $service)
                {
                    $Invoice->service=$service->serviceName;
                }
                ?>
                <?php
                $name='no';
                $patintID='no';
                foreach ($patients as $patient)
                {
                if($Invoice->patient_ID==$patient->id)
                {
                    $name=$patient->name;
                    $patintID=$patient->id;
                }
                }?>
                <tr>
                    <th>Patient Name</th>
                    <td>
                        <?php echo e($name); ?>

                        
                    </td>
                </tr>
    
                <tr>
                    <th>Total amount</th>
                    <td><?php echo e($Invoice->amount); ?></td>
                </tr>
                <tr>
                    <th>Total service</th>
                    <td><?php echo e($Invoice->service); ?></td>
                </tr>
                <tr>
                    <th>Remaining amount</th>
                    <td>
                        <?php echo e($Invoice->remaining_amount); ?>

                    </td>
                </tr>
                <tr>
                        
                <tr>
                    <th></th>
                    <td><a href="<?php echo e(URL::previous()); ?>" class="btn btn-light"><i class="fa fa-arrow-left"></i> Go Back</a></td>
                    
                </tr>
                
            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('patient.layouts.patient', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
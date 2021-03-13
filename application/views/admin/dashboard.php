<!--
=========================================================
Material Dashboard - v2.1.2
=========================================================

Product Page: https://www.creative-tim.com/product/material-dashboard
Copyright 2020 Creative Tim (https://www.creative-tim.com)
Coded by Creative Tim

=========================================================
The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->
<!DOCTYPE html>

    <?php $this->load->view('includes/validation') ?>

<html lang="en">

<head>
  <?php $this->load->view('includes/head')?>
</head>

<body class="">
    <div class="wrapper ">

        <!-- SIDEBAR -->
        <?php $this->load->view('includes/adminsidebar') ?>
        <!-- END OF SIDEBAR -->

        <!-- NAVBAR -->
        <?php $this->load->view('includes/adminnavbar') ?>
        <!-- END OF NAVBAR -->

        <!-- MAIN CONTENT -->
        <div class="content">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header card-header-warning card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">approval</i>
                                </div>
                                <p class="card-category">Request Count</p>
                                <h3 class="card-title"><?php echo $request[0]->requestCount?>
                                </h3>
                                </div>
                                <div class="card-footer">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header card-header-success card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">thumb_up_alt</i>
                                </div>
                                <p class="card-category">Approved Count</p>
                                <h3 class="card-title"><?php echo $approved[0]->approvedCount?></h3>
                                </div>
                                <div class="card-footer">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header card-header-danger card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">thumb_down_alt</i>
                                </div>
                                <p class="card-category">Declined Count</p>
                                <h3 class="card-title"><?php echo $declined[0]->declinedCount?></h3>
                                </div>
                                <div class="card-footer">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header card-header-info card-header-icon">
                                <div class="card-icon">
                                    <i class="fa fa-user"></i>
                                </div>
                                <p class="card-category">User Count</p>
                                <h3 class="card-title"><?php echo $user[0]->userCount?></h3>
                                </div>
                                <div class="card-footer">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row"> 
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title ">Reports</h4>
                                <p class="card-category">Reports Log</p>
                            </div>
                                <div class="card-body">
                                    <div class="table-responsive">

                                        <!-- TABLE STARTS -->
                                        <table id="approvedTable" class="table" style="width:100%">
                                            <thead class=" text-primary">
                                                <th>ID</th>
                                                <th>Applicant Name</th>
                                                <th>Team Name</th>
                                                <th>Email</th>
                                                <th>Requested Date</th>
                                                <th>Status</th>
                                                <th>Admin in charge</th>
                                            </thead>
                                            <tbody id="approvedBodyTable">
                                                
                                            </tbody>
                                        </table>
                                        <!-- TABLE END -->

                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT -->

    </div>
  
    <!-- CORE JS -->
    <?php $this->load->view('includes/corejs')?>
    <?php $this->load->view('includes/notification')?>
    <!-- END OF CORE JS -->
  
</body>

<script>
$(document).ready(function(){

    function loadtable(){
        approvedDataTable = $('#approvedTable').DataTable( {
            "pageLength": 10,
            "ajax": "<?php echo base_url()?>admin/approved/show_all_approved",
            "columns": [
                { data: "id"},
                { data: "requestApplicantName"},
                { data: "requestTeamName"},
                { data: "requestEmail"},
                { data: "requestDate", render: function(data, type, row){
                    return moment(data).format('LL')
                }},
                { data: "requestStatus", render: function(data, type, row){
                    if(data == 2){
                        return `<span class="badge badge-success">Approved</span>`
                    }
                    else{
                        return `<span class="badge badge-danger">Declined</span>`
                    }
                }},
                { data: "userName", render: function(data, type, row){
                    return `<span class="badge badge-primary">${data}</span>`
                }},
            ],

            "aoColumnDefs": [{"bVisible": false, "aTargets": [0]}],
            "order": [[0, "desc"]]
        })
    }

    function refresh() {
        var url = "<?php echo base_url()?>admin/approved/show_all_approved"

        approvedDataTable.ajax.url(url).load();
    }


    loadtable()

    // DELETE USER
    $(document).on("click", ".btnDelete", function(){
        var id = this.value

        console.log(id)

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                
                $.ajax({
                    url: '<?php echo base_url()?>admin/approved/delete_approved',
                    data: {id: id},
                    method: 'POST',

                        success:function(data){
                            refresh();
                            Swal.fire(
                                'Deleted!',
                                'Approved has been remove!.',
                                'success'
                                )
                        }
                });

            }
        })
    })
    // END OF DELETE USER


});
</script>

</html>
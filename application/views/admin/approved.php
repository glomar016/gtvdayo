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
                
                <!-- TABLE CARD -->
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">Approved Request</h4>
                        <p class="card-category">List of approved request</p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">

                            <!-- TABLE STARTS -->
                            <table id="approvedTable" class="table" style="width:100%">
                                <thead class=" text-primary">
                                    <th>ID</th>
                                    <th>Applicant Name</th>
                                    <th>Team Name</th>
                                    <th>Barangay</th>
                                    <th>City</th>
                                    <th>Email</th>
                                    <th>Requested Date</th>
                                    <th>Approved by</th>
                                    <th>Action</th>
                                </thead>
                                <tbody id="approvedBodyTable">
                                    
                                </tbody>
                            </table>
                            <!-- TABLE END -->

                        </div>
                    </div>
                </div>
                <!-- END OF TABLE CARD -->

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
            "ajax": "<?php echo base_url()?>admin/approved/show_approved",
            "columns": [
                { data: "id"},
                { data: "requestApplicantName"},
                { data: "requestTeamName"},
                { data: "requestBarangay"},
                { data: "requestCity"},
                { data: "requestEmail"},
                { data: "requestDate", render: function(data, type, row){
                    return moment(data).format('LL')
                }},
                { data: "userName"},
                { data: "requestStatus", render: function(data, type, row){
                    if(data == 2){
                        return `<div class="btn-group" >'
                        <button class="btn btn-danger btn-sm btnDelete" value="${row.approvedID}" title="Remove" style="margin:2px" type="button">Remove</button></div>`;
                    }
                    else{
                        return `<div class="btn-group">'
                                '<button class="btn btn-dark btn-sm btnActivate" value="${row.approvedID}" title="Activate" type="button">Activate</button></div>`;
                    }
                }}
            ],

            "aoColumnDefs": [{"bVisible": false, "aTargets": [0]}],
            "order": [[0, "desc"]]
        })
    }

    function refresh() {
        var url = "<?php echo base_url()?>admin/approved/show_approved"

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
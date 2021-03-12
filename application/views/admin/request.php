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
                        <h4 class="card-title ">Schedule Request</h4>
                        <p class="card-category">List of schedule request</p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">

                            <!-- TABLE STARTS -->
                            <table id="requestTable" class="table" style="width:100%">
                                <thead class=" text-primary">
                                    <th>ID</th>
                                    <th>Applicant Name</th>
                                    <th>Team Name</th>
                                    <th>Barangay</th>
                                    <th>City</th>
                                    <th>Email</th>
                                    <th>Requested Date</th>
                                    <th>Action</th>
                                </thead>
                                <tbody id="requestBodyTable">
                                    
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

    <div id="sendModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header" style="color:white;background-color:#4caf50">
                <h5 class="modal-title">Send Mail to Applicant</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="sendForm" method="POST">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="label">Court Location</label>
                          <input id="sendID" name="sendID" hidden>
                          <input type="text" id="sendAddress" name="sendAddress" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="label">Game Time Preferred</label>
                          <input id="sendTime" name="sendTime" type="time" class="form-control">
                        </div>
                      </div>
                    </div>
                
            </div>
            <div class="modal-footer">
                <input type="submit" value="Send Message" id="btnSend" class="btn btn-primary">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </form>
            </div>
        </div>
    </div>
  
    <!-- CORE JS -->
    <?php $this->load->view('includes/corejs')?>
    <?php $this->load->view('includes/notification')?>
    <!-- END OF CORE JS -->
  
</body>

<script>
$(document).ready(function(){

    function loadtable(){
        requestDataTable = $('#requestTable').DataTable( {
            "pageLength": 10,
            "ajax": "<?php echo base_url()?>admin/request/show_request",
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
                { data: "requestStatus", render: function(data, type, row){
                    if(data == 1){
                        return `<div class="btn-group" >'
                        <button class="btn btn-success btn-sm btnApprove" value="${row.id}" title="btnApprove" style="margin:2px" type="button">Approve</button>
                        <button class="btn btn-danger btn-sm btnDelete" value="${row.id}" title="Delete" style="margin:2px" type="button">Decline</button></div>`;
                    }
                    else{
                        return `<div class="btn-group">'
                                '<button class="btn btn-dark btn-sm btnActivate" value="${row.id}" title="Activate" type="button">Activate</button></div>`;
                    }
                }}
            ],

            "aoColumnDefs": [{"bVisible": false, "aTargets": [0]}],
            "order": [[0, "desc"]]
        })
    }

    function refresh() {
        var url = "<?php echo base_url()?>admin/request/show_request"

        requestDataTable.ajax.url(url).load();
    }


    loadtable()

    // DELETE USER
    $(document).on("click", ".btnDelete", function(){
        var id = this.value

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, decline it!'
            }).then((result) => {
            if (result.isConfirmed) {
                
                $.ajax({
                    url: '<?php echo base_url()?>admin/request/delete_request',
                    data: {id: id},
                    method: 'POST',

                        success:function(data){
                            refresh();
                            Swal.fire(
                                'Deleted!',
                                'Request has been declined!.',
                                'success'
                                )
                        }
                });

            }
        })
    })
    // END OF DELETE USER

    // DELETE USER
    $(document).on("click", ".btnApprove", function(){
        var id = this.value

        $('#sendID').val(id)
        $('#sendModal').modal('show')
    })
    // END OF DELETE USER

    $('#sendForm').on('submit', function(e){
        var id = $('#sendID').val()
        console.log(id)
        var address = $('#sendAddress').val()
        var time = $('#sendTime').val()
        e.preventDefault()
        
        if(address == '' || time == ''){
            Swal.fire(
            'Warning',
            'Fill required fields!',
            'warning'
            )
            $('#btnSend').val('Send Message')
                            $("#btnSend").attr("disabled", false)
        }
        else{
            $("#btnSend").attr("disabled", true)
            $('#btnSend').val('Sending Message...')

            

                    $.ajax({
                        url: '<?php echo base_url()?>admin/request/send_message',
                        data: $('#sendForm').serialize(),
                        method: 'POST',

                            success:function(data){
                                refresh();
                                $('#sendModal').modal('hide')
                                $('#btnSend').val('Send Message')
                                $("#btnSend").attr("disabled", false)
                                showNotify('add_alert', 'You successfully send an email to the applicant', 'success', 'top', 'right');
                            }
                    });
        }

        
    })
});
</script>

</html>
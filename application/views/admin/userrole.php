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
                        <h4 class="card-title ">Users</h4>
                        <p class="card-category"> List of users</p>
                        <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#userModal">
                            Add User
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">

                            <!-- TABLE STARTS -->
                            <table id="userTable" class="table" style="width:100%">
                                <thead class=" text-primary">
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    
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

    <div id="userModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header" style="color:white;background-color:#4caf50">
                <h5 class="modal-title">Add User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="userForm" method="POST">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Username</label>
                          <input id="userName" name="userName" type="text" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Password</label>
                          <input id="userPassword" name="userPassword" type="password" class="form-control">
                        </div>
                      </div>
                    </div>
                
            </div>
            <div class="modal-footer">
                <input type="submit" value="Submit" id="btnAddUser" class="btn btn-success">
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
        userDataTable = $('#userTable').DataTable( {
            "pageLength": 10,
            "ajax": "<?php echo base_url()?>admin/userrole/show_user",
            "columns": [
                { data: "id"},
                { data: "userName"},
                { data: "userStatus", render: function(data, type, row){
                    if(data == 1){
                        return `<div class="btn-group">'
                                '<button class="btn btn-danger btn-sm btnDelete" value="${row.id}" title="Delete" type="button">Delete</button></div>`;
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
        var url = "<?php echo base_url()?>admin/userrole/show_user"

        userDataTable.ajax.url(url).load();
    }

    loadtable()

    // ADD USER
    $('#userForm').on('submit', function(e){
        e.preventDefault()
        
        var userName = $('#userName').val()
        var userPassword = $('#userPassword').val()

        if(userName == '' || userPassword == ''){
            Swal.fire({
                    title: 'Warning!',
                    text: 'Please fill out required field.',
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                    })
        }
        else{
            var form = $('#addTaskForm');
            // ajax
            $.ajax({
                url: '<?php echo base_url() ?>admin/userrole/add_user',
                type: 'post',
                data: new FormData(this),
                processData:false,
                contentType:false,

                success: function() {
                    $('#userModal').modal('hide');
                    $('#userModal form')[0].reset();
                    showNotify('add_alert', 'You successfully added a user', 'success', 'top', 'right');
                    refresh()
                }

            });
            // end of ajax
        }

    })
    // END OF ADD USER

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
            confirmButtonText: 'Yes, deactivate it!'
            }).then((result) => {
            if (result.isConfirmed) {
                
                $.ajax({
                    url: '<?php echo base_url()?>admin/userrole/delete_user',
                    data: {id: id},

                        success:function(data){
                            refresh();
                            Swal.fire(
                                'Deleted!',
                                'User has been deactivated!.',
                                'success'
                                )
                        }
                });


            }
        })
    })
    // END OF DELETE USER

    // DELETE USER
    $(document).on("click", ".btnActivate", function(){
        var id = this.value

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, activate it!'
            }).then((result) => {
            if (result.isConfirmed) {
                
                $.ajax({
                    url: '<?php echo base_url()?>admin/userrole/activate_user',
                    data: {id: id},

                        success:function(data){
                            refresh();
                            Swal.fire(
                                'Sucess!',
                                'User has been deactivated!.',
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
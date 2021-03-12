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
                                        <th>Password</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody id="tableBody">
                                        
                                    </tbody>
                                </table>
                                <!-- TABLE END -->

                            </div>
                        </div>
                    </div>
                <!-- END OF TABLE CARD -->
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
        userDataTable = $('#userTable').DataTable({
            "ajax": "<?php echo base_url()?>admin/test/get_all_users",
            "columns": [
                {data: "id"},
                {data: "userName", render: function(data, row, type){
                    if(data == 'cxrrupt04'){
                        return `<p style="color:red">${data}</p>`
                    }
                    else{
                        return data;
                    }
                }},
                {data: "userPassword"},
                { data: "userStatus", render: function(data, type, row){
                    if(data == 1){
                        return `<div class="btn-group">
                                <button class="btn btn-primary btn-sm btn_view" value="${row.id}" title="View" type="button" >View</button>
                                <button class="btn btn-warning btn-sm btn_edit" value="${row.id}" title="Edit" type="button" >Edit</button>
                                <button class="btn btn-danger btn-sm btn_delete" value="${row.id}" title="Delete" type="button">Delete</button></div>`;
                    }   
                    else{
                        return `<button class="btn btn-dark btn-sm btn_activate" value="${row.id}" title="Activate" type="button">Activate</button></div>`;
                    }
                }}
            ]

        })
    }

    function refresh(){
        var url = "<?php echo base_url()?>admin/test/get_all_users";

        userDataTable.ajax.url(url).load();
    }

    loadtable()

    // $.ajax({
    //     url: '<?php echo base_url()?>admin/test/get_all_users',
    //     type: 'GET',
    //     success: function(data){
    //         var parsedResponse = jQuery.parseJSON(data)
            
    //         console.log(parsedResponse);
    //         for(i = 0; i < parsedResponse.length; i++){
    //             var tableRow = `<tr>
    //                 <td>${parsedResponse[i]['id']}</td>
    //                 <td>${parsedResponse[i]['userName']}</td>
    //                 <td>${parsedResponse[i]['userPassword']}</td>
    //                 <td><button class="btn btn-danger">Delete</button></td>
    //             </tr>`

    //             $('#tableBody').append(tableRow)
    //         }
    //     }
    // })

    $(document).on("click", ".btn_delete", function(){
        var id = this.value

        $.ajax({
            url: '<?php echo base_url()?>admin/test/delete_user',
            data: {id: id},
            type: 'POST',

            success: function(){
                refresh()
            }
        })
    })

})
</script>

</html>
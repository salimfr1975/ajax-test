<!Doctype html>
<html>
    <head>
        <title>
            Afci - Website
        </title>
        <link rel="stylesheet" href="css/style.css">

        
    </head>
    <body>
        <table id="main" border="0" cellspacing="0">
            <tr>
                <td id="header">
                    <h1>AFCI Formation</h1>
                    <div id="chercher">
                        <label>Chercher : </label>
                        <input type="text" id="txtChercher" 
                            autocomplete="off">
                    </div>
                </td>
            </tr>
            <tr>
                <td id="frmTable">
                    <form id= "frmAjouter">
                        <table border ="0">
                            <tr>
                                <td>First Name : </td>
                                <td><input type="text" id="fname"> </td>
                                <td>Last Name :</td>
                                <td><input type="text" id="lname"></td>
                                <td><input type="submit" id="save-button"></td>
                            </tr>
                        </table>
                       <br>
                       
                       <table border ="0">
                            <tr>
                                <td>HTML </td>
                                <td>ANGULAR </td>
                                <td>PHP</td>
                                <td>AJAX</td>
                                <td>IONIC</td>
                            </tr>
                            <tr>
                                <td> <input type="text" id="html"></td>
                                <td> <input type="text" id="angular"> </td>
                                <td> <input type="text" id="php"></td>
                                <td> <input type="text" id="ajax"></td>
                                <td> <input type="text" id="ionic"></td>
                            </tr>
                        </table>
                        
                    </form>
                </td>
            </tr>
            <tr>
                <td id="table-data">

                </td>
            </tr>
        </table>
        <div id="error-message">

        </div>
        <div id="success-message">

        </div>
        <div id="modal">
            <div id="modal-form">
                <h2>Modifier les Enregistrements</h2>
                <table cellpadding="10px" width="100%">

                </table>
                <div id="close-btn">X</div>
            </div>
        </div>


        



        <script type="text/javascript" src="js/jquery.js">

        </script>
        
        <script type="text/javascript">
            $(document).ready(function()
            {
                function loadTable()
                {
                    $.ajax(
                        {
                            url:"ajax-load.php",
                            type:"POST",
                            success:function(data){
                                $("#table-data").html(data);
                            }
                        }
                    );
                }
                loadTable();

                $("#save-button").on("click",function(e)
                {
                    e.preventDefault();
                    var fname = $("#fname").val();
                    var lname = $("#lname").val();
                    if(fname=="" || lname=="") 
                    {
                        $("#error-message").html("All fields are required.").slideDown();
                        $("#success-message").slideUp();
                    }
                    else
                    {
                        $.ajax({
                            url : "ajax-insert.php",
                            type : "POST",
                            data : {first_name:fname, last_name:lname},
                            success : function(data)
                            {
                                if(data == 1)
                                {
                                    loadTable();
                                    $("#frmAjouter").trigger("reset");
                                    $("#success-message").html("Data Inserted successfully").slideDown();
                                    $("#error-message").slideUp();
                                }
                                else
                                {
                                    $("#error-message").html("Can't Save Record.").slideDown();
                                    $("#success-message").slideUp();
                                }
                            }

                        });
                    }
                });
                
                $(document).on("click",".delete-btn", function()
                {
                    if(confirm("Do you really want to delete this record ?"))
                    {
                        var studentId = $(this).data("id");
                        var element = this;
                        $.ajax
                        ({
                            url: "ajax-delete.php",
                            type : "POST",
                            data : 
                            {
                                id : studentId
                            },
                            success : function(data)
                            {
                                if(data == 1)
                                {
                                    $(element).closest("tr").fadeOut();
                                }
                                else
                                {
                                    $("#error-message").html("Can't Delete Record.").slideDown();
                                    $("#success-message").slideUp();
                                }
                            }
                        });
                    }
                });
                $(document).on("click",".edit-btn", function()
                {
                    $("#modal").show();
                    var studentId = $(this).data("id");
                    $.ajax
                    (
                        {
                            url: "load-update-form.php",
                            type: "POST",
                            data: {id: studentId },
                            success: function(data) 
                            {
                                $("#modal-form table").html(data);
                            }
                        }
                    )
                });

                $(document).on("click",".report-btn", function()
                {
                    $("#modal").show();
                    var studentId = $(this).data("id");
                    $.ajax
                    (
                        {
                            url: "load-update-form.php",
                            type: "POST",
                            data: {id: studentId },
                            success: function(data) 
                            {
                                $("#modal-form table").html(data);
                            }
                        }
                    )
                });
                
                $("#close-btn").on("click",function()
                {
                    $("#modal").hide();
                });
                
                $(document).on("click","#edit-submit", function(){
                    var stuId = $("#edit-id").val();
                    var fname = $("#edit-fname").val();
                    var lname = $("#edit-lname").val();
                    $.ajax({
                    url: "ajax-update-form.php",
                    type : "POST",
                    data : {id: stuId, first_name: fname, last_name: lname},
                    success: function(data) {
                        if(data == 1){
                        $("#modal").hide();
                        loadTable();
                        }
                        }
                    })
                });
                $("#txtChercher").on("keyup",function()
                {
                    var chercher_lettre = $(this).val();
                    $.ajax
                    ({
                        url: "ajax-chercher.php",
                        type: "POST",
                        data : {chercher:chercher_lettre},
                        success: function(data) 
                        {
                            $("#table-data").html(data);
                        }
                    });
                });
            });
        </script>
    <body>
</html>
    

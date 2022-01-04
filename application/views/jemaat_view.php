<html>
<head>
    <title>Data Jemaat Gereja</title>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    
</head>
<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <h3 class="navbar-text">Data Gereja</h3>
            </div>
        </div>
    </nav>
    <div class="container">
        <br />
        <br />
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="panel-title">Daftar Jemaat Gereja</h3>
                    </div>
                    <div class="col-md-6" align="right">
                        <button type="button" id="add_button" class="btn btn-success btn-xs">Tambah Data Jemaat</button>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <span id="success_message"></span>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>              
                            <th>Nama</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>Edit</th>
                            <th>Hapus</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>

<div id="userModal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="user_form">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Tambah Jemaat</h4>
                </div>
                <div class="modal-body">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" />
                    <span id="nama_lengkap_error" class="text-danger"></span>
                    <br />

                    <label>Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" />
                    <span id="tempat_lahir_error" class="text-danger"></span>
                    <br />

                    <label>Tanggal Lahir</label>
                    <input type="text" name="tanggal_lahir" id="tanggal_lahir" class="form-control" />
                    <span id="tanggal_lahir_error" class="text-danger"></span>
                    <br />

                    <label>Jenis Kelamin</label>
                    <input type="text" name="jenis_kelamin" id="jenis_kelamin" class="form-control" />
                    <span id="jenis_kelamin_error" class="text-danger"></span>
                    <br />

                    <label>Alamat</label>
                    <input type="text" name="alamat" id="alamat" class="form-control" />
                    <span id="alamat_error" class="text-danger"></span>
                    <br />
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id_jemaat" id="id_jemaat" />
                    <input type="hidden" name="data_action" id="data_action" value="Insert" />
                    <input type="submit" name="action" id="action" class="btn btn-success" value="Add" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript" language="javascript" >
$(document).ready(function(){
    
    function fetch_data()
    {
        $.ajax({
            url:"<?php echo base_url(); ?>jemaat/action",
            method:"POST",
            data:{data_action:'fetch_all'},
            success:function(data)
            {
                $('tbody').html(data);
            }
        });
    }

    fetch_data();

    $('#add_button').click(function(){
        $('#user_form')[0].reset();
        $('.modal-title').text("tambah jemaat");
        $('#action').val('Add');
        $('#data_action').val("Insert");
        $('#userModal').modal('show');
    });

    $(document).on('submit', '#user_form', function(event){
        event.preventDefault();
        $.ajax({
            url:"<?php echo base_url() . 'Jemaat/action' ?>",
            method:"POST",
            data:$(this).serialize(),
            dataType:"json",
            success:function(data)
            {
                if(data.success)
                {
                    $('#user_form')[0].reset();
                    $('#userModal').modal('hide');
                    fetch_data();
                    if($('#data_action').val() == "Insert")
                    {
                        $('#success_message').html('<div class="alert alert-success">Data Sudah Ditambah</div>');
                    }
                }

                if(data.error)
                {
                    $('#nama_lengkap_error').html(data.nama_lengkap_error);
                    $('#tempat_lahir_error').html(data.tempat_lahir_error);
                    $('#tanggal_lahir_error').html(data.tanggal_lahir_error);
                    $('#jenis_kelamin_error').html(data.jenis_kelamin_error);
                    $('#alamat_error').html(data.alamat_error);
                }
            }
        })
    });

    $(document).on('click', '.edit', function(){
        var id_jemaat = $(this).attr('id');
        $.ajax({
            url:"<?php echo base_url(); ?>Jemaat/action",
            method:"POST",
            data:{id_jemaat:id_jemaat, data_action:'fetch_single'},
            dataType:"json",
            success:function(data)
            {
                $('#userModal').modal('show');
                $('#nama_lengkap').val(data.nama_lengkap);
                $('#tempat_lahir').val(data.tempat_lahir);
                $('#tanggal_lahir').val(data.tanggal_lahir);
                $('#jenis_kelamin').val(data.jenis_kelamin);
                $('#alamat').val(data.alamat);
                $('.modal-title').text('Edit Jemaat');
                $('#id_jemaat').val(id_jemaat);
                $('#action').val('Edit');
                $('#data_action').val('Edit');
            }
        })
    });

    $(document).on('click', '.delete', function(){
        var id_jemaat = $(this).attr('id');
        if(confirm("Apa anda yakin ingin menghapus?"))
        {
            $.ajax({
                url:"<?php echo base_url(); ?>Jemaat/action",
                method:"POST",
                data:{id_jemaat:id_jemaat, data_action:'Delete'},
                dataType:"JSON",
                success:function(data)
                {
                    if(data.success)
                    {
                        $('#success_message').html('<div class="alert alert-danger">Data Sudah Dihapus</div>');
                        fetch_data();
                    }
                }
            })
        }
    });
    
});
</script>
<?php $this->load->view('templates/headersidebar_view'); ?>
                </div>
                </div>
                <div class="static-content-wrapper">
                    <div class="static-content">
                        <div class="page-content">
                            <ol class="breadcrumb">
                                <li><a href="index.html">Dashboard</a></li>
                                <li class="active"><a href="#">survey</a></li>
                            </ol>
                            <div class="container-fluid">
                            <div data-widget-group="group1">
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="panel panel-default">
                                    <div class="panel-heading">
                                      <h2>Data Survey</h2>
                                      <div class="panel-ctrls"></div>
                                    </div>
                                    <div class="panel-body">
                                      <div id="devices">
                                      <button class="btn btn-success pull-right" onclick="add_survey()"><i class="glyphicon glyphicon-plus"></i>Add</button>
        
                                        <table cellpadding="0" cellspacing="0" class="table table-striped table-fixed-header m-n" id="tb_survey">
                                          <thead>
                                            <tr>
                                              <th>ID</th>
                                              <th>Komoditas</th>
                                              <th>Satuan</th>
                                              <th>Harga</th>
                                              <th>Pasar</th>
                                              <th>User</th>
                                              <th>Date</th>
                                              <th>Status</th>
                                              <th width="15%">Action</th> 
                                            </tr>
                                          </thead>
                                          <tbody>
                                          </tbody>
                                        </table>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>

                            </div> <!-- .container-fluid -->
                        </div> <!-- #page-content -->
                    </div>
                    <footer role="contentinfo">
    <div class="clearfix">
        <ul class="list-unstyled list-inline pull-left">
            <li><h6 style="margin: 0;">&copy; 2015 Avenxo</h6></li>
        </ul>
        <button class="pull-right btn btn-link btn-xs hidden-print" id="back-to-top"><i class="ti ti-arrow-up"></i></button>
    </div>
</footer>

                </div>
            </div>
        </div>

    
<!-- Modal -->
<!-- Modal Add Device -->
         <div class="modal fade" id="modal_form" role="dialog" >
            <div class="modal-dialog">
               <div class="modal-content">
                   <div class="modal-header">
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                       <h4 class="modal-title" id="modal-title">Add Data Pasar</h4>
                   </div>
                   <div class="modal-body form">
                    <form class="form-horizontal" id="form" action="＃" method="post">
                        <input type="hidden" value="" name="id"/> 
                        <div class="form-group">
                            <div class="row">
                              <label class="control-label col-sm-2">Komoditas</label>
                                <div class="col-sm-8">
                                    <select name="komoditas" id="selector1" class="form-control">
                                        <option value="">--- Pilih Komoditas ---</option>
                                        <?php foreach ($komoditas as $row) : ?>
                                        <option value="<?php echo $row->id; ?>"><?php echo $row->nama;?></option>
                                        <?php endforeach; ?>
                                    </select>

                                    
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                              <label class="control-label col-sm-2">Harga</label>
                                <div class="col-sm-8">
                                    <div class="input-group" >
                                        <span class="input-group-addon"><i class="ti ">Rp. </i></span>
                                        <input type="input" name="harga" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                              <label class="control-label col-sm-2">Pasar</label>
                                <div class="col-sm-8">
                                    <select name="pasar" id="selector2" class="form-control">
                                        <option value="">--- Pilih Pasar ---</option>
                                        <?php foreach ($pasar as $row) : ?>
                                        <option value="<?php echo $row->id; ?>"><?php echo $row->nama;?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">    
                                 <label class="col-sm-2 control-label">Date</label>
                                <div class="col-sm-8">
                                    <div class="input-group" >
                                        <span class="input-group-addon"><i class="ti ti-calendar"></i></span>
                                        <input type="text" class="form-control datepicker" id="datepicker" name="date">
                                    </div>
                                </div>
                            </div>
						</div>
                        
                    </form>
                   </div>
                   <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" id="btnSave" onClick="save()" class="btn btn-success">Save</button>
                   </div>
                    </div>
            </div>
         </div>

    <!-- Load site level scripts -->

<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script> -->

<?php $this->load->view('templates/footer_view'); ?>


<!-- End loading site level scripts -->
    
    <!-- Load page level scripts-->
    
 <!-- Load page level scripts-->
    
<script type="text/javascript" src="<?php echo base_url('') ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url('') ?>assets/plugins/datatables/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="<?php echo base_url('') ?>assets/demo/demo-datatables.js"></script>
<!-- End loading page level scripts-->

<script type="text/javascript">
		 table = $('#tb_survey').DataTable({
				"processing" : true,
				"severSide"  : true,
				"order" : [],
            // "sAjaxSource": "../server_side/scripts/server_processing.php"
                // deferRender: true,
				"ajax" : {
					"url" : "<?php echo site_url('survey/dataJSON') ?>",
                    "type" : "POST",
                    "dataSrc" : ""
				},
		  		"columns" : [
                {"data" : "id"},
		  		{"data" : "komoditas"},
		  		{"data" : "satuan"},
                {"data" : "harga"},
                {"data" : "pasar"},
                {"data" : "user"},
                {"data" : "date"},
                {"data" : "status"},
                {"data" : "action"}
		  		],

			});

            //datepicker
            $('.datepicker').datepicker({
                autoclose: true,
                format: "yyyy-mm-dd",
                todayHighlight: true,
                orientation: "top auto",
                todayBtn: true,
                todayHighlight: true,  
            });

            function add_survey(){
                save_method= 'add';
                $('#form')[0].reset();
                $('.form-group').removeClass('has-error');
                $('.help-block').empty();
                $('#modal_form').modal('show');
                $('.modal-title').text('Add Data survey');
            }

            function edit_survey(id){
                save_method = 'update';
                $('#form')[0].reset();
                $('.form-group').removeClass('has-error');
                $('.help-block').empty(); 
            
                $.ajax({
                    url : "<?php echo site_url('survey/edit_data/')?>" + id,
                    type: "GET",
                    dataType: "JSON",
                    success: function(data)
                    
                    {
                        $('[name="id"]').val(data.id);
                        $('[name="komoditas"]').val(data.id_komoditas).trigger('change');
                        $('[name="harga"]').val(data.harga);
                        $('[name="pasar"]').val(data.id_pasar);
                        $('[name="date"]').val(data.date);
                        $('#modal_form').modal('show');
                        $('.modal-title').text('Edit Data survey');
            
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error get data from ajax');
                    }
                });
            }

            function save()
            {
                $('#btnSave').text('saving...'); //change button text
                $('#btnSave').attr('disabled',true); //set button disable 
                var url;
            
                if(save_method == 'add') {
                    url = "<?php echo site_url('survey/add_data')?>";
                } else {
                    url = "<?php echo site_url('survey/update_data')?>";
                }

                $.ajax({
                    url : url,
                    type: "POST",
                    data: $('#form').serialize(),
                    dataType: "JSON",
                    success: function(data)
                    {
            
                        if(data.status) 
                        {
                            $('#modal_form').modal('hide');
                            reload_table();
                        }
            
                        $('#btnSave').text('save'); 
                        $('#btnSave').attr('disabled',false); 
            
            
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error menambah / mengupdate data');
                        $('#btnSave').text('save'); 
                        $('#btnSave').attr('disabled',false); 
                    }
                });
            }

            function delete_survey(id){
                if(confirm('Anda yakin ingin menghapus data ini ?')){
                    $.ajax({
                        url: "<?php echo site_url('survey/delete_data/') ?>"+id,
                        type: "POST",
                        dataType: "JSON",
                        success: function(data){
                            $('#modal_form').modal('hide');
                            reload_table();
                        },
                        error: function (jqXHR, textStatus, errorThrown){
                            alert('Error menghapus data');
                        }
                    })
                }
            }
            function reload_table(){
                table.ajax.reload(null,false);
            }
		

	</script>
    </body>
</html>
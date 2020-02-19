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
                                        <div class="form-group">
                                            <div class="row">
                                            <label class="control-label col-sm-2">Pasar</label>
                                                <div class="col-sm-4">
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
                                                <div class="col-sm-4">
                                                    <div class="input-group" >
                                                        <span class="input-group-addon"><i class="ti ti-calendar"></i></span>
                                                        <input type="text" class="form-control datepicker" id="datepicker" name="date">
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                
                                                </div>
                                            </div>
                                        </div>
                                        <table cellpadding="0" cellspacing="0" class="table table-striped table-fixed-header m-n" id="tb_survey">
                                          <thead>
                                            <tr>
                                              <th width="10%">No.</th>
                                              <th>Komoditas</th>
                                              <th>Harga</th>
                                              <th width="15%">Action</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                              
                                          </tbody>
                                        </table>
                                        <button class="btn btn-success" data-aksi="add_komo"><i class="glyphicon glyphicon-plus"></i>Tambah Komoditas</button>
                                        <button class="btn btn-primary pull-right" data-aksi="simpan_komo"><i class="glyphicon glyphicon-plus"></i>Simpan</button>
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
            $('button[data-aksi="add_komo"]').click(function(){
                var tbl = $('table#tb_survey');
                tbl.find('tbody').append(`
                    <tr>
                        <td></td>
                        <td>
                        <select name="komoditas" id="selector1" class="form-control">
                            <option value="">--- Pilih Komoditas ---</option>
                            <?php foreach ($komoditas as $row) : ?>
                            <option value="<?php echo $row->id; ?>"><?php echo $row->nama;?></option>
                            <?php endforeach; ?>
                        </select>
                        </td>
                        <td>
                        <div class="input-group" >
                            <span class="input-group-addon"><i class="ti ">Rp. </i></span>
                            <input type="input" name="harga" class="form-control">
                        </div>
                        </td>
                        <td><a href="javascript:;" data-aksi="hapus_komo"><i class="fa fa-trash-o"></i></a></td>
                    </tr>`);
                handle_tbno();
            })
            function handle_tbno(){
                $('table#tb_survey tbody tr').each(function(i){
                    $(this).find('td:first').html(i+1);
                })
            }
            $('body').on('click','a[data-aksi="hapus_komo"]',function(){
                $(this).closest('tr').remove();
                handle_tbno();
            })

            $('button[data-aksi="simpan_komo"]').click(function(){
                var data = {
                    'id_pasar' : $('select[name="pasar"]').val(),
                    'date' : $('input[name="date"]').val(),
                    'komoditas' : [],
                }
                $("table#tb_survey tbody tr").each(function(){
                    var komo = {
                        'id_komoditas': $(this).find('select[name="komoditas"]').val(),
                        'harga' : $(this).find('input[name="harga"]').val(),
                    };
                    data.komoditas.push(komo);
                })
                console.log(data);
                $.post('<?php echo site_url('survey/add_data')?>/',data,function(respon){
                    if(respon.ok){
                        alert('Data survery berhasil disimpan');
                        clear_form();
                    }
                    else{ alert('Gagal menambahkan data survey baru');
                    }
                },'json').fail(function(){
                    alert('Gagal menambahkan data survey baru');
                })
            })

            function clear_form(){
                $('select[name="pasar"]').val(''),
                $('input[name="date"]').val(''),
                $("table#tb_survey tbody tr").each(function(){
                    $(this).find('select[name="komoditas"]').val(''),
                    $(this).find('input[name="harga"]').val('')
                });
            }

            //datepicker
            $('.datepicker').datepicker({
                autoclose: true,
                format: "yyyy-mm-dd",
                todayHighlight: true,
                orientation: "top auto",
                todayBtn: true,
                todayHighlight: true,  
            });


	</script>
    </body>
</html>
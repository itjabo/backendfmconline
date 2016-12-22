<section class="content">
		<div class="box box-primary" style="margin:0px;padding:0px;">
		  <div class="row" style="margin:0px;padding:0px;">
                <div class="box-header with-border">
				</div>
                <!-- /.box-header -->
			<div class="col-md-7 col-xs-12">
			<?php echo substr(date('Y-m-d'),8,2).'/'.substr(date('Y-m-d'),5,2).'/'.substr(date('Y-m-d'),0,4);?>
			  <div class="box ">
                <!-- form start -->	
					<?php
					$attributes = array('class' => 'form-group');
						echo $error;
						if (strcmp($error,"Sukses Insert Data")==0){
							echo "<script type='text/javascript'>alert('$error');window.location = 'bbm';</script>";
						}elseif(strlen($error)>2){
							echo "<script type='text/javascript'>alert('Sukses Insert Data, Gambar Tanda Tangan tidak ada');window.location = 'bbm';</script>";
						}
						echo form_open_multipart('submit_laporan', $attributes); 
					?>					
						  <div class="box-body">
							<H3>FORMULIR BERITA</H3>
							
							<div class="form-group">
							    <label>Tanda Tangan (Format: gif|jpg|png|jpeg Max:1MB)</label>
								
								<input type="file" id="userfile" name="userfile" size="20" />
							</div>
								<button type="submit"   class="btn btn-primary">Tambah</button>
							  <?php
								echo form_close();
							  ?>
						  </div><!-- /.box-body -->	
					</form>		
              </div>  
			</div>	
		  </div>	  
		</div> 
         </section>
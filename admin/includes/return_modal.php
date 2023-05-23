<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Return Books</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="return_add.php">
          		  <div class="form-group">
                  	<label for="student" class="col-sm-3 control-label">Student ID</label>

                  	<div class="col-sm-9">
						<!--<select  class="form-control" id="student" name="student" required>
						<option value="" selected>- Select Student -</option>
                        <?php
                          $sql = "SELECT * FROM students";
                          $query = $conn->query($sql);
                          while($row = $query->fetch_array()){
                            echo "
                              <option value='".$row['student_id']."'>".$row['student_id']."</option>
                            ";
                          }
                        ?>
						</select>-->
                    	<input type="text" class="form-control" id="student" name="student" placeholder="Enter Student ID No..." required>
                  	</div>
                </div>
                <div class="form-group">
                    <label for="isbn" class="col-sm-3 control-label">ISBN</label>

					<div class="col-sm-9">
					<!--<select  class="form-control" id="isbn" name="isbn[]" required>
						<option value="" selected>- Select Book -</option>
                        <?php 
                          $sql = "SELECT * FROM books WHERE `status`='1'";
                          $query = $conn->query($sql);
                          while($row = $query->fetch_array()){
                            echo "
                              <option value='".$row['isbn']."'>".$row['isbn']."</option>
                            ";
                          } 
                        ?>
						</select>-->
                     <input type="text" class="form-control" id="isbn" name="isbn[]" placeholder="Enter ISBN..." required>
                    </div>
                </div>
                <span id="append-div"></span>
                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">
                      <button class="btn w3-button label-success btn-xs btn-flat" id="append"><i class="fa fa-plus"></i> Book Field</button>
                    </div>
                </div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn w3-button label-success btn-flat" name="add"><i class="fa fa-save"></i> Save</button>
            	</form>
          	</div>
        </div>
    </div>
</div>
<!-- Delete -->
<div class="modal fade" id="pay">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Payment</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="return_payment.php">
            		<input type="hidden" class="return_id" name="id">
                <div class="form-group">
                    <label for="author" class="col-sm-3 control-label">Payment:</label>

                    <div class="col-sm-9">
                      <input type="number" class="form-control" id="pay_penalty" name="pay_penalty" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="author" class="col-sm-3 control-label">Amount:</label>

                    <div class="col-sm-9">
                      <input type="number" class="form-control" id="amount" name="amount">
                    </div>
                </div>
          	</div>
            
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-success btn-flat" name="pay"><i class="fa fa-save"></i>  Save</button>
            	</form>
          	</div>
        </div>
    </div>
</div>


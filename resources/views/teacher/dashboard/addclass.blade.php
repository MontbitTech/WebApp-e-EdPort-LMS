<div class="modal fade" id="addClassModal" data-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light d-flex align-items-center">
                <h5 class="modal-title font-weight-bold">Add Class</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg class="icon">
                        <use xlink:href="../images/icons.svg#icon_times2"></use>
                    </svg>
                </button>
            </div>
            <div class="modal-body pt-4">

                {!! Form::open(array('route' => ['add.class'],'method'=>'POST','autocomplete'=>'off','id'=>'frm_add_class')) !!}
                <div class="form-group row">
                    <label for="addinputDate" class="col-md-4 col-form-label text-md-right">Date:</label>
                    <div class="col-md-6">
                        {!! Form::text('class_date', null, array('id'=>'addClassDate','placeholder' => 'DD/MM/YYYY','class' => 'form-control ac-datepicker','required'=>'required',"onkeydown"=>"return false;")) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="addinputFtime" class="col-md-4 col-form-label text-md-right">Class From
                        Time:</label>
                    <div class="col-md-6">
                        {!! Form::text('start_time', null, array('id'=>'addClassStartTime','placeholder' => '00:00 AM/PM','class' => 'form-control ac-time','required'=>'required',"onkeydown"=>"return false;")) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="addinputTtime" class="col-md-4 col-form-label text-md-right">Class To Time:</label>
                    <div class="col-md-6">
                        {!! Form::text('end_time', null, array('id'=>'addClassEndTime','placeholder' => '00:00 AM/PM','class' => 'form-control ac-time','required'=>'required',"onkeydown"=>"return false;")) !!}
                    </div>
                </div>
            </div>



            <div class="form-group row px-2">
                <label class="col-md-12 text-danger text-center text-float-moblie" style="font-size: 12px;padding-left: 130px;">*Extra
                    classes for regular assigned classes can be created here</label>
                <label for="addclassChoose" class="col-md-4 col-form-label text-md-right">Class:</label>
                <div class="col-md-6">
                    <select name="class_id" id="class_id" class="form-control" required>
                        <option value=""> Select Class</option>
                        <?php
                        foreach ($data['classData'] as $row) {
                        ?>

                            <option value="<?= $row->id; ?>"> <?= 'Class ' . $row->class_name . ' - ' . $row->section_name . ' - ' . $row->subject_name; ?></option>
                        <?php
                        }
                        ?>
                    </select>

                </div>
            </div>


            <!-- <div class="form-group row">
                <label for="class_liveurl" class="col-md-4 col-form-label text-md-right">Join Live <small>(Link)</small>:</label>
                <div class="col-md-6">
                  {!! Form::textarea('join_liveUrl', null, array('placeholder' => 'Enter Live class url','class' => 'form-control','required'=>'required','rows'=>'3')) !!}
                        </div>
                      </div> -->

            <div class="form-group row px-2">
                <label for="inputNotifystd" class="col-md-4 col-form-label text-md-right">Notify
                    Students:</label>
                <div class="col-md-6">

                    {!! Form::textarea('notify_stdMessage', null, array('placeholder' => 'Enter Notify Message','class' => 'form-control','required'=>'required','rows'=>'3')) !!}

                </div>
            </div>
            <div class="form-group row px-2">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" id="submit" class="btn btn-primary px-4">Save Class</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
@extends('layouts.admin.app')

@section('content')

<section class="main-section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-sm-12">
        <div class="bar-patty">
          <div class="page-heading">Teachers</div>
          <div class="col-lg-8 text-lg-right p-0">
            <span data-dtsearch="#teachersList" class="d-inline-block my-1">
              <div class="form-control form-control-sm text-left">
                <div class="spinner-border spinner-border-sm" role="status"></div>
              </div>
            </span>
            <span data-dtlength="#teachersList" class="d-inline-block my-1">
              <div class="form-control form-control-sm">
                <div class="spinner-border spinner-border-sm" role="status"></div>
              </div>
            </span>
            <button type="button" data-target="#addnewTeacher" data-toggle="modal" class="btn btn-sm btn-success px-3 ml-lg-2 my-1 font-weight-bold ls-0p5">
              <svg class="icon icon-2x mr-2"><use xlink:href="images/icons.svg#icon_adduser"></use></svg>Add New Teacher
            </a>
          </div>  
        </div>
        <!-- <h3 class="bar-heading"></h3> -->
        <table id="teachersList" class="table table-borderless table-design table-textmiddle w-100" data-order="[[0,&quot;asc&quot;]]" data-page-length="100" data-lastcol="center">
          <colgroup>
            <col width="100">
            <col>
            <col>
            <col>
            <col width="180">
          </colgroup>
          <thead>
            <tr>
              <th>S.No.</th>
              <th>Teacher Name</th>
              <th>Email</th>
              <th>Login Pin</th>
              <th><div class="minmax-w150"> Action</div></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Mohd Faiz</td>
              <td>mohdfaiz@gmail.com</td>
              <td>38253916</td>
              <td>
                <button type="button" data-editmodal="#A123" class="btn btn-sm btn-info border-0" title="Edit"><svg class="icon mr-1"><use xlink:href="images/icons.svg#icon_edit"></use></svg> Edit</button>
                <button type="button" data-editmodal="#A123" class="btn btn-sm btn-danger border-0" title="Delete"><svg class="icon mr-1"><use xlink:href="images/icons.svg#icon_trash"></use></svg> Delete</button>
              </td>
            </tr>
            <tr>
              <td>2</td>
              <td>Anjali Singh</td>
              <td>anjalisingh@yahoo.com</td>
              <td>89889768</td>
              <td>
                <button type="button" data-editmodal="#A123" class="btn btn-sm btn-info border-0" title="Edit"><svg class="icon mr-1"><use xlink:href="images/icons.svg#icon_edit"></use></svg> Edit</button>
                <button type="button" data-editmodal="#A123" class="btn btn-sm btn-danger border-0" title="Delete"><svg class="icon mr-1"><use xlink:href="images/icons.svg#icon_trash"></use></svg> Delete</button>
              </td>
            </tr>
            <tr>
              <td>3</td>
              <td>Rinkoo Singh</td>
              <td>rinkoosingh@reddif.com</td>
              <td>78767543</td>
              <td>
                <button type="button" data-editmodal="#A123" class="btn btn-sm btn-info border-0" title="Edit"><svg class="icon mr-1"><use xlink:href="images/icons.svg#icon_edit"></use></svg> Edit</button>
                <button type="button" data-editmodal="#A123" class="btn btn-sm btn-danger border-0" title="Delete"><svg class="icon mr-1"><use xlink:href="images/icons.svg#icon_trash"></use></svg> Delete</button>
              </td>
            </tr>
            <tr>
              <td>4</td>
              <td>Amit Kapoor</td>
              <td>amitkapoor@gmail.com</td>
              <td>32423987</td>
              <td>
                <button type="button" data-editmodal="#A123" class="btn btn-sm btn-info border-0" title="Edit"><svg class="icon mr-1"><use xlink:href="images/icons.svg#icon_edit"></use></svg> Edit</button>
                <button type="button" data-editmodal="#A123" class="btn btn-sm btn-danger border-0" title="Delete"><svg class="icon mr-1"><use xlink:href="images/icons.svg#icon_trash"></use></svg> Delete</button>
              </td>
            </tr>
            <tr>
              <td>5</td>
              <td>Raeesh Alam</td>
              <td>raeesh@xipetech.com</td>
              <td>78912345</td>
              <td>
                <button type="button" data-editmodal="#A123" class="btn btn-sm btn-info border-0" title="Edit"><svg class="icon mr-1"><use xlink:href="images/icons.svg#icon_edit"></use></svg> Edit</button>
                <button type="button" data-editmodal="#A123" class="btn btn-sm btn-danger border-0" title="Delete"><svg class="icon mr-1"><use xlink:href="images/icons.svg#icon_trash"></use></svg> Delete</button>
              </td>
            </tr>
            <tr>
              <td>6</td>
              <td>Shumer Singh</td>
              <td>shumer@xipetech.com</td>
              <td>34578912</td>
              <td>
                <button type="button" data-editmodal="#A123" class="btn btn-sm btn-info border-0" title="Edit"><svg class="icon mr-1"><use xlink:href="images/icons.svg#icon_edit"></use></svg> Edit</button>
                <button type="button" data-editmodal="#A123" class="btn btn-sm btn-danger border-0" title="Delete"><svg class="icon mr-1"><use xlink:href="images/icons.svg#icon_trash"></use></svg> Delete</button>
              </td>
            </tr>
            <tr>
              <td>7</td>
              <td>Mickel Clark</td>
              <td>miclark@yahoo.com</td>
              <td>89134572</td>
              <td>
                <button type="button" data-editmodal="#A123" class="btn btn-sm btn-info border-0" title="Edit"><svg class="icon mr-1"><use xlink:href="images/icons.svg#icon_edit"></use></svg> Edit</button>
                <button type="button" data-editmodal="#A123" class="btn btn-sm btn-danger border-0" title="Delete"><svg class="icon mr-1"><use xlink:href="images/icons.svg#icon_trash"></use></svg> Delete</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>

<!-- Add New Teacher Modal -->
<div class="modal fade" id="addnewTeacher" data-backdrop="static" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-light d-flex align-items-center">
        <h5 class="modal-title font-weight-bold">Add New Teacher</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <svg class="icon"><use xlink:href="images/icons.svg#icon_times2"></use></svg>
        </button>
      </div>
      <div class="modal-body pt-4">
        <form>
          <div class="form-group row">
            <label for="newteacherName" class="col-md-4 col-form-label text-md-right">Name:</label>
            <div class="col-md-6">
              <input type="text" class="form-control" id="newteacherName" placeholder="Enter Teacher Name" required="required">
            </div>
          </div>
          <div class="form-group row">
            <label for="newteacherEmail" class="col-md-4 col-form-label text-md-right">Email:</label>
            <div class="col-md-6">
              <input type="email" class="form-control" id="newteacherEmail" placeholder="Enter Email Address" required="required">
            </div>
          </div>
          <div class="form-group row">
            <label for="newteacherPin" class="col-md-4 col-form-label text-md-right">Pin:</label>
            <div class="col-md-6">
              <input type="text" class="form-control" id="newteacherPin" value="32459867" readonly="readonly">
            </div>
          </div>
          <div class="form-group row">
            <label for="checkconfirmPin" class="col-md-4 col-form-label text-md-right">Confirm Pin:</label>
            <div class="col-md-6">
              <input type="text" class="form-control" id="checkconfirmPin" placeholder="Enter Confirm Pin" required="required">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-8 offset-md-4">
              <button type="submit" class="btn btn-primary px-4">Save</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
  $('#teacherlist').DataTable({
    initComplete: function(settings, json) {
      $('[data-dtlist="#'+settings.nTable.id+'"').html($('#'+settings.nTable.id+'_length').find("label"));
      $('[data-dtfilter="#'+settings.nTable.id+'"').html($('#'+settings.nTable.id+'_filter').find("input[type=search]").attr('placeholder', $('#'+settings.nTable.id).attr('data-filterplaceholder')))
    }
  });
  $('.dateset').datepicker({
    dateFormat: "yy/mm/dd"
    // showAnim: "slide"
  })
});
</script>
@endsection
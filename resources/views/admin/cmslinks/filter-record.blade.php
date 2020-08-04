          <table id="cmsrecords" class="table table-sm table-bordered display" style="width:100%" data-page-length="25" data-order="[[ 1, &quot;asc&quot; ]]" data-col1="60" data-collast="120" data-filterplaceholder="Search Records ...">
              <thead>
                  <tr>
                      @if(count($getResult)>0)
                      <th width="50px"><input type="checkbox" class="master" id="master"></th>
                      @endif
                      <th>Class</th>
                      <th>Subject</th>
                      <th>Topic</th>
                      <th>e-EdPort</th>
                      <th>Youtube</th>
                      <th>Wikipedia</th>
                      <th>My School</th>
                      <th>Assignment</th>
                      <th>Action</th>
                  </tr>
              </thead>

              <tbody>
                  @if(count($getResult)>0)
                  @php $i=0; @endphp



                  @foreach($getResult as $list)

                  <tr id="tr_{{$list->id}}">
                      <td><input type="checkbox" class="sub_chk" data-id="{{$list->id}}"></td>
                      <td class="text-center">{{$list->class}}</td>
                      <td>{{$list->Subject->subject_name}}</td>
                      <td>{{$list->topic}}</td>

                      @if($list->link)
                      <td class="text-center">
                          <a href="{{$list->link}}" target="_blank">Link</a>
                      </td>
                      @else
                      <td class="text-center">
                          <a href="{{route('cms.editlink', encrypt($list->id))}}" class="text-danger w-100"> Insert Link</a>
                      </td>
                      @endif

                      @if($list->youtube)
                      <td class="text-center">
                          <a href="{{$list->youtube}}" target="_blank">Link</a>
                      </td>
                      @else
                      <td class="text-center">
                          <a href="{{route('cms.editlink', encrypt($list->id))}}" class="text-danger w-100"> Insert Link</a>
                      </td>
                      @endif
                      @if($list->others)
                      <td class="text-center">
                          <a href="{{$list->others}}" target="_blank">Link</a>
                      </td>
                      @else
                      <td class="text-center">
                          <a href="{{route('cms.editlink', encrypt($list->id))}}" class="text-danger w-100"> Insert Link</a>
                      </td>
                      @endif
                      @if($list->khan_academy)
                      <td class="text-center">
                          <a href="{{$list->khan_academy}}" target="_blank">Link</a>
                      </td>
                      @else
                      <td class="text-center">
                          <a href="{{route('cms.editlink', encrypt($list->id))}}" class="text-danger w-100"> Insert Link</a>
                      </td>
                      @endif
                      @if($list->assignment_link)
                      <td class="text-center">
                          <a href="{{$list->assignment_link}}" target="_blank">Link</a>
                      </td>
                      @else
                      <td class="text-center">
                          <a href="{{route('cms.editlink', encrypt($list->id))}}" class="text-danger w-100"> Insert Link</a>
                      </td>
                      @endif
                      <td>
                          <a href="{{route('cms.editlink', encrypt($list->id))}}">Edit</a> |
                          <a href="javascript:void(0);" data-deleteModal="{{$list->id}}">{{ __('Delete') }}</a>


                      </td>
                  </tr>
                  @endforeach
                  @endif
              </tbody>
          </table>
          <div class="modal fade" id="studentdeletModal" data-backdrop="static" tabindex="-1" role="dialog">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header bg-light d-flex align-items-center">
                          <h5 class="modal-title font-weight-bold">Delete Class</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <svg class="icon">
                                  <use xlink:href="../images/icons.svg#icon_times2"></use>
                              </svg>
                          </button>
                      </div>
                      <div class="modal-body pt-4">
                          <form id="deleteform" method="POST">
                              @csrf
                              <input type="hidden" name="txt_student_id" id="txt_student_id" />
                              <div class="form-group text-center">
                                  <h4>Type "delete" to confirm</h4>
                              </div>
                              <div class="form-group text-center ">
                                  <input type="text" name="delete" class="form-control" id="delete" required>

                              </div>
                              <div class="form-group text-center">
                                  <button type="submit" class="btn btn-danger px-4">
                                      Delete
                                  </button>
                                  <button type="button" class="btn btn-default" class="close" data-dismiss="modal" aria-label="Close">
                                      Cancel
                                  </button>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
          <script type="text/javascript">
              $(document).ready(function() {


                  $('#master').on('click', function(e) {
                      if ($(this).is(':checked', true)) {
                          $(".sub_chk").prop('checked', true);
                      } else {
                          $(".sub_chk").prop('checked', false);
                      }
                  });

                  $('.sub_chk').change(function() { //".checkbox" change 
                      if ($('.sub_chk:checked').length == $('.sub_chk').length) {
                          $('.master').prop('checked', true);
                      } else {
                          $('.master').prop('checked', false);
                      }
                  });


                  $('.delete_all').on('click', function(e) {

                      var allVals = [];
                      $(".sub_chk:checked").each(function() {
                          allVals.push($(this).attr('data-id'));
                      });


                      if (allVals.length <= 0) {
                          alert("Please select row.");
                      } else {


                          var check = confirm("Are you sure you want to delete this row?");
                          if (check == true) {


                              var join_selected_values = allVals.join(",");


                              $.ajax({
                                  url: $(this).data('url'),
                                  type: 'DELETE',
                                  headers: {
                                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                  },
                                  data: 'ids=' + join_selected_values,
                                  success: function(data) {
                                      if (data['success']) {
                                          $(".sub_chk:checked").each(function() {
                                              $(this).parents("tr").remove();
                                              location.reload(true);
                                              //$('.master').prop('checked',false);
                                          });
                                          //alert(data['success']);
                                          $.fn.notifyMe('success', 10, "Deleted Successfully");
                                      } else if (data['error']) {
                                          alert(data['error']);
                                      } else {
                                          alert('Whoops Something went wrong!!');
                                      }
                                  },
                                  error: function(data) {
                                      alert(data.responseText);
                                  }
                              });


                              $.each(allVals, function(index, value) {
                                  $('table tr').filter("[data-row-id='" + value + "']").remove();
                              });
                          }
                      }
                  });

                  $(document).on('confirm', function(e) {
                      var ele = e.target;
                      e.preventDefault();


                      $.ajax({
                          url: ele.href,
                          type: 'DELETE',
                          headers: {
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          },
                          success: function(data) {
                              if (data['success']) {
                                  $("#" + data['tr']).slideUp("slow");
                                  alert(data['success']);
                              } else if (data['error']) {
                                  alert(data['error']);
                              } else {
                                  alert('Whoops Something went wrong!!');
                              }
                          },
                          error: function(data) {
                              alert(data.responseText);
                          }
                      });


                      return false;
                  });
              });
              $(document).on('click', '[data-deleteModal]', function() {
                  var val = $(this).data('deletemodal');

                  $('#studentdeletModal').modal('show');
                  var route = "{{url('admin/delete-link')}}" + "/" + val;
                  $("#deleteform").attr('action', route);

              });
          </script>
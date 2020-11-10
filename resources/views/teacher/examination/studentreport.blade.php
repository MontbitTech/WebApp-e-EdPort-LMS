 <div class="col-md-12 col-lg-12 col-12 px-0 mb-3">
     <div class="card card-info  collapsed-card">
         <div class="card-header py-1 pb-0 border-transparent text-white btn-ui">
             <h6 class="card-title d-inline align-bottom">Examination Reports</h6>
             <div class="card-tools d-inline float-right">
                 <button type="button" class="btn border ml-2 btn-tool text-white " data-card-widget="collapse">
                     <i class="fas fa-plus"></i>
                 </button>
             </div>
         </div>
         <div class="card-body card-border-exam" style="display: none;">
             <div class="row mb-3">
                 <div class="col-md-4">
                     <select class="form-control" id="classroom" onchange="javascript:getExamination()">
                         <option value="" selected>Select Classroom</option>
                         @foreach($inviteClassData as $classroom)
                         <option value="{{$classroom->class_id}}">
                             {{$classroom->studentClass->class_name}} {{$classroom->studentClass->section_name}} {{$classroom->studentSubject->subject_name}}
                         </option>
                         @endforeach
                     </select>
                 </div>
                 <div class="col-md-4">
                     <select class="form-control" id="examination" onchange="javascript:getResultOfClassroom()">
                         <option value="" selected>Select Examination</option>
                         
                     </select>
                 </div>
             </div>
             <table id="studentreport" class="table  table-sm table-bordered display" style="width:100%" data-order="[[ 0, &quot;asc&quot; ]]" data-col1="60" data-collast="120">
                 <thead>
                     <tr>
                         <th scope="col">Student name</th>
                         <th scope="col">Classroom</th>
                         <th scope="col">Exam name</th>
                         <th scope="col">Marks</th>
                     </tr>
                 </thead>
                 <tbody id="resultTableBody">

                 </tbody>
             </table>
         </div>
     </div>
 </div>


 <!-- modal student edit report -->
 <div class="modal fade" id="studentedit" tabindex="-1" role="dialog" aria-labelledby="studenteditTitle" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="studenteditTitle">Show Student Report</h5>
                 <!-- <div class="text-center">
                     vikram singh total marks:
                 </div> -->
                 <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <table id="studentreportshow" class="table  table-sm table-bordered display" style="width:100%" data-order="[[ 0, &quot;asc&quot; ]]" data-col1="60" data-collast="120">
                     <thead>
                         <tr>
                             <th scope="col">Question</th>
                             <th scope="col">Answer key</th>
                             <th scope="col">Answer</th>

                         </tr>
                     </thead>
                     <tbody>
                         <tr>
                             <td class="comment">Lorem ipsum dolor sit Earum.</td>
                             <td>Lorem, ipsum.</td>
                             <td>lorem</td>

                         </tr>
                     </tbody>
                 </table>
             </div>
             <div class="modal-footer ">

             </div>
         </div>
     </div>
 </div>
 <!-- *********end******** -->




 <!-- deletestudent reports -->
 <div class="modal fade" id="deletestudent" data-backdrop="static" tabindex="-1" role="dialog">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header bg-light d-flex align-items-center">
                 <h5 class="modal-title font-weight-bold">Delete Student Report</h5>
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
                         <button type="submit" class="btn btn-back mr-2 px-4">
                             Delete
                         </button>
                         <button type="button" class="btn submit-btn" class="close" data-dismiss="modal" aria-label="Close">
                             Cancel
                         </button>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>
 <!-- ********end  delete student reports ******* -->

 <script>

     function getExamination(){
        var classroom_id = $('#classroom').val();
        
        $('.loader').show();
         $.ajax({
             url: "{{url('/teacher/examination/getExamsList')}}",
             type: "GET",
             data: {
                 classroom_id   : classroom_id,
             },
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
             success: function(result) {
                $('.loader').fadeOut();
                let response = JSON.parse(result);
                $('#examination').empty();
                $('#examination').append('<option value="">Select Examination </option>');
                $.each(response.data, function(key, value) {
                    $('#examination').append('<option value="' + value.examination_id + '">' + value.examination.title + '</option>');
                });
             },
             error: function(error_r) {
                 $('.loader').fadeOut();
                 console.log(error_r);
             }
         });
     }
     function getResultOfClassroom() {

         var classroom_id = $('#classroom').val();
         var examination_id = $('#examination').val();

         $('.loader').show();
         $.ajax({
             url: "{{url('/teacher/examination/resultList')}}",
             type: "GET",
             data: {
                 classroom_id   : classroom_id,
                 examination_id : examination_id
             },
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
             success: function(result) {
                 $('#resultTableBody').empty();
                 $('.loader').fadeOut();
                 var data = '';
                 $.each(result.response, function(index, val) {
                     data += '<tr>';
                     data += '<td>' + val.student.name + '</td>';
                     data += '<td>' + val.classroom.class_name + ' ' + val.classroom.section_name + ' ' + val.classroom.student_subject.subject_name + '</td>';
                     data += '<td>' + val.examination.title + '</td>';
                     data += '<td>' + val.marks_obtained + '/' + val.total_marks + '</td>';
                     data += '</tr>'
                 });

                 $('#resultTableBody').html(data);

             },
             error: function(error_r) {
                 $('.loader').fadeOut();
                 console.log(error_r);
             }
         });
     }
 </script>
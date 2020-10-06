 <div class="col-md-12 col-lg-12 col-12 px-0 mb-3">
     <div class="card card-info  ">
         <div class="card-header pt-1 pb-0 border-transparent text-white" style="background-color: #373c8e;">
             <h4 class="card-title d-inline">Exam List</h4>
             <div class="card-tools d-inline float-right">
                 <a href="#" class="btn bg-white text-succes " data-toggle="modal" data-target="#addexam">Add Exam</a>
                 <button type="button" class="btn border ml-2 btn-tool text-white " data-card-widget="collapse">
                     <i class="fas fa-minus"></i>
                 </button>
             </div>
         </div>
         <div class="card-body card-border-exam">
             <div class="row mb-3 d-flex justify-content-center">
                 <!-- <div class="col-md-4">
                     <select class="form-control">
                         <option value="" selected>Select Class</option>
                         <option value="">10 A</option>
                         <option value=""> 11</option>
                     </select>
                 </div> -->
                 <!-- <div class="col-md-4">
                     <select class="form-control">
                         <option value="" selected>Select Subject</option>
                         <option value="">Hindi</option>
                         <option value=""> English</option>
                     </select>
                 </div> -->
                 <div class="col-md-4 ">
                     <!-- <label class="d-block mb-2">Class</label> -->
                     <select class="form-control select1 " id="examlist" onchange="getExamlist()" style="width: 100%;">
                         <option value="">Select Classroom</option>
                         @foreach($classroomlist->unique('classroom_id') as $classroom)
                         <option value="{{$classroom->id}}">{{$classroom->classroom->class_name}} {{$classroom->classroom->section_name}}, {{$classroom->classroom->studentSubject->subject_name}}</option>
                         @endforeach
                     </select>
                 </div>
             </div>
             <table id="exam" class="table  table-sm table-bordered display" style="width:100%" data-order="[[ 0, &quot;asc&quot; ]]" data-col1="60" data-collast="120">
                 <thead>
                     <tr>
                         <!-- <th scope="col">Question</th> -->
                         <th scope="col">Classroom</th>
                         <th scope="col">Exam name</th>
                         <!-- <th scope="col">Marks</th> -->
                         <!-- <th scope="col">Percent</th> -->
                         <th scope="col">Action</th>
                     </tr>
                 </thead>
                 <tbody>
                     @php
                     $i=1;
                     @endphp
                     @foreach ($examinationshow as $examinationshows)
                     <input type="hidden" id="classroom_id{{$i}}" value="{{$examinationshows->classroom_id}}">
                     <input type="hidden" id="examination_id{{$i}}" value="{{$examinationshows->examination_id}}">
                     <input type="hidden" id="examDeleteId{{$i}}" value="{{$examinationshows->id}}">
                     <tr id="test">

                         <td>{{$examinationshows->classroom->class_name}} {{$examinationshows->classroom->section_name}} {{$examinationshows->classroom->studentSubject->subject_name}}</td>
                         <td>{{$examinationshows->examination->title}}</td>
                         <!-- <td></td> -->
                         <!-- <td>15</td> -->
                         <!-- <td>80% </td> -->
                         <td>
                             <button type="button" data-Examination="{{$i}}" class="btn" data-toggle="modal" data-target="#showexam">Show</button>
                             ||
                             <form action="{{route('examination.delete',$examinationshows->id)}}" class="d-inline" method="POST">
                                 @csrf
                                 @method('delete')
                                 <button class="btn">Delete</button>
                             </form>||
                             <button type="button" class="btn">Assigen</button>
                         </td>

                     </tr>
                     @php
                     $i++;
                     @endphp
                     @endforeach

                 </tbody>
             </table>
         </div>
     </div>
 </div>
 <script>
     $(document).on('click', '[data-Examination]', function() {
         var val = $(this).data('examination');
         var examination_id = $("#examination_id" + val).val();
         var classroom_id = $("#classroom_id" + val).val();


         $('.loader').show();
         $.ajax({
             type: 'POST',
             url: '{{ url("/teacher/examination/exampaper") }}',
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
             data: {
                 'examination_id': examination_id,
                 'classroom_id': classroom_id,
             },
             success: function(result) {
                 $('.loader').fadeOut();
                 $('#showexam').find('.media').remove();
                 let count = 1;
                 let data = '';
                 var response = JSON.parse(result);
                 response.data.forEach(function(da) {
                     data += '<div class="media px-3 mb-2">';
                     data += '<strong class="mr-1">' + count + ' </strong>';
                     data += '<div class="media-body font-weight-bold">' + da.questions.question + '</div>';
                     data += '</div></div>';
                     count++;

                     $('#showexam').find('.modal-body').append(data);

                 });
             },
             error: function() {
                 $('.loader').fadeOut();
                 $.fn.notifyMe('error', 4, 'There is some error while searching for assignment!');
             }
         });
     });
 </script>
 <script>
     function getExamlist() {
         var classroom_id = $('#examlist').val();
         //  var className = $('#class').val();
         //  var chapter = $('#chapter').val();
         //  var topic = $('#topic').val();

         //  if (subject == '' || className == '')
         //      return;

         $('.loader').show();
         $.ajax({
             url: "{{url('/teacher/examination/exampaperlist')}}",
             type: "POST",
             data: {
                 classroom_id: classroom_id,
                 //  subject_id: subject,
                 //  chapter: chapter,
                 //  topic: topic
             },
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
             success: function(result) {
                 $('.loader').fadeOut();
                 $('#test').find('td').remove();
                 //  if (result.success) {

                 let count = 1;
                 let data = "";
                 var response = JSON.parse(result);
                 response.data.forEach(function(exam) {
                     data += '<td >' + exam.classroom.class_name + exam.classroom.section_name + exam.classroom.studentSubject.subject_name + '</td>';
                     data += '<td>' + exam.examination.title + '</td>';
                     data += '<td><button type="button" data-Examination="{{$i}}" class="btn" data-toggle="modal" data-target="#showexam" > Show </button> ||';
                     data += '<button class ="btn" data-toggle="modal"   data-target="#deleteexam" > Delete </button> </td > ';

                     count++;
                 });


                 $('#test').append(data);

                 //  } else {
                 //      $.fn.notifyMe('error', 5, result.response);
                 //  }
             },
             error: function(error_r) {
                 $('.loader').fadeOut();
                 console.log(error_r);
             }
         });
     }
 </script>
 <!-- modal add exam -->
 <div class="modal fade" id="addexam" tabindex="-1" role="dialog" aria-labelledby="addexamTitle" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="addexamTitle">Add Question</h5>
                 <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body px-0">
                 <form>
                     <div class="row mb-3 px-3">
                         <div class="col-md-4">
                             <select class="form-control">
                                 <option value="" selected>Select Class</option>
                                 <option value="">10 A</option>
                                 <option value=""> 11</option>
                             </select>
                         </div>
                         <div class="col-md-4">
                             <select class="form-control">
                                 <option value="" selected>Select Subject</option>
                                 <option value="">Hindi</option>
                                 <option value=""> English</option>
                             </select>
                         </div>
                         <div class="col-md-4">
                             <select class="form-control">
                                 <option value="" selected>Select Chapter</option>
                                 <option value="">Chapter 1</option>
                                 <option value="">Chapter 2</option>
                             </select>
                         </div>
                     </div>
                     <div class="row  px-3">
                         <div class="col-md-1">
                             <input type="checkbox" checked>
                         </div>
                         <div class="col-md-11  ">
                             <div class="media">
                                 <strong class="mr-1">Q.1 </strong>
                                 <div class="media-body font-weight-bold">
                                     Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde, eligendi.
                                 </div>
                             </div>
                         </div>

                         <div class="col-md-1 mt-2">
                             <input type="checkbox" checked>
                         </div>
                         <div class="col-md-11  mt-2">
                             <div class="media">
                                 <strong class="mr-1">Q.2 </strong>
                                 <div class="media-body font-weight-bold">
                                     Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aperiam, beatae repellat amet
                                     voluptate fugiat expedita laudantium debitis ipsam reprehenderit doloribus.
                                 </div>
                             </div>
                         </div>


                     </div>
                     <hr>
                     <div class="form-group px-3">
                         <label for="exampleInputQuestionname" class="mb-0">Enter Exam Name</label>
                         <input type="text" class="form-control input-xs" id="exampleInputQuestionname" placeholder="Exam name">
                     </div>
                     <div class="media px-3">
                         <strong class="mr-1">Q.1 </strong>
                         <div class="media-body font-weight-bold">
                             <textarea class="w-100 form-control border-0 rounded-0" style="resize: none;" rows="3" disabled>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aperiam, beatae repellat amet  voluptate fugiat expedita laudantium debitis ipsam reprehenderit doloribus.
                                   </textarea>
                         </div>
                     </div>
                     <div class="media px-3">
                         <strong class="mr-1">Q.2 </strong>
                         <div class="media-body font-weight-bold">
                             <textarea class="w-100 form-control border-0 rounded-0" style="resize: none;" rows="3" disabled>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aperiam, beatae repellat amet  voluptate fugiat expedita laudantium debitis ipsam reprehendeorem ipsum dolor, sit amet consectetur adipisicing elit. Aperiam, beatae repellat amet  voluptate fugiat expedita laudantium debitis ipsam reprehenderit doloribus.
                                   </textarea>
                         </div>
                     </div>
                 </form>

             </div>
             <div class="modal-footer ">
                 <div class="m-auto">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                     <button type="button" class="btn btn-primary">Save</button>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- *********end******** -->

 <!-- modal show exam -->
 <div class="modal fade" id="showexam" tabindex="-1" role="dialog" aria-labelledby="showexamTitle" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="showexamTitle">Show Exam</h5>
                 <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body " id="viewExaminationpaper">
                 <div class="px-3 m-auto ">
                     <h4 class="text-center">examination name</h4>
                 </div>
                 <div class=" px-3 d-flex justify-content-between font-weight-bold mt-2 mb-4 ">
                     <strong>Classroom:10 a Hindi</strong>
                     <span>time:45 min</span>
                     <span>marks:50</span>
                 </div>

                 <!-- <div class="media px-3 mb-2">
                     <strong class="mr-1">Q.1 </strong>
                     <div class="media-body font-weight-bold">
                         <div>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aperiam, beatae repellat amet voluptate fugiat expedita laudantium debitis ipsam reprehenderit doloribus.
                         </div>
                     </div>
                 </div>
                 <div class="media px-3">
                     <strong class="mr-1">Q.2 </strong>
                     <div class="media-body font-weight-bold">
                         <div class="  ">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aperiam, beatae repellat amet voluptate fugiat expedita laudantium debitis ipsam reprehendeorem ipsum dolor, sit amet consectetur adipisicing elit. Aperiam, beatae repellat amet voluptate fugiat expedita laudantium debitis ipsam reprehenderit doloribus.
                         </div>
                     </div>
                 </div> -->
             </div>

         </div>
     </div>
 </div>
 <!-- *********end******** -->
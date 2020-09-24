 <div class="col-md-12 col-lg-12 col-12 px-0 mb-3">
     <div class="card card-info  ">
         <div class="card-header pt-1 pb-0 border-transparent text-white" style="background-color: #373c8e;">
             <h4 class="card-title d-inline">Create Exam</h4>
             <div class="card-tools d-inline float-right">
                 <a href="#" class="btn bg-white text-succes " data-toggle="modal" data-target="#addexam">Add Exam</a>
                 <button type="button" class="btn border ml-2 btn-tool text-white " data-card-widget="collapse">
                     <i class="fas fa-minus"></i>
                 </button>
             </div>
         </div>
         <div class="card-body card-border-exam">
             <div class="row mb-3">
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
                         <option value="" selected>Select Exam name</option>
                         <option value="">exam 1</option>
                         <option value="">exam 2</option>
                     </select>
                 </div>
             </div>
             <table id="exam" class="table  table-sm table-bordered display" style="width:100%" data-order="[[ 0, &quot;asc&quot; ]]" data-col1="60" data-collast="120">
                 <thead>
                     <tr>
                         <!-- <th scope="col">Question</th> -->
                         <th scope="col">Classroom</th>
                         <th scope="col">Exam name</th>
                         <th scope="col">Marks</th>
                         <!-- <th scope="col">Percent</th> -->
                         <th scope="col">Action</th>
                     </tr>
                 </thead>
                 <tbody>
                     <tr>
                         <!-- <td>Lorem ipsum dolor sit amet.</td> -->
                         <td>10 A Hindi</td>
                         <td>exam 1</td>
                         <td>15</td>
                         <!-- <td>80% </td> -->
                         <td>
                             <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#showexam">Show</a>
                             ||
                             <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#deleteexam">Delete</a>
                         </td>
                     </tr>
                 </tbody>
             </table>
         </div>
     </div>
 </div>




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
             <div class="modal-body">
                 <div class="px-3 m-auto ">
                     <h4 class="text-center">examination name</h4>
                 </div>
                 <div class=" px-3 d-flex justify-content-between font-weight-bold mt-2 mb-4 ">
                     <strong>Classroom:10 a Hindi</strong>
                     <span>time:45 min</span>
                     <span>marks:50</span>
                 </div>
                 <div class="media px-3 mb-2">
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
                 </div>
             </div>

         </div>
     </div>
 </div>
 <!-- *********end******** -->
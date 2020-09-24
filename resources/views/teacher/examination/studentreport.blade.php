 <div class="col-md-12 col-lg-12 col-12 px-0 mb-3">
     <div class="card card-info  ">
         <div class="card-header pt-1 pb-0 border-transparent text-white" style="background-color: #373c8e;">
             <h4 class="card-title d-inline">Student Reports</h4>
             <div class="card-tools d-inline float-right">
                 <button type="button" class="btn border ml-2 btn-tool text-white " data-card-widget="collapse">
                     <i class="fas fa-minus"></i>
                 </button>
             </div>
         </div>
         <div class="card-body card-border-exam">
             <div class="row mb-3">
                 <div class="col-md-4">
                     <select class="form-control" name="" id="">
                         <option value="" selected>Select Class</option>
                         <option value="">10 A</option>
                         <option value=""> 11</option>
                     </select>
                 </div>
                 <div class="col-md-4">
                     <select class="form-control" name="" id="">
                         <option value="" selected>Select Subject</option>
                         <option value="">Hindi</option>
                         <option value=""> English</option>
                     </select>
                 </div>
                 <div class="col-md-4">
                     <select class="form-control" name="" id="">
                         <option value="" selected>Select Exam name</option>
                         <option value="">exam 1</option>
                         <option value="">exam 2</option>
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
                         <!-- <th scope="col">Percent</th> -->
                         <th scope="col">Action</th>
                     </tr>
                 </thead>
                 <tbody>
                     <tr>
                         <td>vikram singh</td>
                         <td>10 A Hindi</td>
                         <td>exam 1</td>
                         <td>15/10</td>
                         <!-- <td>80% </td> -->
                         <td>
                             <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#studentedit">Show</a>
                             ||
                             <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#deletestudent">Delete</a>
                         </td>
                     </tr>
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
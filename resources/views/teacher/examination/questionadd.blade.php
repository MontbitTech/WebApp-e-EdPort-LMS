 <div class="col-md-12 col-lg-12 col-12 px-0 mb-3">
     <div class="card card-info  ">
         <div class="card-header pt-1 pb-0 border-transparent text-white" style="background-color: #373c8e;">
             <h4 class="card-title d-inline">Question List</h4>
             <div class="card-tools d-inline float-right">
                 <a href="#" class="btn bg-white text-succes " data-toggle="modal" data-target="#exampleModalCenter">Add Question</a>
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
                         <option value="" selected>Select Chapter</option>
                         <option value="">Chapter 1</option>
                         <option value="">Chapter 2</option>
                     </select>
                 </div>
             </div>
             <table id="questions" class="table  table-sm table-bordered display" style="width:100%" data-order="[[ 0, &quot;asc&quot; ]]" data-col1="60" data-collast="120">
                 <thead>
                     <tr>
                         <th scope="col">Question</th>
                         <th scope="col">Answer</th>
                         <th scope="col">Classroom</th>
                         <th scope="col">Action</th>
                     </tr>
                 </thead>
                 <tbody>
                     <tr>
                         <td>youre name</td>
                         <td>vikram,vicky,vikram singh</td>
                         <td>10 a hindi</td>
                         <td>
                             <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#questionedit">Edit</a>
                             ||
                             <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#deletequestion">Delete</a>
                         </td>
                     </tr>
                 </tbody>
             </table>
         </div>
     </div>
 </div>





 <!-- modal edit question -->
 <div class="modal fade" id="questionedit" tabindex="-1" role="dialog" aria-labelledby="questioneditTitle" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="questioneditTitle">Edit Question</h5>
                 <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form>
                     <div class="row ">
                         <div class="col-md-4">
                             <div class="form-group">
                                 <select class="form-control" name="" id="">
                                     <option value="">Select Class</option>
                                     <option value="" selected>10 A</option>
                                     <option value=""> 11</option>
                                 </select>
                             </div>
                         </div>
                         <div class="col-md-4">
                             <div class="form-group">
                                 <select class="form-control" name="" id="">
                                     <option value="">Select Subject</option>
                                     <option value="" selected>Hindi</option>
                                     <option value=""> English</option>
                                 </select>
                             </div>
                         </div>
                         <div class="col-md-4">
                             <div class="form-group">
                                 <select class="form-control" name="" id="">
                                     <option value="">Select Chapter</option>
                                     <option value="" selected>Chapter 1</option>
                                     <option value="">Chapter 2</option>
                                 </select>
                             </div>
                         </div>
                     </div>
                     <label for="exampleInputQuestion1" class="align-top">Question </label>
                     <div class="form-group mb-0 pb-1">
                         <textarea name="" id="exampleInputQuestion1" class="w-100 form-control" rows="3" placeholder="Insert your question" style="resize: none;"> Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eaque, iusto?</textarea>
                     </div>
                     <table class="table table-borderless">
                         <thead>
                             <tr>
                                 <th scope="col" class="text-center pb-0 pt-0 mb-0 mt-0">Option </th>
                                 <th scope="col" class="pb-0 pt-0 mb-0 mt-0">Answer</th>
                                 <th scope="col" class="text-center pb-0 pt-0 mb-0 mt-0">Option </th>
                                 <th scope="col" class="pb-0 pt-0 mb-0 mt-0">Answer</th>
                             </tr>
                         </thead>
                         <tbody>
                             <tr>
                                 <td class="mb-0 mt-0 pt-0 pb-1">
                                     <input class="form-control form-control-sm  " type="text" value="name" placeholder="option 1">
                                 </td>
                                 <td class="mb-0 mt-0 pt-0 pb-0">
                                     <input type="checkbox" class=" form-control-sm  ml-4 " checked>
                                 </td>
                                 <td class="mb-0 mt-0 pt-0 pb-1">
                                     <input class="form-control form-control-sm  " value="name" type="text" placeholder="option 2">
                                 </td>
                                 <td class="mb-0 mt-0 pt-0 pb-0">
                                     <input type="checkbox" class=" form-control-sm  ml-4 " checked>
                                 </td>
                             </tr>
                             <tr>
                                 <td class="mb-0 mt-0 pt-1 pb-0">
                                     <input class="form-control form-control-sm  " value="name" type="text" placeholder="option 3">
                                 </td>
                                 <td class="mb-0 mt-0 pt-0 pb-0">
                                     <input type="checkbox" class=" form-control-sm  ml-4 ">
                                 </td>
                                 <td class="mb-0 mt-0 pt-1 pb-0">
                                     <input class="form-control form-control-sm  " value="name" type="text" placeholder="option 4">
                                 </td>
                                 <td class="mb-0 mt-0 pt-0 pb-0">
                                     <input type="checkbox" class=" form-control-sm  ml-4 ">
                                 </td>
                             </tr>
                         </tbody>
                     </table>

                 </form>
             </div>
             <div class="modal-footer ">
                 <div class="m-auto">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                     <button type="button" class="btn btn-primary">Update</button>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- *********end******** -->


 <!-- delete question  -->
 <div class="modal fade" id="deletequestion" data-backdrop="static" tabindex="-1" role="dialog">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header bg-light d-flex align-items-center">
                 <h5 class="modal-title font-weight-bold">Delete Question</h5>
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
 <!-- ********end  delete question  ******* -->

 <!-- modal add question -->
 <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalCenterTitle">Add Question</h5>
                 <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form>
                     <div class="row ">
                         <div class="col-md-4">
                             <div class="form-group">
                                 <select class="form-control" name="" id="">
                                     <option value="" selected>Select Class</option>
                                     <option value="">10 A</option>
                                     <option value=""> 11</option>
                                 </select>
                             </div>
                         </div>
                         <div class="col-md-4">
                             <div class="form-group">
                                 <select class="form-control" name="" id="">
                                     <option value="" selected>Select Subject</option>
                                     <option value="">Hindi</option>
                                     <option value=""> English</option>
                                 </select>
                             </div>
                         </div>
                         <div class="col-md-4">
                             <div class="form-group">
                                 <select class="form-control" name="" id="">
                                     <option value="" selected>Select Chapter</option>
                                     <option value="">Chapter 1</option>
                                     <option value="">Chapter 2</option>
                                 </select>
                             </div>
                         </div>
                     </div>
                     <label for="exampleInputQuestion1" class="align-top">Question 1</label>
                     <div class="form-group mb-0 pb-1">
                         <textarea name="" id="exampleInputQuestion1" class="w-100 form-control" rows="3" placeholder="Insert your question" style="resize: none;"></textarea>
                     </div>
                     <table class="table table-borderless">
                         <thead>
                             <tr>
                                 <th scope="col" class="text-center pb-0 pt-0 mb-0 mt-0">Option </th>
                                 <th scope="col" class="pb-0 pt-0 mb-0 mt-0">Answer</th>
                                 <th scope="col" class="text-center pb-0 pt-0 mb-0 mt-0">Option </th>
                                 <th scope="col" class="pb-0 pt-0 mb-0 mt-0">Answer</th>
                             </tr>
                         </thead>
                         <tbody>
                             <tr>
                                 <td class="mb-0 mt-0 pt-0 pb-1">
                                     <input class="form-control form-control-sm  " type="text" placeholder="option 1">
                                 </td>
                                 <td class="mb-0 mt-0 pt-0 pb-0">
                                     <input type="checkbox" class=" form-control-sm  ml-4 ">
                                 </td>
                                 <td class="mb-0 mt-0 pt-0 pb-1">
                                     <input class="form-control form-control-sm  " type="text" placeholder="option 2">
                                 </td>
                                 <td class="mb-0 mt-0 pt-0 pb-0">
                                     <input type="checkbox" class=" form-control-sm  ml-4 ">
                                 </td>
                             </tr>
                             <tr>
                                 <td class="mb-0 mt-0 pt-1 pb-0">
                                     <input class="form-control form-control-sm  " type="text" placeholder="option 3">
                                 </td>
                                 <td class="mb-0 mt-0 pt-0 pb-0">
                                     <input type="checkbox" class=" form-control-sm  ml-4 ">
                                 </td>
                                 <td class="mb-0 mt-0 pt-1 pb-0">
                                     <input class="form-control form-control-sm  " type="text" placeholder="option 4">
                                 </td>
                                 <td class="mb-0 mt-0 pt-0 pb-0">
                                     <input type="checkbox" class=" form-control-sm  ml-4 ">
                                 </td>
                             </tr>
                         </tbody>
                     </table>
                     <div class="newquestion"></div>
                 </form>
             </div>
             <div class="modal-footer ">
                 <div class="m-auto">
                     <button class="btn btn-info addquestion" style="background-color: #373c8e;"><i class="fas fa-plus mr-3"></i>Add Question</button>
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                     <button type="button" class="btn btn-primary">Save</button>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- *********end******** -->
 <script>
     var max_fields = 100000; //maximum input boxes allowed
     var wrapper = $(".newquestion"); //Fields wrapper
     var add_button = $(".addquestion"); //Add button ID

     var x = 1; //initlal text box count
     $(add_button).click(function(e) { //on add input button click
         e.preventDefault();
         if (x < max_fields) { //max input box allowed
             x++; //text box increment
             $(wrapper).append(`
                         <div class="">
                                    <hr>                     
                                    <label for="exampleInputQuestion` + x + `" class="align-top">Question ` + x + `</label>
                                    <a href="#" style="float:right;" class="remove_field"><i class="fas fa-times"></i></a>
                                   <div class="form-group mb-0 pb-1">                                   
                                      <textarea name="" id="exampleInputQuestion` + x + `" class="w-100 form-control" rows="3" placeholder="Insert your question" style="resize: none;" ></textarea>
                                    </div>
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="text-center pb-0 pt-0 mb-0 mt-0">Option </th>
                                                <th scope="col" class="pb-0 pt-0 mb-0 mt-0">Answer</th>
                                                <th scope="col" class="text-center pb-0 pt-0 mb-0 mt-0">Option </th>
                                                <th scope="col" class="pb-0 pt-0 mb-0 mt-0">Answer</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="mb-0 mt-0 pt-0 pb-1">
                                                    <input class="form-control form-control-sm  " type="text" placeholder="option 1">
                                                </td>
                                                <td class="mb-0 mt-0 pt-0 pb-0">
                                                    <input type="checkbox" class=" form-control-sm  ml-4 ">
                                                </td>
                                                 <td class="mb-0 mt-0 pt-0 pb-1">
                                                    <input class="form-control form-control-sm  " type="text" placeholder="option 2">
                                                </td>
                                                <td class="mb-0 mt-0 pt-0 pb-0">
                                                    <input type="checkbox" class=" form-control-sm  ml-4 ">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="mb-0 mt-0 pt-1 pb-0">
                                                    <input class="form-control form-control-sm  " type="text" placeholder="option 3">
                                                </td>
                                                <td class="mb-0 mt-0 pt-0 pb-0">
                                                    <input type="checkbox" class=" form-control-sm  ml-4 ">
                                                </td>
                                                <td class="mb-0 mt-0 pt-0 pb-0">
                                                    <input class="form-control form-control-sm  " type="text" placeholder="option 4">
                                                </td>
                                                <td class="mb-0 mt-0 pt-1 pb-0">
                                                    <input type="checkbox" class=" form-control-sm  ml-4 ">
                                                </td>
                                            </tr>                     
                                        </tbody>
                                   </table>                                    
                            </div>`); //add input box
         }
     });

     $(wrapper).on("click", ".remove_field", function(e) { //user click on remove text
         e.preventDefault();
         $(this).parent('div').remove();
         x--;
     });
 </script>
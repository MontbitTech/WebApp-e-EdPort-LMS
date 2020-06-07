@extends('layouts.teacher.app')
@section('content')


<section class="main-section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-sm-12">
        <div class="classes-box pr-3">
          <div class="classes-datetime">
            <div class="cls-date">22 Apr</div>
            <div class="cls-from">10:00 AM</div>
            <div class="cls-separater">to</div>
            <div class="cls-to">11:00 AM</div>
          </div>
          <div class="d-flex justify-content-between align-items-center flex-wrap pt-1 pb-2">
            <div class="font-weight-bold pt-1"><span class="text-secondary">Class:</span> 7th Std</div>
            <div class="font-weight-bold pt-1"><span class="text-secondary">Section:</span> A</div>
            <div class="font-weight-bold pt-1"><span class="text-secondary">Subject:</span> Physics</div>
            <div class="font-weight-bold pt-1"><span class="text-secondary">Topic:</span> Intro of Quantum</div>
          </div>
          <p class="mt-0 mb-2 text-secondary text-edit" contenteditable="true">
            The branch of science concerned with the nature and properties of matter and energy.
          </p>
          <div class="d-flex justify-content-between flex-wrap py-2">
            <div>
              <a href="#" class="btn btn-sm btn-outline-primary mb-1 mr-2 border-0 btn-shadow">
                <svg class="icon font-12 mr-1"><use xlink:href="images/icons.svg#icon_plus"></use></svg> Add Quiz
              </a>
              <a href="#" class="btn btn-sm btn-outline-success mb-1 mr-2 border-0 btn-shadow d-none">
                <svg class="icon icon-1x mr-1"><use xlink:href="images/icons.svg#icon_eye"></use></svg> View Result 
              </a>
            </div>
            <div>
              <a href="#editQuizModal" data-editmodal="#A123" class="btn btn-sm btn-outline-secondary mb-1 border-0 btn-shadow" title="Edit">
                <svg class="icon mr-1"><use xlink:href="images/icons.svg#icon_edit"></use></svg> Edit 
              </a>
            </div>
          </div>
        </div>
        <div class="classes-box pr-3">
          <div class="classes-datetime">
            <div class="cls-date">23 Apr</div>
            <div class="cls-from">10:30 AM</div>
            <div class="cls-separater">to</div>
            <div class="cls-to">11:00 AM</div>
          </div>
          <div class="d-flex justify-content-between align-items-center flex-wrap pt-1 pb-2">
            <div class="font-weight-bold pt-1"><span class="text-secondary">Class:</span> 7th Std</div>
            <div class="font-weight-bold pt-1"><span class="text-secondary">Section:</span> B</div>
            <div class="font-weight-bold pt-1"><span class="text-secondary">Subject:</span> Physics</div>
            <div class="font-weight-bold pt-1"><span class="text-secondary">Topic:</span> Photoelectric Effect</div>
          </div>
          <p class="mt-0 mb-2 text-secondary text-edit" contenteditable="true">
            The branch of science concerned with the nature and properties of matter and energy.
          </p>
          <div class="d-flex justify-content-between flex-wrap py-2">
            <div>
              <a href="#" class="btn btn-sm btn-outline-primary mb-1 mr-2 border-0 btn-shadow">
                <svg class="icon font-12 mr-1"><use xlink:href="images/icons.svg#icon_plus"></use></svg> Add Quiz
              </a>
              <a href="#" class="btn btn-sm btn-outline-success mb-1 mr-2 border-0 btn-shadow d-none">
                <svg class="icon icon-1x mr-1"><use xlink:href="images/icons.svg#icon_eye"></use></svg> View Result 
              </a>
            </div>
            <div>
              <a href="#editQuizModal" data-editmodal="#A123" class="btn btn-sm btn-outline-secondary mb-1 border-0 btn-shadow" title="Edit">
                <svg class="icon mr-1"><use xlink:href="images/icons.svg#icon_edit"></use></svg> Edit 
              </a>
            </div>
          </div>
        </div>
        <div class="classes-box pr-3">
          <div class="classes-datetime">
            <div class="cls-date">22 Apr</div>
            <div class="cls-from">09:00 AM</div>
            <div class="cls-separater">to</div>
            <div class="cls-to">10:00 AM</div>
          </div>
          <div class="d-flex justify-content-between align-items-center flex-wrap pt-1 pb-2">
            <div class="font-weight-bold pt-1"><span class="text-secondary">Class:</span> 7th Std</div>
            <div class="font-weight-bold pt-1"><span class="text-secondary">Section:</span> C</div>
            <div class="font-weight-bold pt-1"><span class="text-secondary">Subject:</span> Physics</div>
            <div class="font-weight-bold pt-1"><span class="text-secondary">Topic:</span> Atomic Spectra</div>
          </div>
          <p class="mt-0 mb-2 text-secondary text-edit" contenteditable="true">
            The branch of science concerned with the nature and properties of matter and energy.
          </p>
          <div class="d-flex justify-content-between flex-wrap py-2">
            <div>
              <a href="#" class="btn btn-sm btn-outline-primary mb-1 mr-2 border-0 btn-shadow">
                <svg class="icon font-12 mr-1"><use xlink:href="images/icons.svg#icon_plus"></use></svg> Add Quiz
              </a>
              <a href="#" class="btn btn-sm btn-outline-success mb-1 mr-2 border-0 btn-shadow d-none">
                <svg class="icon icon-1x mr-1"><use xlink:href="images/icons.svg#icon_eye"></use></svg> View Result 
              </a>
            </div>
            <div>
              <a href="#editQuizModal" data-editmodal="#A123" class="btn btn-sm btn-outline-secondary mb-1 border-0 btn-shadow" title="Edit">
                <svg class="icon mr-1"><use xlink:href="images/icons.svg#icon_edit"></use></svg> Edit 
              </a>
            </div>
          </div>
        </div>
        <div class="classes-box pr-3">
          <div class="classes-datetime">
            <div class="cls-date">24 Apr</div>
            <div class="cls-from">08:30 AM</div>
            <div class="cls-separater">to</div>
            <div class="cls-to">09:00 AM</div>
          </div>
          <div class="d-flex justify-content-between align-items-center flex-wrap pt-1 pb-2">
            <div class="font-weight-bold pt-1"><span class="text-secondary">Class:</span> 7th Std</div>
            <div class="font-weight-bold pt-1"><span class="text-secondary">Section:</span> A</div>
            <div class="font-weight-bold pt-1"><span class="text-secondary">Subject:</span> Physics</div>
            <div class="font-weight-bold pt-1"><span class="text-secondary">Topic:</span> Bohr Model</div>
          </div>
          <p class="mt-0 mb-2 text-secondary text-edit" contenteditable="true">
            The branch of science concerned with the nature and properties of matter and energy.
          </p>
          <div class="d-flex justify-content-between flex-wrap py-2">
            <div>
              <a href="#" class="btn btn-sm btn-outline-primary mb-1 mr-2 border-0 btn-shadow">
                <svg class="icon font-12 mr-1"><use xlink:href="images/icons.svg#icon_plus"></use></svg> Add Quiz
              </a>
              <a href="#" class="btn btn-sm btn-outline-success mb-1 mr-2 border-0 btn-shadow d-none">
                <svg class="icon icon-1x mr-1"><use xlink:href="images/icons.svg#icon_eye"></use></svg> View Result 
              </a>
            </div>
            <div>
              <a href="#editQuizModal" data-editmodal="#A123" class="btn btn-sm btn-outline-secondary mb-1 border-0 btn-shadow" title="Edit">
                <svg class="icon mr-1"><use xlink:href="images/icons.svg#icon_edit"></use></svg> Edit 
              </a>
            </div>
          </div>
        </div>
        <div class="classes-box pr-3">
          <div class="classes-datetime">
            <div class="cls-date">22 Apr</div>
            <div class="cls-from">10:00 AM</div>
            <div class="cls-separater">to</div>
            <div class="cls-to">11:00 AM</div>
          </div>
          <div class="d-flex justify-content-between align-items-center flex-wrap pt-1 pb-2">
            <div class="font-weight-bold pt-1"><span class="text-secondary">Class:</span> 7th Std</div>
            <div class="font-weight-bold pt-1"><span class="text-secondary">Section:</span> A</div>
            <div class="font-weight-bold pt-1"><span class="text-secondary">Subject:</span> Physics</div>
            <div class="font-weight-bold pt-1"><span class="text-secondary">Topic:</span> de Broglie Waves/Atom</div>
          </div>
          <p class="mt-0 mb-2 text-secondary text-edit" contenteditable="true">
            The branch of science concerned with the nature and properties of matter and energy.
          </p>
          <div class="d-flex justify-content-between flex-wrap py-2">
            <div>
              <a href="#" class="btn btn-sm btn-outline-primary mb-1 mr-2 border-0 btn-shadow">
                <svg class="icon font-12 mr-1"><use xlink:href="images/icons.svg#icon_plus"></use></svg> Add Quiz
              </a>
              <a href="#" class="btn btn-sm btn-outline-success mb-1 mr-2 border-0 btn-shadow d-none">
                <svg class="icon icon-1x mr-1"><use xlink:href="images/icons.svg#icon_eye"></use></svg> View Result 
              </a>
            </div>
            <div>
              <a href="#editQuizModal" data-editmodal="#A123" class="btn btn-sm btn-outline-secondary mb-1 border-0 btn-shadow" title="Edit">
                <svg class="icon mr-1"><use xlink:href="images/icons.svg#icon_edit"></use></svg> Edit 
              </a>
            </div>
          </div>
        </div>
        <div class="classes-box pr-3">
          <div class="classes-datetime">
            <div class="cls-date">22 Apr</div>
            <div class="cls-from">10:00 AM</div>
            <div class="cls-separater">to</div>
            <div class="cls-to">11:00 AM</div>
          </div>
          <div class="d-flex justify-content-between align-items-center flex-wrap pt-1 pb-2">
            <div class="font-weight-bold pt-1"><span class="text-secondary">Class:</span> 7th Std</div>
            <div class="font-weight-bold pt-1"><span class="text-secondary">Section:</span> A</div>
            <div class="font-weight-bold pt-1"><span class="text-secondary">Subject:</span> Physics</div>
            <div class="font-weight-bold pt-1"><span class="text-secondary">Topic:</span> Matter Waves/Atom</div>
          </div>
          <p class="mt-0 mb-2 text-secondary text-edit" contenteditable="true">
            The branch of science concerned with the nature and properties of matter and energy.
          </p>
          <div class="d-flex justify-content-between flex-wrap py-2">
            <div>
              <a href="#" class="btn btn-sm btn-outline-primary mb-1 mr-2 border-0 btn-shadow">
                <svg class="icon font-12 mr-1"><use xlink:href="images/icons.svg#icon_plus"></use></svg> Add Quiz
              </a>
              <a href="#" class="btn btn-sm btn-outline-success mb-1 mr-2 border-0 btn-shadow d-none">
                <svg class="icon icon-1x mr-1"><use xlink:href="images/icons.svg#icon_eye"></use></svg> View Result 
              </a>
            </div>
            <div>
              <a href="#editQuizModal" data-editmodal="#A123" class="btn btn-sm btn-outline-secondary mb-1 border-0 btn-shadow" title="Edit">
                <svg class="icon mr-1"><use xlink:href="images/icons.svg#icon_edit"></use></svg> Edit 
              </a>
            </div>
          </div>
        </div>
        <div class="classes-box pr-3">
          <div class="classes-datetime">
            <div class="cls-date">22 Apr</div>
            <div class="cls-from">10:00 AM</div>
            <div class="cls-separater">to</div>
            <div class="cls-to">11:00 AM</div>
          </div>
          <div class="d-flex justify-content-between align-items-center flex-wrap pt-1 pb-2">
            <div class="font-weight-bold pt-1"><span class="text-secondary">Class:</span> 7th Std</div>
            <div class="font-weight-bold pt-1"><span class="text-secondary">Section:</span> A</div>
            <div class="font-weight-bold pt-1"><span class="text-secondary">Subject:</span> Physics</div>
            <div class="font-weight-bold pt-1"><span class="text-secondary">Topic:</span> Schrodinger Equation</div>
          </div>
          <p class="mt-0 mb-2 text-secondary text-edit" contenteditable="true">
            The branch of science concerned with the nature and properties of matter and energy.
          </p>
          <div class="d-flex justify-content-between flex-wrap py-2">
            <div>
              <a href="#" class="btn btn-sm btn-outline-primary mb-1 mr-2 border-0 btn-shadow">
                <svg class="icon font-12 mr-1"><use xlink:href="images/icons.svg#icon_plus"></use></svg> Add Quiz
              </a>
              <a href="#" class="btn btn-sm btn-outline-success mb-1 mr-2 border-0 btn-shadow d-none">
                <svg class="icon icon-1x mr-1"><use xlink:href="images/icons.svg#icon_eye"></use></svg> View Result 
              </a>
            </div>
            <div>
              <a href="#editQuizModal" data-editmodal="#A123" class="btn btn-sm btn-outline-secondary mb-1 border-0 btn-shadow" title="Edit">
                <svg class="icon mr-1"><use xlink:href="images/icons.svg#icon_edit"></use></svg> Edit 
              </a>
            </div>
          </div>
        </div>
        <div class="classes-box pr-3">
          <div class="classes-datetime">
            <div class="cls-date">22 Apr</div>
            <div class="cls-from">10:00 AM</div>
            <div class="cls-separater">to</div>
            <div class="cls-to">11:00 AM</div>
          </div>
          <div class="d-flex justify-content-between align-items-center flex-wrap pt-1 pb-2">
            <div class="font-weight-bold pt-1"><span class="text-secondary">Class:</span> 7th Std</div>
            <div class="font-weight-bold pt-1"><span class="text-secondary">Section:</span> A</div>
            <div class="font-weight-bold pt-1"><span class="text-secondary">Subject:</span> Physics</div>
            <div class="font-weight-bold pt-1"><span class="text-secondary">Topic:</span> Infinite/Finite Square Well</div>
          </div>
          <p class="mt-0 mb-2 text-secondary text-edit" contenteditable="true">
            The branch of science concerned with the nature and properties of matter and energy.
          </p>
          <div class="d-flex justify-content-between flex-wrap py-2">
            <div>
              <a href="#" class="btn btn-sm btn-outline-primary mb-1 mr-2 border-0 btn-shadow">
                <svg class="icon font-12 mr-1"><use xlink:href="images/icons.svg#icon_plus"></use></svg> Add Quiz
              </a>
              <a href="#" class="btn btn-sm btn-outline-success mb-1 mr-2 border-0 btn-shadow d-none">
                <svg class="icon icon-1x mr-1"><use xlink:href="images/icons.svg#icon_eye"></use></svg> View Result 
              </a>
            </div>
            <div>
              <a href="#editQuizModal" data-editmodal="#A123" class="btn btn-sm btn-outline-secondary mb-1 border-0 btn-shadow" title="Edit">
                <svg class="icon mr-1"><use xlink:href="images/icons.svg#icon_edit"></use></svg> Edit 
              </a>
            </div>
          </div>
        </div>
        <div class="classes-box pr-3">
          <div class="classes-datetime">
            <div class="cls-date">22 Apr</div>
            <div class="cls-from">10:00 AM</div>
            <div class="cls-separater">to</div>
            <div class="cls-to">11:00 AM</div>
          </div>
          <div class="d-flex justify-content-between align-items-center flex-wrap pt-1 pb-2">
            <div class="font-weight-bold pt-1"><span class="text-secondary">Class:</span> 8th Std</div>
            <div class="font-weight-bold pt-1"><span class="text-secondary">Section:</span> C</div>
            <div class="font-weight-bold pt-1"><span class="text-secondary">Subject:</span> Physics</div>
            <div class="font-weight-bold pt-1"><span class="text-secondary">Topic:</span> Tunneling/Alpha Decay</div>
          </div>
          <p class="mt-0 mb-2 text-secondary text-edit" contenteditable="true">
            The branch of science concerned with the nature and properties of matter and energy.
          </p>
          <div class="d-flex justify-content-between flex-wrap py-2">
            <div>
              <a href="#" class="btn btn-sm btn-outline-primary mb-1 mr-2 border-0 btn-shadow">
                <svg class="icon font-12 mr-1"><use xlink:href="images/icons.svg#icon_plus"></use></svg> Add Quiz
              </a>
              <a href="#" class="btn btn-sm btn-outline-success mb-1 mr-2 border-0 btn-shadow d-none">
                <svg class="icon icon-1x mr-1"><use xlink:href="images/icons.svg#icon_eye"></use></svg> View Result 
              </a>
            </div>
            <div>
              <a href="#editQuizModal" data-editmodal="#A123" class="btn btn-sm btn-outline-secondary mb-1 border-0 btn-shadow" title="Edit">
                <svg class="icon mr-1"><use xlink:href="images/icons.svg#icon_edit"></use></svg> Edit 
              </a>
            </div>
          </div>
        </div>          
      </div>
    </div>
  </div>
</section>


<!-- Add Quiz Modal -->
<div class="modal fade" id="addQuizModal" data-backdrop="static" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title font-weight-bold">Add Quiz</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body pt-4">
        <form>
          <div class="form-group row">
            <label for="addinputDate" class="col-md-4 col-form-label text-md-right">Date:</label>
            <div class="col-md-6">
              <input type="text" class="form-control" id="addinputDate" value="" placeholder="Example 20 Apr">
            </div>
          </div>
          <div class="form-group row">
            <label for="addinputFtime" class="col-md-4 col-form-label text-md-right">Class From Time:</label>
            <div class="col-md-6">
              <input type="text" class="form-control" id="addinputFtime" value="" placeholder="00:00 AM/PM">
            </div>
          </div>
          <div class="form-group row">
            <label for="addinputTtime" class="col-md-4 col-form-label text-md-right">Class To Time:</label>
            <div class="col-md-6">
              <input type="text" class="form-control" id="addinputTtime" value="" placeholder="00:00 AM/PM">
            </div>
          </div>
          <div class="form-group row">
            <label for="addclassChoose" class="col-md-4 col-form-label text-md-right">Class:</label>
            <div class="col-md-6">
              <select class="custom-select" id="addclassChoose">
                <option>Select Class</option>
                <option>6th Std</option>
                <option>7th Std</option>
                <option>8th Std</option>
                <option>9th Std</option>
                <option>10th Std</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="addinputSection" class="col-md-4 col-form-label text-md-right">Section:</label>
            <div class="col-md-6">
              <input type="text" class="form-control" id="addinputSection" value="" placeholder="Example A,B">
            </div>
          </div>
          <div class="form-group row">
            <label for="addinputSubject" class="col-md-4 col-form-label text-md-right">Subject:</label>
            <div class="col-md-6">
              <select class="custom-select" id="addinputSubject">
                <option>Select Subject</option>
                <option>Physics</option>
                <option>Chemistry</option>
                <option>Mathematics</option>
                <option>English</option>
                <option>Biology</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputDesc" class="col-md-4 col-form-label text-md-right">Description:</label>
            <div class="col-md-6">
              <textarea class="form-control" id="inputDesc" rows="3" placeholder="Write here..."></textarea>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputJoinlive" class="col-md-4 col-form-label text-md-right">Join Live <small>(Link)</small>:</label>
            <div class="col-md-6">
              <textarea class="form-control" id="inputJoinlive" rows="3" placeholder="Enter Link"></textarea>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputAddquiz" class="col-md-4 col-form-label text-md-right">Add Quiz <small>(Link)</small>:</label>
            <div class="col-md-6">
              <textarea class="form-control" id="inputAddquiz" rows="3" placeholder="Enter Link"></textarea>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputNotifystd" class="col-md-4 col-form-label text-md-right">Notify Students:</label>
            <div class="col-md-6">
              <textarea class="form-control" id="inputNotifystd" rows="3" placeholder="Enter Notify Message"></textarea>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-8 offset-md-4">
              <button type="button" class="btn btn-primary px-4">Save Class</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End -->

<!-- Edit Quiz Modal -->
<div class="modal fade" id="editQuizModal" data-backdrop="static" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title font-weight-bold">Edit Quiz</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body pt-4">
        <form>
          {{-- <div class="form-group row">
            <label for="inputDate" class="col-md-4 col-form-label text-md-right">Date:</label>
            <div class="col-md-6">
              <input type="text" class="form-control" id="inputDate" value="22 Apr">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputFtime" class="col-md-4 col-form-label text-md-right">Class From Time:</label>
            <div class="col-md-6">
              <input type="text" class="form-control" id="inputFtime" value="10:00 AM" placeholder="00:00 AM/PM">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputTtime" class="col-md-4 col-form-label text-md-right">Class To Time:</label>
            <div class="col-md-6">
              <input type="text" class="form-control" id="inputTtime" value="11:00 AM" placeholder="00:00 AM/PM">
            </div>
          </div>
          <div class="form-group row">
            <label for="classChoose" class="col-md-4 col-form-label text-md-right">Class:</label>
            <div class="col-md-6">
              <select class="custom-select" id="classChoose">
                <option>Select Class</option>
                <option>6th Std</option>
                <option>7th Std</option>
                <option>8th Std</option>
                <option>9th Std</option>
                <option>10th Std</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputSection" class="col-md-4 col-form-label text-md-right">Section:</label>
            <div class="col-md-6">
              <input type="text" class="form-control" id="inputSection" value="A" placeholder="Example A,B">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputSubject" class="col-md-4 col-form-label text-md-right">Subject:</label>
            <div class="col-md-6">
              <select class="custom-select" id="inputSubject">
                <option>Select Subject</option>
                <option>Physics</option>
                <option>Chemistry</option>
                <option>Mathematics</option>
                <option>English</option>
                <option>Biology</option>
              </select>
            </div>
          </div> --}}
          <div class="form-group row">
            <label for="inputDesc" class="col-md-4 col-form-label text-md-right">Description:</label>
            <div class="col-md-6">
              <textarea class="form-control" id="inputDesc" rows="3" placeholder="Write here...">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</textarea>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputAddquiz" class="col-md-4 col-form-label text-md-right">Add Quiz <small>(Link)</small>:</label>
            <div class="col-md-6">
              <textarea class="form-control" id="inputAddquiz" rows="3" placeholder="Enter Link">https://www.xipetech.club/work/lms/</textarea>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputNotifystd" class="col-md-4 col-form-label text-md-right">View Result <small>(Link)</small>:</label>
            <div class="col-md-6">
              <textarea class="form-control" id="inputNotifystd" rows="3" placeholder="Enter Link">https://www.xipetech.club/work/lms/</textarea>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-8 offset-md-4">
              <button type="button" class="btn btn-primary px-4">Save</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End -->
<script type="text/javascript">
$(document).on('click', '[data-editmodal]', function(){
  $('#editQuizModal').modal('show');
});
$(document).on('change', '[data-selecttopic]', function(){
  var getid = $(this).attr('data-selecttopic');
  if($(this).val()!=''){
    $(getid).fadeIn();
  }
  else{
    $(getid).hide();    
  }
});
</script>

@endsection
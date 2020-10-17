  <div class="tab-pane fade" id="plclasses">
      @if(count($pastDates) > 0)
      @php
      $i=1;
      @endphp

      <div class="form-group col-md-5">
          <select name="past_class" id="pastclassdata{{$i}}" style="margin-left: -14px;width:60%" class="form-control" onchange="viewPastClass({{$i}})">
              <option value="">Select Date</option>
              @foreach ($pastDates as $tt)
              <option value="{{$tt->class_date}}">{{ date("D, d M", strtotime($tt->class_date))}}</option>
              @php
              $i++;
              @endphp
              @endforeach
          </select>
      </div>
      @endif
      @if(count($pastClassData) > 0)

      @php
      $i=1;
      $new= $i;
      @endphp
      @foreach ($pastClassData as $t)
      <?php
        $cls = 0;
        $section_name = '';
        $g_class_id = '';
        $class_name = '';
        $subject_name = '';
        $chapter = '';
        $topic = '';
        if ($t->studentClass) {
            $class_name = $t->studentClass->class_name;
            //$class_name = App\Http\Helpers\CommonHelper::addOrdinalNumberSuffix($t->studentClass->class_name);
            $section_name = $t->studentClass->section_name;
            $g_class_id = $t->studentClass->g_class_id;
        }
        if ($t->studentSubject) {
            $subject_name = $t->studentSubject->subject_name;
        }
        if ($t->cmsLink) {
            $chapter = $t->cmsLink->chapter;
            $topic = $t->cmsLink->topic;
        }
        ?>


      <div class="card text-center mb-3">

          <input type="hidden" id="pastdateClass_id{{$i}}" value="{{$t->id}}">
          <input type="hidden" id="past_class_id{{$i}}" value="{{$t->class_id}}">
          <input type="hidden" id="past_subject_id{{$i}}" value="{{$t->subject_id}}">

          <input type="hidden" id="past_desc{{$i}}" value="{{$t->class_description}}">
          <input type="hidden" id="past_gMeetURL{{$i}}" value="{{$t->g_meet_url}}">
          <input type="hidden" id="past_stdMessage{{$i}}" value="{{$t->class_student_msg}}">
          <input type="hidden" id="past_recURL{{$i}}" value="{{$t->recording_url}}">
          <input type="hidden" id="pastg_class_id_{{$i}}" value="{{ $g_class_id}}" />
          <?php
            $class_date = date("d M", strtotime($t->class_date));
            ?>

          <div class="card-header text-white p-0 " style="background:#253372;">
              <div class="container-fluid padding-right">
                  <div class="row p-0 m-0 ">
                      <div class="col-md-1 col-lg-1 col-2 text-left px-0 pt-3 mx-0 font-weight-bold">{{ $class_date }}</div>
                      <div class="col-md-3 col-3 col-lg-2 col-sm-3 font-weight-bold px-0 pt-3 mx-0 font-size-tab ">
                          {{ date('h:i a',strtotime($t->from_timing))}} to {{ date('h:i a',strtotime($t->to_timing))}}
                      </div>
                      <div class="col-md-6 col-7 col-sm-7 font-weight-bold pt-3 px-0 font-size-tab display-none-lp"> Classroom: {{ $class_name}} {{$section_name }} , {{$subject_name}}</div>
                      <div class="col-md-2 col-2 col-lg-1 col-sm-2 font-weight-bold pt-3 px-0 font-size-tab display-none-tab"> Class: {{ $class_name }} Std</div>
                      <div class="col-md-1 col-1 col-lg-1 col-sm-1 font-weight-bold pt-3 px-0 font-size-tab display-none-tab"> Section:{{$section_name}}</div>
                      <div class="col-md-5 col-5 col-lg-5 col-sm-5 font-weight-bold   m-auto pt-1 px-0 font-size-tab display-none-tab"> Subject: {{$subject_name}}</div>
                      <div class="col-md-2 col-2 col-lg-2 mx-0 px-0 pt-1">
                          <div class="row mx-0 px-0">
                              <div class="col-7 col-md-9 col-lg-7  px-0 mx-0">@if($t->cancelled)
                                  <h2 class="btn btn-md bg-danger text-white mx-0 px-2 my-1 font-weight-bold font-size-tab btn-sm-size">Cancelled</h2>
                                  @endif
                              </div>
                              <div class="col-5 col-md-3 col-lg-5 pr-0 mr-0"> <button type="button" class="float-right btn  btn-collapse font-size-tab text-white collapse-btn px-2 py-1 my-1" data-toggle="collapse" data-target="#collapseExample{{$t->id}}" aria-expanded="false" aria-controls="collapseExample{{$t->id}}"><i class="toggle-class  fas fa-plus"></i>
                                  </button></div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="collapse card-border" id="collapseExample{{$t->id}}">
              <div class="card-body p-0">
                  <div class="row m-2">
                      <div class="col-md-6">
                          <div class="row">
                              <div class="col-md-6">
                                  {{$chapter}}
                              </div>
                              <div class="col-md-6">
                                  <?php
                                    $x = $t->cmsLink;
                                    ?>
                                  {{$topic}}
                              </div>
                              @if($t->cancelled)
                              @else
                              <div class="col-md-12">
                                  <?php
                                    $cms_link = '';
                                    $youtube = '';
                                    $academy = '';
                                    $book = '';
                                    $other = '';
                                    if (strlen($x) > 0) {
                                        $display_style = 'display: block;';
                                        $cms_link = $x->link;
                                        $youtube = $x->youtube;
                                        $academy = $x->khan_academy;
                                        $book    = $x->book_url;
                                        $other   = $x->others;
                                    } else
                                        $display_style = 'display: none;';


                                    if ($t->topic_id != '') {
                                        //  $display_style = 'display: block;';
                                    }
                                    if ($t->cmsLink) {
                                        // $cms_link = $t->cmsLink->link;
                                    }
                                    $cms_link = '';
                                    if (strlen($x) > 0) {
                                        $display_style = 'display: block;';
                                        $cms_link = $x->link;
                                    } else
                                        $display_style = 'display: none;';
                                    ?>
                                  <!--new changes -->
                                  <div class="m-auto mt-2 pt-2" id="icon{{$t->id}}">
                                      <div class="row">
                                          @if($cms_link!=null)
                                          <div class="col-md-6 mt-2">
                                              <div class="w-100 d-inline-flex" style="letter-spacing:3px;">
                                                  <a href="javascript:void(0);" data-topiclink="{{ $cms_link  }}" data-topicid="{{$t->topic_id}}" class="col-9 btn btn-sm btn-outline-dark btn-shadow border-0 d-inline-flex d-none" id="viewcontent_{{$t->id}}" style="{{$display_style}}">
                                                      <!-- Edport Content -->
                                                      <span class="m-auto font-weight-bolder">e-Edport</span>
                                                  </a>
                                                  <button class="col-3 btn btn-sm btn-outline-dark btn-shadow border-0" onclick="shareContent('{{$cms_link}}','{{$t->id}}')">
                                                      <i class="fa fa-share-alt" aria-hidden="true"></i>
                                                  </button>
                                              </div>
                                          </div>
                                          @endif
                                          @if($academy!=null)
                                          <?php
                                            $parse = parse_url($academy);
                                            $academy_name = $parse['host'];
                                            $academy_name = str_ireplace(['www.', '.com', '.ca', 'lms.', '-s', '.net', '.info', '.org', 'en.', '.tech', '.coop', '.int', '.co', '.uk', '.ac', '.io', '.github', 'about.'], '', $academy_name);
                                            ?>
                                          <div class="col-md-6 mt-2">
                                              <div class="w-100 d-inline-flex" style="letter-spacing:3px;">
                                                  <a href="javascript:void(0);" data-academylink="{{ $academy}}" data-topicid="{{$t->topic_id}}" id="academy_{{$t->id}}" class="col-9 btn btn-sm btn-outline-primary btn-shadow border-0 d-inline-flex d-none" style="{{$display_style}}">
                                                      <span class="m-auto font-weight-bolder">{{$academy_name}}</span>
                                                  </a>
                                                  <button class="col-3 btn btn-sm btn-outline-primary btn-shadow border-0" onclick="shareContent('{{$academy}}','{{$t->id}}')">
                                                      <i class="fa fa-share-alt" aria-hidden="true"></i>
                                                  </button>
                                              </div>
                                          </div>
                                          @endif
                                          @if($youtube!=null)
                                          <?php
                                            $parse = parse_url($youtube);
                                            $youtube_name = $parse['host'];
                                            $youtube_name = str_ireplace(['www.', '.com', '.ca', 'lms.', '-s', '.net', '.info', '.org', 'en.', '.tech', '.coop', '.int', '.co', '.uk', '.ac', '.io', '.github', 'about.'], '', $youtube_name);
                                            ?>
                                          <div class="col-md-6 mt-2">
                                              <div class="w-100 d-inline-flex" style="letter-spacing:3px;">
                                                  <a href="javascript:void(0);" data-youtubelink="{{ $youtube}}" data-topicid="{{$t->topic_id}}" id="youtube_{{$t->id}}" class="col-9 btn btn-sm btn-outline-danger btn-shadow border-0 d-inline-flex d-none" style="{{$display_style}}">
                                                      <span class="m-auto font-weight-bolder">{{$youtube_name}}</span>
                                                  </a>
                                                  <button class="col-3 btn btn-sm btn-outline-danger btn-shadow border-0" onclick="shareContent('{{$youtube}}','{{$t->id}}')">
                                                      <i class="fa fa-share-alt" aria-hidden="true"></i>
                                                  </button>
                                              </div>
                                          </div>
                                          @endif
                                          @if($other!=null)
                                          <?php
                                            $parse = parse_url($other);
                                            $other_name = $parse['host'];
                                            $other_name = str_ireplace(['www.', '.com', '.ca', 'lms.', '-s', '.net', '.info', '.org', 'en.', '.tech', '.coop', '.int', '.co', '.uk', '.ac', '.io', '.github', 'about.'], '', $other_name);
                                            ?>
                                          <div class="col-md-6 mt-2">
                                              <div class="w-100 d-inline-flex" style="letter-spacing:3px;">
                                                  <a href="javascript:void(0);" data-wikipedialink="{{ $other}}" data-topicid="{{$t->topic_id}}" id="wikipedia_{{$t->id}}" class="col-9 btn btn-sm btn-outline-secondary btn-shadow border-0 d-inline-flex d-none" style="{{$display_style}}">
                                                      <span class="m-auto font-weight-bolder">{{$other_name}}</span>
                                                  </a>
                                                  <button class="col-3 btn btn-sm btn-outline-secondary btn-shadow border-0" onclick="shareContent('{{$other}}','{{$t->id}}')">
                                                      <i class="fa fa-share-alt" aria-hidden="true"></i>
                                                  </button>
                                              </div>
                                          </div>
                                          @endif
                                          @if($book!=null) <?php
                                                            $parse = parse_url($book);
                                                            $book_name = $parse['host'];

                                                            $book_name = str_ireplace(['www.', '.com', '.ca', 'lms.', '-s', '.net', '.info', '.org', 'en.', '.tech', '.coop', '.int', '.co', '.uk', '.ac', '.io', '.github', 'about.'], '', $book_name);
                                                            ?>
                                          <div class="col-md-6 mt-2">
                                              <div class="w-100 d-inline-flex" style="letter-spacing:3px;">
                                                  <a href="javascript:void(0);" data-book="{{ $book}}" data-topicid="{{$t->topic_id}}" id="book_{{$t->id}}" class="col-9 btn btn-sm btn-outline-primary btn-shadow border-0 d-inline-flex d-none" style="{{$display_style}}">
                                                      <span class="m-auto font-weight-bolder">{{$book_name}}</span>
                                                  </a>
                                                  <button class="col-3 btn btn-sm btn-outline-primary btn-shadow border-0" onclick="shareContent('{{$book}}','{{$t->id}}')">
                                                      <i class="fa fa-share-alt" aria-hidden="true"></i>
                                                  </button>
                                              </div>
                                          </div>
                                          @endif
                                      </div>
                                  </div>
                              </div>
                              @endif
                          </div>
                      </div>
                      <div class="col-md-6 mt-1">
                          <div class=" mt-1 mb-1">
                              <textarea class="form-control " style="resize: none;" rows="4" placeholder="Empty Notes!" disabled name="class_description">@if($t->class_description!=''){{$t->class_description}}@else{{$t->class_description}}@endif</textarea>
                          </div>
                      </div>
                  </div>
              </div>
              @if($t->cancelled)
              @else
              <div class="card-footer p-1" style="background:#fff;">
                  <div class="d-flex justify-content-between flex-wrap">
                      <div class="m-auto">
                          <button type="button" data-toggle="modal" data-target="#viewStudentModal" data-dateclass="{{$t->id}}" data-id="view_student" data-view="{{$i}}" id="purchaseshowdivid" class="btn btn-md btn-outline-primary mb-1 border-0 btn-shadow btn-sm-size" href="javascript:;" data-tooltip="tooltip" data-placement="top" title="" data-original-title="View">View Students</button>
                          <?php
                            $assignmentData = App\Http\Helpers\CommonHelper::get_assignment_data($t->id);
                            ?>
                          @if (count($assignmentData) > 0)
                          <button onclick="viewAssignment({{$t->id}})" class="btn btn-md btn-outline-primary ml-2 mb-1 mr-2 border-0 btn-shadow" data-toggle="modal" data-target="#exampleModalLong">View Assigment</button>
                          @endif
                      </div>
                  </div>
              </div>
              @endif
          </div>
      </div>

      @php
      $i++;
      @endphp
      @endforeach
      @else

      <!-- <div class="classes-box min-height-auto py-4 p-4 text-danger text-center">
                                                        <svg class="icon icon-4x mr-3">
                                                            <use xlink:href="../images/icons.svg#icon_nodate"></use>
                                                        </svg>
                                                        No Lectures found for {{ date("d/m/Y") }}.
                                                        <br><br>
                                                        <a href="{{ route('reload-timetable') }}" target="_blank">
                                                            Click here to reload updated timetable again.
                                                        </a>
                                                        <script>
                                                            function reload_timetable() {
                                                                fetch("{{ route('reload-timetable') }}")
                                                                    .then(function (response) {
                                                                        location.reload();
                                                                    })
                                                            }
                                                            reload_timetable()
                                                        </script>
                                                    </div> -->
      @endif
  </div>
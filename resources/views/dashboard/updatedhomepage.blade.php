@php
use App\Facades\UtilityFacades;
$logo = asset(Storage::url('uploads/logo/'));
$users = \Auth::user();
$currantLang = $users->currentLanguage();
$company_favicon = UtilityFacades::getValByName('company_favicon');
$settings = UtilityFacades::settings();
if (!str_starts_with($settings['facebook_url'], 'https://')) {
$settings['facebook_url'] = 'https://' . $settings['facebook_url'];
}
if (!str_starts_with($settings['linkedin_url'], 'https://')) {
$settings['linkedin_url'] = 'https://' . $settings['linkedin_url'];
}
if (!str_starts_with($settings['twitter_url'], 'https://')) {
$settings['twitter_url'] = 'https://' . $settings['twitter_url'];
}
if(isset($settings['color']))
{
$primary_color = $settings['color'];
if ($primary_color!="") {
$color = $primary_color;
} else {
$color = 'theme-1';
}
}
else{
$color = 'theme-1';
}
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard</title>
  <!-- Bootstrap CSS -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    rel="stylesheet" />
  <link rel="icon" href="{{ $logo . (isset($company_favicon) && !empty($company_favicon) ? $company_favicon : 'favicon.png') }}" type="image" sizes="16x16">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
  <link href="{{ asset('assets/css/new_style.css') }}" rel="stylesheet">
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> -->

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <script src="{{ asset('js/jquery.min.js') }}"></script>
</head>

<body>
  <header>
    <nav>
      <div class="head-logo" >
        <a href=""><img src="{{ $logo }}/light_logo.png" alt="logo" / style="width:270px !important;"></a>

      </div>

      <div class="resize-etc">
        <h6 style="margin-bottom:2px !important;">{{$settings['organization_name']}}</h6>
        <p style="margin-bottom:2px !important;">{{$settings['authority']}}</p>
        <!-- <h6>DIRECTORATE OF e-GOVERNANCE TAMILNADU e-GOVERNANCE AGENCY</h6>
        <p>Goverment of India</p> -->
        <div>
          <a href="{{$settings['facebook_url']}}" target="_blank" class="social-icon"><i class="bi bi-facebook"></i></a>
          <a href="{{$settings['twitter_url']}}" target="_blank" class="social-icon"><i class="bi bi-twitter"></i></a>
          <a href="{{$settings['linkedin_url']}}" target="_blank" class="social-icon"><i class="bi bi-linkedin"></i></a>
          <a href="javascript:void(0);" onclick="increaseFontSize()" class="social-icon">A+</a>
          <a href="javascript:void(0);" onclick="resetFontSize()" class="social-icon">A</a>
          <a href="javascript:void(0);" onclick="decreaseFontSize()" class="social-icon">A-</a>
          <a href="" class="social-icon"><i class="bi bi-question-circle"></i></a>
        </div>
      </div>
    </nav>
  </header>

  <aside>
    <div class="sidebar" style="padding-top:10px !important;">
      <div class="profile-img"> <img style="width: 80px; height:80px; border:3px solid #37B726; border-radius: 50px;margin:0 auto;"
          src="{{ asset('public/assets/images/user/' . $user_details->avatar) }}"
          alt="User"
          class="rounded-circle mb-2" />
        <!-- <p>CONSULTANT</p> -->
      </div>
      <div style="text-align:center;"><h6>{{ Auth::user()->name }}</h6></div>

      <div class="links">
        <ul>
          <li>
            <a href="#"><i class="bi bi-house-door-fill"></i>Home</a>
          </li>

          @can('manage-receipt')
          <li>
            <a href="{{route('receipt.index')}}"><i class="bi bi-calendar3"></i>eFile</a>
          </li>
          @endcan
          @can('manage-user')
          <li>
            <a href="{{ route('users.index') }}"><i class="bi bi-calendar-event"></i>Users</a>
          </li>
          @endcan
          @can('manage-role')
          <li>
            <a href="{{ route('roles.index') }}"><i class="bi bi-calendar-event"></i>Roles</a>
          </li>
          @endcan
          @can('manage-permission')
          <li>
            <a href="{{ route('permission.index') }}"><i class="bi bi-calendar-event"></i>Permissions</a>
          </li>
          @endcan
          @can('manage-department')
          <li>
            <a href="{{ route('department.index') }}"><i class="bi bi-gear-wide-connected"></i>Department</a>
          </li>
          @endcan
          @can('manage-section')
          <li>
            <a href="{{ route('section.index') }}"><i class="bi bi-gear-wide-connected"></i>Sections</a>
          </li>
          @endcan
          @can('manage-category')
          <li>
            <a href="{{ route('category.index') }}"><i class="bi bi-envelope-fill"></i>Category</a>
          </li>
          @endcan
          @can('manage-subcategory')
          <li>
            <a href="{{ route('subcategory.index') }}"><i class="bi bi-gear-wide-connected"></i>SubCategory</a>
          </li>
          @endcan
          <li>
            <a href="#"><i class="fa fa-calendar" ></i>Calendar</a>
          </li>
                    <li>
            <a href="#"><i class="fa fa-book" aria-hidden="true"></i>KMS</a>
          </li>
                    <li>
            <a href="#"><i class="fa fa-envelope" aria-hidden="true"></i>Mail</a>
          </li>
                              <li>
            <a href="#"><i class="fa fa-list-alt" aria-hidden="true"></i>To do list</a>
          </li>
                                        <li>
            <a href="#"><i class="bi bi-gear-wide-connected"></i>Notes</a>
          </li>
        </ul>
      </div>
    </div>
  </aside>

  <main>
    <div class="inner-head">
      <div class="left-side">
        <p style="margin-bottom:0px !important; width:130px;clip-path: polygon(75% 0%, 100% 50%, 75% 100%, 0% 100%, 0% 0%, 0% 0%);">Set Status</p>
        <ul>
          <li class="border-right" id="online"><i class="bi bi-clock-history"></i>Online</li>
          <li class="border-right" id="busy"><i class="bi bi-cast"></i>Busy</li>
          <li class="border-right" id="meeting"><i class="bi bi-people"></i>Meeting</li>
          <li class="border-right" id="tea_break"><i class="bi bi-cup-hot-fill"></i>Tea Break</li>
          <li class="border-right" id="lunch_break"><i class="bi bi-x-lg"></i>Lunch break</li>
        </ul>
      </div>
      <div class="right-side">
        <ul>
          <div class="dropdown">
            <li type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="bi bi-gear"></i>Settings</li>
            <!-- <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Dropdown
            </button> -->
            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
              <a style="padding: 0 9px;" href="{{ route('profile') }}" class="dropdown-item" type="a"><i style="padding-right: 4%;" class="fa fa-user action-btn"></i>Profile</a>
              <!-- <button class="dropdown-item" type="button">Another action</button>
              <button class="dropdown-item" type="button">Something else here</button> -->
            </div>
          </div>
          <li><a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="bi bi-power"></i>Log Out</a></li>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        </ul>
      </div>
    </div>

    <div class="row" style="padding: 5px;">
      <!-- center content here -->
      <div class="col-md-9">
        <div class="row" style="row-gap: 20px">
          <!-- efile card  -->
          <div class="col-md-6" style="padding-left: 20px !important;padding-right:10px !important ">
            <div class="card">
              <div class="card-header">
                <div><i class="bi bi-calendar3"></i>  eFile</div>
                <div>
                  <i class="bi bi-aspect-ratio" id="eFile-lg-modal" data-toggle="modal" data-target=".efile-modal-large"></i>
                  <i class="bi bi-arrow-clockwise reload-icon" style="cursor: pointer;"></i>
                  <i class="bi bi-question-circle"></i>
                </div>
                <!-- modal starts from here -->
                <div class="modal fade efile-modal-large" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <table class="table table-striped" id="eFile-lg-table">
                      </table>
                    </div>
                  </div>
                </div>
                <!-- modal ends here -->
              </div>
              <div class="card-body" style="height:350px !important;overflow-y: auto;
  -ms-overflow-style: none; /* IE and Edge */
  scrollbar-width: 1px;">
                <div class="d-flex justify-content-end">
                  <div class="card-tabs">
                    <p class="active" id="efile">eFile</p>
                    <p id="recipts">Recipts</p>
                  </div>
                </div>
                <ul id="file_details">
                </ul>
              </div>
            </div>
          </div>
          <!-- notice board card  -->
          <div class="col-md-6" style="padding-left: 0px !important;">
            <div class="card">
              <div class="card-header">
                <div> <i class="fa-solid fa-contact-book"></i>   Notice Board</div>
                <div>
                  <i class="bi bi-aspect-ratio" id="notice-lg-modal" data-toggle="modal" data-target=".notice-modal-large"></i>
                  <i class="bi bi-arrow-clockwise" id="reload-noticeboard"></i>
                  <i class="bi bi-question-circle"></i>
                  <i class="bi bi-three-dots-vertical"></i>
                </div>
                <!-- modal starts from here -->
                <div class="modal fade notice-modal-large" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <table class="table table-striped" id="notice-lg-table">
                      </table>
                    </div>
                  </div>
                </div>
                <!-- modal ends here -->
              </div>
              <div class="card-body notice-board-card" style="height:350px !important;overflow-y: auto;
  -ms-overflow-style: none; /* IE and Edge */
  scrollbar-width: 1px;">
                <div class="d-flex justify-content-end">
                  <div class="card-tabs">
                    <p class="active" id="notice_board">Notice Board</p>
                    <p id="my_doc">My Docs</p>
                  </div>
                </div>
                <ul id="notice_board_details">
                </ul>
              </div>
            </div>
          </div>
          <!-- Notes card  -->
          <div class="col-md-6" style="padding-left: 20px !important;padding-right:10px !important ">
            <div class="card">
              <div class="card-header">
                <div> <i class="fa-solid fa-sticky-note"></i>    Notes</div>
                <div>
                  <i class="bi bi-search"></i>
                  <i data-toggle="modal" data-target="#exampleModalCenter2" class="bi bi-plus-circle"></i>
                  <i class="bi bi-aspect-ratio" id="notes-lg-modal" data-toggle="modal" data-target=".notes-modal-large"></i>
                  <i id="notes-reload" class="bi bi-arrow-clockwise"></i>
                  <i class="bi bi-question-circle"></i>
                </div>
                <!-- modal starts from here -->
                <div class="modal fade notes-modal-large" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <table class="table table-striped" id="notes-lg-table">
                      </table>
                    </div>
                  </div>
                </div>
                <!-- modal ends here -->
              </div>
              <div class="card-body">
                <ul id="notes_details">
                </ul>
              </div>
            </div>
          </div>

          <!-- To do List card  -->
          <div class="col-md-6" style="padding-left: 0px !important;">
            <div class="card">
              <div class="card-header">
                <div><i class="fa-solid fa-newspaper"></i>    To Do List</div>
                <div>
                  <i data-toggle="modal" data-target="#exampleModalCenter" class="bi bi-plus-circle"></i>
                  <i class="bi bi-aspect-ratio" id="todos-lg-modal" data-toggle="modal" data-target=".todos-modal-large"></i>
                  <i class="bi bi-arrow-clockwise" id="todo_reload"></i>
                </div>
                <!-- modal starts from here -->
                <div class="modal fade todos-modal-large" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <table class="table table-striped" id="todos-lg-table">
                      </table>
                    </div>
                  </div>
                </div>
                <!-- modal ends here -->
              </div>
              <div class="card-body">
                <ul id="todo_details">
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- right side content here -->
      <div class="col-md-3">
        <div class="row" style="row-gap: 20px">
          <!-- Team strat -->
          <div class="col-12">
            <div class="card team-card">
              <div class="card-header">
                <div>Team</div>
                <div class="icon-container">
                  <input type="text" placeholder="Search" id="searchInput" autocomplete="off" class="search-input">
                  <i class="bi bi-x-lg" id="closeSearch" class="hidden" style="font-size: medium;"></i>
                  <i class="bi bi-search" id="team-search"></i>
                  <i class="bi bi-arrow-clockwise" id="team_reload"></i>
                  <i class="bi bi-three-dots-vertical"></i>
                </div>

              </div>
              <div class="card-body" >
                <ul id="teams-details">
                </ul>
              </div>
            </div>
          </div>
          <!-- connect start -->
          <div class="col-12">
            <div class="card connect-card">
              <div class="card-header">
                <div>Connect</div>
              </div>
              <div class="card-body">
                <ul>
                  <li>
                    <a href=""><i class="bi bi-journal-medical"></i>Directory</a>
                  </li>
                  <li>
                    <a href=""><i class="bi bi-person-video"></i>VC Room</a>
                  </li>
                  <li>
                    <a href=""><i class="bi bi-arrows-fullscreen"></i>Quick Connect</a>
                  </li>
                  <li>
                    <a href=""><i class="bi bi-calendar3"></i>Event</a>
                  </li>
                  <li>
                    <a href=""><i class="bi bi-person-rolodex"></i>My
                      Contacts/Group</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <!-- create todo-Modal -->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Todo</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('create.todo') }}" method="POST">
            @csrf
            <div class="d-flex flex-row mb-3" style="gap: 20px;">
              <div class="form-group" style="width: 48%;">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" id="exampleFormControlInput1" placeholder="add title">
              </div>
              <div class="form-group" style="width: 48%;">
                <label for="exampleFormControlInput2">Date</label>
                <input type="datetime-local" name="date" class="form-control" id="exampleFormControlInput2" placeholder="date">
              </div>
            </div>
            <div class="form-group">
              <label for="exampleFormControlTextarea1">Description</label>
              <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- edit todo modal -->
  <div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Todo</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('update.todo') }}" method="POST">
            @csrf
            <div class="d-flex flex-row mb-3" style="gap: 20px;">
              <div class="form-group" style="width: 48%;">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" id="todo_title" placeholder="add title">
              </div>
              <div class="form-group" style="width: 48%;">
                <label for="exampleFormControlInput2">Date</label>
                <input type="datetime-local" name="date" class="form-control" id="todo_date" placeholder="date">
              </div>
            </div>
            <div class="form-group">
              <label for="exampleFormControlTextarea1">Description</label>
              <textarea name="description" class="form-control" id="todo_description" rows="3"></textarea>
            </div>
            <input type="hidden" name="id" class="form-control" id="todo_id" placeholder="id">
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- create personal notes -->
  <div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Personal Note</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('create.pnotes') }}" method="POST">
            @csrf
            <div class="d-flex flex-row mb-3" style="gap: 20px;">
              <div class="form-group" style="width: 100%;">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" id="exampleFormControlInput1" placeholder="add title">
              </div>
            </div>
            <div class="form-group">
              <label for="exampleFormControlTextarea1">Description</label>
              <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- edit personal notes -->
  <div class="modal fade" id="exampleModalCenter3" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Personal Note</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('update.pnotes') }}" method="POST">
            @csrf
            <div class="d-flex flex-row mb-3" style="gap: 20px;">
              <div class="form-group" style="width: 100%;">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" id="notes_title" placeholder="add title">
              </div>
            </div>
            <div class="form-group">
              <label for="exampleFormControlTextarea1">Description</label>
              <textarea name="description" class="form-control" id="notes_description" rows="3"></textarea>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
            <input type="hidden" name="id" class="form-control" id="notes_id" placeholder="id">
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- show notice -->
  <div class="modal fade" id="noticeViewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Notice Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="d-flex flex-row mb-3" style="gap: 20px;">
            <div class="form-group" style="width: 100%;">
              <label for="title">Title</label>
              <p id="notice_title" class="form-control" style="background-color: #f8f9fa; border: none; padding-left: 10px;">Sample Title</p>
            </div>
          </div>
          <div class="form-group">
            <label for="exampleFormControlTextarea1">Description</label>
            <p id="notice_description" class="form-control" style="background-color: #f8f9fa; border: none; padding-left: 10px; min-height: 100px;">This is a sample description text to display.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end show notice -->
 
  <!-- Bootstrap JS -->
  @include('dashboard.dashboardScript')
  <script>
    let currentFontSize = 16; // Default font size in pixels

    function increaseFontSize() {
      currentFontSize += 2;
      document.body.style.fontSize = currentFontSize + 'px';
    }

    function decreaseFontSize() {
      currentFontSize -= 2;
      if (currentFontSize >= 10) { // Ensure font size doesn't get too small
        document.body.style.fontSize = currentFontSize + 'px';
      }
    }

    function resetFontSize() {
      currentFontSize = 16; // Default font size
      document.body.style.fontSize = currentFontSize + 'px';
    }
  </script>
</body>

</html>
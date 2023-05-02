<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('assets/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Exam Dashboard</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('assets/dist/img/user6-128x128.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{auth()->user()->name}}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>



      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">


          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                index
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            @can('access-admin')
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('faculity.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Faculity</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('department.index')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Department</p>
                  </a>
                </li>

              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('subject.index')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Subject</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('unapproved.index')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Professors Requests</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('approved.index')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Professors</p>
                  </a>
                </li>
              </ul>
              @endcan

              @can('access-professor')
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('chapter.index')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Chapter</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('exam.index')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Exams</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('QnA.index')}}" class="nav-link">
                    <i class="far fa-question-circle nav-icon"></i>
                    <p>Q&N</p>
                  </a>
                </li>
              </ul>
                  <ul class="nav nav-treeview">
                      <li class="nav-item">
                          <a href="{{route('mark.index')}}" class="nav-link">
                              <i class="fa fa-check mr-3"></i>
                              <p>Marks</p>
                          </a>
                      </li>
                  </ul>
              @endcan
              @can('access-student')

                  <ul class="nav nav-treeview">
                      <li class="nav-item">
                          <a href="{{route('test.index')}}" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Tests</p>
                          </a>
                      </li>
                  </ul>
              @endcan
          </li>
        </ul>

      </nav>


      <!-- /.sidebar-menu -->
    </div>

    <!-- /.sidebar -->
  </aside>

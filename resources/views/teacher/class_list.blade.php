<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>

    <link rel="stylesheet" href="{{asset('assets/css/sidebar-template.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/dashboard.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/page-content.css')}}">
</head>
<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">

            {{-- SIDEBAR --}}
            @include('components.teacher_sidebar')

            <!-- Main content area -->
            <div class="col p-0">
                <nav class="navbar navbar-expand-lg navbar-light custom-navbar">
                    <div class="container-fluid d-flex align-items-center">
                        <img src="{{asset('assets/images/logo.png')}}" alt="Logo" class="logo">
                        <p class="logo-name">EUC Grading System</p>
                        <div class="navbar-nav ms-auto">
                            <div class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user-circle profile-icon"></i> Profile
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                                    <li><a class="dropdown-item" href="teacher-profile.html">View Profile</a></li>
                                    <li><a class="dropdown-item" href="logout.html">Logout</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>

                <!-- Page content -->
                <div class="container-fluid page-content mt-3">
                    <br><br>

                    <div class="d-flex mb-3">
                        <h5>View Students</h5>

                        <div class="d-flex ms-auto">
                            <form action="/teacher/view/subjects/class_list/{{$class_id}}" method="GET">
                                <div class="search-container me-3">
                                    <input type="text" name="search" class="form-control" placeholder="Search Students..." id="searchInput">
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Table for viewing students -->
                    <div class="table-container">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Course</th>
                                    <th>Year</th>
                                    <th>Input Grade</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($students as $student)

                                <tr>
                                    <td>
                                        <div style="color: rgb(192, 27, 27); font-size: 0.85em;">{{$student->student_id}}</div>
                                        <div>{{$student->name}}</div>
                                    </td>
                                    <td>{{$student->course}}</td>
                                    <td>
                                        @if ($student->year == 0)
                                            Irregular
                                        @elseif ($student->year == 1)
                                            1st Year
                                        @elseif ($student->year == 2)
                                            2nd Year
                                        @elseif ($student->year == 3)
                                            3rd Year
                                        @elseif ($student->year == 4)
                                            4th Year
                                        @endif
                                    </td>
                                    <td><input type="text" class="form-control" style="width: 120px;" placeholder="Enter Grade" onblur="replaceGrade(this)"></td>
                                </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('sidebarCollapse').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('toggled');
        });

        function replaceGrade(input) {
            const grade = input.value.trim();
            if (grade) {
                input.parentElement.innerHTML = `<span>${grade}</span>`;
            }
        }
    </script>

</body>
</html>

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
            <div class="p-0 col">

                {{-- APPBAR --}}
                @include('components.teacher_appbar')

                <!-- Page content -->
                <div class="mt-3 container-fluid page-content">
                    <br><br>

                    <div class="mb-3 d-flex">
                        <h5>Class List </h5>

                        <div class="d-flex ms-auto">

                            <form action="/teacher/view/subjects" method="GET">
                                <div class="search-container me-3">
                                    <input type="text" name="search" class="form-control" placeholder="Search Subjects..."
                                        id="searchInput">
                                </div>
                            </form>

                        </div>
                    </div>

                    <!-- Table for managing subjects -->
                    <div class="table-container">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Section Code</th>
                                    <th>Subject</th>
                                    <th>Grade Status</th>
                                    <th>View Class List</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($classes as $class)

                                    <tr>
                                        <td>{{$class->section}}</td>
                                        <td>
                                            {{$class->subject_name}}
                                            <p class="subject-code" id="subjectCode"
                                                style="font-size: 0.8em; color: rgb(182, 26, 26);">{{$class->subject_code}} - {{$class->units}} units</p>
                                        </td>

                                        {{-- When there is no students with a score of 0, means everyone has been graded, thus being completed --}}
                                        @if ($class->ungraded_count <= 0)
                                        <td><span class="badge bg-success">Completed</span></td>
                                        @else
                                        <td><span class="badge bg-warning">Pending</span></td>
                                        @endif

                                        <td>
                                            {{-- <button class="btn btn-action"
                                                onclick="window.location.href='class-list.html';">
                                                <i class="fas fa-eye"></i>
                                            </button> --}}
                                            <a href="/teacher/view/subjects/class_list/{{$class->id}}" class="btn btn-action"><i class="fas fa-eye"></i></a>
                                        </td>
                                    </tr>

                                @endforeach

                                {{-- <tr>
                                    <td>LWRBB1-B</td>
                                    <td>
                                        Introduction to Computer Science
                                        <p class="subject-code" id="subjectCode"
                                            style="font-size: 0.8em; color: rgb(182, 26, 26);">GE101 - 3 units</p>
                                    </td>
                                    <td><span class="badge bg-warning">Pending</span></td>

                                    <td>
                                        <button class="btn btn-action"
                                            onclick="window.location.href='class-list.html';">
                                            <i class="fas fa-eye"></i>
                                        </button>

                                    </td>
                                </tr> --}}

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('sidebarCollapse').addEventListener('click', function () {
            document.getElementById('sidebar').classList.toggle('toggled');
        });
    </script>

</body>

</html>

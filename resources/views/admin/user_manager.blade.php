<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Dashboard - Manage Admins</title>
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
            @include('components.admin_sidebar')

            <!-- Main content area -->
            <div class="col p-0">

                {{-- APPBAR --}}
                @include('components.admin_appbar')

                {{-- POPUP --}}
                @include('components.popup-condition')

                <!-- Page content -->
                <div class="container-fluid page-content mt-3">
                    <br><br>

                    <div class="d-flex mb-3">
                        <h5>Manage Users</h5>

                        <div class="d-flex ms-auto">
                            <form method="GET">
                                <div class="search-container me-3">
                                    <input type="text" name="search" class="form-control" placeholder="Search Admins..." id="searchInput">
                                </div>
                            </form>
                            <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#addAdminModal">
                                <i class="fas fa-user-plus"></i> Add Admins
                            </button>
                        </div>
                    </div>

                    {{-- ADD MODAL --}}
                    @include('components.user_manager.add-modal')

                    <!-- Table for managing admins -->
                    <div class="table-container">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($admins as $admin)
                                    <tr>
                                        <td>{{$admin->name}}</td>
                                        <td>{{$admin->email}}</td>
                                        <td>Admin</td>
                                        <td>
                                            <button class="btn btn-action" data-id="{{$admin->id}}" data-name="{{$admin->name}}" data-email="{{$admin->email}}" data-bs-toggle="modal" data-bs-target="#editAdminModal"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-action" data-id="{{$admin->id}}" data-bs-toggle="modal" data-bs-target="#deleteAdminModal"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- EDIT MODAL --}}
    @include('components.user_manager.edit-modal')

    {{-- DELETE MODAL --}}
    @include('components.user_manager.delete-modal')

    <script>
        var deleteUserModalBtn = document.querySelector('#deleteUserModalBtn');
        var deleteButtons = document.querySelectorAll('[data-bs-target="#deleteAdminModal"]');
        var editButtons = document.querySelectorAll('[data-bs-target="#editAdminModal"]');
        var editForm = document.querySelector('#editForm');

        editButtons.forEach(function (button) {
            button.addEventListener('click',function () {
                var id = button.getAttribute('data-id');
                var name = button.getAttribute('data-name');
                var email = button.getAttribute('data-email');

                // alert(`${id} - ${name} - ${email}`);

                document.getElementById('editAdminName').value = name;
                document.getElementById('editAdminEmail').value = email;
                editForm.setAttribute('action','/admin/manager/edit/user/' + id);
            });
        });

        deleteButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                var id = button.getAttribute('data-id');

                // alert(id);
                deleteUserModalBtn.setAttribute('href','/admin/manager/delete/user/' + id);
            });
        });

        document.getElementById('sidebarCollapse').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('toggled');
        });

        function showPassword(inputId) {
            var password = document.getElementById(inputId);

            if(password.type == 'password') {
                password.type = 'text';
            } else if(password.type == 'text') {
                password.type = 'password'
            }
        }

        const toastSuccess = new bootstrap.Toast(document.getElementById('toastSuccess'));
        toastSuccess.show();
    </script>

</body>
</html>

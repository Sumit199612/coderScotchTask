<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coder Scotch Add Users</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js"></script>
    <style>
        .user-field {
            margin-bottom: 1rem;
        }
    </style>
</head>

<body class="bg-light p-5">

    <div class="container">
        <h1 class="text-center mb-4">Coder Scotch Test</h1>
        <div class="card">
            <div class="card card-body">
                <div class="card card-primary p-2">
                    <div class="card card-header mb-2">
                        <h1>Add Users To Start Tournament</h1>
                    </div>
                    <form id="userForm" action="{{ route('start-tournament') }}" method="POST"
                        onsubmit="return validateForm()">
                        {{ csrf_field() }}
                        <div data-repeater-list="userFields">
                            <div class="user-field" data-repeater-item>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <input type="text" name="name" placeholder="Name" class="form-control"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <input type="email" name="email" placeholder="Email"
                                                class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-2" style="margin-top: 5px;">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-danger btn-sm inner"
                                                data-repeater-delete>X</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" data-repeater-create class="btn btn-primary mt-3">Add Another
                            User</button>
                        <button type="submit" class="btn btn-success mt-3">Start Tournament</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#userForm').repeater({
                initEmpty: false,
                isFirstItemUndeletable: true,
                show: function() {
                    $(this).slideDown();
                },
                hide: function(e) {
                    if (confirm('Are you sure you want to delete this element?')) {
                        $(this).slideUp(e);
                    }
                }
            });
            // Attach validation to the submit button
            $('.btn-success').click(function(e) {
                const userFieldsCount = $('[data-repeater-item]').length; // Count the number of user fields
                if (userFieldsCount < 2) {
                    e.preventDefault(); // Prevent form submission
                    alert('At least two users are required to start the tournament.');
                }
            });
        });
    </script>

</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tournament Details And Result</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
                        <h1>Tournament Groups</h1>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Group Name</th>
                                    <th scope="col">Users</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($groupDetails as $groupData)
                                    <tr>
                                        <td>{{ $groupData['group_name'] }}</td>
                                        <td>
                                            <table class="table table-sm">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($groupData['users'] as $user)
                                                        <tr>
                                                            <td>{{ $user['name'] }}</td>
                                                            <td>{{ $user['email'] }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <h1>Final Winner : {{ $finalWinner['name'] }}</h1>
                        </table>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger mt-3">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success mt-3">{{ session('success') }}</div>
                    @endif
                </div>

                <div class="card card-primary p-2">
                    <div class="card card-header mb-2">
                        <h1>Round Details</h1>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Rounds No.</th>
                                    <th scope="col">Winners</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roundDetails as $roundData)
                                    <?php $roundWinners = implode(" | ",$roundData['roundWinners']) ?>
                                    <tr>
                                        <td>{{ $roundData['roundNumber'] }}</td>
                                        <td>
                                            <table class="table table-sm">
                                                <thead>
                                                    <tr>
                                                        <th>Player Name</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>{{ $roundWinners }}</td>

                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <h1>Final Winner : {{ $finalWinner['name'] }}</h1>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

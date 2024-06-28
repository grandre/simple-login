<!DOCTYPE html>
<html lang="en">

<head>
    <title>Users page</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>

    <div>
        <table class="table table-dark">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Street</th>
                    <th scope="col">neighborhood</th>
                    <th scope="col">number</th>
                    <th scope="col">city</th>
                    <th scope="col">state</th>
                    <th scope="col">postal_code</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{$user->name}} </td>
                    <td>{{$user->email}} </td>
                    <td>{{$user->address->street}} </td>
                    <td>{{$user->address->neighborhood}} </td>
                    <td>{{$user->address->number}} </td>
                    <td>{{$user->address->city}} </td>
                    <td>{{$user->address->estate}} </td>
                    <td>{{$user->address->postal_code}} </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
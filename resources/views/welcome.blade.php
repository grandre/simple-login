<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login page</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <form name="formLogin">
        @csrf
        <div class="form-group">
            <label for="name">Email:</label>
            <input type="email" class="form-control" required id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <button type="button" class="btn btn-primary" onclick="window.location.href = '{{ route("register") }}'">Register</button>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>

    <script>
        $(function() {
            $('form[name="formLogin"]').submit(function(event) {
                event.preventDefault();

                $.ajax({
                    url: "{{ route('auth.login') }}",
                    type: "post",
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.success === true) {

                            localStorage.setItem('token', response.accessToken);
                            window.location.href = "{{ route('users') }}";
                        } else {
                            $('.messageBox').removeClass('d-none').html(response.message);
                        }
                    },
                    headers: {
                        "Accept": "application/json",
                        "Authorization": "Bearer " + localStorage.getItem('token')
                    }
                });
            });
        });
    </script>
</body>

</html>
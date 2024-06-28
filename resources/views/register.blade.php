<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register page</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <form name="formLogin">
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" required id="name" name="name" placeholder="Enter name">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" required id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Confirm Password</label>
            <input type="password" name="c_password" class="form-control" id="c_password" placeholder="Password">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Street</label>
            <input type="text" name="street" class="form-control" id="street" placeholder="street">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">neighborhood</label>
            <input type="text" name="neighborhood" class="form-control" id="neighborhood" placeholder="neighborhood">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">number</label>
            <input type="text" name="number" class="form-control" placeholder="number">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">city</label>
            <input type="text" name="city" class="form-control" id="city" placeholder="city">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">state</label>
            <input type="text" name="estate" class="form-control" id="estate" placeholder="state">
        </div>
        <div class="form-group">
            <label for="cep">postal code:</label>
            <input type="text" class="form-control" name="postal_code" id="cep" placeholder="Enter postal code">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <form name="formCep">
        @csrf

        <div class="form-group">
            <label for="cep">Search with your cep!</label>
            <input type="text" class="form-control" name="postal_code" id="cep" placeholder="Enter postal code">
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>

    <script>
        $(function() {
            $('form[name="formLogin"]').submit(function(event) {
                event.preventDefault();

                $.ajax({
                    url: "{{ route('auth.register') }}",
                    type: "post",
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.success === true) {
                            $('.messageBox').removeClass('d-none').html(response.message);
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

            $('form[name="formCep"]').submit(function(event) {
                event.preventDefault();
                var cep = $(this).find('input#cep').val();
                $.ajax({
                    url: "{{ route('cep') }}",
                    type: "get",
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.success === true) {
                            $('#street').val(response.result.logradouro);
                            $('#neighborhood').val(response.result.bairro);
                            $('#city').val(response.result.cidade);
                            $('#estate').val(response.result.uf);
                            $('#cep').val(cep);
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
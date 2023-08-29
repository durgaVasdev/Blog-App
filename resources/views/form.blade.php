<!DOCTYPE html>
<html>
<head>
    <title>Laravel 8 Ajax Validation Example - ItSolutionStuff.com</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
</head>
<body>
       
<div class="container">
    <h2>Laravel 8 Ajax Validation - ItSolutionStuff.com</h2>
       
    <div class="alert alert-danger print-error-msg" style="display:none">
        <ul></ul>
    </div>
       
    <!--<form>
        {{ csrf_field() }}
        <div class="form-group">
            <label>First Name:</label>
            <input type="text" name="first_name" class="form-control" placeholder="First Name">
        </div>
       
        <div class="form-group">
            <label>Last Name:</label>
            <input type="text" name="last_name" class="form-control" placeholder="Last Name">
        </div>
        <div class="form-group">
            <strong>Email:</strong>
            <input type="text" name="email" class="form-control" placeholder="Email">
        </div>
       
        <div class="form-group">
            <strong>Address:</strong>
            <textarea class="form-control" name="address" placeholder="Address"></textarea>
        </div>
       
        <div class="form-group">
            <button class="btn btn-success btn-submit">Submit</button>
        </div>
    </form>
</div>
       
<script type="text/javascript">
       
    $(document).ready(function() {
        $(".btn-submit").click(function(e){
            e.preventDefault();
       
            var _token = $("input[name='_token']").val();
            var first_name = $("input[name='first_name']").val();
            var last_name = $("input[name='last_name']").val();
            var email = $("input[name='email']").val();
            var address = $("textarea[name='address']").val();
            $.ajax({
                url: "{{ route('') }}",
                type:'POST',
                data: {_token:_token, first_name:first_name, last_name:last_name, email:email, address:address},
                success: function(data) {
                    if($.isEmptyObject(data.error)){
                        alert(data.success);
                    }else{
                        printErrorMsg(data.error);
                    }
                }
            });
       
        }); 
       
        function printErrorMsg (msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display','block');
            $.each( msg, function( key, value ) {
                $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
            });
        }
    });


</script>-->

<form id="myForm">
    @csrf
    <input type="text" name="name" id="name">
    <!-- Other form fields -->
    <button type="submit">Submit</button>
</form>
<div id="validation-errors"></div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#myForm').submit(function(e) {
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: '{{ route('validate.form') }}', // Replace with your route
                data: $(this).serialize(),
                success: function(response) {
                    // Handle successful validation
                    $('#validation-errors').html('');
                },
                error: function(response) {
                    // Handle validation errors
                    var errors = response.responseJSON.errors;
                    $('#validation-errors').empty().append('<ul>');
                    for (var key in errors) {
                        $('#validation-errors ul').append('<li>' + errors[key][0] + '</li>');
                    }
                    $('#validation-errors').append('</ul>');
                }
            });
        });
    });
</script>


</body>
</html>
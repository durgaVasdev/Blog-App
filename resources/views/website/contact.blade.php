<!--<h3>This is Contact_Page</h3>-->
<!--<h3>This is Web_Home_Page</h3>-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @section('title','Contact Page')
</head>
<body>
   @extends('components.header')

@section('content')
   <div class="row" style="margin-top:100px; margin-bottom: 150px;">
    <div class="col-md-3" style="margin-top:75px; margin-left:250px;">
    <h3>Contact us</h3>
    <p>
    Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia,
    </p>
    </div>
    <div class="col-md-4">
        
    <form>
        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" placeholder="Enter Email">
        </div>
        <div class="form-group">
        <label>Mobile:</label>
            <input type="text" name="mobile" class="form-control" placeholder="Enter Mobile">
        </div>
        <div class="form-group">
        <label>Message:</label>
            <textarea class="form>-control" rows="4" cols="75" placeholder="Type message..."></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>
   </div>
 @endsection
</body>
</html>
<!--<h3>This is Web_Home_Page</h3>-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @section('title','Home Page')
</head>
<body>
   @extends('components.header')

@section('content')
   
<div class="row" style="margin:50px;">
<div class="col-md-3" style="margin:50px;">
    <img src="{{ asset ('images/person1.jpg') }}" class="img-thumbnail" height="300px" width="300px">
</div>

<div class="col-md-6">
    <p>
        <h3>Hii there !</h3>
        Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.
    </p>
</div>
</div>

<div class="row">
    <div class="col-md-6" style="margin:50px">
    <p>
        <h3>My career so far  !</h3>
        Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.
    </p>
    </div>
    <div class="col-md-3"
    ><br><br>
    <img src="{{ asset ('images/person4.jpg') }}" style="height:250px" width="250px">
        </div>

</div>
<br>
<center><h3><u>Out team members</u></h3></center>

<div class="row" style="margin:50px">
    <div class="col-md-3">
    <img src="{{ asset ('images/person1.jpg') }}" class="rounded-circle">
    </div>
    <div class="col-md-3">
    <img src="{{ asset ('images/person2.jpg') }}" class="rounded-circle">
    </div>
    <div class="col-md-3">
    <img src="{{ asset ('images/person1.jpg') }}" class="rounded-circle">
    </div>
    <div class="col-md-3">
    <img src="{{ asset ('images/person2.jpg') }}" class="rounded-circle">
    </div>
</div>
 @endsection
</body>
</html>
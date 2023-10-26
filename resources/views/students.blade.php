<!DOCTYPE html>
<html>
<head>
    <title>Laravel 8 Datatables Tutorial - ItSolutionStuff.com</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.10/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.10/js/jquery.dataTables.min.js"></script>
</head>
<body>



  {{--  <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" id="name" name="name">
    </div>
    
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="text" class="form-control" id="email" name="email">
    </div>
    
    <button id="filter" class="btn btn-primary">Apply Filters</button>--}}
    
<div class="container">
    <h1>Laravel Datatables <br/></h1>
  {{--  <form>
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" id="name" name="name">
    </div>
    
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="text" class="form-control" id="email" name="email">
    </div>
    </form>--}}


   {{--<div class="mb-3">
        <form id="search-form">
            <div class="form-group">
                <label for="searchName">Name:</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="form-group">
                <label for="searchEmail">Email:</label>
                <input type="text" class="form-control" id="email" name="email">
            </div>
            <button type="button" class="btn btn-primary" id="search-button">Search</button>
        </form>
    </div>--}}

    <form>
        
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" id="name" placeholder="Enter Name" >
    

        <label for="email">Email:</label>
        <input type="text" id="email" name="email" id="email" placeholder="Enter Email">

        <button type="button"  id="search-button">Search</button>

       {{-- <button id="search-form" type="submit">Search</button>--}}
    </form>
    
    <table id="students-table"  class="table table-bordered data-table">
            <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>

            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
   
</body>
   
<script type="text/javascript">
  
  $(document).ready(function() {
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('users.index') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });
});
</script>
</html>
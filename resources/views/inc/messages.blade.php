<!-- if the amount of errors is greater than 0, serve error msg -->
@if(count($errors) > 0)
    <!-- loop each error, assign each one to a single error -->
    @foreach($errors->all() as $error)
        <div class="alert alert-danger">
            {{$error}}
        </div>
    @endforeach

@endif

@if(session('success'))
    <div class="alert alert-success">
        {{session('success')}}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{session('error')}}
    </div>
@endif
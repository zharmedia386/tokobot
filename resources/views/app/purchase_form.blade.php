@extends('layouts.master-1')
@section('title', 'Purchase Invoice')
@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between">
        <div class="header-title">
            <h4 class="card-title">Input</h4>
        </div>
    </div>
    <div class="card-body">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vulputate, ex ac venenatis mollis, diam nibh finibus leo</p>
        <form>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Input Text </label>
                <input type="text" class="form-control" id="exampleInputText1" value="Mark Jhon" placeholder="Enter Name" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputEmail3">Email Input</label>
                <input type="email" class="form-control" id="exampleInputEmail3" value="markjhon@gmail.com" placeholder="Enter Email" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputurl">Url Input</label>
                <input type="url" class="form-control" id="exampleInputurl" value="https://getbootstrap.com" placeholder="Enter Url" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputphone">Teliphone Input</label>
                <input type="tel" class="form-control" id="exampleInputphone" value="1-(555)-555-5555" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputNumber1">Number Input</label>
                <input type="number" class="form-control" id="exampleInputNumber1" value="2356" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputPassword3">Password Input</label>
                <input type="password" class="form-control" id="exampleInputPassword3" value="markjhon123" placeholder="Enter Password" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputdate">Date Input</label>
                <input type="date" class="form-control" id="exampleInputdate" value="2019-12-18" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputmonth">Month Input</label>
                <input type="month" class="form-control" id="exampleInputmonth" value="2019-12" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputweek">Week Input</label>
                <input type="week" class="form-control" id="exampleInputweek" value="2019-W46" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputtime">Time Input</label>
                <input type="time" class="form-control" id="exampleInputtime" value="13:45" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputdatetime">Date and Time Input</label>
                <input type="datetime-local" class="form-control" id="exampleInputdatetime" value="2019-12-19T13:45:00" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleFormControlTextarea1">Example textarea</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="5"></textarea>
            </div>
            <button type="submit" class="btn btn-primary rounded">Submit</button>
            <button type="submit" class="btn btn-danger rounded">cancel</button>
        </form>
    </div>
</div>


@endsection
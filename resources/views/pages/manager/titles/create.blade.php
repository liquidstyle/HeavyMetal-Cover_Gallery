@extends('layouts.manager')

@section('content')
    <div class="container">
        <h3>New Title</h3>
    </div>
    <form action="/manager/titles" method="post" class="col-md-12">
    @csrf

    <input type="hidden" name="active" value="0">
        <div class="form-group row col-md-5">
            <label for="status"><strong>Status</strong></label>
            <select name="status" class="form-control">
                <option value="Draft">Draft</option>
                <option value="Needs Review">Needs Review</option>
                <option value="Pending">Pending</option>
                <option value="Published">Published</option>
            </select>
        </div>

        <div class="form-group row col-md-5">
            <label for="type"><strong>Cover Type</strong></label>
            <select name="type" class="form-control">
                <option value="Magazine">Magazine</option>
                <option value="Comic">Comic Book</option>
                <option value="Book">Book</option>
                <option value="Graphic Novel">Graphic Novel</option>
                <option value="Poster">Poster</option>
                <option value="Toy">Toy</option>
                <option value="Trading Card">Trading Card</option>
            </select>
        </div>

        <hr>

        <div class="form-group row col-md-5">
            <label for="name"><strong>Name</strong></label>
            <input type="text" name="name" value="Cover {{ date("YmdHis") }}" class="form-control">
        </div>

        <div class="form-group row col-md-5">
            <label for="special_issue"><strong>Special Issue</strong></label>
            <input type="text" name="special_issue" value="my special issue" class="form-control">
        </div>

        <div class="form-group row col-md-5">
            <label for="month_year"><strong>Published Date</strong></label>
            <div class="col-md-5">
                <select name="month" class="form-control">
                    <option value="{{date("m")}}">{{date("M")}}</option>
                </select>
                <select name="year" class="form-control">
                    <option value="{{date("Y")}}">{{date("Y")}}</option>
                </select>
            </div>
        </div>
        
        <hr>
        
        <div class="form-group row col-md-8">
            <label for="description"><strong>Description</strong></label>
            <textarea name="description" class="form-control" style="height:150px;">This is my test description</textarea>
        </div>

        <hr>
        
        <h4>Covers</h4>

        <div class="form-group row col-md-5">
                <label for="cover_variant"><strong>Cover Variant</strong></label>
                <select name="cover_variant" class="form-control">
                    <option value="a">A</option>
                    <option value="b">B</option>
                    <option value="c">C</option>
                    <option value="d">D</option>
                    <option value="e">E</option>
                </select>
            </div>

        <div class="form-group row col-md-5">
            <label for="front_cover_name"><strong>Front Cover Name</strong></label>
            <input type="text" name="front_cover_name" value="Wicked Cover" class="form-control">
        </div>

        <div class="form-group row col-md-5">
            <label for="front_cover_authors"><strong>Front Cover Authors</strong></label>
            <select name="front_cover_authors[]" class="form-control" MULTIPLE>
                <option value="{{ time() }}" SELECTED>front author {{ date("MY") }}</option>
                <option value="{{ time() }}" SELECTED>front author2 {{ date("MY") }}</option>
            </select>
        </div>
        <div class="form-group row col-md-5">
            <label for="back_cover_name"><strong>Back Cover Name</strong></label>
            <input type="text" name="back_cover_name" value="Wicked Back Cover" class="form-control">
        </div>

        <div class="form-group row col-md-5">
            <label for="back_cover_authors"><strong>Back Cover Authors</strong></label>
            <select name="back_cover_authors[]" class="form-control" MULTIPLE>
                <option value="{{ time() }}" SELECTED>back author {{ date("MY") }}</option>
                <option value="{{ time() }}" SELECTED>back author2 {{ date("MY") }}</option>
            </select>
        </div>

        <div class="form-group row col-md-5">
            <label for="signed_by"><strong>Signed By</strong></label>
            <select name="signed_by[]" class="form-control" MULTIPLE>
                <option value="{{ time() }}" SELECTED>signed person {{ date("MY") }}</option>
                <option value="{{ time() }}" SELECTED>signed person2 {{ date("MY") }}</option>
            </select>
        </div>
            
        <div class="form-group ">
            <button class="btn btn-success">Add Title</button>
            &nbsp;<a href="/manager/titles" style="color:red;">reset</a>
        </div>

    </form>
@endsection

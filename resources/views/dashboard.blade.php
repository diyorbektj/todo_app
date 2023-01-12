@extends('layout')

@section('content')
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
{{--            <form action="{{ route('todo.create') }}" method="POST" id="handleAjax">--}}

{{--                @csrf--}}



{{--                <div id="errors-list"></div>--}}
{{--            <div style="display: flex;align-items: center;">--}}
{{--                    <input name="todo" id="todo" type="text" class="form-control w-100" placeholder="ToDo">--}}
{{--                    <button type="submit" class="btn btn-primary">+</button>--}}
{{--            </div>--}}
{{--            </form>--}}
            <div class="mt-4" style="display: flex; justify-content: space-between">
                <div style="font-size: 35px;">
                    ToDo
                </div>
                <div>
                    <a class="btn btn-success" href="javascript:void(0)" id="filterTodo">
                        <svg class="text-white" style="width: 25px" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z" />
                        </svg>

                    </a>
                    <a class="btn btn-primary" href="javascript:void(0)" id="createNewTodo">
                        +

                    </a>
                </div>
            </div>
            <div class="m-3"></div>
            @foreach($todo as $item)
                <div class="card mt-2">
                    <div class="p-2" style="height: auto; display: flex; justify-content: space-between">
                        <div style="display:flex; justify-content: space-between">
                            @if($item->image)
                                <p class=""><img src="{{$item->image}}"></p>
                            @endif
                            <p style="font-size: 16px;padding-left: 10px">{{ $item->todo  }}</p>
                        </div>
                        <div>
                        @foreach($item->tags as $tag)
                            <p class="btn btn-light">{{$tag->tag}}</p>
                            @endforeach
                            <a href="/delete/{{$item->id}}" class="btn btn-danger ml-4"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="20">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
            <div id="todolist"></div>
        </div>
    </div>
    <div class="modal fade" id="ajaxModel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('todo.create') }}" method="POST" id="handleAjax" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Todo</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="todo" name="todo" placeholder="Enter Name" value="" maxlength="50" required="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="image" class="col-sm-2 control-label">Image</label>
                            <div class="col-sm-12">
                                <input type="file" class="form-control" id="image" name="image" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Tags</label>
                            <div class="col-sm-12">
                                <div id="test">
                                    <div class='m-3'><input type='text' class='form-control' id='tags[]' name='tags[]' placeholder='Tag' value='' required=''> </div>
                                </div>
                                <a href="#" id="addtag" class="btn btn-danger">+</a>
                            </div>
                        </div>

                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary">Save changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="ajaxModelFilter" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeadingFilter"></h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('dashboard') }}" method="GET" id="handleAjaxFilter">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Todo</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="todo" name="todo" placeholder="Enter Name">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Tag</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="tag" name="tag" placeholder="Enter Tag" value="" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Limit</label>
                            <div class="col-sm-12">
                                <input type="number" class="form-control" id="limit" name="limit" placeholder="Limit" >
                            </div>
                        </div>

                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary">Save changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">



            $(function() {
                $('#createNewTodo').click(function () {
                    $('#saveBtn').val("create-product");
                    $('#productForm').trigger("reset");
                    $('#modelHeading').html("Create New Todo");
                    $('#ajaxModel').modal('show');
                });
                $('#filterTodo').click(function () {
                    $('#productForm').trigger("reset");
                    $('#modelHeadingFilter').html("Filter Todo");
                    $('#ajaxModelFilter').modal('show');
                });
                $(document).ready(function(){
                    $("#addtag").click(function(){
                        $("#test").append("<div class='m-3'>" +
                        "<input type='text' class='form-control' id='tags[]' name='tags[]' placeholder='Tag' value='' required=''> </div>");
                    });
                });
                $(document).on("submit", "#handleAjaxFilter", function() {
                    var e = this;

                    $.ajax({

                        url: $(this).attr('action'),

                        data: $(this).serialize(),

                        type: "GET",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',

                        success: function (data) {

                            $(e).find("[type='submit']").html("Submitting");}
                    })})



                $('#handleAjax').on('submit', function(event){
                    event.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: new FormData(this),
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        $(this).find("[type='submit']").html("Submitting");

                        if (data) {
                            $(this).find("[type='submit']").html("+");
                            $("#todolist").append('<div class="card mt-2">'+
                            '<div class="p-2" style="height: auto; display: flex; justify-content: space-between">'+
                                '<p style="font-size: 16px;">'+ data.todo + '</p>'+
                            '<div class="w-25">'+
                                '<p class="btn btn-light">'+data.tags[0].tag ?? null+'</p>'+
                            '</div></div> </div>');

                        }else{

                            $(".alert").remove();

                            $.each(data.errors, function (key, val) {

                                $("#errors-list").append("<div class='alert alert-danger'>" + val + "</div>");

                            });

                        }



                    }

                });



                return false;

            })})
    </script>
@endsection

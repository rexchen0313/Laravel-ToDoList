@extends('layouts.todolist')

@section('script')
<script>
  $(function(){
    $('#send').click(function(){
      $.ajax({
        url: '/api/todo',
        type: 'POST',
        dataType: 'json',
        contentType : 'application/x-www-form-urlencoded;charset=utf-8',
        data: {
          'title': $('#todo-title').val(),
          'content': $('#todo-content').val()
        },
        success : function(result) {
          location.href = '/';
        },
        error : function(result) {
          console.log(result.responseText);
          let errors = JSON.parse(result.responseText).errors
          if(errors.title.length > 0) {
            $('#error-title').text(errors.title[0]);
          }
        }
      });
    });
  });
</script>
@endsection

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <!-- <div class="panel-heading">Add task</div> -->
        <div class="panel-body">
          <form>
            <div class="form-group">
              <label for="todo-title">Title</label>
              <br><span id="error-title" class="text-danger"></span>
              <input id="todo-title" class="form-control form-control-lg" type="text" placeholder="Please Type Something Here...">
            </div>
            <div class="form-group">
              <label for="todo-content">Content</label>
              <textarea id="todo-content" class="form-control" rows="12"></textarea>
            </div>
            <button id="send" type="button" class="btn btn-info btn-lg btn-block">新增</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
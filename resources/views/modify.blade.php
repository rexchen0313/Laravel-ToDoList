@extends('layouts.todolist')

@section('script')
<script>
  function nl2br (str, is_xhtml) {   
      var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';    
      return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1'+ breakTag +'$2');
  }
  let id = {{ $id }};
  $(function(){
    $.getJSON(`/api/todo/${id}`, function(data){ // 載入時，取得原本資料 
      console.log(data.title);
      $("#todo-title").val(data.title);
      let content = data.content === null ? '' : data.content;
      $("#todo-content").text(nl2br(content));
    });

    $('#send').click(function(){ // 發送更改
      $.ajax({
        url: `/api/todo/${id}`,
        type: 'PATCH',
        dataType: 'json',
        contentType : 'application/x-www-form-urlencoded;charset=utf-8',
        data: {
          'title': $('#todo-title').val(),
          'content': $('#todo-content').val()
        },
        success : function(result) {
          console.log(result);
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
        <!-- <div class="panel-heading">modify task</div> -->
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
            <button id="send" type="button" class="btn btn-info btn-lg btn-block">修改</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
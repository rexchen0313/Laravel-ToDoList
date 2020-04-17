@extends('layouts.todolist')

@section('script')
<script>
  function nl2br (str, is_xhtml) {   
      var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';    
      return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1'+ breakTag +'$2');
  }
  let id = {{ $id }};
  $(function(){
    $.getJSON(`/api/todo/${id}`, function(data){ // 載入時，透過API取得資料
      console.log(data);
      $("#title").text(data.title);
      $("#datetime").text(data.updated_at);
      let content = data.content === null ? '' : data.content;
      $("#content").append(nl2br(content));
    });

    $(".btn-delete").click(function(){ // 刪除任務
      if (confirm('Do you want to delete ?')) {
        $.ajax({
          url: `/api/todo/${id}`,
          type: 'delete',
          dataType: 'json',
          contentType : 'application/x-www-form-urlencoded;charset=utf-8',
          success : function(result) {
            location.href = '/';
          },
          error : function(result) {
            console.log(result.responseText);
          }
        });
      }
    });
  });
</script>
@endsection

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">
          <div id="title" class="h1"></div>
          <div id="datetime"></div>
        </div>
        <div class="panel-heading">
          <a class="btn btn-primary" href="/modify/{{ $id }}">Edit task</a>
          <button class="btn btn-danger btn-delete">Delete task</button>
        </div>
        <div id="content" class="panel-body"></div>
      </div>
    </div>
  </div>
</div>
@endsection
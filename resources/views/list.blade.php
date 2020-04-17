@extends('layouts.todolist')

@section('script')
<script>
  function getQueryParams() {
    let url = new URL(location.href);
    let params = url.searchParams;
    let query = {};
    for(let pair of params.entries()) {
      query[pair[0]] = pair[1];
    }
    return query;
  }
  let query = getQueryParams();
  let count = 0;
  let isLastPage;
  let page = '';
  if(query.page !== undefined) {
    page = `?page=${query.page}`;
  }
  $(function(){
    $.getJSON(`/api/todo${page}`, function(res){
      count = res.data.length;
      for (let index in res.data) {
        let obj = res.data[index];
        $('#list').append(
          `<tr>
            <td><a href="/task/${obj.id}">${obj.title}</a></td>
            <td>${obj.updated_at}</td>
            <td>
              <button class="btn btn-danger btn-sm btn-delete" data-id="${obj.id}">Delete task</button>
            </td>
          </tr>`
        );
      }
      if (res.prev_page_url === null) {
        $('#btn-previous').hide();
      } else {
        $('#btn-previous').attr('href', res.prev_page_url.replace('/api/todo', ''));
      }
      isLastPage = res.next_page_url === null;
      if (res.next_page_url === null) {
        $('#btn-next').hide();
      } else {
        $('#btn-next').attr('href', res.next_page_url.replace('/api/todo', ''));
      }
    });
    $(document).on('click', '.btn-delete', function(e) { // 動態生成的HTML元素，需透過on才能綁定事件
      if (confirm('Do you want to delete ?')) {
        let id = e.target.dataset.id;
        $.ajax({
          url: `/api/todo/${id}`,
          type: 'delete',
          dataType: 'json',
          contentType : 'application/x-www-form-urlencoded;charset=utf-8',
          success: function(result) {
            console.log(result);
            if(isLastPage && count -1 < 1 && query.page > 1) {
              let newPage = '';
              if(query.page !== undefined) {
                newPage = `?page=${query.page - 1}`;
              }
              location.href = location.href.replace(page, newPage);
            } else {
              window.location.reload();
            }
          },
          error: function(result) {
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
        <div class="panel-heading">Tasks List</div>
        <div class="panel-body">
          <table class="table">
            <thead >
              <tr>
                <th>title</th>
                <th>datetime</th>
                <th>-</th>
              </tr>
            </thead>
            <tbody id="list">
            </tbody>
          </table>
          <a id="btn-previous" class="btn btn-primary" href="">Previous</a>
          <a id="btn-next" class="btn btn-primary" href="">Next</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
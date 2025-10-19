<!doctype html>
<html>
<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Todos - jQuery AJAX</title>
  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
 


</head>
<body>
  <h1>Todos (jQuery + AJAX)</h1>

  <form id="todoForm">
    <input type="text" name="title" id="title" placeholder="New todo">
    <button type="submit">Add</button>
  </form>

  <ul id="todoList">
    @foreach($todos as $t)
      <li data-id="{{ $t->id }}">{{ $t->title }}</li>
    @endforeach
  </ul>
  
  <script>
   
    $.ajaxSetup({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    $('#todoForm').on('submit', function(e) {
      e.preventDefault();
      let title = $('#title').val();
      $.ajax({
        url: "{{ route('todos.store') }}",
        method: 'POST',
        data: { title },
        success: function(response) {
          if(response.success){
           
            $('#todoList').prepend('<li data-id="'+response.todo.id+'">'+response.todo.title+'</li>');
            $('#title').val('');
          }
        },
        error: function(xhr) {
    
          if(xhr.status === 422) {
            let errors = xhr.responseJSON.errors;
            alert(Object.values(errors).map(e => e.join(", ")).join("\n"));
          } else {
            alert('Something went wrong');
          }
        }
      });
    });

       
  </script>





</body>
</html>

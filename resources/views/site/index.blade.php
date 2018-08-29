@extends('layouts.app')
@section('content')
<table class="table" id="datatable">
    <thead>
        <tr>
            <td>ID</td>
            <td>Título</td>
            <td>Categoria</td>
            <td>Preço</td>
            <td>Quantidade</td>
        </tr>
    </thead>
</table>

<script>
    init.push(function(){
       let url = 'api\\'+{!! route('products.index') !!}
       $('#datatable').DataTable({
           processing: true,
           serverSide: true,
           searching : false,
           bLengthChange: false,
           ajax: url,
           columns: [
               {data: 'log_name'},
               {data: 'causer_id'},
               {data: 'created_at'},
               {data: 'description'}
           ],
       });
    });
</script>

@endsection
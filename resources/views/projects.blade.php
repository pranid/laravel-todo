@extends('layouts.app')

@section('content')
    <form action="#" class="form-horizontal" id="save-form">
        <div class="form-group">
            <label for="" class="col-sm-2 control-label">Project Name</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="name_aa">
                <span class="error-msg"></span>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-6">
                {{ csrf_field() }}
                {{ method_field('POST') }}
                <button type="submit" class="btn btn-primary pull-right">Submit</button>
            </div>
        </div>

    </form>
    <script type="text/javascript">
        $(function () {
            $('#save-form').submit(function (e) {
                e.preventDefault();
                $.ajax({
                    url: '{{ url("project") }}',
                    dataType: 'json',
                    data:$(this).serializeArray(),
                    type:'POST',
                    success:function(res) {
                        console.log(res);
                    },
                    error:function(res) {
                        console.log(res);
                    }
                });
            });
        });
    </script>
@endsection
@extends('layouts.app')

@section('content')
    {{-- ADD NEW TASK FORM --}}
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Add New Task
                </div>
                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    <!-- New Task Form -->
                    <form action="{{ url('/task') }}" method="POST" class="form-horizontal">

                    {{ csrf_field() }}
                    {{ method_field('POST') }}

                    <!-- Task Name -->
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="task" class="col-sm-3 control-label">Task</label>

                            <div class="col-sm-6">
                                <input type="text" name="name" id="task-name" class="form-control">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Add Task Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-primary pull-right">
                                    <i class="fa fa-plus"></i> Add Task
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    {{-- LIST ALL TASK --}}
    <div class="row">
        <div class="col-sm-12">
            <!-- Current Tasks -->
            @if (count($tasks) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Current Tasks
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped task-table">

                            <!-- Table Headings -->
                            <thead>
                            <th>#</th>
                            <th>Task</th>
                            <th>Timestamp</th>
                            <th>&nbsp;</th>

                            </thead>

                            <!-- Table Body -->
                            <tbody>
                            @foreach ($tasks as $task)
                                <tr>
                                    <td>
                                        {{ $task->id }}
                                    </td>
                                    <!-- Task Name -->
                                    <td class="table-text">
                                        <form action="{{ url('/task/'.$task->id) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('PUT') }}
                                            <input type="text" class="form-control ip-task-name" name="name"
                                                   value="{{ $task->name }}">
                                            <div class="task-name">{{ $task->name }}</div>
                                        </form>
                                    </td>
                                    <td>{{ $task->created_at }}</td>
                                    <!-- Delete Button -->
                                    <td>
                                        <form action="{{ url('/task/'.$task->id) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}

                                            <button class="btn btn-sm btn-danger">Delete Task</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $tasks->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>


    <style type="text/css">
        .ip-task-name {
            display: none;
        }

        .active {
            display: inline-block;
        }
    </style>
    <script type="text/javascript">
        $(function () {
            $('.task-name').dblclick(function () {
                $(this).hide();
                $(this).prev('.ip-task-name').addClass('active');
            });

            $('body').on('blur', '.ip-task-name.active', function (e) {
                var task_name = $(this).next('.task-name').text();
                if (task_name == $(this).val()) {
                    $(this).removeClass('active');
                    $(this).next('.task-name').show();
                } else {
                    var confirm_status = confirm("Do you wish to update?");
                    if (confirm_status === true) {
                        $(this).parent('form').submit();
                    } else {
                        $(this).removeClass('active');
                        $(this).next('.task-name').show();
                    }
                }

            });

            $('#check-ajax').click(function (e) {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '{{ url('/checkAjax') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {name: 'Hello', _token: CSRF_TOKEN},
                    success: function (res) {
                        console.log(res);
                    },
                    error: function (res) {
                        console.error(res);
                    }
                })
            });

        });
    </script>

    <!-- TODO: Current Tasks -->
@endsection
@extends('Layouts.app')
@section('pageSpecificHead')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('plugins/fullcalendar/my-custom-file/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
@endsection
@section('App-MainContent')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">All Your Todos List</h3>
                        </div>
                        <div class="card-body p-0">
                            <!-- THE CALENDAR -->
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form action="{{ route('storeTodoList') }}" method="POST">
            @csrf
            @method('POST')
            <div class="modal fade" id="addTodoModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
                aria-labelledby="cashColateralLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="cashColateralLabel">Add New Todo</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="todoTitle">Title</label>
                                <input type="text" class="form-control" id="todoTitle" name="todoTitle"
                                    placeholder="Give the task a title">
                                <span class="text-danger">
                                    @error('todoTitle')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="todoDescription">Description</label>
                                <textarea class="form-control" rows="3" id="todoDescription" name="todoDescription"
                                    placeholder="Write some details"></textarea>
                                <span class="text-danger">
                                    @error('todoDescription')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <label>Start Time</label>
                                <div class="input-group date" id="todoStartDateAndTime" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" name="todoStartDateAndTime"
                                      id="todoStartDateAndTimeInput"  data-target="#todoStartDateAndTime" />
                                    <div class="input-group-append" data-target="#todoStartDateAndTime"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="endDateAndTime">End Time</label>
                                <div class="input-group date" id="todoEndDateAndTime" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" name="todoEndDateAndTime"
                                       id="todoEndDateAndTimeInput" data-target="#todoEndDateAndTime" />
                                    <div class="input-group-append" data-target="#todoEndDateAndTime"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="submitCashAmount" class="btn btn-primary">Submit</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <form action="{{ route('updateTodoList') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal fade" id="todoDetailModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
                aria-labelledby="cashColateralLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="cashColateralLabel">Todo Detail</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="todoTitleDetail">Title</label>
                                <input type="text" class="form-control" id="todoTitleDetail" name="todoTitleDetail"
                                    placeholder="Give the task a title">
                                <span class="text-danger">
                                    @error('todoTitleDetail')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="todoDescriptionDetail">Description</label>
                                <textarea class="form-control" rows="3" id="todoDescriptionDetail" name="todoDescriptionDetail"
                                    placeholder="Write some details"></textarea>
                                <span class="text-danger">
                                    @error('todoDescriptionDetail')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <label>Start Time</label>
                                <div class="input-group date" id="todoStartDateAndTimeOnEdit" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" name="todoStartDateAndTimeOnEdit"
                                      id="todoStartDateAndTimeInputDetail"  data-target="#todoStartDateAndTimeOnEdit" />
                                    <div class="input-group-append" data-target="#todoStartDateAndTimeOnEdit"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="endDateAndTime">End Time</label>
                                <div class="input-group date" id="todoEndDateAndTimeOnEdit" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" name="todoEndDateAndTimeOnEdit"
                                       id="todoEndDateAndTimeInputDetail" data-target="#todoEndDateAndTimeOnEdit" />
                                    <div class="input-group-append" data-target="#todoEndDateAndTimeOnEdit"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="submitCashAmount" class="btn btn-success">Done</button>
                            <button type="submit" id="submitCashAmount" class="btn btn-danger">Not Done</button>
                            <button type="submit" id="submitCashAmount" class="btn btn-primary">Update</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>


        <div class="modal fade" id="previousDateSelectionError" data-backdrop="static" data-keyboard="false"
            tabindex="-1" aria-labelledby="previousDateLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 style="color: red" class="modal-title" id="previousDateLabel">Error</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h3 style="color: red">You cannot select previous date/time.</h3>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('pageSpecificFooter')
    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery/my-custom-file/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- jQuery UI -->
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>

    <!-- Full calendar -->
    <script src="{{ asset('plugins/moment/my-custom-file/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/fullcalendar/my-custom-file/main.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script>
        $(function() {
            var SITEURL = "{{ url('/') }}";
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            //Todo start date and time picker todoEndDateAndTime
            $('#todoStartDateAndTime').datetimepicker({
                format: "YYYY-MM-DD hh:mm A",
                icons: {
                    time: 'far fa-clock'
                }
            });
            //Todo end date and time picker OnEdit
            $('#todoEndDateAndTime').datetimepicker({
                format: "YYYY-MM-DD hh:mm A",
                icons: {
                    time: 'far fa-clock'
                }
            });
            //Todo start date and time picker OnEdit
            $('#todoStartDateAndTimeOnEdit').datetimepicker({
                format: "YYYY-MM-DD hh:mm A",
                icons: {
                    time: 'far fa-clock'
                }
            });
            //Todo end date and time picker OnEdit
            $('#todoEndDateAndTimeOnEdit').datetimepicker({
                format: "YYYY-MM-DD hh:mm A",
                icons: {
                    time: 'far fa-clock'
                }
            });
            var calendar = $('#calendar').fullCalendar({
                events: SITEURL + '/todoList',
                displayEventTime: false,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay',
                },
                defaultView: 'month',
                selectable: true,
                select: function(start, end, allDay) {
                    // Restrict selection of previous dates
                    var check = $.fullCalendar.formatDate(start, "Y-MM-DD");
                    // Get todays date and check if the selected date is before today
                    var today = new Date();
                    today = moment(today).format('YYYY-MM-DD')
                    if (check < today) {
                        console.log('Date Expired');
                        $('#previousDateSelectionError').modal('show');
                    } else {
                    $('#addTodoModal').modal('show');
                    var endFormatted = $.fullCalendar.formatDate(end, "YYYY-MM-DD hh:mm A");
                    var start = $.fullCalendar.formatDate(start, "YYYY-MM-DD hh:mm A");
                    console.log('start date is: ');
                    console.log(start);
                    $('#todoStartDateAndTimeInput').val(start);
                    $('#todoEndDateAndTimeInput').val(endFormatted);
                    calendar.fullCalendar('unselect');
                    }
                },

                eventClick: function(event) {
                    $.ajax({
                        url: SITEURL + '/todoListAjax',
                        data: {
                            id: event.id,
                        },
                        type: 'POST',
                        success: function(response){
                            $('#todoDetailModal').modal('show');
                            $('#todoTitleDetail').val(response.title);
                            $('#todoDescriptionDetail').val(response.description);
                            $('#todoStartDateAndTimeInputDetail').val(response.start);
                            $('#todoEndDateAndTimeInputDetail').val(response.end);
                        }
                    });

                   
                },

            });
        });
    </script>
@endsection

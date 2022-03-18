<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Form Builder</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"/>
        <link rel="stylesheet" href="{{ asset('css/tether.min.css') }}"/>
        <link rel="stylesheet" href="{{ asset('css/font-awesome/css/font-awesome.min.css') }}"/>
        <link rel="stylesheet" href="{{ asset('css/form_builder.css') }}"/>
    </head>
    <body>
        <div class="container">
            <nav class="navbar navbar-light  bg-faded fixed-top">
                <div class="clearfix">
                    <div class="container">
                        <button style="cursor: pointer;display: none" class="btn btn-info export_html mt-2 pull-right">Export HTML</button>
                        <h3 class="mr-auto">Dynamic Form builder</h3>
                    </div>
                </div>
            </nav>
            <br/>
            <div class="clearfix"></div>
            <div class="form_builder" style="margin-top: 25px">
                <div class="row">
                    <div class="col-sm-2">
                        <nav class="nav-sidebar">
                            <ul class="nav">
                                <li class="form_bal_textfield">
                                    <a href="javascript:;">Text Field <i class="fa fa-plus-circle pull-right"></i></a>
                                </li>
                                <li class="form_bal_select">
                                    <a href="javascript:;">Select <i class="fa fa-plus-circle pull-right"></i></a>
                                </li>
                                <li class="form_bal_number">
                                    <a href="javascript:;">Number <i class="fa fa-plus-circle pull-right"></i></a>
                                </li>
                                <li class="form_bal_button">
                                    <a href="javascript:;">Button <i class="fa fa-plus-circle pull-right"></i></a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-md-5 bal_builder">
                        <div class="form_builder_area"></div>
                    </div>
                    <div class="col-md-5">
                        <div class="col-md-12">
                            <form id="form" action="#" class="form-horizontal">
                            <meta name="csrf-token" content="{{ csrf_token() }}" />
                            
                                <div class="preview"></div>
                                <div style="display: none" class="form-group plain_html"><textarea rows="50" class="form-control"></textarea></div>
                                <br>  @foreach($form->options as $field)
                                    @php
                                    $formField = json_decode(json_encode($field),true);
                                    @endphp

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="">{{ $formField['name'] }}</label>

                                            @switch($formField['type'])
                                                @case("select")
                                                    <select  name="{{ $formField['name'] }}" class="custom-select">
                                                        <option value="">Choose...</option>
                                                        <!-- @foreach(explode(",", $options->values) as $value)
                                                        <option value="{{ trim($value) }}" {{ old($field_name) == trim($value)? "selected" : "" }}>{{ trim($value) }}</option>
                                                        @endforeach -->
                                                    </select>
                                                    @break

                                                @default
                                                    <input type="{{ $formField['type'] }}" class="form-control" name="{{ $formField['name'] }}"  placeholder="{{ $formField['placeholder'] }}" value="{{ $formField['value'] }}" />
                                            @endswitch

                                        
                                            </div>                                        
                                        </div>
                                    </div>
                                @endforeach
                          <input type="submit" class="btn btn-primary" value="Create Form"/>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('js/tether.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/form_builder.js') }}"></script>
        <script>
                $("#form").on("submit", function(event) {
                    event.preventDefault();
                    console.log(event.target)
                    const a = [];
                    for(const element of event.target) {
                        const placeholder =element.getAttribute("placeholder")
                        const type=element.getAttribute("type")
                        const name=element.getAttribute("name")
                        const label = element.getAttribute("label")
                        const value = element.getAttribute("value")
                        a.push({placeholder, type, name, label,value})
                    }
                    $.ajax({
                        url: '{{url('/save-form')}}',
                        type: 'post',
                        contentType: "json",
                        processData: false,
                        success: function (data) {
                            // $('#target').html(data.msg);
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: JSON.stringify(a)
                    });
                 })
        </script>
    </body>
</html>

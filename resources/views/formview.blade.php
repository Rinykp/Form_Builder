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
                        <h4 class="mr-auto">View dynamic form</h4>
                    </div>
                </div>
            </nav>
            <br/>
            <div class="clearfix"></div>
            </br>
            
            @foreach($form->options as $field)
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

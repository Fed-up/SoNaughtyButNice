@extends('tmpl.admin')

@section('title'){{ $title }} @stop

@section('_head')
    <script type="text/javascript" src="/packages/jquery-1.11.1.min/vendor/jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/packages/jquery-1.11.1.min/vendor/jquery-ui-1.10.4.custom/css/no-theme/jquery-ui-1.10.4.custom.min.css"/> 

    <script>
        $(function() {

        $( "._mySortable" ).sortable({ 
        axis: "y", 
        opacity: 0.5,
        placeholder: "sortable-placeholder",
        // callback function
        update: function( event, ui ) {
            ui.item.css({'background':'#DBEEC9'})
            },
            });
            $( "._mySortable" ).disableSelection();
        });
    </script>

@stop

@section('content')
    <div class="row">
        <h1 class="page-header">@yield('title')</h1>

        @if(isset($data->id))
            {{ Form::open(array('action' => 'Admin_CategoriesController@postUpdateCategories', 'class' => 'form-horizontal')) }} 
        @else
            {{ Form::open(array('action' => 'Admin_CategoriesController@postAddCategories', 'class' => 'form-horizontal')) }} 
        @endif

        <ul id="myTab" class="nav nav-tabs">

            <li class="{{ ($tab_data == 'sav')? 'active' : '' ; }}"><a href="#savoury" data-toggle="tab">Savoury</a></li>
            <li class="{{ ($tab_data == 'sna')? 'active' : '' ; }}"><a href="#snack" data-toggle="tab">Snacks</a></li>
            <li class="{{ ($tab_data == 'des')? 'active' : '' ; }}"><a href="#dessert" data-toggle="tab">Dessert</a></li>
            <li class="{{ ($tab_data == 'ref')? 'active' : '' ; }}"><a href="#refreshment" data-toggle="tab">Refreshments</a></li>
        </ul>

        <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade in {{ ($tab_data == 'sav')? 'active' : '' ; }}" id="savoury">
                <table class="table table-striped">
                    <thead> 
                        <tr>
                            <th>#</td>
                            <th>Recipe Name</th>
                            <th></th>
                            <th>Savoury</th>
                            <th>Snack</th>
                            <th>Dessert</th>
                            <th>Refreshment</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($savoury as $recipe) 
                            <tr>
                                <td>{{ $recipe->id }}</td>
                                <td>{{ $recipe->name }}</td>
                                <td></td>
                                <td>
                                    @if($recipe->savoury == 1)
                                        {{ link_to('/admin/menu/savoury/'.$recipe->id, '', array('class' => 'btn btn-success glyphicon glyphicon-ok')) }}
                                    @else
                                        {{ link_to('/admin/menu/savoury/'.$recipe->id, '', array('class' => 'btn btn-danger glyphicon glyphicon-remove')) }}
                                    @endif
                                </td>
                                <td>
                                    @if($recipe->snack == 1)
                                        {{ link_to('/admin/menu/snack/'.$recipe->id, '', array('class' => 'btn btn-success glyphicon glyphicon-ok')) }}
                                    @else
                                        {{ link_to('/admin/menu/snack/'.$recipe->id, '', array('class' => 'btn btn-danger glyphicon glyphicon-remove')) }}
                                    @endif
                                </td>
                                <td>
                                    @if($recipe->dessert == 1)
                                        {{ link_to('/admin/menu/dessert/'.$recipe->id, '', array('class' => 'btn btn-success glyphicon glyphicon-ok')) }}
                                    @else
                                        {{ link_to('/admin/menu/dessert/'.$recipe->id, '', array('class' => 'btn btn-danger glyphicon glyphicon-remove')) }}
                                    @endif
                                </td>
                                <td>
                                    @if($recipe->refreshment == 1)
                                        {{ link_to('/admin/menu/refreshment/'.$recipe->id, '', array('class' => 'btn btn-success glyphicon glyphicon-ok')) }}
                                    @else
                                        {{ link_to('/admin/menu/refreshment/'.$recipe->id, '', array('class' => 'btn btn-danger glyphicon glyphicon-remove')) }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach   
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="20">
                                Total: {{ $recipes->count() }} 
                            </td>
                        </tr>
                    </tfoot>
                </table> 
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</td>
                            <th>Recipe Name</th>
                            <th></th>
                            <th>Savoury</th>
                            <th>Snack</th>
                            <th>Dessert</th>
                            <th>Refreshment</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recipes as $recipe)  
                            @if($recipe->savoury != 1) 
                            <tr>
                                <td>{{ $recipe->id }}</td>
                                <td>{{ $recipe->name }}</td>
                                <td></td>
                                <td>
                                    @if($recipe->savoury == 1)
                                        {{ link_to('/admin/menu/savoury/'.$recipe->id, '', array('class' => 'btn btn-success glyphicon glyphicon-ok')) }}
                                    @else
                                        {{ link_to('/admin/menu/savoury/'.$recipe->id, '', array('class' => 'btn btn-danger glyphicon glyphicon-remove')) }}
                                    @endif
                                </td>
                                <td>
                                    @if($recipe->snack == 1)
                                        {{ link_to('/admin/menu/snack/'.$recipe->id, '', array('class' => 'btn btn-success glyphicon glyphicon-ok')) }}
                                    @else
                                        {{ link_to('/admin/menu/snack/'.$recipe->id, '', array('class' => 'btn btn-danger glyphicon glyphicon-remove')) }}
                                    @endif
                                </td>
                                <td>
                                    @if($recipe->dessert == 1)
                                        {{ link_to('/admin/menu/dessert/'.$recipe->id, '', array('class' => 'btn btn-success glyphicon glyphicon-ok')) }}
                                    @else
                                        {{ link_to('/admin/menu/dessert/'.$recipe->id, '', array('class' => 'btn btn-danger glyphicon glyphicon-remove')) }}
                                    @endif
                                </td>
                                <td>
                                    @if($recipe->refreshment == 1)
                                        {{ link_to('/admin/menu/refreshment/'.$recipe->id, '', array('class' => 'btn btn-success glyphicon glyphicon-ok')) }}
                                    @else
                                        {{ link_to('/admin/menu/refreshment/'.$recipe->id, '', array('class' => 'btn btn-danger glyphicon glyphicon-remove')) }}
                                    @endif
                                </td>
                            </tr>
                            @endif
                        @endforeach   
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="20">
                                Total: {{ $recipes->count() }} 
                            </td>
                        </tr>
                    </tfoot>
                </table> 
            </div>
            <div class="tab-pane fade in {{ ($tab_data == 'sna')? 'active' : '' ; }}" id="snack">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</td>
                            <th>Recipe Name</th>
                            <th></th>
                            <th>Savoury</th>
                            <th>Snack</th>
                            <th>Dessert</th>
                            <th>Refreshment</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($snack as $recipe) 
                            <tr>
                                <td>{{ $recipe->id }}</td>
                                <td>{{ $recipe->name }}</td>
                                <td></td>
                                <td>
                                    @if($recipe->savoury == 1)
                                        {{ link_to('/admin/menu/savoury/'.$recipe->id, '', array('class' => 'btn btn-success glyphicon glyphicon-ok')) }}
                                    @else
                                        {{ link_to('/admin/menu/savoury/'.$recipe->id, '', array('class' => 'btn btn-danger glyphicon glyphicon-remove')) }}
                                    @endif
                                </td>
                                <td>
                                    @if($recipe->snack == 1)
                                        {{ link_to('/admin/menu/snack/'.$recipe->id, '', array('class' => 'btn btn-success glyphicon glyphicon-ok')) }}
                                    @else
                                        {{ link_to('/admin/menu/snack/'.$recipe->id, '', array('class' => 'btn btn-danger glyphicon glyphicon-remove')) }}
                                    @endif
                                </td>
                                <td>
                                    @if($recipe->dessert == 1)
                                        {{ link_to('/admin/menu/dessert/'.$recipe->id, '', array('class' => 'btn btn-success glyphicon glyphicon-ok')) }}
                                    @else
                                        {{ link_to('/admin/menu/dessert/'.$recipe->id, '', array('class' => 'btn btn-danger glyphicon glyphicon-remove')) }}
                                    @endif
                                </td>
                                <td>
                                    @if($recipe->refreshment == 1)
                                        {{ link_to('/admin/menu/refreshment/'.$recipe->id, '', array('class' => 'btn btn-success glyphicon glyphicon-ok')) }}
                                    @else
                                        {{ link_to('/admin/menu/refreshment/'.$recipe->id, '', array('class' => 'btn btn-danger glyphicon glyphicon-remove')) }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach   
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="20">
                                Total: {{ $recipes->count() }} 
                            </td>
                        </tr>
                    </tfoot>
                </table> 
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</td>
                            <th>Recipe Name</th>
                            <th></th>
                            <th>Savoury</th>
                            <th>Snack</th>
                            <th>Dessert</th>
                            <th>Refreshment</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recipes as $recipe)  
                            @if($recipe->snack != 1) 
                            <tr>
                                <td>{{ $recipe->id }}</td>
                                <td>{{ $recipe->name }}</td>
                                <td></td>
                                <td>
                                    @if($recipe->savoury == 1)
                                        {{ link_to('/admin/menu/savoury/'.$recipe->id, '', array('class' => 'btn btn-success glyphicon glyphicon-ok')) }}
                                    @else
                                        {{ link_to('/admin/menu/savoury/'.$recipe->id, '', array('class' => 'btn btn-danger glyphicon glyphicon-remove')) }}
                                    @endif
                                </td>
                                <td>
                                    @if($recipe->snack == 1)
                                        {{ link_to('/admin/menu/snack/'.$recipe->id, '', array('class' => 'btn btn-success glyphicon glyphicon-ok')) }}
                                    @else
                                        {{ link_to('/admin/menu/snack/'.$recipe->id, '', array('class' => 'btn btn-danger glyphicon glyphicon-remove')) }}
                                    @endif
                                </td>
                                <td>
                                    @if($recipe->dessert == 1)
                                        {{ link_to('/admin/menu/dessert/'.$recipe->id, '', array('class' => 'btn btn-success glyphicon glyphicon-ok')) }}
                                    @else
                                        {{ link_to('/admin/menu/dessert/'.$recipe->id, '', array('class' => 'btn btn-danger glyphicon glyphicon-remove')) }}
                                    @endif
                                </td>
                                <td>
                                    @if($recipe->refreshment == 1)
                                        {{ link_to('/admin/menu/refreshment/'.$recipe->id, '', array('class' => 'btn btn-success glyphicon glyphicon-ok')) }}
                                    @else
                                        {{ link_to('/admin/menu/refreshment/'.$recipe->id, '', array('class' => 'btn btn-danger glyphicon glyphicon-remove')) }}
                                    @endif
                                </td>
                            </tr>
                            @endif
                        @endforeach   
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="20">
                                Total: {{ $recipes->count() }} 
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="tab-pane fade in {{ ($tab_data == 'des')? 'active' : '' ; }}" id="dessert">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</td>
                            <th>Recipe Name</th>
                            <th></th>
                            <th>Savoury</th>
                            <th>Snack</th>
                            <th>Dessert</th>
                            <th>Refreshment</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dessert as $recipe) 
                            <tr>
                                <td>{{ $recipe->id }}</td>
                                <td>{{ $recipe->name }}</td>
                                <td></td>
                                <td>
                                    @if($recipe->savoury == 1)
                                        {{ link_to('/admin/menu/savoury/'.$recipe->id, '', array('class' => 'btn btn-success glyphicon glyphicon-ok')) }}
                                    @else
                                        {{ link_to('/admin/menu/savoury/'.$recipe->id, '', array('class' => 'btn btn-danger glyphicon glyphicon-remove')) }}
                                    @endif
                                </td>
                                <td>
                                    @if($recipe->snack == 1)
                                        {{ link_to('/admin/menu/snack/'.$recipe->id, '', array('class' => 'btn btn-success glyphicon glyphicon-ok')) }}
                                    @else
                                        {{ link_to('/admin/menu/snack/'.$recipe->id, '', array('class' => 'btn btn-danger glyphicon glyphicon-remove')) }}
                                    @endif
                                </td>
                                <td>
                                    @if($recipe->dessert == 1)
                                        {{ link_to('/admin/menu/dessert/'.$recipe->id, '', array('class' => 'btn btn-success glyphicon glyphicon-ok')) }}
                                    @else
                                        {{ link_to('/admin/menu/dessert/'.$recipe->id, '', array('class' => 'btn btn-danger glyphicon glyphicon-remove')) }}
                                    @endif
                                </td>
                                <td>
                                    @if($recipe->refreshment == 1)
                                        {{ link_to('/admin/menu/refreshment/'.$recipe->id, '', array('class' => 'btn btn-success glyphicon glyphicon-ok')) }}
                                    @else
                                        {{ link_to('/admin/menu/refreshment/'.$recipe->id, '', array('class' => 'btn btn-danger glyphicon glyphicon-remove')) }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach   
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="20">
                                Total: {{ $recipes->count() }} 
                            </td>
                        </tr>
                    </tfoot>
                </table> 
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</td>
                            <th>Recipe Name</th>
                            <th></th>
                            <th>Savoury</th>
                            <th>Snack</th>
                            <th>Dessert</th>
                            <th>Refreshment</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recipes as $recipe)  
                            @if($recipe->dessert != 1) 
                            <tr>
                                <td>{{ $recipe->id }}</td>
                                <td>{{ $recipe->name }}</td>
                                <td></td>
                                <td>
                                    @if($recipe->savoury == 1)
                                        {{ link_to('/admin/menu/savoury/'.$recipe->id, '', array('class' => 'btn btn-success glyphicon glyphicon-ok')) }}
                                    @else
                                        {{ link_to('/admin/menu/savoury/'.$recipe->id, '', array('class' => 'btn btn-danger glyphicon glyphicon-remove')) }}
                                    @endif
                                </td>
                                <td>
                                    @if($recipe->snack == 1)
                                        {{ link_to('/admin/menu/snack/'.$recipe->id, '', array('class' => 'btn btn-success glyphicon glyphicon-ok')) }}
                                    @else
                                        {{ link_to('/admin/menu/snack/'.$recipe->id, '', array('class' => 'btn btn-danger glyphicon glyphicon-remove')) }}
                                    @endif
                                </td>
                                <td>
                                    @if($recipe->dessert == 1)
                                        {{ link_to('/admin/menu/dessert/'.$recipe->id, '', array('class' => 'btn btn-success glyphicon glyphicon-ok')) }}
                                    @else
                                        {{ link_to('/admin/menu/dessert/'.$recipe->id, '', array('class' => 'btn btn-danger glyphicon glyphicon-remove')) }}
                                    @endif
                                </td>
                                <td>
                                    @if($recipe->refreshment == 1)
                                        {{ link_to('/admin/menu/refreshment/'.$recipe->id, '', array('class' => 'btn btn-success glyphicon glyphicon-ok')) }}
                                    @else
                                        {{ link_to('/admin/menu/refreshment/'.$recipe->id, '', array('class' => 'btn btn-danger glyphicon glyphicon-remove')) }}
                                    @endif
                                </td>
                            </tr>
                            @endif
                        @endforeach   
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="20">
                                Total: {{ $recipes->count() }} 
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="tab-pane fade in {{ ($tab_data == 'ref')? 'active' : '' ; }}" id="refreshment">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</td>
                            <th>Recipe Name</th>
                            <th></th>
                            <th>Savoury</th>
                            <th>Snack</th>
                            <th>Dessert</th>
                            <th>Refreshment</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($refreshment as $recipe) 
                            <tr>
                                <td>{{ $recipe->id }}</td>
                                <td>{{ $recipe->name }}</td>
                                <td></td>
                                <td>
                                    @if($recipe->savoury == 1)
                                        {{ link_to('/admin/menu/savoury/'.$recipe->id, '', array('class' => 'btn btn-success glyphicon glyphicon-ok')) }}
                                    @else
                                        {{ link_to('/admin/menu/savoury/'.$recipe->id, '', array('class' => 'btn btn-danger glyphicon glyphicon-remove')) }}
                                    @endif
                                </td>
                                <td>
                                    @if($recipe->snack == 1)
                                        {{ link_to('/admin/menu/snack/'.$recipe->id, '', array('class' => 'btn btn-success glyphicon glyphicon-ok')) }}
                                    @else
                                        {{ link_to('/admin/menu/snack/'.$recipe->id, '', array('class' => 'btn btn-danger glyphicon glyphicon-remove')) }}
                                    @endif
                                </td>
                                <td>
                                    @if($recipe->dessert == 1)
                                        {{ link_to('/admin/menu/dessert/'.$recipe->id, '', array('class' => 'btn btn-success glyphicon glyphicon-ok')) }}
                                    @else
                                        {{ link_to('/admin/menu/dessert/'.$recipe->id, '', array('class' => 'btn btn-danger glyphicon glyphicon-remove')) }}
                                    @endif
                                </td>
                                <td>
                                    @if($recipe->refreshment == 1)
                                        {{ link_to('/admin/menu/refreshment/'.$recipe->id, '', array('class' => 'btn btn-success glyphicon glyphicon-ok')) }}
                                    @else
                                        {{ link_to('/admin/menu/refreshment/'.$recipe->id, '', array('class' => 'btn btn-danger glyphicon glyphicon-remove')) }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach   
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="20">
                                Total: {{ $recipes->count() }} 
                            </td>
                        </tr>
                    </tfoot>
                </table> 
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</td>
                            <th>Recipe Name</th>
                            <th></th>
                            <th>Savoury</th>
                            <th>Snack</th>
                            <th>Dessert</th>
                            <th>Refreshment</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recipes as $recipe)  
                            @if($recipe->refreshment != 1) 
                            <tr>
                                <td>{{ $recipe->id }}</td>
                                <td>{{ $recipe->name }}</td>
                                <td></td>
                                <td>
                                    @if($recipe->savoury == 1)
                                        {{ link_to('/admin/menu/savoury/'.$recipe->id, '', array('class' => 'btn btn-success glyphicon glyphicon-ok')) }}
                                    @else
                                        {{ link_to('/admin/menu/savoury/'.$recipe->id, '', array('class' => 'btn btn-danger glyphicon glyphicon-remove')) }}
                                    @endif
                                </td>
                                <td>
                                    @if($recipe->snack == 1)
                                        {{ link_to('/admin/menu/snack/'.$recipe->id, '', array('class' => 'btn btn-success glyphicon glyphicon-ok')) }}
                                    @else
                                        {{ link_to('/admin/menu/snack/'.$recipe->id, '', array('class' => 'btn btn-danger glyphicon glyphicon-remove')) }}
                                    @endif
                                </td>
                                <td>
                                    @if($recipe->dessert == 1)
                                        {{ link_to('/admin/menu/dessert/'.$recipe->id, '', array('class' => 'btn btn-success glyphicon glyphicon-ok')) }}
                                    @else
                                        {{ link_to('/admin/menu/dessert/'.$recipe->id, '', array('class' => 'btn btn-danger glyphicon glyphicon-remove')) }}
                                    @endif
                                </td>
                                <td>
                                    @if($recipe->refreshment == 1)
                                        {{ link_to('/admin/menu/refreshment/'.$recipe->id, '', array('class' => 'btn btn-success glyphicon glyphicon-ok')) }}
                                    @else
                                        {{ link_to('/admin/menu/refreshment/'.$recipe->id, '', array('class' => 'btn btn-danger glyphicon glyphicon-remove')) }}
                                    @endif
                                </td>
                            </tr>
                            @endif
                        @endforeach   
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="20">
                                Total: {{ $recipes->count() }} 
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            
        </div>
        <hr>   	
        {{ Form::hidden('id', (isset($input['id'])? Input::old('id') : (isset($data->id)? $data->id : '' ))) }}
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
            {{ Form::submit('Save', array('class' => 'btn btn-success')) }}
            <a href="/admin/menu/categories/">
            {{ Form::button('Cancel' ,array('class' => 'btn btn-danger')) }}
            </a>
            </div>
        </div>       	
    </div>

@stop

@section('_tail')
@stop
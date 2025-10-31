@extends('agent.layout')

@includeIf('backend.partials.rtl_style')

@section('content')
    <div class="page-header">
        <h4 class="page-title">{{ __('Properties') }}</h4>
        <ul class="breadcrumbs">
            <li class="nav-home">
                <a href="{{ route('admin.dashboard', getParam()) }}">
                    <i class="flaticon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">{{ __('Property Management') }}</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">{{ __('Manage Properties') }}</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="card-title d-inline-block">{{ __('Properties') }}</div>
                        </div>

                        <div class="col-lg-3">
                            <form action="{{ route('agent.property_management.properties', getParam()) }}" method="get"
                                id="carSearchForm">
                                <div class="row">

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input type="text" name="title" value="{{ request()->input('title') }}"
                                                class="form-control" placeholder="{{ __('Enter title') }}">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                @includeIf('agent.partials.languages')
                            </div>
                        </div>
                        <div class="col-lg-3 mt-2 mt-lg-0">
                            <a href="{{ route('agent.property_management.type', getParam()) }}"
                                class="btn btn-primary btn-sm float-lg-right"><i class="fas fa-plus"></i>
                                {{ __('Add Property') }} </a>

                            <button class="btn btn-danger btn-sm float-lg-right mr-2 d-none bulk-delete"
                                data-href="{{ route('agent.property_management.bulk_delete_property', getParam()) }}"><i
                                    class="flaticon-interface-5"></i>
                                {{ __('Delete') }} </button>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            @if (count($properties) == 0)
                                <h3 class="text-center">
                                    {{ __('NO PROPERTIES ARE FOUND') }} </h3>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-striped mt-3">
                                        <thead>
                                            <tr>
                                                <th scope="col">
                                                    <input type="checkbox" class="bulk-check" data-val="all">
                                                </th>
                                                <th scope="col">{{ __('Title') }}</th>
                                                <th scope="col">{{ __('Type') }}</th>
                                                <th scope="col">{{ __('City') }}</th>
                                                <th scope="col">{{ __('Status') }}</th>
                                                <th scope="col">{{ __('Actions') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($properties as $property)
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" class="bulk-check"
                                                            data-val="{{ $property->id }}">
                                                    </td>


                                                    <td>

                                                        @if (!empty($property->title))
                                                            
                                                            {{ strlen(@$property->title) > 50 ? mb_substr(@$property->title, 0, 50, 'utf-8') . '...' : @$property->title }}
                                                            
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{ $property->type }}
                                                    </td>
                                                    <td>
                                                        {{ $property->city_name }}
                                                    </td>
                                                     
                                                    <td>
                                                        <form id="statusForm{{ $property->id }}" class="d-inline-block"
                                                            action="{{ route('agent.property_management.update_status', getParam()) }}"
                                                            method="post">
                                                            @csrf
                                                            <input type="hidden" name="propertyId"
                                                                value="{{ $property->id }}">

                                                            <select
                                                                class="form-control {{ $property->status == 1 ? 'bg-success' : 'bg-danger' }} form-control-sm"
                                                                name="status"
                                                                onchange="document.getElementById('statusForm{{ $property->id }}').submit();">
                                                                <option value="1"
                                                                    {{ $property->status == 1 ? 'selected' : '' }}>
                                                                    {{ __('Active') }}
                                                                </option>
                                                                <option value="0"
                                                                    {{ $property->status == 0 ? 'selected' : '' }}>
                                                                    {{ __('Inactive') }}
                                                                </option>
                                                            </select>
                                                        </form>
                                                    </td>

                                                    <td>
                                                        <div class="dropdown">
                                                            <button class="btn btn-secondary dropdown-toggle btn-sm"
                                                                type="button" id="dropdownMenuButton"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                {{ __('Select') }}
                                                            </button>

                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                                                <a class="dropdown-item"
                                                                    href="{{ route('agent.property_management.edit', [getParam(), $property->id]) }}">
                                                                    <span class="btn-label">
                                                                        <i class="fas fa-edit"></i>
                                                                        {{ __('Edit') }}
                                                                    </span>
                                                                </a>

                                                                <form class="deleteform d-inline-block dropdown-item"
                                                                    action="{{ route('agent.property_management.delete_property', getParam()) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    <input type="hidden" name="property_id"
                                                                        value="{{ $property->id }}">

                                                                    <button type="submit"
                                                                        class="p-0 deletebtn dropdown-item">
                                                                        <span class="btn-label">
                                                                            <i class="fas fa-trash-alt"></i>
                                                                            {{ __('Delete') }}
                                                                        </span>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    {{ $properties->appends([
                            'vendor_id' => request()->input('vendor_id'),
                            'title' => request()->input('title'),
                        ])->links() }}
                </div>

            </div>
        </div>
    </div>

@endsection

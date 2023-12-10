@extends('layouts.admin')

@section('title', 'فئة الفواتير')

@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span></h4>

<div class="row">
    <div class="col-md-12">
        <ul class="nav nav-pills flex-column flex-md-row mb-3">
            <li class="nav-item">
                {{-- <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> الخزن</a>
                --}}
            </li>
        </ul>
        <div class="card mb-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h5 class="m-0 font-weight-bold">تعديل فئة فواتير [<span class="">
                        {{ $sales_material_type->name}}</span>]
                </h5>

                <div class="d-flex align-items-center justify-content-between">
                    <a href="{{ route('backend.sales_material_types.index') }}" class=" btn btn-primary">
                        <span class="text font-weight-bold">فئات الفواتير</span>

                        <span class="">
                            <i class='bx bx-home'></i>
                        </span>
                    </a>

                </div>
            </div>
            <!-- Account -->

            <hr class="m-0" />

            <div class="card-body">

                <form id="formAccountSettings"
                    action="{{ route('backend.sales_material_types.update', $sales_material_type->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="name" class="form-label font-weight-bold">اسم فئة الفواتير</label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text" id="name"
                                name="name" value="{{ old('name', $sales_material_type->name) }}" autofocus />

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="active">حالة فئة الفواتير</label>
                            <select name="active" id="active" class="form-select @error('active') is-invalid @enderror">
                                <option value="1" {{ old('active', $sales_material_type->active) =='1' ? 'selected' :
                                    null }}>
                                    مفعل
                                </option>

                                <option value="0" {{ old('active', $sales_material_type->active) =='0' ? 'selected' :
                                    null }}>
                                    غير مفعل
                                </option>
                            </select>
                            @error('active')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2">تحديث</button>
                        <a href="{{ route('backend.sales_material_types.index') }}" class="btn btn-outline-secondary">
                            إلغاء
                        </a>
                    </div>
                </form>
            </div>
            <!-- /Account -->
        </div>

    </div>
</div>

@endsection
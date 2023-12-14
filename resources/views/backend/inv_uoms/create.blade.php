@extends('layouts.admin')

@section('title', 'الضبط العام')

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
                <h5 class="m-0 font-weight-bold">انشاء وحدة قياس جديدة</h5>

                <div class="d-flex align-items-center justify-content-between">
                    <a href="{{ route('backend.inv_uoms.index') }}" class=" btn btn-primary">
                        <span class="text font-weight-bold">وحدات القياس</span>

                        <span class="">
                            <i class='bx bx-home'></i>
                        </span>
                    </a>

                </div>
            </div>
            <!-- Account -->

            <hr class="m-0" />

            <div class="card-body">

                <form id="formAccountSettings" action="{{ route('backend.inv_uoms.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-md-4">
                            <label for="name" class="form-label font-weight-bold">اسم الوحدة</label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text" id="name"
                                name="name" value="{{ old('name') }}" autofocus />

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-4">
                            <label class="form-label" for="is_master">نوع الوحدة</label>
                            <select name="is_master" id="is_master"
                                class="form-select @error('is_master') is-invalid @enderror">
                                <option value="1" {{ old('is_master')=='1' ? 'selected' : null }}>
                                    رئيسية
                                </option>

                                <option value="0" {{ old('is_master')=='0' ? 'selected' : null }}>
                                    تجزئة
                                </option>
                            </select>
                            @error('is_master')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-4">
                            <label class="form-label" for="active">حالة التفعيل</label>
                            <select name="active" id="active" class="form-select @error('active') is-invalid @enderror">
                                <option value="1" {{ old('active')=='1' ? 'selected' : null }}>
                                    مفعل
                                </option>

                                <option value="0" {{ old('active')=='0' ? 'selected' : null }}>
                                    غير مفعل
                                </option>
                            </select>
                            @error('active')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>


                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary me-2">إنشاء</button>
                            <a href="{{ route('backend.inv_uoms.index') }}" class="btn btn-outline-secondary">إلغاء</a>
                        </div>
                    </div>
                    {{-- /.row --}}
                </form>
            </div>
            <!-- /Account -->
        </div>

    </div>
</div>

@endsection
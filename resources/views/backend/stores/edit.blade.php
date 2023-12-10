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
                <h5 class="m-0 font-weight-bold">تعديل مخزن [{{ $store->name }}]</h5>

                <div class="d-flex align-items-center justify-content-between">
                    <a href="{{ route('backend.stores.index') }}" class=" btn btn-primary">
                        <span class="text font-weight-bold">المخازن</span>

                        <span class="">
                            <i class='bx bx-home'></i>
                        </span>
                    </a>

                </div>
            </div>
            <!-- Account -->

            <hr class="m-0" />

            <div class="card-body">

                <form id="formAccountSettings" action="{{ route('backend.stores.update', $store->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="name" class="form-label font-weight-bold">اسم المخزن</label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text" id="name"
                                name="name" value="{{ old('name', $store->name) }}" autofocus />

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="phone" class="form-label font-weight-bold">هاتف المخزن</label>
                            <input class="form-control @error('phone') is-invalid @enderror" type="text" id="phone"
                                name="phone" value="{{ old('phone', $store->phone) }}" autofocus />

                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="address" class="form-label font-weight-bold">عنوان المخزن</label>
                            <input class="form-control @error('address') is-invalid @enderror" type="text" id="phone"
                                name="address" value="{{ old('address', $store->address) }}" autofocus />

                            @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="active">حالة التفعيل</label>
                            <select name="active" id="active" class="form-select @error('active') is-invalid @enderror">
                                <option value="1" {{ old('active', $store->active)=='1' ? 'selected' : null }}>
                                    مفعل
                                </option>

                                <option value="0" {{ old('active', $store->active)=='0' ? 'selected' : null }}>
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
                            <button type="submit" class="btn btn-primary me-2">تعديل</button>
                            <a href="{{ route('backend.stores.index') }}" class="btn btn-outline-secondary">إلغاء</a>
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

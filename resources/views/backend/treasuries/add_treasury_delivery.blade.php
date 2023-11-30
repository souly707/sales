@extends('layouts.admin')

@section('title', 'الخزن')

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
                <h5 class="m-0 font-weight-bold">إضافة الخزن الفرعية</h5>

                <div class="d-flex align-items-center justify-content-between">
                    <a href="{{ route('backend.treasuries.index') }}" class=" btn btn-primary">
                        <span class="text font-weight-bold">الخزن</span>

                        <span class="">
                            <i class='bx bx-home'></i>
                        </span>
                    </a>

                </div>
            </div>
            <!-- Account -->

            <hr class="m-0" />

            <div class="card-body">

                <form id="formAccountSettings" action="{{ route('backend.store.treasuries_delivery', $data->id) }}"
                    method="POST">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-md-8">
                            <label for="name" class="form-label font-weight-bold">
                                اضافة خزن للاستلام منها للخزنة [{{ $data->name }}]
                            </label>

                            <select name="treasury_can_delivery_id" id="treasury_can_delivery_id"
                                class="form-select @error('treasury_can_delivery_id') is-invalid @enderror">

                                <option value="">--اختر الخزنة--</option>
                                @forelse ($treasuries as $treasury)
                                <option value="{{ $treasury->id }}" {{ old('treasury_can_delivery_id')==$treasury->id
                                    ?'selected' : null }}>
                                    {{ $treasury->name }}
                                </option>
                                @empty

                                @endforelse
                            </select>

                            @error('treasury_can_delivery_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="col-md-4 mt-4">
                            <button type="submit" class="btn btn-primary me-2">إضافة</button>
                            <a href="{{ route('backend.treasuries.index') }}"
                                class="btn btn-outline-secondary">إلغاء</a>
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